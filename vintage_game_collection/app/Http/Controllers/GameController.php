<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GameController extends Controller 
{
    /**
     * Display a listing of the resource with Search and Pagination.
     */
    public function index(Request $request): View 
    {
        $query = Game::query();

        // BONUS: Search/Filter Feature
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('platform', 'LIKE', "%{$search}%");
            });
        }

        // BONUS: Pagination (5 items per page)
        // latest() ensures new additions appear at the top
        $games = $query->latest()->paginate(5);
        
        return view('games.index', compact('games'));
    }

    public function create(): View 
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage with Validation and Image Upload.
     */
    public function store(Request $request): RedirectResponse 
    {
        // BONUS: Request Validation
        $validated = $request->validate([
            'title'         => 'required|max:255',
            'platform'      => 'required|max:100',
            'year_released' => 'required|numeric|min:1950|max:' . (date('Y') + 1),
            'condition'     => 'required|in:Mint,Good,Fair,Poor',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB Max
        ]);

        // BONUS: Image Upload Logic
        if ($request->hasFile('image')) {
            // Stores in storage/app/public/games
            $path = $request->file('image')->store('games', 'public');
            $validated['image'] = $path;
        }

        Game::create($validated);

        return redirect()->route('games.index')->with('success', 'Artifact successfully synchronized to vault.');
    }

    public function show(Game $game): View 
    {
        return view('games.show', compact('game'));
    }

    public function edit(Game $game): View 
    {
        return view('games.edit', compact('game'));
    }

    /**
     * Update the resource and manage image replacement.
     */
    public function update(Request $request, Game $game): RedirectResponse 
    {
        $validated = $request->validate([
            'title'         => 'required|max:255',
            'platform'      => 'required',
            'year_released' => 'required|numeric',
            'condition'     => 'required',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image file from physical storage to save space
            if ($game->image && Storage::disk('public')->exists($game->image)) {
                Storage::disk('public')->delete($game->image);
            }
            
            // Upload new image
            $path = $request->file('image')->store('games', 'public');
            $validated['image'] = $path;
        }

        $game->update($validated);

        return redirect()->route('games.index')->with('success', 'Vault record updated successfully.');
    }

    /**
     * Remove the resource and clean up files.
     */
    public function destroy(Game $game): RedirectResponse 
    {
        // Delete image file before deleting the database record
        if ($game->image && Storage::disk('public')->exists($game->image)) {
            Storage::disk('public')->delete($game->image);
        }
        
        $game->delete();

        return redirect()->route('games.index')->with('success', 'Record purged from database.');
    }
}