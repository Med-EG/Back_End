<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OperationInfo;
use Illuminate\Support\Facades\Validator;

class OperationInfoController extends Controller
{
    public function index()
    {
        $operation = OperationInfo::all();

        return $operation;
    }
    public function show($id)
    {
        $operation = OperationInfo::findOrFail($id);
        return $operation;
    }
    public function showByRecord($recordId)
    {
        return OperationInfo::with('workingDay')->where('medical_record_id', $recordId)->firstOrFail();
    }
    public function showByDoctor($doctorId)
    {
        return OperationInfo::with('doctor')->where('doctor_id', $doctorId)->firstOrFail();
    }
    public function store(Request $request)
    {
        $validatedData =Validator::make( $request->all(),[
            'operation_id' => 'required|exists:operations,operation_id',
            'medical_record_id' => 'required|exists:basic_medical_info,medical_record_id',
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'operation_date' => 'required|date',
            'surgeon_name' => 'nullable|string',
            'operation_notes' => 'nullable|string',
            'complications' => 'nullable|string'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
        $operation = OperationInfo::create($request->all());

        return $operation;
    }
    public function update(Request $request, $id)
    {
        $operation = OperationInfo::findOrFail($id);
        $operation->update($request->all());

        return $operation;
    }
    public function destroy($id)
    {
        $operation = OperationInfo::findOrFail($id);
        $operation->delete();
    }
}
