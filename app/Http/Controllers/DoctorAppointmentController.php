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
        $appointment = DoctorAppointment::find($id);

        if (!$appointment) {
            return response()->json(['error' => 'DoctorAppointment not found'], 404);
        }
        return $appointment;
    }
    public function showByPatient($patientId)
    {
        $appointment = DoctorAppointment::with('patient')->where('patient_id', $patientId)->first();
        if (!$appointment) {
            return response()->json(['error' => 'DoctorAppointment not found'], 404);
        }
        return $appointment;
    }
    public function showByDoctor($doctorId)
    {
        $appointment = DoctorAppointment::with('doctor')->where('doctor_id', $doctorId)->first();
        if (!$appointment) {
            return response()->json(['error' => 'DoctorAppointment not found'], 404);
        }
        return $appointment;
    }
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
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
        $appointment = DoctorAppointment::find($id);
        if (!$appointment) {
            return response()->json(['error' => 'DoctorAppointment not found'], 404);
        }
        $appointment->delete();
    }
}
