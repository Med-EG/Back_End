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
    public function show($contact_id)
    {
         $emergencyContacts  = PatientEmergencyContact::with('patient')->find($contact_id);
        return $emergencyContacts ;
    }
    // shows the emergency contacts for one patient
    public function getEmergencyContacts($patientId)
    {
        $patient = Patient::with('emergencyContacts')->find($patientId);

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
    public function update(Request $request, $contact_id)
    {
        $this->validate($request, [
            'patient_id' => 'exists:patients,patient_id',
            'emergency_contact' => 'integer',
            'contact_name' => 'string',
        ]);

        $emergencyContact = PatientEmergencyContact::find($contact_id);
        $emergencyContact->update($request->all());
        return $emergencyContact;
    }
    public function destroy($contact_id)
    {
        $emergencyContact = PatientEmergencyContact::find($contact_id);
       return $emergencyContact->delete();
        
    }
}
