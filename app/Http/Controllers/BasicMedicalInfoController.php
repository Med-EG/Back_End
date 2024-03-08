<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BasicMedicalInfo;
use Illuminate\Support\Facades\Validator;


class BasicMedicalInfoController extends Controller
{
    public function index()
    {
        $medicalInfos = BasicMedicalInfo::all();

        return $medicalInfos;
    }
    public function show($patientId)
    {
        $medicalInfo = BasicMedicalInfo::with('patient')->where('patient_id', $patientId)->first();
        if (!$medicalInfo) {
            return response()->json(['error' => 'BasicMedicalInfo not found'], 404);
        }
        return $medicalInfo;
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,patient_id', // Ensure patient_id exists in the patients table
            'weight' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
            'blood_type' => 'required|string|max:255',
            'alcoholic' => 'required|boolean',
            'alcoholic_level' => 'required|string|max:255',
            'smoker' => 'required|boolean',
            'smoking_level' => 'required|string|max:255',
            'job' => 'required|string|max:255',
            'marital_status' => 'required|string|max:255',
            'past_fracrues' => 'nullable|string',
            'sleeping_hours' => 'nullable|string|max:255',
            'sleeping_quality' => 'nullable|string|max:255',
            'father' => 'required|string',
            'mother' => 'required|string',
            'second_degree' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $medicalInfo = BasicMedicalInfo::create($request->all());

        return $medicalInfo;
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'patient_id'      => 'required|exists:patients,patient_id',
            'weight'          => 'required|numeric|min:0',
            'height'          => 'required|numeric|min:0',
            'blood_type'      => 'required|string|max:255',
            'alcoholic'       => 'required|boolean',
            'alcoholic_level' => 'required|string|max:255',
            'smoker'          => 'required|boolean',
            'smoking_level'   => 'required|string|max:255',
            'job'             => 'required|string|max:255',
            'marital_status'  => 'required|string|max:255',
            'past_fracrues'   => 'nullable|string',
            'sleeping_hours'  => 'nullable|string|max:255',
            'sleeping_quality'=> 'nullable|string|max:255',
            'father'          => 'required|string',
            'mother'          => 'required|string',
            'second_degree'   => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        $medicalInfo = BasicMedicalInfo::find($id);
    
        if (!$medicalInfo) {
            return response()->json(['error' => 'BasicMedicalInfo not found'], 404);
        }
    
        $medicalInfo->update($request->all());
    
        return $medicalInfo;
    }
    
    public function destroy($id)
    {
        $medicalInfo = BasicMedicalInfo::find($id);
        if (!$medicalInfo) {
            return response()->json(['error' => 'BasicMedicalInfo not found'], 404);
        }
        $medicalInfo->delete();
    }
}
