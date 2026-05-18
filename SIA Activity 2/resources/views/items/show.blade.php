@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <a href="{{ route('items.index') }}" class="text-slate-400 hover:text-yellow-500 font-bold uppercase text-xs tracking-widest mb-8 inline-block">
        ← Return to Roster
    </a>

    <div class="bg-slate-800 rounded-[3rem] overflow-hidden border border-slate-700 flex flex-col md:flex-row shadow-2xl">
        <div id="img-container" class="md:w-1/2 bg-slate-900 p-12 flex items-center justify-center relative overflow-hidden">
            <span id="bg-num" class="absolute text-[15rem] font-black italic text-white/5 pointer-events-none">#{{ $item['number'] }}</span>
            <img id="p-img" src="{{ $item['image'] }}" class="w-full max-w-xs z-10 transition-transform duration-75">
        </div>

        <div class="md:w-1/2 p-12 flex flex-col justify-center">
            <p class="text-blue-400 font-black tracking-widest uppercase text-xs mb-2">{{ $item['team'] }}</p>
            <h2 class="text-5xl font-black italic uppercase leading-none mb-8">{{ $item['name'] }}</h2>
            
            <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="bg-slate-900 p-5 rounded-2xl border border-slate-700">
                    <p class="text-slate-500 text-[10px] font-bold uppercase mb-1">Role</p>
                    <p class="font-bold">{{ $item['position'] }}</p>
                </div>
                <div class="bg-slate-900 p-5 rounded-2xl border border-slate-700">
                    <p class="text-slate-500 text-[10px] font-bold uppercase mb-1">Jersey</p>
                    <p class="font-bold text-yellow-500">#{{ $item['number'] }}</p>
                </div>
            </div>

            <div id="stat-panel" class="hidden grid grid-cols-2 gap-4 mb-8 animate-pulse">
                <div class="text-center bg-white/5 p-4 rounded-xl">
                    <span class="block text-2xl font-black text-yellow-500" id="val-ppg">0</span>
                    <span class="text-[10px] uppercase font-bold text-slate-500">PPG</span>
                </div>
                <div class="text-center bg-white/5 p-4 rounded-xl">
                    <span class="block text-2xl font-black text-blue-500" id="val-apg">0</span>
                    <span class="text-[10px] uppercase font-bold text-slate-500">APG</span>
                </div>
            </div>

            <button id="get-stats" class="w-full bg-yellow-500 hover:bg-yellow-400 text-black font-black py-4 rounded-2xl uppercase tracking-widest transition-all">
                Generate Scouting Report
            </button>
        </div>
    </div>
</div>

<script>
    // 3D Parallax
    const box = document.getElementById('img-container');
    const pimg = document.getElementById('p-img');
    const bgn = document.getElementById('bg-num');

    box.addEventListener('mousemove', (e) => {
        const { width, height, left, top } = box.getBoundingClientRect();
        const x = (e.clientX - left) / width - 0.5;
        const y = (e.clientY - top) / height - 0.5;
        pimg.style.transform = `perspective(500px) rotateY(${x * 30}deg) rotateX(${y * -30}deg)`;
        bgn.style.transform = `translate(${x * -20}px, ${y * -20}px)`;
    });

    // Stat Counter
    document.getElementById('get-stats').addEventListener('click', function() {
        this.style.display = 'none';
        document.getElementById('stat-panel').classList.remove('hidden');
        
        let p = 0; let a = 0;
        let int = setInterval(() => {
            p += 0.8; a += 0.3;
            document.getElementById('val-ppg').innerText = p.toFixed(1);
            document.getElementById('val-apg').innerText = a.toFixed(1);
            if (p >= 25) {
                clearInterval(int);
                document.getElementById('stat-panel').classList.remove('animate-pulse');
            }
        }, 30);
    });
</script>
@endsection