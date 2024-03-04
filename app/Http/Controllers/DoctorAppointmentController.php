<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoctorAppointment;
use Illuminate\Support\Facades\Validator;

class DoctorAppointmentController extends Controller
{
    public function index()
    {
        $appointment = DoctorAppointment::all();

        return $appointment;
    }
    public function show($id)
    {
        $appointment = DoctorAppointment::findOrFail($id);
        return $appointment;
    }
    public function showByPatient($patientId)
    {
        return DoctorAppointment::with('patient')->where('patient_id', $patientId)->firstOrFail();
    }
    public function showByDoctor($doctorId)
    {
        return DoctorAppointment::with('doctor')->where('doctor_id', $doctorId)->firstOrFail();
    }
    public function store(Request $request)
    {
        $validatedData =Validator::make( $request->all(),[
            'patient_id' => 'required|exists:patients,patient_id',
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'working_hour_id' => 'required|string',
            'working_day_id' => 'required|string',

        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
        $appointment = DoctorAppointment::create($request->all());

        return $appointment;
    }
    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            'patient_id'       => 'required|exists:patients,patient_id',
            'doctor_id'        => 'required|exists:doctors,doctor_id',
            'working_hour_id'  => 'required|string',
            'working_day_id'   => 'required|string',
        ]);
    
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
    
        $appointment = DoctorAppointment::find($id);
    
        if (!$appointment) {
            return response()->json(['error' => 'DoctorAppointment not found'], 404);
        }
    
        $appointment->update($request->all());
    
        return $appointment;
    }
    
    public function destroy($id)
    {
        $appointment = DoctorAppointment::findOrFail($id);
        $appointment->delete();
    }
}
