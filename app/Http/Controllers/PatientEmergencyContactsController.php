<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PatientEmergencyContact;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;


class PatientEmergencyContactsController extends Controller
{
    //shows all the contacts
    public function index()
    {
         $emergencyContacts  = PatientEmergencyContact::with('patient')->get();
        return $emergencyContacts ;
    }
    // shows the details of one contact number
    public function show($id)
    {
         $emergencyContacts  = PatientEmergencyContact::with('patient')->find($id);
        return $emergencyContacts ;
    }
    // shows the emergency contacts for one patient
    public function getEmergencyContacts($id)
    {
        $patient = Patient::with('emergencyContacts')->find($id);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }

        $emergencyContacts = $patient->emergencyContacts;

        return $emergencyContacts;
    }
    // add new contact
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            'patient_id' => 'required|exists:patients,patient_id',
            'emergency_contact' => 'required|integer',
            'contact_name' => 'required|string',
        ]);
        
  
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }


        $emergencyContact = PatientEmergencyContact::create($request->all());
        return $emergencyContact;
    }

    // update certain contact
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'patient_id'       => 'required|exists:patients,patient_id',
            'emergency_contact'=> 'required|integer',
            'contact_name'     => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $emergencyContact = PatientEmergencyContact::find($id);

        if (!$emergencyContact) {
            return response()->json(['error' => 'EmergencyContact not found'], 404);
        }

        $emergencyContact->update($request->all());

        return $emergencyContact;
    }
    public function destroy($id)
    {
        $emergencyContact = PatientEmergencyContact::find($id);
       return $emergencyContact->delete();
        
    }
}
