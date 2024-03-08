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
        $operationInfo = OperationInfo::find($id);

        if (!$operationInfo) {
            return response()->json(['error' => 'OperationInfo not found'], 404);
        }
        return $operationInfo;
    }
    public function showByRecord($recordId)
    {
        $operationInfo = OperationInfo::with('operationInfo')->where('medical_record_id', $recordId)->firstOrFail();
        if (!$operationInfo) {
            return response()->json(['error' => 'OperationInfo not found'], 404);
        }
        return $operationInfo;
    }
    public function showByDoctor($doctorId)
    {
        $operationInfo = OperationInfo::with('doctor')->where('doctor_id', $doctorId)->firstOrFail();
        if (!$operationInfo) {
            return response()->json(['error' => 'OperationInfo not found'], 404);
        }
        return $operationInfo;
    }
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
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
        $operationInfo = OperationInfo::create($request->all());

        return $operationInfo;
    }
    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            'operation_id'     => 'required|exists:operations,operation_id',
            'medical_record_id' => 'required|exists:basic_medical_info,medical_record_id',
            'doctor_id'        => 'required|exists:doctors,doctor_id',
            'operation_date'   => 'required|date',
            'surgeon_name'     => 'nullable|string',
            'operation_notes'  => 'nullable|string',
            'complications'    => 'nullable|string',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }

        $operationInfo = OperationInfo::find($id);

        if (!$operationInfo) {
            return response()->json(['error' => 'OperationInfo not found'], 404);
        }

        $operationInfo->update($request->all());

        return $operationInfo;
    }

    public function destroy($id)
    {
        $operationInfo = OperationInfo::find($id);

        if (!$operationInfo) {
            return response()->json(['error' => 'OperationInfo not found'], 404);
        }
        $operationInfo->delete();
    }
}
