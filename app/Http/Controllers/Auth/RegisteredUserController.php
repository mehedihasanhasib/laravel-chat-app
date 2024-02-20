<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'profile_picture' => ['required', 'image'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // store to profile picture in public folder
        $file_name = time() . $request->file('profile_picture')->getClientOriginalName();
        $path =  public_path() . '/profile_picture';
        $request->file('profile_picture')->move($path,  $file_name);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'profile_picture' => $file_name,
            'password' => Hash::make($request->password),

        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
