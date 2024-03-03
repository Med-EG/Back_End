<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
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
        $patient = Patient::findOrFail($id);
        return $patient;
    }
    //edit patient
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'username'       => 'required|string|unique:patients,username,' . $id . '|max:255',
            'password'       => 'required|string|min:6',
            'gender'         => 'required|string|max:255',
            'national_id'    => 'required|string|unique:patients,national_id,' . $id . '|max:255',
            'email'          => 'required|string|email|unique:patients,email,' . $id . '|max:255',
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

        $patient->update($request->all());

        return $patient;
    }
    //delete patient
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        return $patient->delete();
    }
}
