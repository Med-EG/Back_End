<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;

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
        $validatedData = $request->validate([
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
            'rating' => 'required',
        ]);

        $doctor = new Doctor();
        $doctor->first_name = $validatedData['first_name'];
        $doctor->last_name = $validatedData['last_name'];
        $doctor->email = $validatedData['email'];
        $doctor->password = bcrypt($validatedData['password']); // Hash the password
        $doctor->gender = $validatedData['gender'];
        $doctor->specialization = $validatedData['specialization'];
        $doctor->education = $validatedData['education'];
        $doctor->license_id = $validatedData['license_id'];
        $doctor->country = $validatedData['country'];
        $doctor->city = $validatedData['city'];
        $doctor->street = $validatedData['street'];
        $doctor->years_of_experince = $validatedData['years_of_experience'];
        $doctor->scientific_degree = $validatedData['scientific_degree'];
        $doctor->doctor_image = $validatedData['doctor_image'];
        $doctor->price = $validatedData['price'];
        $doctor->rating = $validatedData['rating'];

        $doctor->save();

        return response()->json($doctor, 201);
    
    }

    //Updating a Medicine
    public function update(Request $request,$id){
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
