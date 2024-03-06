<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorAuthController extends Controller
{
    public function signup(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:doctors',
            'password' => 'required|min:8',
            'gender' => 'required|string',
            'specialization' => 'required|string',
            'education' => 'required|string',
            'license_id' => 'required|integer|unique:doctors',
            'country' => 'required|string',
            'city' => 'required|string',
            'street' => 'required|string',
            'scientific_degree' => 'required|string',
            'doctor_image' => 'required|image',
            'price' => 'required|numeric',
            'rating' => 'integer',
            'years_of_experience' => 'nullable|integer',
        ]);
        
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
        
        $doctorImage = null;
        if ($request->hasFile('doctor_image')) {
            $image = $request->file('doctor_image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $doctorImage = 'images/'.$imageName;
        }
        
        $hashedPassword = Hash::make($request->password);
        
        $doctor = new Doctor([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $hashedPassword,
            'gender' => $request->gender,
            'specialization' => $request->specialization,
            'education' => $request->education,
            'license_id' => $request->license_id,
            'country' => $request->country,
            'city' => $request->city,
            'street' => $request->street,
            'scientific_degree' => $request->scientific_degree,
            'doctor_image' => $doctorImage,
            'price' => $request->price,
            'rating' => $request->rating ?? 0,
            'years_of_experience' => $request->years_of_experience,
        ]);
        
        $doctor->save();
    
        
        return response()->json($doctor);
        
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $doctor = Doctor::where('email', $request->email)->first();
        if(!$doctor || ! Hash::check($request->password, $doctor->password)){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $token = $doctor->createToken('DoctorAccessToken')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
