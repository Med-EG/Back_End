<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class PatientAuthController extends Controller
{
    public function signup(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string|unique:patients,username',
            'password' => 'required|string|min:8',
            'gender' => 'required|string',
            'national_id' => 'required|integer|unique:patients,national_id',
            'email' => 'required|email|unique:patients,email',
            'address' => 'required|string',
            'birth_date' => 'required|date',
            'phone_number' => 'required|numeric',
            'Personal_image' => 'required|string',
        ]);
        
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
        
        $personalImage = null;
        if ($request->hasFile('personal_image')) {
            $image = $request->file('personal_image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $personalImage = 'images/'.$imageName;
        }

        $hashedPassword = Hash::make($request->password);
        
        $patient = new Patient([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'password' => $hashedPassword,
            'gender' => $request->gender,
            'national_id' => $request->national_id,
            'email' => $request->email,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'phone_number' => $request->phone_number,
            'personal_image' => $personalImage,
        ]);
        
        $patient->save();
        
        $token = $patient->createToken('PatientAccessToken')->plainTextToken;
        
        return response()->json(['token' => $token]);
        
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $patient = Patient::where('email', $request->email)->first();
        if(!$patient || ! Hash::check($request->password, $patient->password)){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $token = $patient->createToken('PatientAccessToken')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
