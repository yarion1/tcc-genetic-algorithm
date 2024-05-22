<?php
namespace App\Services\GeneticAlgorithm;

use App\Models\ProfessorSchedule;

class Individual
{
    /**
     * This is the genetic makeup of an individual
     *
     * @var array
     */
    private $chromosome;


    /**
     * Fitness of the individual
     *
     * @var double
     */
    private $fitness;

    public static $partialApplied = false;

    /**
     * Create a new individual from a timetable
     *
     * @var Timetable The timetable
     */
    public function __construct($timetable = null, $horario_id = null)
    {

        if ($timetable) {

            if (!self::$partialApplied) {

                $courseIds = [];

                $partial = ProfessorSchedule::query()->select(['course_id', 'day_id', 'timeslot_id', 'room_id', 'professor_id'])->where('horario_id', $horario_id)->get();
                if($partial->isNotEmpty()){
                    foreach ($partial as $courseId){
                        $courseIds[$courseId->course_id] = $courseId;
                    }
                }
                ProfessorSchedule::where('horario_id', $horario_id)->delete();
                self::$partialApplied = true;
            } else {
                $partial = collect();
            }

            $newChromosome = [];
            $chromosomeIndex = 0;

            foreach ($timetable->getGroups() as $group) {
                foreach ($group->getModuleIds() as $moduleId) {
                    $module = $timetable->getModule($moduleId);
                    //print "\nOn Module " . $module->getModuleCode() . "\n";

                    for ($i = 1; $i <= $module->getSlots($group->getId()); $i++) {

                        if ($partial->isNotEmpty()  && isset($courseIds[$moduleId])) {
                            $schedule = $courseIds[$moduleId];
                            $timeslotId = 'D' . $schedule->day_id . 'T' . $schedule->timeslot_id;

                            $newChromosome[$chromosomeIndex] = $timeslotId;
                            $chromosomeIndex++;

                            $roomId = $schedule->room_id;
                            $newChromosome[$chromosomeIndex] = $roomId;
                            $chromosomeIndex++;

                            $professor = $schedule->professor_id;
                            $newChromosome[$chromosomeIndex] = $professor;
                            $chromosomeIndex++;

                        } else {
                            // Add random time slot
                            $timeslotId = $timetable->getRandomTimeslot()->getId();
                            $newChromosome[$chromosomeIndex] = $timeslotId;
                            $chromosomeIndex++;

                            // Add random room
                            $roomId = $timetable->getRandomRoom()->getId();
                            $newChromosome[$chromosomeIndex] = $roomId;
                            $chromosomeIndex++;

                            // Add random professor
                            $professor = $module->getRandomProfessorId();
                            $newChromosome[$chromosomeIndex] = $professor;
                            $chromosomeIndex++;
                        }

                        $module->increaseAllocatedSlots();
                        $timeslot = $timetable->getTimeslot($timeslotId);

                        $timeslotId = $timeslot->getNext();

                        while (($i + 1) <= $timetable->maxContinuousSlots && ($module->getSlots() != $module->getAllocatedSlots()) && ($timeslotId > -1)) {
                            $newChromosome[$chromosomeIndex] = $timeslotId;
                            $chromosomeIndex++;

                            $newChromosome[$chromosomeIndex] = $roomId;
                            $chromosomeIndex++;

                            $newChromosome[$chromosomeIndex] = $professor;
                            $chromosomeIndex++;

                            $timeslotId = $timetable->getTimeslot($timeslotId)->getNext();
                            $module->increaseAllocatedSlots();
                            $i += 1;
                        }
                    }
                }
            }

            foreach ($timetable->getModules() as $module) {
                $module->resetAllocated();
            }
        } else {
            $newChromosome = [];
        }

        $this->chromosome = $newChromosome;
    }

    /**
     * Create a new individual with a randomised chromosome
     *
     * @param int $chromosomeLength Desired chromosome length
     */
    public static function random($chromosomeLength)
    {
        $individual = new Individual();

        for ($i = 0; $i < $chromosomeLength; $i++) {
            $individual->setGene($i, mt_rand(0, 1));
        }

        return $individual;
    }

    /**
     * Get the individual's chromosome
     *
     * @return array The chromosome
     */
    public function getChromosome()
    {
        return $this->chromosome;
    }

    /**
     * Get the length of the individual's chromosome
     *
     * @return int The length
     */
    public function getChromosomeLength()
    {
        return count($this->chromosome);
    }

    /**
     * Fix a gene at the given location of the chromosome
     *
     * @param int $index The location to insert the gene
     * @param int $gene The gene
     */
    public function setGene($index, $gene)
    {
        $this->chromosome[$index] = $gene;
    }

    /**
     * Get the gene at the specified location
     *
     * @param int $index The location to get the gene at
     * @return int The bit representing the gene at that location
     */
    public function getGene($index)
    {
        return $this->chromosome[$index];
    }

    /**
     * Set the fitness param for this individual
     *
     * @param double $fitness The fitness of this individual
     */
    public function setFitness($fitness)
    {
        $this->fitness = $fitness;
    }

    /**
     * Get the fitness for this individual
     *
     * @return double The fitness of the individual
     */
    public function getFitness()
    {
        return $this->fitness;
    }

    /**
     * Get a printout of the individual
     *
     * @return string Output of the individual details
     */
    public function __toString()
    {
        return $this->getChromosomeString();
    }

    public function getChromosomeString()
    {
        return implode(",", $this->chromosome);
    }
}