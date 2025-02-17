<?php

namespace App\Services\GeneticAlgorithm;

use App\Events\TimetableComplete;
use App\Events\TimetablesGenerated;

use App\Models\Course;
use App\Models\ModelFront\Horario;
use App\Models\Room as RoomModel;
use App\Models\Timeslot as TimeslotModel;
use App\Models\Timetable as TimetableModel;
use App\Models\Professor as ProfessorModel;
use App\Models\CollegeClass as CollegeClassModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TimetableGA
{
    /**
     * Timetable we want to run the algorithm for
     *
     * @var App\Models\Timetable
     */
    protected $timetable;

    /**
     * Create a new instance of TimetableGA class
     *
     * @param App\Models\Timetable $timetable Timetable we want to run the algorithm
     *                                        to generate
     */
    public function __construct(TimetableModel $timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Create the problem instance for the algorithm
     *
     */
    public function initializeTimetable()
    {
        $maxContinuousSlots = 1;
        $timetable = new Timetable($maxContinuousSlots);

        // Set up rooms for the GA data using rooms data from DB
        $rooms = RoomModel::all();

        foreach ($rooms as $room) {
            $unavailableSlotIds = [];

            foreach ($room->unavailable_rooms as $timeslot) {
                $unavailableSlotIds[] = 'D' . $timeslot->day_id . 'T' . $timeslot->timeslot_id;
            }
            $timetable->addRoom($room->id, $unavailableSlotIds);
        }

        // Set up timeslots
        $days = $this->timetable->days;
        $timeslots = TimeslotModel::all();
        $count = 1;

        foreach ($days as $day) {
            foreach ($timeslots as $timeslot) {
                $timeslotId = 'D' . $day->id . "T" . $timeslot->id;
                $nextTimeslotId = $this->getNextTimeslotId($day, $timeslot);
                $timetable->addTimeslot($timeslotId, $nextTimeslotId);
            }
        }

        // Set up professors
        $professors = ProfessorModel::all();

        foreach ($professors as $professor) {
            $unavailableSlotIds = [];

            foreach ($professor->unavailable_timeslots as $timeslot) {
                $unavailableSlotIds[] = 'D' . $timeslot->day_id . 'T' . $timeslot->timeslot_id;
            }

            $timetable->addProfessor($professor->id, $unavailableSlotIds);
        }

        // Set up courses
        $results = DB::table('courses_classes')
            ->where('academic_period_id', $this->timetable->academic_period_id)
            ->selectRaw('distinct course_id')
            ->get();

        $semesterCourseIds = [];

        foreach ($results as $result) {
            $semesterCourseIds[] = $result->course_id;
        }

        $courses = Course::whereIn('id', $semesterCourseIds)->get();

        foreach ($courses as $course) {
            $professorIds  = [];

            foreach ($course->professors as $professor) {
                $professorIds[] = $professor->id;
            }

            $timetable->addModule($course->id, $professorIds);
        }

        // Set up class groups
        $classes = CollegeClassModel::all();

        foreach ($classes as $class) {
            $courseIds = [];
            $courses = $class->courses()->wherePivot('academic_period_id', $this->timetable->academic_period_id)->get();

            foreach ($courses as $course) {
                $courseIds[] = $course->id;
            }

            $timetable->addGroup($class->id, $courseIds);
        }

        return $timetable;
    }


    /**
     * Get the id of the next timeslot after the one given
     *
     */
    public function getNextTimeslotId($day, $timeslot)
    {
        $highestRank = TimeslotModel::count();
        $currentRank = (int)($timeslot->rank);
        $id = '';
        $endId = 'D0T0';

        if (($currentRank + 1) <= $highestRank) {
            $nextTimeslot = TimeslotModel::where('rank', ($currentRank + 1))->first();

            if ($nextTimeslot) {
                $id = 'D' . $day->id  . 'T' . $nextTimeslot->id;
            } else {
                $id = $endId;
            }
        } else {
            $id = $endId;
        }

        return $id;
    }

    /**
     * Run the timetable generation algorithm
     *
     */
    public function run()
    {
        try {

            Individual::$partialApplied = false;

            $maxGenerations = 400;

            $timetable = $this->initializeTimetable();

            $algorithm = new GeneticAlgorithm(150, 0.01, 0.9, 2, 10);

            $horario_id = $this->timetable->horario_id;

            $population = $algorithm->initPopulation($timetable, $horario_id);

            $algorithm->evaluatePopulation($population, $timetable);

            $generation = 1;

            while (
                !$algorithm->isTerminationConditionMet($population)
                && !$algorithm->isGenerationsMaxedOut($generation, $maxGenerations)
            ) {
                $fittest = $population->getFittest(0);

                print "Generation: " . $generation . "(" . $fittest->getFitness() . ") - ";
                Log::channel('simple')->info("Generation: ".$generation);
                print $fittest;
                print "\n";

                // Apply crossover
                $population = $algorithm->crossoverPopulation($population);

                // Apply mutation
                $population = $algorithm->mutatePopulation($population, $timetable);

                // Evaluate Population
                $algorithm->evaluatePopulation($population, $timetable);

                // Increment current
                $generation++;

                // Cool temperature of GA for simulated annealing
                $algorithm->coolTemperature();
            }

            $solution =  $population->getFittest(0);
            $scheme = $timetable->getScheme();
            $timetable->createClasses($solution);
            $classes = $timetable->getClasses();

            $this->timetable->update([
                'chromosome' => $solution->getChromosomeString(),
                'fitness' => $solution->getFitness(),
                'generations' => $generation,
                'scheme' => $scheme,
                'status' => 'COMPLETED'
            ]);
            $horario_id = $this->timetable->horario_id;
            $description = Horario::find($horario_id)->descricao ?? null;

            foreach ($classes as $class) {
                $groupId = $class->getGroupId();
                $timeslot = $timetable->getTimeslot($class->getTimeslotId());
                $dayId = $timeslot->getDayId();
                $timeslotId = $timeslot->getTimeslotId();
                $professorId = $class->getProfessorId();
                $moduleId = $class->getModuleId();
                $roomId = $class->getRoomId();
                $startTime = $timeslot->getStartTime();
                $endTime = $timeslot->getEndTime();
                $title = $class->getTitle();

                $this->timetable->schedules()->create([
                    'day_id' => $dayId,
                    'timeslot_id' => $timeslotId,
                    'professor_id' => $professorId,
                    'course_id' => $moduleId,
                    'class_id' => $groupId,
                    'room_id' => $roomId,
                    'horario_id' => $horario_id,
                    'startTime' => $startTime,
                    'endTime' => $endTime,
                    'title' => "Aula de ".$title,
                ]);
            }
            Cache::flush();
            event(new TimetableComplete($horario_id, $description, $this->timetable->user_id ));
            event(new TimetablesGenerated($this->timetable));
        } catch (\Throwable $th) {
            Log::error("Error while generating timetable " . $th->getMessage(), ['trace' => $th->getTrace()]);
        }
    }
}
