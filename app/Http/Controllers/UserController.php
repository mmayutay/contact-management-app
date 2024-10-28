<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index() {
        $users = User::all();


        return Inertia::render('User', [
            'users' => $users
        ]);
    }

    public function store(Request $request) {

        $validated = $this->validateRequest($request);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect('user');
    }

    public function update(Request $request, User $user)
    {
        $validated = $this->validateRequest($request, true);

        $validated['password'] = Hash::make($validated['password']);

        $user->update($validated);

        return redirect('/user');
    }

    public function register(Request $request) 
    {
        $validated = $this->validateRequest($request);

        $validated['password'] = Hash::make($request['password']);

        $user = User::create($validated);

        Auth::login($user);

        return redirect('/dashboard');
    }

    private function validateRequest(Request $request, $isEdit = false)
    {
        return $request->validate([
            'email' => ['required'],
            'name' => ['required'],
            'password' => ['nullable', Rule::requiredIf($isEdit)]
        ]);
    }
}