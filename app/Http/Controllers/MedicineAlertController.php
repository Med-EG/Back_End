<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicineAlert;
class MedicineAlertController extends Controller
{
    public function index()
    {
        $Medicine_Alerts = MedicineAlert::with('Patient')->get();
        return $Medicine_Alerts;
    }

    public function show($id)
    {
        $Medicine_Alert = MedicineAlert::with('Patient')->find($id);
        return $Medicine_Alert;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'patient_id' => 'required|exists:patients,patient_id',
            'medicine_name' => 'required',
            'medicine_dose' => 'required',
        ]);

        $Medicine_Alert = MedicineAlert::create($request->all());
        return $Medicine_Alert;
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'patient_id' => 'exists:patients,patient_id',
            'medicine_name' => 'required',
            'medicine_dose' => 'required',
        ]);

        $Medicine_Alert = MedicineAlert::find($id);
        $Medicine_Alert->update($request->all());
        return $Medicine_Alert;
    }

    public function destroy($id)
    {
        $Medicine_Alert = MedicineAlert::find($id);
        $Medicine_Alert->delete();
        return null;
    }
}
