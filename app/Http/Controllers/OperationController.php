<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operation;
use Illuminate\Support\Facades\Validator;


class OperationController extends Controller
{
    //Showing all data 
    public function index(){
        return Operation::all(); 
    }

    //Showing all data 
    public function show($id){
        $operation = Operation::findOrFail($id);
        return $operation; 
    }

    // Storing new Operation 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'operation_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $operation = Operation::create($request->only('operation_name'));

        return response()->json($operation, 201);
    }

    //Updating a Medicine
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'operation_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $operation = Operation::find($id);

        if (!$operation) {
            return response()->json(['error' => 'Operation not found'], 404);
        }

        $operation->update($request->only('operation_name'));

        return $operation;
    }

    //Deleting a medicine
    public function destroy($id){
        $operation=Operation::findOrFail($id);
        $operation->delete();
        return response()->json('Operation Deleted successfully');
    }
}
