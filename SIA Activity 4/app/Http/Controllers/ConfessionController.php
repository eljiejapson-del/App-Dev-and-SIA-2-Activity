<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfessionController extends Controller
{
    public function index()
    {
        return view('confess');
    }

    public function store(Request $request)
    {
        // 3. Validation Rules (Requirement: 30 pts)
        $request->validate([
            'codename'    => 'required|min:3',           // Field 1: Text
            'email'       => 'required|email',           // Field 2: Email
            'category'    => 'required',                 // Field 3: Select
            'spice_level' => 'required|numeric|min:1',   // Field 4: Number
            'message'     => 'required|min:10',          // Field 5: Textarea
        ], [
            // Bonus: Custom Messages
            'message.min' => 'The vault needs a deeper secret!',
            'spice_level.min' => 'Drama level must be at least 1.'
        ]);

        // If validation passes, we return with a success message
        return redirect('/confess')->with('success', 'Confession locked in the vault! 🔐');
    }
}