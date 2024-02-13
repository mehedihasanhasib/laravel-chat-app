<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use Illuminate\Http\Request;

class NewMessageController extends Controller
{
    public function index()
    {
        event(new NewMessage('hello world'));
    }
}
