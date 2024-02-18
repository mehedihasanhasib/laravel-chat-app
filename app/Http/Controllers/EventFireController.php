<?php

namespace App\Http\Controllers;

use App\Events\TestPresenceChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventFireController extends Controller
{
    public function fire_event(Request $request)
    {
        $user_name = Auth::user()->name;
        event(new TestPresenceChannel($request->message, $user_name));
    }
}
