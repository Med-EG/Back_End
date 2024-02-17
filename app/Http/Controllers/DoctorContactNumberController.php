<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoctorContactNumber;
use App\Models\Doctor;

class DoctorContactNumberController extends Controller
{
    //Showing all numbers
    public function index()
    {
        $number = DoctorContactNumber::all();

        return $number;
    }

    //showing all el numbers for one doctor
    public function one_doc($doctorId)
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
        $validatedData = $request->validate([
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'contact_number' => 'required',
        ]);

        $number = new DoctorContactNumber();
        $number->doctor_id = $validatedData['doctor_id'];
        $number->contact_number = $validatedData['contact_number'];

        $number->save();
        return response()->json($number, 201);
    }

    //show a single number
    public function show($doctorId)
    {
        return DoctorContactNumber::with('doctor')->where('doctor_id', $doctorId)->firstOrFail();
    }

    //updating a number
    public function update(Request $request, $id)
    {
        $number = DoctorContactNumber::findOrFail($id);

        $validatedData = $request->validate([
            'contact_number' => 'required',
        ]);

        $number->contact_number = $validatedData['contact_number'];
        
        $number->save();

        return response()->json($number, 200);
    }

    //delete a day
    public function destroy($id)
    {
        $number = DoctorContactNumber::findOrFail($id);
        $number->delete();
        return response()->json(null, 204);
    }
}
