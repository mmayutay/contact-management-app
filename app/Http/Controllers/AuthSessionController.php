<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthSessionController extends Controller
{
    public function index()
    {
        return Inertia::render('Login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::query()
            ->where('email', $request['email'])->first();

        $checkPassword = Hash::check($request['password'], $user->password);

        if(! $checkPassword) {
            return 'Incorrect Password!';
        }
        

        Auth::login($user);

        return redirect()->intended('/');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
