<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine_Alert;
class Medicine_AlertController extends Controller
{
    public function index()
    {
        $Medicine_Alerts = Medicine_Alert::with('Patient')->get();
        return $Medicine_Alerts;
    }

    public function show($id)
    {
        $Medicine_Alert = Medicine_Alert::with('Patient')->find($id);
        return $Medicine_Alert;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'patient_id' => 'required|exists:patients,patient_id',
            'medicine_name' => 'required',
            'medicine_dose' => 'required',
        ]);

        $Medicine_Alert = Medicine_Alert::create($request->all());
        return $Medicine_Alert;
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'patient_id' => 'exists:patients,patient_id',
            'medicine_name' => 'required',
            'medicine_dose' => 'required',
        ]);

        $Medicine_Alert = Medicine_Alert::find($id);
        $Medicine_Alert->update($request->all());
        return $Medicine_Alert;
    }

    public function destroy($id)
    {
        $Medicine_Alert = Medicine_Alert::find($id);
        $Medicine_Alert->delete();
        return null;
    }
}
