<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class PatientController extends Controller
{ 
    // return all patients
    public function index()
    {
        $patients = Patient::all();
        return $patients;
    }
    //return single patient
    public function show($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }
        return $patient;
    }
    //edit patient
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'username'       => 'required|string|unique:patients|max:255',
            'password'       => 'required|string|min:6',
            'gender'         => 'required|string|max:255',
            'national_id'    => 'required|string|unique:patients,national_id|max:255',
            'email'          => 'required|string|email|unique:patients,email|max:255',
            'address'        => 'required|string|max:255',
            'birth_date'     => 'required|date',
            'phone_number'   => 'required|string|max:255',
            'Personal_image' => 'nullable|string', 
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }

        $personalImage = null;
        if ($request->hasFile('personal_image')) {
            $image = $request->file('personal_image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $personalImage = 'images/'.$imageName;
        }

        $hashedPassword = Hash::make($request->password);
        
        $patient->update([
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

        return $patient;
    }
    //delete patient
    public function destroy($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }
        return $patient->delete();
    }
}
