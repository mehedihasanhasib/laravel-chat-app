<?php

namespace App\Http\Controllers;

use App\Events\TestPresenceChannel;
use Illuminate\Http\Request;

class EventFireController extends Controller
{
    public function fire_event(Request $request)
    {
        event(new TestPresenceChannel('hello world'));
    }
}
