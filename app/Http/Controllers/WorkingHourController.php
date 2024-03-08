<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\WorkingDay;
use Illuminate\Http\Request;
use App\Models\WorkingHour;
use Illuminate\Support\Facades\Validator;
class WorkingHourController extends Controller
{
    public function index()
    {
        $hour = WorkingHour::all();

        return $hour;
    }
    public function show($id)
    {
        $hour = WorkingHour::find($id);
        if (!$hour) {
            return response()->json(['error' => 'Wokring Hour not found'], 404);
        }
    
        return response()->json($hour);
    }
    public function showByDay($id)
    {
        $day = WorkingDay::find($id);
        if (!$day) {
            return response()->json(['error' => 'Working Day not found'], 404);
        }
    
        $hours = WorkingHour::where('working_day_id', $id)->get();
        return response()->json($hours);
    }
    public function showByDoctor($id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['error' => 'Doctor not found'], 404);
        }
    
        $hours = WorkingHour::where('doctor_id', $id)->get();
        return response()->json($hours);
    }
    public function store(Request $request)
    {
        $validatedData =Validator::make( $request->all(),[
            'working_day_id' => 'required|exists:working_days,working_day_id',
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
        $hour = WorkingHour::create($request->all());

        return $hour;
    }
    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            'working_day_id' => 'required|exists:working_days,working_day_id',
            'doctor_id'      => 'required|exists:doctors,doctor_id',
            'start_time'     => 'required|date_format:H:i',
            'end_time'       => 'required|date_format:H:i|after:start_time',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }

        $workingHour = WorkingHour::find($id);

        if (!$workingHour) {
            return response()->json(['error' => 'WorkingHour not found'], 404);
        }

        $workingHour->update($request->all());

        return $workingHour;
    }
    public function destroy($id)
    {
        $hour = WorkingHour::findOrFail($id);
        $hour->delete();
    }
}
