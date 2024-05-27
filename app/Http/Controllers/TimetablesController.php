<?php

namespace App\Http\Controllers;

use App\Services\GeneticAlgorithm\TimetableGA;
use Illuminate\Http\Request;
use App\Services\TimetableService;
use App\Events\TimetablesRequested;

use App\Models\Day;
use App\Models\Timetable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TimetablesController extends Controller
{

    protected TimetableService $service;

    public function __construct(TimetableService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $timetables = Timetable::orderBy('created_at', 'DESC')->paginate(10);

        return view('dashboard.timetables', compact('timetables'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'academic_period_id' => 'required',
            'horario_id' => 'required'
        ];

        $messages = [
            'academic_period_id.required' => 'An academic period must be selected',
            'horario_id.required' => 'horario_id is required'
        ];

        $this->validate($request, $rules, $messages);

        $errors = [];
        $dayIds = [];

        $days = Day::all();

        foreach ($days as $day) {
            if ($request->has('day_' . $day->id)) {
                $dayIds[] = $day->id;
            }
        }

        if (!count($dayIds)) {
            $errors[] = 'At least one day should be selected';
        }

        if (count($errors)) {
            return response()->json(['errors' => $errors], 422);
        }

        $otherChecks = $this->service->checkCreationConditions();

        if (count($otherChecks)) {
            return response()->json(['errors' => $otherChecks], 422);
        }

        $timetable = Timetable::where('horario_id', $request->horario_id)->first() ?? Timetable::create([
            'user_id' => Auth::user()->id,
            'academic_period_id' => $request->academic_period_id,
            'status' => 'IN PROGRESS',
            'name' => $request->name,
            'horario_id' => $request->horario_id
        ]);

        if ($timetable) {
            $timetable->days()->sync($dayIds);
        }

        event(new TimetablesRequested($timetable));

        return response()->json(['message' => 'Timetables are being generated.Check back later'], 200);
    }

    public function view($id)
    {
        $timetable = Timetable::find($id);

        if (!$timetable) {
            return redirect('/');
        } else {
            $path = $timetable->file_url;
            $timetableData =  Storage::get($path);
            $timetableName = $timetable->name;
            return view('timetables.view', compact('timetableData', 'timetableName'));
        }
    }
}
