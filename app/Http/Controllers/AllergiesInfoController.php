<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AllergiesInfo;
use Illuminate\Support\Facades\Validator;


class AllergiesInfoController extends Controller
{
    public function index()
    {
        $allergy = AllergiesInfo::all();

        return $allergy;
    }
    public function show($id)
    {
        $allergy = AllergiesInfo::findOrFail($id);
        return $allergy;
    }
    public function showByRecord($recordId)
    {
        return AllergiesInfo::with('workingDay')->where('medical_record_id', $recordId)->firstOrFail();
    }
    public function showByDoctor($doctorId)
    {
        return AllergiesInfo::with('doctor')->where('doctor_id', $doctorId)->firstOrFail();
    }
    public function store(Request $request)
    {
        $validatedData =Validator::make( $request->all(),[
            'allergy_id' => 'required|exists:allergies,allergy_id',
            'medical_record_id' => 'required|exists:basic_medical_info,medical_record_id',
            'doctor_id' => 'nullable|exists:doctors,doctor_id',
            'allergy_type' => 'required|string',
            'severity_level' => 'nullable|string',
            'body_response' => 'nullable|string'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
        $allergyInfo = AllergiesInfo::create($request->all());

        return $allergyInfo;
    }
    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            'allergy_id'      => 'required|exists:allergies,allergy_id',
            'medical_record_id' => 'required|exists:basic_medical_info,medical_record_id',
            'doctor_id'       => 'nullable|exists:doctors,doctor_id',
            'allergy_type'    => 'required|string',
            'severity_level'  => 'nullable|string',
            'body_response'   => 'nullable|string',
        ]);
    
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
    
        $allergyInfo = AllergiesInfo::find($id);
    
        if (!$allergyInfo) {
            return response()->json(['error' => 'AllergiesInfo not found'], 404);
        }
    
        $allergyInfo->update($request->all());
    
        return $allergyInfo;
    }
    
    public function destroy($id)
    {
        $allergy = AllergiesInfo::findOrFail($id);
        $allergy->delete();
    }
}
