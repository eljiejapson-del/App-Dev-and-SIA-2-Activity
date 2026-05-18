<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetroVault | Archive Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        
        /* Custom Scanline Animation for Success Messages */
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .animate-slide-in { animation: slideIn 0.5s ease-out forwards; }
    </style>
</head>
<body class="bg-[#0f172a] text-gray-100 min-h-screen selection:bg-purple-500/30">

    <div class="h-1 w-full bg-linear-to-r from-transparent via-purple-500 to-transparent opacity-50"></div>

    <nav class="bg-gray-900/80 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50 p-4 shadow-2xl">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('games.index') }}" class="group flex items-center gap-2">
                <div class="bg-purple-600 p-1.5 rounded-lg group-hover:rotate-12 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                    </svg>
                </div>
                <span class="text-2xl font-black tracking-tighter italic text-white">
                    RETRO<span class="text-purple-500">VAULT</span>
                </span>
            </a>

            <div class="flex items-center gap-6">
                <div class="hidden md:flex gap-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">
                    <a href="{{ route('games.index') }}" class="hover:text-purple-400 transition">Database</a>
                    <span class="opacity-20">|</span>
                    <span class="text-green-500">System Online</span>
                </div>
                <a href="{{ route('games.create') }}" class="bg-white hover:bg-purple-500 hover:text-white text-black px-5 py-2 rounded-xl text-xs font-black transition-all uppercase tracking-widest flex items-center gap-2">
                    <span>Add Entry</span>
                </a>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="fixed top-24 right-6 z-60 animate-slide-in">
            <div class="bg-gray-900 border-l-4 border-green-500 p-4 rounded-xl shadow-2xl flex items-center gap-4 min-w-[300px]">
                <div class="bg-green-500/20 p-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-green-500 uppercase tracking-widest">Notification</p>
                    <p class="text-sm text-gray-300 font-bold">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-gray-500 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <main class="container mx-auto px-4 min-h-[calc(100vh-160px)]">
        @yield('content')
    </main>

    <footer class="container mx-auto px-4 py-8 mt-12 border-t border-gray-800/50">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[10px] font-mono text-gray-600 uppercase tracking-widest">
                &copy; {{ date('Y') }} RetroVault Terminal v4.0.2 - BSIT_PROJECT_CORE
            </p>
            <div class="flex gap-4">
                <div class="h-2 w-2 rounded-full bg-purple-500 animate-pulse"></div>
                <div class="h-2 w-2 rounded-full bg-blue-500 animate-pulse delay-75"></div>
                <div class="h-2 w-2 rounded-full bg-green-500 animate-pulse delay-150"></div>
            </div>
        </div>
    </footer>

    <script>
        setTimeout(() => {
            const alerts = document.querySelectorAll('.animate-slide-in');
            alerts.forEach(el => {
                el.style.opacity = '0';
                el.style.transition = 'opacity 0.5s ease';
                setTimeout(() => el.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>