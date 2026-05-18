@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    
    <div class="flex flex-col lg:flex-row justify-between items-end mb-8 gap-6">
        <div>
            <h1 class="text-5xl font-black text-white tracking-tighter italic leading-none">
                GAME<span class="text-purple-500 italic">_VAULT</span>
            </h1>
            <p class="text-gray-500 font-mono text-xs mt-2 uppercase tracking-[0.3em]">Archives Access: Level 3 Clearances Only</p>
        </div>
        
        <div class="flex flex-col sm:flex-row w-full lg:w-auto gap-4">
            <form action="{{ route('games.index') }}" method="GET" class="relative group">
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="SCANNING FOR TITLES..." 
                    class="bg-gray-900 border-2 border-gray-800 text-purple-100 pl-10 pr-4 py-3 rounded-2xl focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none w-full sm:w-72 transition-all duration-300 font-mono text-sm placeholder-gray-700">
                <div class="absolute left-3 top-3.5 text-gray-700 group-focus-within:text-purple-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <button type="submit" class="hidden">Scan</button>
            </form>

            <a href="{{ route('games.create') }}" class="bg-purple-600 hover:bg-purple-500 text-white px-8 py-3 rounded-2xl font-black transition-all shadow-[0_0_20px_rgba(147,51,234,0.3)] hover:-translate-y-1 text-center uppercase tracking-widest text-sm">
                + New Entry
            </a>
        </div>
    </div>

    <div class="bg-gray-800/50 backdrop-blur-sm rounded-3xl shadow-2xl border border-gray-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-900/80 text-gray-400 uppercase text-[10px] font-black tracking-[0.2em] border-b border-gray-700">
                        <th class="p-6">Registry Visual</th>
                        <th class="p-6">Title & Metadata</th>
                        <th class="p-6">Platform</th>
                        <th class="p-6">Physical Integrity</th>
                        <th class="p-6 text-right">Commands</th>
                    </tr>
                </thead>
                
                <tbody class="divide-y divide-gray-700/50">
                    @forelse($games as $game)
                    <tr class="hover:bg-purple-900/10 transition-all duration-300 group">
                        <td class="p-6">
                            <div class="relative w-20 h-28 transform group-hover:scale-110 group-hover:rotate-2 transition-all duration-500">
                                @if($game->image)
                                    <img src="{{ asset('storage/' . $game->image) }}" class="w-full h-full object-cover rounded-xl shadow-2xl border-2 border-gray-700 group-hover:border-purple-500">
                                @else
                                    <div class="w-full h-full bg-gray-900 rounded-xl flex flex-col items-center justify-center border-2 border-dashed border-gray-700 text-gray-700">
                                        <span class="text-2xl mb-1">💿</span>
                                        <span class="text-[8px] font-black uppercase">Missing</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-linear-to-b from-transparent via-purple-500/10 to-transparent translate-y-[-100%] group-hover:translate-y-[100%] transition-all duration-[1.5s] pointer-events-none"></div>
                            </div>
                        </td>
                        
                        <td class="p-6">
                            <div class="flex flex-col">
                                <span class="text-xl font-black text-white group-hover:text-purple-400 transition-colors">{{ $game->title }}</span>
                                <span class="text-xs text-gray-500 font-mono mt-1">V_ID: {{ sprintf('%05d', $game->id) }} | Est. {{ $game->year_released }}</span>
                            </div>
                        </td>
                        
                        <td class="p-6">
                            <span class="bg-gray-900 text-purple-400 border border-purple-500/20 px-4 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest group-hover:bg-purple-900 group-hover:text-white transition-all">
                                {{ $game->platform }}
                            </span>
                        </td>

                        <td class="p-6">
                            <div class="flex items-center gap-2">
                                @php
                                    $color = match($game->condition) {
                                        'Mint' => 'bg-green-500',
                                        'Good' => 'bg-blue-500',
                                        'Fair' => 'bg-yellow-500',
                                        default => 'bg-red-500',
                                    };
                                @endphp
                                <div class="h-2 w-2 rounded-full {{ $color }} animate-pulse"></div>
                                <span class="text-xs font-bold uppercase tracking-tighter {{ str_replace('bg-', 'text-', $color) }} opacity-80">
                                    {{ $game->condition }}
                                </span>
                            </div>
                        </td>

                        <td class="p-6 text-right">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-4 group-hover:translate-x-0">
                                <a href="{{ route('games.show', $game->id) }}" class="p-2 bg-gray-700 hover:bg-blue-600 text-white rounded-lg transition" title="Inspect">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="{{ route('games.edit', $game->id) }}" class="p-2 bg-gray-700 hover:bg-yellow-600 text-white rounded-lg transition" title="Modify">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="inline">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-gray-700 hover:bg-red-600 text-white rounded-lg transition" 
                                        onclick="return confirm('Purge data from vault permanently?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-20 text-center">
                            <div class="flex flex-col items-center">
                                <span class="text-6xl mb-4 grayscale opacity-20">📡</span>
                                <h3 class="text-gray-500 font-mono text-xs uppercase tracking-[0.4em]">Zero Results Found</h3>
                                <a href="{{ route('games.index') }}" class="mt-4 text-purple-500 text-xs font-bold hover:underline">RESET SENSORS</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-10 flex justify-center">
        <div class="vault-pagination">
            {{ $games->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<button id="scrollTop" class="fixed bottom-8 right-8 bg-purple-600 text-white p-4 rounded-full shadow-2xl opacity-0 translate-y-10 transition-all duration-500 hover:bg-purple-500">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7" />
    </svg>
</button>

<style>
    /* Custom Scrollbar for the Vault */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #111827; }
    ::-webkit-scrollbar-thumb { background: #4b5563; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #9333ea; }

    /* Tailwind Pagination Overrides */
    .vault-pagination nav { @apply shadow-none; }
    .vault-pagination span, .vault-pagination a { 
        @apply bg-gray-800 border-gray-700 text-gray-400 rounded-xl mx-1 px-4 py-2 transition-all !important;
    }
    .vault-pagination .active span { 
        @apply bg-purple-600 border-purple-500 text-white shadow-[0_0_15px_rgba(147,51,234,0.4)] !important;
    }
</style>

<script>
    // Smooth scroll and back-to-top logic
    const scrollBtn = document.getElementById('scrollTop');
    
    window.onscroll = function() {
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            scrollBtn.classList.remove('opacity-0', 'translate-y-10');
        } else {
            scrollBtn.classList.add('opacity-0', 'translate-y-10');
        }
    };

    scrollBtn.onclick = function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // Auto-hide success messages if they exist
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert-success');
        alerts.forEach(el => el.style.display = 'none');
    }, 4000);
</script>
@endsection