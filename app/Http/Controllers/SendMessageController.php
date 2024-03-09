<?php

namespace App\Http\Controllers;

use App\Events\MessageBroadcastEvent;
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
        event(new MessageBroadcastEvent($chats));
        return response()->json($chats);
    }

    public function load_chats(Request $request)
    {
        $chats = Chat::where(function ($query) use ($request) {
            $query->where('sender_id', $request->sender_id)
                ->where('receiver_id', $request->receiver_id);
        })
            ->orWhere(function ($query) use ($request) {
                $query->where('sender_id', $request->receiver_id)
                    ->where('receiver_id', $request->sender_id);
            })
            ->get();


        return response()->json($chats);
    }
}
