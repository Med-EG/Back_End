<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PatientFaceId;
use App\Models\Patient;

class PatientFaceIDController extends Controller
{
    public function index()
    {
        $faceIds = PatientFaceId::with('patient')->get();
        return $faceIds;
    }

    public function show($id)
    {
        $faceId = PatientFaceId::with('patient')->find($id);

        if (!$faceId) {
            return response()->json(['error' => 'Face ID not found'], 404);
        }

        return $faceId;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'patient_id' => 'required|exists:patients,patient_id',
            'face_image' => 'required|string',
        ]);

        $faceId = PatientFaceId::create($request->all());
        return $faceId;
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'patient_id' => 'exists:patients,patient_id',
            'face_image' => 'string',
        ]);

        $faceId = PatientFaceId::find($id);

        if (!$faceId) {
            return response()->json(['error' => 'Face ID not found'], 404);
        }

        $faceId->update($request->all());
        return $faceId;
    }

    public function destroy($id)
    {
        $faceId = PatientFaceId::find($id);

        if (!$faceId) {
            return response()->json(['error' => 'Face ID not found'], 404);
        }

       return $faceId->delete();
      
    }
    
    public function getFaceIdsForOnePatient($patientId)
    {
        $patient = Patient::with('patientFaceID')->find($patientId);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }

     return  $patient;

       
    }
}
