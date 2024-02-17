<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoctorAssistant;
use App\Models\Doctor;

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

    //storing new assistant
    public function store(Request $request)
    {
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

    //show a single assistant
    public function show($doctorId)
    {
        return DoctorAssistant::with('doctor')->where('doctor_id', $doctorId)->firstOrFail();
    }

    //updating an assistant
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

    //delete an assistant
    public function destroy($id)
    {
        $assistant = DoctorAssistant::findOrFail($id);
        $assistant->delete();
        return response()->json(null, 204);
    }
}
