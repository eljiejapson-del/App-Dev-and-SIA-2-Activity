@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="flex items-center justify-between mb-10">
        <h1 class="text-4xl font-black text-white tracking-tighter italic">
            DATA<span class="text-purple-500">_SCAN</span>
        </h1>
        <div class="flex gap-3">
            <a href="{{ route('games.edit', $game->id) }}" class="bg-yellow-500 hover:bg-yellow-400 text-black px-6 py-2 rounded-xl font-black text-xs transition uppercase tracking-widest shadow-lg shadow-yellow-500/20">
                Edit Entry
            </a>
            <a href="{{ route('games.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-xl font-black text-xs transition uppercase tracking-widest">
                Close
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <div class="relative group">
            <div class="absolute -inset-1 bg-linear-to-r from-purple-600 to-blue-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
            
            <div class="relative bg-gray-900 rounded-3xl border border-gray-700 overflow-hidden aspect-3/4 flex items-center justify-center">
                @if($game->image)
                    <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }}" class="w-full h-full object-cover">
                @else
                    <div class="text-center p-12">
                        <div class="text-7xl mb-4 opacity-20">🎮</div>
                        <h3 class="text-gray-500 font-mono text-xs uppercase tracking-[0.3em]">No Visual Signal</h3>
                        <p class="text-gray-700 text-[10px] mt-2 italic">Add box art in the edit menu</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-gray-800 p-8 rounded-3xl border border-gray-700 shadow-xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 text-4xl italic font-black">ID:{{ $game->id }}</div>
                <span class="text-purple-500 text-[10px] font-black uppercase tracking-[0.4em] mb-2 block">Primary Identifier</span>
                <p class="text-3xl font-black text-white leading-tight">{{ $game->title }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-800/50 p-5 rounded-2xl border border-gray-700">
                    <span class="text-gray-500 text-[10px] font-bold uppercase tracking-widest mb-1 block">Platform</span>
                    <p class="text-xl font-black text-purple-300 font-mono">{{ strtoupper($game->platform) }}</p>
                </div>
                <div class="bg-gray-800/50 p-5 rounded-2xl border border-gray-700">
                    <span class="text-gray-500 text-[10px] font-bold uppercase tracking-widest mb-1 block">Launch Year</span>
                    <p class="text-xl font-black text-purple-300 font-mono">{{ $game->year_released }}</p>
                </div>
            </div>

            <div class="bg-gray-800 p-6 rounded-3xl border border-gray-700 flex justify-between items-center shadow-inner">
                <div>
                    <span class="text-gray-500 text-[10px] font-bold uppercase tracking-[0.2em] mb-1 block">Physical Integrity</span>
                    <p id="conditionText" class="text-2xl font-black italic">{{ $game->condition }}</p>
                </div>
                <div class="relative">
                    <div id="statusDot" class="h-6 w-6 rounded-full relative z-10"></div>
                    <div id="statusPulse" class="absolute inset-0 h-6 w-6 rounded-full animate-ping opacity-75"></div>
                </div>
            </div>

            <p class="text-center text-gray-600 text-[10px] uppercase tracking-widest font-bold pt-4">
                Systems check complete. Data verified.
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cond = "{{ $game->condition }}";
        const dot = document.getElementById('statusDot');
        const pulse = document.getElementById('statusPulse');
        const text = document.getElementById('conditionText');

        const themes = {
            'Mint': 'text-green-400 bg-green-500',
            'Good': 'text-blue-400 bg-blue-500',
            'Fair': 'text-yellow-400 bg-yellow-500',
            'Poor': 'text-red-400 bg-red-500'
        };

        const colors = themes[cond] || 'text-gray-400 bg-gray-500';
        const [textCol, bgCol] = colors.split(' ');

        text.classList.add(textCol);
        dot.classList.add(bgCol);
        pulse.classList.add(bgCol);
    });
</script>
@endsection