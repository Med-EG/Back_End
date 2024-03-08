<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Allergies;
use Illuminate\Support\Facades\Validator;

class AllergiesController extends Controller
{
    //Showing all data 
    public function index()
    {
        return Allergies::all();
    }

    //Showing all data 
    public function show($id)
    {
        $allergy = Allergies::find($id);

    if (!$allergy) {
        return response()->json(['error' => 'Allergy not found'], 404);
    }
        return $allergy;
    }

    // Storing new Medicine 
    public function store(Request $request)
    {
        
        $validatedData = Validator::make($request->all(), [
            'allergy_name' => 'required|string|max:255',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
        Allergies::create($request->all());
        return response()->json('allergy Added successfully');
    }

    //Updating a Medicine
    public function update(Request $request, $id)
    {   
        $validatedData = Validator::make($request->all(), [
        'allergy_name' => 'required|string|max:255',
        ]);

        if ($validatedData->fails()) {
           return response()->json(['error' => $validatedData->errors()], 400);
        }

    $allergy = Allergies::find($id);

    if (!$allergy) {
        return response()->json(['error' => 'Allergy not found'], 404);
    }
        $allergy->update($request->all());
        return response()->json('allergy Upadted successfully');
    }

    //Deleting a medicine
    public function destroy($id)
    {
        $allergy = Allergies::findOrFail($id);
        $allergy->delete();
        return response()->json('allergy Deleted successfully');
    }
}
