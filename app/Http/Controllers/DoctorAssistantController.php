<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoctorAssistant;
use App\Models\Doctor;

class DoctorAssistantController extends Controller
{
    public function index()
    {
        $medicalInfos = DoctorAssistant::all();

        return $medicalInfos;
    }
    public function one_doc($doctorId)
    {
        $doctor = Doctor::find($doctorId);
        if (!$doctor) {
            return response()->json(['error' => 'Doctor not found'], 404);
        }
    
        $assistants = DoctorAssistant::where('doctor_id', $doctorId)->get();
        return response()->json($assistants);
    }

    public function store(Request $request)
    {
        // $doctor = Doctor::find($doctorId);
        // if (!$doctor) {
        //     return response()->json(['error' => 'Doctor not found'], 404);
        // }

        // $validatedData = $request->validate([
        //     'name' => 'required',
        // ]);

        // $assistant = DoctorAssistant::create([
        //     'name' => $request->name,
        //     'doctor_id' => $doctorId,
        // ]);
        $validatedData = $request->validate([
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'assistant_name' => 'required',
            'email' => 'required|email|unique:doctor_assistants,email',
            'password' => 'required',
        ]);

        $assistant = new DoctorAssistant();
        $assistant->doctor_id = $validatedData['doctor_id'];
        $assistant->assistant_name = $validatedData['assistant_name'];
        $assistant->email = $validatedData['email'];
        $assistant->password = bcrypt($validatedData['password']); // Hash the password

        $assistant->save();
        return response()->json($assistant, 201);
    }

    public function show($id)
    {
        $assistant = DoctorAssistant::findOrFail($id);
        return response()->json($assistant);
    }

    public function update(Request $request, $id)
    {
        $assistant = DoctorAssistant::findOrFail($id);

        $validatedData = $request->validate([
            'assistant_name' => 'required',
            'email' => 'required|email|unique:doctor_assistants,email,' . $id,
            'password' => 'required',
        ]);

        $assistant->assistant_name = $validatedData['assistant_name'];
        $assistant->email = $validatedData['email'];
        $assistant->password = bcrypt($validatedData['password']); // Hash the password

        $assistant->save();

        return response()->json($assistant, 200);
    }

    public function destroy($id)
    {
        $assistant = DoctorAssistant::findOrFail($id);
        $assistant->delete();
        return response()->json(null, 204);
    }
}
