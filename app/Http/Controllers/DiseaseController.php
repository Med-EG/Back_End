<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disease;
use Illuminate\Support\Facades\Validator;


class DiseaseController extends Controller
{
    //Showing all data 
    public function index(){
        return Disease::all(); 
    }

    //Showing all data 
    public function show($id){
        $disease = Disease::find($id);

        if (!$disease) {
            return response()->json(['error' => 'Disease not found'], 404);
        }
        return response()->json($disease); 
    }

    // Storing new Disease 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'disease_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $disease = Disease::create($request->only('disease_name'));

        return response()->json($disease, 201);
    }


    //Updating a Disease
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'disease_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $disease = Disease::find($id);

        if (!$disease) {
            return response()->json(['error' => 'Disease not found'], 404);
        }

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
