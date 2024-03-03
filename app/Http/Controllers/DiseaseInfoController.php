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
        $medicine = DiseaseInfo::findOrFail($id);
        return $medicine;
    }
    public function showByRecord($recordId)
    {
        return DiseaseInfo::with('workingDay')->where('medical_record_id', $recordId)->firstOrFail();
    }
    public function showByDoctor($doctorId)
    {
        return DiseaseInfo::with('doctor')->where('doctor_id', $doctorId)->firstOrFail();
    }
    public function store(Request $request)
    {
        $validatedData =Validator::make( $request->all(),[
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
        $medicine = DiseaseInfo::findOrFail($id);
        $medicine->update($request->all());

        return $medicine;
    }
    public function destroy($id)
    {
        $medicine = DiseaseInfo::findOrFail($id);
        $medicine->delete();
    }
}
