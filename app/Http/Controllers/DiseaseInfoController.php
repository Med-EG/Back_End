<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiseaseInfo;
use Illuminate\Support\Facades\Validator;

class DiseaseInfoController extends Controller
{
    public function index()
    {
        $medicine = DiseaseInfo::all();

        return $medicine;
    }
    public function show($id)
    {
        $diseaseInfo = DiseaseInfo::find($id);

        if (!$diseaseInfo) {
            return response()->json(['error' => 'Disease Info not found'], 404);
        }
        return $diseaseInfo;
    }
    public function showByRecord($id)
    {
        $diseaseInfo = DiseaseInfo::with('diseaseInfo')->where('medical_record_id', $id)->first();
        if (!$diseaseInfo) {
            return response()->json(['error' => 'Medical Record not found'], 404);
        }
        return $diseaseInfo;
    }
    public function showByDoctor($doctorId)
    {
        $diseaseInfo = DiseaseInfo::with('doctor')->where('doctor_id', $doctorId)->first();
        if (!$diseaseInfo) {
            return response()->json(['error' => 'Disease Info not found'], 404);
        }
        return $diseaseInfo;
    }
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'medicine_id' => 'required|exists:medications,medicine_id',
            'medical_record_id' => 'required|exists:basic_medical_info,medical_record_id',
            'doctor_id' => 'nullable|exists:doctors,doctor_id',
            'notes' => 'nullable|string'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
        $medicine = DiseaseInfo::create($request->all());

        return $medicine;
    }
    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            'medicine_id'       => 'required|exists:medications,medicine_id',
            'medical_record_id' => 'required|exists:basic_medical_info,medical_record_id',
            'doctor_id'         => 'nullable|exists:doctors,doctor_id',
            'notes'             => 'nullable|string',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }

        $medicineInfo = DiseaseInfo::find($id);

        if (!$medicineInfo) {
            return response()->json(['error' => 'DiseaseInfo not found'], 404);
        }

        $medicineInfo->update($request->all());

        return $medicineInfo;
    }

    public function destroy($id)
    {
        $medicine = DiseaseInfo::findOrFail($id);
        $medicine->delete();
    }
}
