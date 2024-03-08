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

    public function show($id)
    {
        $Medicine_Alert = MedicineAlert::with('Patient')->find($id);
        if (!$Medicine_Alert) {
            return response()->json(['error' => 'MedicineAlert not found'], 404);
        }
        return $Medicine_Alert;
    }
      //showing all el alerts for one patients
      public function getAllAlertsForPatient($id)
      {
          // Validate the patient ID
          $validator = Validator::make(['patient_id' => $id], [
              'patient_id' => 'required|exists:patients,patient_id',
          ]);
  
          if ($validator->fails()) {
              return response()->json(['error' => $validator->errors()], 400);
          }
  
          // Retrieve all alerts for the specified patient
          $alerts = MedicineAlert::where('patient_id', $id)->with('patient')->get();
  
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'patient_id'     => 'required|exists:patients,patient_id',
            'medicine_name'  => 'required',
            'medicine_dose'  => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        $medicineAlert = MedicineAlert::find($id);
    
        if (!$medicineAlert) {
            return response()->json(['error' => 'MedicineAlert not found'], 404);
        }
    
        $medicineAlert->update($request->all());
    
        return $medicineAlert;
    }
    
    public function destroy($id)
    {
        $Medicine_Alert = MedicineAlert::find($id);
     return   $Medicine_Alert->delete();
    }
}
