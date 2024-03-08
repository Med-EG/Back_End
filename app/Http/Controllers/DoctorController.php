<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    //Showing all Doctors 
    public function index()
    {
        return Doctor::all();
    }

    //Showing one Doctor 
    public function show($id)
    {
        $validator = Validator::make(['doctor_id' => $id], [
            'doctor_id' => 'required|exists:doctors,doctor_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Doctor ID exists, retrieve the doctor
        $doctor = Doctor::find($id);

        // Return the doctor's information
        return response()->json(['doctor' => $doctor], 200);
    }



    //Updating a Medicine
    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
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
        $doctor = Doctor::findOrFail($id);

        $hashedPassword = Hash::make($request->password);

        $doctorImage = null;
        if ($request->hasFile('doctor_image')) {
            $image = $request->file('doctor_image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $doctorImage = 'images/'.$imageName;
        }
        

        $doctor->first_name = $request->first_name;
        $doctor->last_name = $request->last_name;
        $doctor->email = $request->email;
        $doctor->password = $hashedPassword;
        $doctor->gender = $request->gender;
        $doctor->specialization = $request->specialization;
        $doctor->education = $request->education;
        $doctor->license_id = $request->license_id;
        $doctor->country = $request->country;
        $doctor->city = $request->city;
        $doctor->street = $request->street;
        $doctor->years_of_experience = $request->years_of_experience;
        $doctor->scientific_degree = $request->scientific_degree;
        $doctor->doctor_image = $doctorImage;
        $doctor->price = $request->price;

        $doctor->save();

        return response()->json($doctor, 200);
    }

    public function specialization()
    {
        $specializations = [
            'Anesthesiology',
            'Cardiology',
            'Dermatology',
            'Endocrinology',
            'Gastroenterology',
            'Hematology',
            'Infectious Disease',
            'Internal Medicine',
            'Nephrology',
            'Neurology',
            'Obstetrics & Gynecology (OB/GYN)',
            'Oncology',
            'Ophthalmology',
            'Orthopedics',
            'Ear , Nose & Throat',
            'Pediatrics',
            'Physical Medicine & Rehabilitation (Physiatry)',
            'Psychiatry',
            'Pulmonology',
            'Radiology',
            'Rheumatology',
            'Urology',
        ];

        return response()->json(['specializations' => $specializations]);
    }

    //Deleting a medicine
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        if(!$doctor){
            return response()->json(['error' => 'Doctor not found']);    
        }
        $doctor->delete();
        return response()->json('Doctor Deleted successfully');
    }
}
