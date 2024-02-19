<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicineAlert;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;

class MedicineAlertController extends Controller
{
    public function index()
    {
        $alerts = MedicineAlert::with('patient')->get();

        return $alerts;
    }

    public function show($alert_id)
    {
        $Medicine_Alert = MedicineAlert::with('Patient')->find($alert_id);
        return $Medicine_Alert;
    }
      //showing all el alerts for one patients
      public function getAllAlertsForPatient($patientId)
      {
          // Validate the patient ID
          $validator = Validator::make(['patient_id' => $patientId], [
              'patient_id' => 'required|exists:patients,patient_id',
          ]);
  
          if ($validator->fails()) {
              return response()->json(['error' => $validator->errors()], 400);
          }
  
          // Retrieve all alerts for the specified patient
          $alerts = MedicineAlert::where('patient_id', $patientId)->with('patient')->get();
  
          return $alerts;
      }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            'patient_id' => 'required|exists:patients,patient_id',
            'medicine_name' => 'required',
            'medicine_dose' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $Medicine_Alert = MedicineAlert::create($request->all());
        return $Medicine_Alert;
    }

    public function update(Request $request, $alertId)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,patient_id',
            'medicine_name' => 'required|string|max:255',
            'medicine_dose' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $alert = MedicineAlert::find($alertId);

        if ($alert) {
            $alert->update($request->all());
            return $alert;
        } else {
            return response()->json(['error' => 'Medicine alert not found.'], 404);
        }
    }
    public function destroy($alertId)
    {
        $Medicine_Alert = MedicineAlert::find($alertId);
     return   $Medicine_Alert->delete();
    }
}
