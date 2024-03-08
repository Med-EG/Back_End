<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PatientFaceId;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class PatientFaceIDController extends Controller
{
    public function index()
    {
        $faceIds = PatientFaceId::all();
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
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,patient_id',
            'face_image' => 'required|image',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $personalImage = null;
        if ($request->hasFile('face_image')) {
            $image = $request->file('face_image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $personalImage = 'images/' . $imageName;
        }

        $faceId = new PatientFaceId([
            "patient_id" => $request->patient_id,
            "face_image" => $personalImage
        ]);

        $faceId->save();

        return response()->json($faceId, 201);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,patient_id',
            'face_image' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $faceId = PatientFaceId::find($id);

        if (!$faceId) {
            return response()->json(['error' => 'PatientFaceId not found'], 404);
        }
        $personalImage = null;
        if ($request->hasFile('face_image')) {
            $image = $request->file('face_image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $personalImage = 'images/' . $imageName;
        }

        $faceId->update([
            "patient_id" => $request->patient_id,
            "face_image" => $personalImage
        ]);

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

    public function getFaceIdsForOnePatient($id)
    {
        $patient = Patient::with('patientFaceID')->find($id);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }

        return  $patient;
    }
}
