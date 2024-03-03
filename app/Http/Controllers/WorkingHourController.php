<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        $hour = WorkingHour::findOrFail($id);
        return $hour;
    }
    public function showByDay($dayId)
    {
        return WorkingHour::with('workingDay')->where('working_day_id', $dayId)->firstOrFail();
    }
    public function showByDoctor($doctorId)
    {
        return WorkingHour::with('doctor')->where('doctor_id', $doctorId)->firstOrFail();
    }
    public function store(Request $request)
    {
        $validatedData =Validator::make( $request->all(),[
            'working_day_id' => 'required|exists:working_days,working_day_id',
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
        $hour = WorkingHour::create($request->all());

        return $hour;
    }
    public function update(Request $request, $id)
    {
        $hour = WorkingHour::findOrFail($id);
        $hour->update($request->all());

        return $hour;
    }
    public function destroy($id)
    {
        $hour = WorkingHour::findOrFail($id);
        $hour->delete();
    }
}
