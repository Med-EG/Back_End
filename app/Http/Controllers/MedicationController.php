<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medication;

class MedicationController extends Controller
{
    //Showing all data 
    public function index(){
        return Medication::all(); 
    }

    //Showing all data 
    public function show($id){
        $medicine = Medication::findOrFail($id);
        return $medicine; 
    }

    // Storing new Medicine 
    public function store(Request $request){
        Medication::create($request->all());
        return response()->json('Medicine Added successfully');
    }

    //Updating a Medicine
    public function update(Request $request,$id){
        $medicine=Medication::findOrFail($id);
        $medicine->update($request->all());
        return response()->json('Medicine Upadted successfully');
    }

    //Deleting a medicine
    public function destroy($id){
        $medicine=Medication::findOrFail($id);
        $medicine->delete();
        return response()->json('Medicine Deleted successfully');
    }
}
