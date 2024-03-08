<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Validator;


class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::with(['patient', 'doctor'])->get();

        return $chats;
    }

    public function show($id)
    {
        $chat = Chat::with(['patient', 'doctor'])->find($id);

        if ($chat) {
            return $chat;
        } else {
            return response()->json(['error' => 'Chat not found.'], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,patient_id',
            'doctor_id' => 'required|exists:doctors,doctor_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $chat = Chat::create($request->all());

        return $chat;
    }
    public function destroy($id)
    {
        $chat = Chat::find($id);

        if ($chat) {
            $chat->delete();
            return response()->json(['message' => 'Chat deleted successfully.']);
        } else {
            return response()->json(['error' => 'Chat not found.'], 404);
        }
    }
 
}
