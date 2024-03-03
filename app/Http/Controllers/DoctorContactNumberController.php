<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoctorContactNumber;
use App\Models\Doctor;
use Illuminate\Support\Facades\Validator;


class DoctorContactNumberController extends Controller
{
    //Showing all numbers
    public function index()
    {
        $number = DoctorContactNumber::all();

        return $number;
    }

    //showing all el numbers for one doctor
    public function showByDoctor($doctorId)
    {
        $doctor = Doctor::find($doctorId);
        if (!$doctor) {
            return response()->json(['error' => 'Doctor not found'], 404);
        }
    
        $number = DoctorContactNumber::where('doctor_id', $doctorId)->get();
        return response()->json($number);
    }

    //storing new number
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id'      => 'required|exists:doctors,doctor_id',
            'contact_number' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $doctorContact = DoctorContactNumber::create($request->all());

        return response()->json($doctorContact, 201);
    }

    //show a single number
    public function showById($id)
    {
        $number = DoctorContactNumber::findOrFail($id);
        return response()->json($number, 200);
        
    }

    //updating a number
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id'      => 'required|exists:doctors,doctor_id',
            'contact_number' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $doctorContact = DoctorContactNumber::find($id);

        if (!$doctorContact) {
            return response()->json(['error' => 'DoctorContact not found'], 404);
        }

        $doctorContact->update($request->all());

        return $doctorContact;
    }

    //delete a day
    public function destroy($id)
    {
        $number = DoctorContactNumber::findOrFail($id);
        $number->delete();
        return response()->json(null, 204);
    }
}
