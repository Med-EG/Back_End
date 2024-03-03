<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medication;
use Illuminate\Support\Facades\Validator;


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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'medication_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

   
        Medication::create($request->all());
        return response()->json('Medicine Added successfully');
    }


    //Updating a Medicine
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'medication_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $medication = Medication::find($id);

        if (!$medication) {
            return response()->json(['error' => 'Medication not found'], 404);
        }
        $medication->update($request->all());
        return response()->json('Medicine Upadted successfully');
    }


    //Deleting a medicine
    public function destroy($id){
        $medicine=Medication::findOrFail($id);
        $medicine->delete();
        return response()->json('Medicine Deleted successfully');
    }
}
