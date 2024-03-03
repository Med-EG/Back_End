<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    //Showing all Doctors 
    public function index(){
        return Doctor::all(); 
    }

    //Showing one Doctor 
    public function show($id){
        $doctor = Doctor::findOrFail($id);
        return $doctor; 
    }

    // Storing new Operation 
    public function store(Request $request){

        $validatedData =Validator::make( $request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:doctors',
            'password' => 'required',
            'gender' => 'required',
            'specialization' => 'required',
            'education' => 'required',
            'license_id' => 'required|unique:doctors',
            'country' => 'required',
            'city' => 'required',
            'street' => 'required',
            'years_of_experience' => 'required|integer',
            'scientific_degree' => 'required',
            'doctor_image' => 'required',
            'price' => 'required',
            'rating' => 'required'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
        $doctor = Doctor::create($request->all());

        return $doctor;
    }

    //Updating a Medicine
    public function update(Request $request,$id){
        $validatedData =Validator::make( $request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:doctors',
            'password' => 'required',
            'gender' => 'required',
            'specialization' => 'required',
            'education' => 'required',
            'license_id' => 'required|unique:doctors',
            'country' => 'required',
            'city' => 'required',
            'street' => 'required',
            'years_of_experience' => 'required|integer',
            'scientific_degree' => 'required',
            'doctor_image' => 'required',
            'price' => 'required',
            'rating' => 'required'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
        $doctor=Doctor::findOrFail($id);
        $doctor->update($request->all());
        return response()->json('Doctor Upadted successfully');
    }

    //Deleting a medicine
    public function destroy($id){
        $doctor=Doctor::findOrFail($id);
        $doctor->delete();
        return response()->json('Doctor Deleted successfully');
    }
}
