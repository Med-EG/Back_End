<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

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
        $patient = Patient::find($id);
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
