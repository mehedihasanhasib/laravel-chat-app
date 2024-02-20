<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function load_dashboard()
    {
        $users = User::whereNotIn('id', [Auth::user()->id])->get();
        return view('dashboard', ['users' => $users]);
    }
}
