<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Message;

class MessageController extends Controller
{

    public function showMessagesInChat($id)
    {
        // Validate chat ID
        $validator = Validator::make(['chat_id' => $id], [
            'chat_id' => 'required|exists:chats,chat_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Fetch messages for the given chat ID
        $messages = Message::where('chat_id', $id)->get();

        return response()->json(['messages' => $messages], 200);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'chat_id' => 'required|exists:chats,chat_id',
            'sender' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $message = new Message;
        $message->chat_id = $request->chat_id;
        $message->sender = $request->sender;
        $message->content = $request->content;
        $message->save();

        return response()->json(['message' => 'Message created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'chat_id' => 'sometimes|required|exists:chats,chat_id',
            'sender' => 'sometimes|required|string',
            'content' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $message = Message::find($id);
        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        if ($request->has('chat_id')) {
            $message->chat_id = $request->input('chat_id');
        }
        if ($request->has('sender')) {
            $message->sender = $request->input('sender');
        }
        if ($request->has('content')) {
            $message->content = $request->input('content');
        }

        $message->save();

        return response()->json(['message' => 'Message updated successfully'], 200);
    }

    public function destroy($id)
    {
        $message = Message::find($id);
        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        $message->delete();

        return response()->json(['message' => 'Message deleted successfully'], 200);
    }
}
