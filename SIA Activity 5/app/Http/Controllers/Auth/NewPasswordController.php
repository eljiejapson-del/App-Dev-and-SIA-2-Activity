<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function createDirect(): View
    {
        // This looks for resources/views/auth/reset-password.blade.php
        // If your file is just reset-password.blade.php, change this to 'reset-password'
        return view('auth.reset-password');
    }

    /**
     * Handle the password update request.
     */
    public function storeDirect(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], [
            // Custom error message for better UI
            'email.exists' => 'No user found with this email address.',
        ]);

        $user = User::where('email', $request->email)->first();

        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        // Redirect back to login with a success message
        return redirect()->route('login')->with('status', 'Your password has been reset successfully!');
    }
}