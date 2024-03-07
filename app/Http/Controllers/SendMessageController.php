<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class SendMessageController extends Controller
{
    public function send_message(Request $request)
    {
        $chats = Chat::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'messages' => $request->message,
        ]);

        return response()->json($chats);
    }
}
