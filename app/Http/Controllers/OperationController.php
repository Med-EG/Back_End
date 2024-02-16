<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operation;

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
    public function store(Request $request){
        Operation::create($request->all());
        return response()->json('Operation Added successfully');
    }

    //Updating a Medicine
    public function update(Request $request,$id){
        $operation=Operation::findOrFail($id);
        $operation->update($request->all());
        return response()->json('Operation Upadted successfully');
    }

    //Deleting a medicine
    public function destroy($id){
        $operation=Operation::findOrFail($id);
        $operation->delete();
        return response()->json('Operation Deleted successfully');
    }
}
