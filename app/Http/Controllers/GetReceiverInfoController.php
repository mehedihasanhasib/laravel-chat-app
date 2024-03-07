<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GetReceiverInfoController extends Controller
{
    public function getUserInfo($id)
    {
        $user_info = User::where('id', $id)->get()->first();
        return response()->json($user_info);
    }
}
