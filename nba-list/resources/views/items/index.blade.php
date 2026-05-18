@extends('layouts.app')

@section('content')
<div class="mb-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
    <div>
        <h2 class="text-3xl font-black uppercase italic text-white">Elite <span class="text-yellow-500">Roster</span></h2>
        <div class="h-1 w-12 bg-yellow-500 mt-2"></div>
    </div>

    <div class="flex flex-col sm:row gap-4">
        <input type="text" id="playerSearch" placeholder="Search legend..." 
            class="bg-slate-900 border border-slate-700 text-white px-5 py-3 rounded-2xl focus:outline-none focus:border-yellow-500 w-full sm:w-64">
        
        <select id="filterPosition" class="bg-slate-900 border border-slate-700 text-white px-5 py-3 rounded-2xl focus:outline-none focus:border-yellow-500">
            <option value="all">All Roles</option>
            <option value="Point Guard">Point Guard</option>
            <option value="Shooting Guard">Shooting Guard</option>
            <option value="Small Forward">Small Forward</option>
            <option value="Power Forward">Power Forward</option>
            <option value="Center">Center</option>
        </select>
    </div>
</div>

<div id="playerGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    @foreach($items as $player)
    <div class="player-wrapper opacity-0 translate-y-4 transition-all duration-500" 
         data-name="{{ strtolower($player['name']) }}" 
         data-pos="{{ $player['position'] }}">
        <a href="{{ route('items.show', $player['id']) }}" 
           class="group bg-slate-800 rounded-[2rem] p-2 border border-slate-700 hover:border-yellow-500 transition-all block">
            <div class="h-60 rounded-[1.5rem] overflow-hidden bg-slate-900 flex items-end justify-center relative">
                <span class="absolute top-5 text-4xl font-black text-white/5 uppercase italic pointer-events-none group-hover:text-white/10 transition-all">
                    {{ explode(' ', $player['team'])[0] }}
                </span>
                <img src="{{ $player['image'] }}" class="h-48 object-contain z-10 group-hover:scale-110 transition-transform duration-500">
            </div>
            <div class="p-5">
                <p class="text-blue-400 text-[10px] font-bold uppercase tracking-widest">{{ $player['position'] }}</p>
                <h3 class="text-xl font-black italic uppercase group-hover:text-yellow-500 transition-colors">{{ $player['name'] }}</h3>
            </div>
        </a>
    </div>
    @endforeach
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const search = document.getElementById('playerSearch');
    const filter = document.getElementById('filterPosition');
    const players = document.querySelectorAll('.player-wrapper');

    // Staggered Entrance
    players.forEach((p, i) => {
        setTimeout(() => {
            p.classList.remove('opacity-0', 'translate-y-4');
        }, i * 50);
    });

    function runFilter() {
        const q = search.value.toLowerCase();
        const pos = filter.value;
        players.forEach(p => {
            const match = p.dataset.name.includes(q) && (pos === 'all' || p.dataset.pos === pos);
            p.style.display = match ? 'block' : 'none';
        });
    }

    search.addEventListener('input', runFilter);
    filter.addEventListener('change', runFilter);
});
</script>
@endsection