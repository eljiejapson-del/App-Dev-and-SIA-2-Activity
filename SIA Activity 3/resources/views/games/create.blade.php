@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10">
    <div class="mb-6">
        <a href="{{ route('games.index') }}" class="text-purple-400 hover:text-purple-300 font-bold flex items-center transition">
            <span class="mr-2">←</span> RETURN TO VAULT
        </a>
    </div>

    <div class="bg-gray-800 rounded-2xl shadow-2xl border border-gray-700 overflow-hidden">
        <div class="bg-purple-600 p-4 text-center">
            <h2 class="text-xl font-black text-white tracking-widest uppercase">Register New Artifact</h2>
        </div>

        <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Game Title</label>
                <input type="text" name="title" value="{{ old('title') }}" 
                    class="w-full bg-gray-900 border border-gray-700 rounded-lg p-3 text-white focus:ring-2 focus:ring-purple-500 outline-none transition" 
                    placeholder="e.g. The Legend of Zelda" required>
                @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Platform</label>
                    <input type="text" name="platform" value="{{ old('platform') }}" 
                        class="w-full bg-gray-900 border border-gray-700 rounded-lg p-3 text-white focus:ring-2 focus:ring-purple-500 outline-none transition" 
                        placeholder="e.g. SNES" required>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Year</label>
                    <input type="number" name="year_released" value="{{ old('year_released') }}" 
                        class="w-full bg-gray-900 border border-gray-700 rounded-lg p-3 text-white focus:ring-2 focus:ring-purple-500 outline-none transition" 
                        placeholder="1990" required>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Physical Condition</label>
                <select name="condition" class="w-full bg-gray-900 border border-gray-700 rounded-lg p-3 text-white focus:ring-2 focus:ring-purple-500 outline-none transition cursor-pointer">
                    <option value="Mint">Mint (Flawless)</option>
                    <option value="Good" selected>Good (Minor Wear)</option>
                    <option value="Fair">Fair (Noticeable Damage)</option>
                    <option value="Poor">Poor (Broken/Incomplete)</option>
                </select>
            </div>

            <div class="bg-gray-900 p-4 rounded-xl border border-dashed border-gray-700">
                <label class="block text-xs font-bold uppercase text-gray-500 mb-2 text-center">Visual Scan (Box Art)</label>
                
                <div class="flex justify-center mb-3">
                    <img id="preview" src="#" alt="Preview" class="hidden w-32 h-40 object-cover rounded shadow-lg border-2 border-purple-500">
                </div>

                <input type="file" name="image" id="imageInput" accept="image/*"
                    class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700 cursor-pointer">
                <p class="text-[10px] text-gray-600 mt-2 text-center">JPG, PNG, or GIF. MAX size 2MB.</p>
                @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-black py-4 rounded-xl shadow-[0_0_15px_rgba(147,51,234,0.4)] transition-all transform hover:-translate-y-1">
                ADD TO COLLECTION
            </button>
        </form>
    </div>
</div>

<script>
    imageInput.onchange = evt => {
        const [file] = imageInput.files;
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        }
    }
</script>
@endsection