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
        $patient = Patient::find($id);
        return $patient;
    }
    //store patient
    public function store(Request $request)
    {
        $patient = Patient::create($request->all());
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
       return Patient::destroy($id);
    }
}
