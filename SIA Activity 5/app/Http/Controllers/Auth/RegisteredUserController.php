<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validation: Includes 'role'
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['required', 'string', 'in:Admin,User'], 
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Creation: Saves the 'role'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role, 
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // 3. Part 2 Requirement: Redirect based on role
        if ($user->role === 'Admin') {
            return redirect()->intended('/admin/dashboard'); 
        }

        return redirect(route('dashboard', absolute: false));
    }
}