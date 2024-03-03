<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\WorkingDay;
use Illuminate\Support\Facades\Validator;

class WorkingDayController extends Controller
{
    //Showing all days
    public function index()
    {
        $days = WorkingDay::all();

        return $days;
    }

    //showing all el days for one doctor
    public function one_doc($doctorId)
    {
        $doctor = Doctor::find($doctorId);
        if (!$doctor) {
            return response()->json(['error' => 'Doctor not found'], 404);
        }
    
        $day = WorkingDay::where('doctor_id', $doctorId)->get();
        return response()->json($day);
    }

    //storing new assistant
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id'   => 'required|exists:doctors,doctor_id',
            'day_of_week' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $workingDay = WorkingDay::create($request->all());

        return response()->json($workingDay, 201);
    }
    //show a single day
    public function show($doctorId)
    {
        return WorkingDay::with('doctor')->where('doctor_id', $doctorId)->firstOrFail();
    }

    //updating a day
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id'   => 'required|exists:doctors,doctor_id',
            'day_of_week' => 'required|string', 
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $workingDay = WorkingDay::find($id);

        if (!$workingDay) {
            return response()->json(['error' => 'WorkingDay not found'], 404);
        }

        $workingDay->update($request->all());

        return $workingDay;
    }

    //delete a day
    public function destroy($id)
    {
        $day = WorkingDay::findOrFail($id);
        $day->delete();
        return response()->json(null, 204);
    }
}
