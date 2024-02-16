<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Allergies;

class AllergiesController extends Controller
{
    //Showing all data 
    public function index(){
        return Allergies::all(); 
    }

    //Showing all data 
    public function show($id){
        $allergy = Allergies::findOrFail($id);
        return $allergy; 
    }

    // Storing new Medicine 
    public function store(Request $request){
        Allergies::create($request->all());
        return response()->json('allergy Added successfully');
    }

    //Updating a Medicine
    public function update(Request $request,$id){
        $allergy=Allergies::findOrFail($id);
        $allergy->update($request->all());
        return response()->json('allergy Upadted successfully');
    }

    //Deleting a medicine
    public function destroy($id){
        $allergy=Allergies::findOrFail($id);
        $allergy->delete();
        return response()->json('allergy Deleted successfully');
    }
}
