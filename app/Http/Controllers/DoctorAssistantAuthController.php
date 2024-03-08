<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoctorAssistant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class DoctorAssistantAuthController extends Controller
{
    public function signup(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'assistant_name' => 'required|string',
            'email' => 'required|email|unique:doctor_assistants,email',
            'password' => 'required|string|min:8',
        ]);
        
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
        
        $hashedPassword = Hash::make($request->password);
        
        $doctor = new DoctorAssistant([
            'doctor_id' => $request->doctor_id,
            'assistant_name' => $request->assistant_name,
            'email' => $request->email,
            'password' => $hashedPassword,
        ]);
        
        $doctor->save();
        
        $token = $doctor->createToken('DoctorAssistantAccessToken')->plainTextToken;
        
        return response()->json(['token' => $token]);
        
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $doctor = DoctorAssistant::where('email', $request->email)->first();
        if(!$doctor || ! Hash::check($request->password, $doctor->password)){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $token = $doctor->createToken('DoctorAssistantAccessToken')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
