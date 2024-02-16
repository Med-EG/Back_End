<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disease;

class DiseaseController extends Controller
{
    //Showing all data 
    public function index(){
        return Disease::all(); 
    }

    //Showing all data 
    public function show($id){
        $disease = Disease::findOrFail($id);
        return response()->json($disease); 
    }

    // Storing new Disease 
    public function store(Request $request){
        Disease::create($request->all());
        return response()->json('Disease Added successfully');
    }

    //Updating a Disease
    public function update(Request $request,$id){
        $disease=Disease::findOrFail($id);
        $disease->update($request->all());
        return response()->json('Disease Upadted successfully');
    }

    //Deleting a Disease
    public function destroy($id){
        $disease=Disease::findOrFail($id);
        $disease->delete();
        return response()->json('Disease Deleted successfully');
    }
}
