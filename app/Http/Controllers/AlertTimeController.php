<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AlertTime;
use App\Models\MedicineAlert;
use Illuminate\Support\Facades\Validator;

class AlertTimeController extends Controller
{
    public function index()
    {
        $alertTimes = AlertTime::with('medicineAlert')->get();
        return $alertTimes;
    }

    public function show($id)
    {
        $alertTime = AlertTime::with('medicineAlert')->find($id);

        if (!$alertTime) {
            return response()->json(['error' => 'Alert time not found'], 404);
        }

        return $alertTime;
    }

    public function store(Request $request)
    {
        $validatedData =Validator::make( $request->all(),[
            'alert_id' => 'required|exists:medicine_alerts,alert_id',
            'alert_time' => 'required|date_format:H:i',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
      

        $alertTime = AlertTime::create($request->all());
        return $alertTime;
    }

    public function update(Request $request, $id)
    {
     
        $validatedData =Validator::make( $request->all(),[
            'alert_id' => 'required|exists:medicine_alerts,alert_id',
            'alert_time' => 'required|date_format:H:i',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }
        $alertTime = AlertTime::find($id);

        if (!$alertTime) {
            return response()->json(['error' => 'Alert time not found'], 404);
        }

        $alertTime->update($request->all());
        return $alertTime;
    }

    public function destroy($id)
    {
        $alertTime = AlertTime::find($id);

        if (!$alertTime) {
            return response()->json(['error' => 'Alert time not found'], 404);
        }

        return  $alertTime->delete();
    }
    public function getTimesForMedicineAlert($alertId)
{
    $medicineAlert = MedicineAlert::with('alertTimes')->find($alertId);

    if (!$medicineAlert) {
        return response()->json(['message' => 'Medicine alert not found'], 404);
    }

    return response()->json($medicineAlert->alertTimes);
}
}
