<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employees = \App\Models\User::all();

        // Bonus: Caching with Error Handling & SSL fix
        $externalPosts = Cache::remember('public_posts', 60, function () {
            try {
                // .withoutVerifying() fixes local SSL/HTTPS issues
                $response = Http::timeout(5)
                    ->withoutVerifying() 
                    ->get('https://jsonplaceholder.typicode.com/posts?_limit=5');

                if ($response->successful()) {
                    return $response->json();
                }
                return null;
            } catch (\Exception $e) {
                // Log the error for debugging: \Log::error($e->getMessage());
                return null; 
            }
        });

        return view('dashboard', compact('user', 'externalPosts', 'employees'));
    }
}