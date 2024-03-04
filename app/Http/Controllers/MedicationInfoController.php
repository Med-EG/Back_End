<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicationInfo;
use Illuminate\Support\Facades\Validator;
class MedicationInfoController extends Controller
{
    public function index()
    {
        $medicine = MedicationInfo::all();

        return $medicine;
    }
    public function show($id)
    {
        $medicine = MedicationInfo::findOrFail($id);
        return $medicine;
    }
    public function showByRecord($recordId)
    {
        return MedicationInfo::with('workingDay')->where('medical_record_id', $recordId)->firstOrFail();
    }
    public function showByDoctor($doctorId)
    {
        return MedicationInfo::with('doctor')->where('doctor_id', $doctorId)->firstOrFail();
    }
    public function store(Request $request)
    {
        $validatedData =Validator::make( $request->all(),[
            'medicine_id' => 'required|exists:medications,medicine_id',
            'medical_record_id' => 'required|exists:basic_medical_info,medical_record_id',
            'doctor_id' => 'nullable|exists:doctors,doctor_id',
            'dose' => 'required|string',
            'frequency' => 'required|string',
            'notes' => 'nullable|string'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
        $medicine = MedicationInfo::create($request->all());

        return $medicine;
    }
    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            'medicine_id'       => 'required|exists:medications,medicine_id',
            'medical_record_id' => 'required|exists:basic_medical_info,medical_record_id',
            'doctor_id'         => 'nullable|exists:doctors,doctor_id',
            'dose'              => 'required|string',
            'frequency'         => 'required|string',
            'notes'             => 'nullable|string',
        ]);
    
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
    
        $medicineInfo = MedicationInfo::find($id);
    
        if (!$medicineInfo) {
            return response()->json(['error' => 'MedicationInfo not found'], 404);
        }
    
        $medicineInfo->update($request->all());
    
        return $medicineInfo;
    }
    
    public function destroy($id)
    {
        $medicine = MedicationInfo::findOrFail($id);
        $medicine->delete();
    }
}
