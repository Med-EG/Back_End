<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoctorAssistant;
use App\Models\Doctor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class DoctorAssistantController extends Controller
{

    //Showing all doctor assistants
    public function index()
    {
        $assistant = DoctorAssistant::all();

        return $assistant;
    }

    //showing all el assistant for one doctor
    public function one_doc($doctorId)
    {
        $doctor = Doctor::find($doctorId);
        if (!$doctor) {
            return response()->json(['error' => 'Doctor not found'], 404);
        }

        $assistants = DoctorAssistant::where('doctor_id', $doctorId)->get();
        return response()->json($assistants);
    }


    //show a single assistant
    public function show($id)
    {
        $assistant = DoctorAssistant::find($id);
        if (!$assistant) {
            return response()->json(['error' => 'Doctor assistant not found'], 404);
        }
        return response()->json($assistant);
    }

    //updating an assistant
    public function update(Request $request, $id)
    {
        $assistant = DoctorAssistant::findOrFail($id);

        $validatedData = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'assistant_name' => 'required|string',
            'email' => 'required|email|unique:assistants,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 400);
        }

        $hashedPassword = Hash::make($request->password);

        $assistant->doctor_id = $request->doctor_id;
        $assistant->assistant_name = $request->assistant_name;
        $assistant->email = $request->email;
        $assistant->password = $hashedPassword; // Hash the password

        $assistant->save();

        return response()->json($assistant, 200);
    }

    //delete an assistant
    public function destroy($id)
    {
        $assistant = DoctorAssistant::findOrFail($id);
        $assistant->delete();
        return response()->json(null, 204);
    }
}
