<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\WorkingDay;
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
        $validatedData = $request->validate([
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'day_of_week' => 'required',
        ]);

        $day = new WorkingDay();
        $day->doctor_id = $validatedData['doctor_id'];
        $day->day_of_week = $validatedData['day_of_week'];

        $day->save();
        return response()->json($day, 201);
    }

    //show a single day
    public function show($doctorId)
    {
        return WorkingDay::with('doctor')->where('doctor_id', $doctorId)->firstOrFail();
    }

    //updating a day
    public function update(Request $request, $id)
    {
        $day = WorkingDay::findOrFail($id);

        $validatedData = $request->validate([
            'day_of_week' => 'required',
        ]);

        $day->day_of_week = $validatedData['day_of_week'];
        
        $day->save();

        return response()->json($day, 200);
    }

    //delete a day
    public function destroy($id)
    {
        $day = WorkingDay::findOrFail($id);
        $day->delete();
        return response()->json(null, 204);
    }
}
