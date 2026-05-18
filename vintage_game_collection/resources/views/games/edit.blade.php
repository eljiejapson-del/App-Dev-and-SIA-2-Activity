@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <div class="mb-6">
        <a href="{{ route('games.index') }}" class="text-purple-400 hover:text-purple-300 font-bold flex items-center transition uppercase text-xs tracking-widest">
            <span class="mr-2">←</span> Return to Vault
        </a>
    </div>

    <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-2xl overflow-hidden">
        <div class="bg-linear-to-r from-purple-900 to-indigo-900 p-6 border-b border-purple-500/30">
            <h1 class="text-2xl font-black text-white italic tracking-tighter uppercase">
                Edit Record: {{ $game->title }}
            </h1>
            <p class="text-purple-200 text-xs opacity-80 uppercase tracking-widest">Updating Artifact #{{ $game->id }}</p>
        </div>

        <form id="editForm" action="{{ route('games.update', $game->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf 
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-2 ml-1">Game Title</label>
                    <input type="text" name="title" value="{{ old('title', $game->title) }}" 
                        class="w-full bg-gray-900 border border-gray-700 rounded-xl p-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none transition text-white" required>
                    @error('title') <p class="text-red-500 text-[10px] mt-1 italic">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-2 ml-1">Platform</label>
                        <input type="text" name="platform" value="{{ old('platform', $game->platform) }}" 
                            class="w-full bg-gray-900 border border-gray-700 rounded-xl p-3 focus:ring-2 focus:ring-purple-500 outline-none transition text-white" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-2 ml-1">Release Year</label>
                        <input type="number" name="year_released" value="{{ old('year_released', $game->year_released) }}" 
                            class="w-full bg-gray-900 border border-gray-700 rounded-xl p-3 focus:ring-2 focus:ring-purple-500 outline-none transition text-white" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-2 ml-1">Condition Status</label>
                    <select name="condition" class="w-full bg-gray-900 border border-gray-700 rounded-xl p-3 focus:ring-2 focus:ring-purple-500 outline-none transition text-white cursor-pointer">
                        <option value="Mint" {{ $game->condition == 'Mint' ? 'selected' : '' }}>Mint (Like New)</option>
                        <option value="Good" {{ $game->condition == 'Good' ? 'selected' : '' }}>Good (Minor Wear)</option>
                        <option value="Fair" {{ $game->condition == 'Fair' ? 'selected' : '' }}>Fair (Noticeable Damage)</option>
                        <option value="Poor" {{ $game->condition == 'Poor' ? 'selected' : '' }}>Poor (Broken/Incomplete)</option>
                    </select>
                </div>

                <div class="bg-gray-900/50 p-5 rounded-2xl border border-gray-700">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-4">Visual Data (Cover Art)</label>
                    
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <div class="text-center">
                            <span class="text-[9px] font-black text-gray-600 block mb-2 tracking-widest uppercase">Database Entry</span>
                            @if($game->image)
                                <img src="{{ asset('storage/' . $game->image) }}" class="w-24 h-32 object-cover rounded-lg shadow-2xl border border-gray-700">
                            @else
                                <div class="w-24 h-32 bg-gray-800 rounded-lg border border-dashed border-gray-600 flex items-center justify-center text-gray-600 text-[10px]">NO IMAGE</div>
                            @endif
                        </div>

                        <div class="hidden md:block text-purple-600 animate-pulse">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </div>

                        <div class="text-center">
                            <span class="text-[9px] font-black text-purple-500 block mb-2 tracking-widest uppercase">New Scan</span>
                            <img id="preview" src="#" class="hidden w-24 h-32 object-cover rounded-lg shadow-2xl border-2 border-purple-500">
                            <div id="placeholder" class="w-24 h-32 bg-gray-800 rounded-lg border border-dashed border-gray-700 flex items-center justify-center text-gray-700 text-[10px]">AWAITING...</div>
                        </div>

                        <div class="flex-1 w-full">
                            <input type="file" name="image" id="imageInput" accept="image/*"
                                class="w-full text-[10px] text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-purple-600 file:text-white hover:file:bg-purple-700 cursor-pointer transition-all">
                            <p class="text-[10px] text-gray-600 mt-3 italic leading-tight">Recommended: 240x320px (Portrait). Max size 2MB.</p>
                        </div>
                    </div>
                    @error('image') <p class="text-red-500 text-[10px] mt-2 italic font-bold">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-gray-700">
                <button type="submit" id="submitBtn" 
                    class="w-full bg-purple-600 hover:bg-purple-500 text-white font-black py-4 rounded-2xl shadow-[0_0_20px_rgba(147,51,234,0.3)] transform hover:-translate-y-1 transition-all duration-300 uppercase tracking-[0.2em] text-sm">
                    Overwrite Database Entry
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const form = document.getElementById('editForm');
    const btn = document.getElementById('submitBtn');
    const imageInput = document.getElementById('imageInput');
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder');

    // Live Image Preview Logic
    imageInput.onchange = evt => {
        const [file] = imageInput.files;
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
    }

    // Submission UI Feedback
    form.addEventListener('submit', function() {
        btn.innerHTML = `
            <span class="flex items-center justify-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                COMMITTING CHANGES...
            </span>
        `;
        btn.classList.add('opacity-70', 'cursor-not-allowed');
        btn.disabled = true;
    });
</script>
@endsection