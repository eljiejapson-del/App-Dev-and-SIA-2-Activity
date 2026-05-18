<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBA Elite Registry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; color: white; }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <header class="bg-blue-900 py-6 border-b-4 border-yellow-500 shadow-xl">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <h1 class="text-2xl font-black italic uppercase">🏀 NBA <span class="text-yellow-400">Elite</span></h1>
            
            <div class="text-right">
                @isset($items)
                <p class="text-[10px] font-bold tracking-[0.3em] uppercase text-blue-300">
                    Database Active: <span id="visible-count">{{ count($items) }}</span> Players
                </p>
                @endisset
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-10 flex-grow">
        @yield('content')
    </main>

    <footer class="bg-slate-900 border-t border-slate-800 py-6 text-center text-slate-500 text-xs">
        <p>IT-Laravel Individual Activity &copy; 2026 | Built by Eljie Peteros</p>
    </footer>
</body>
</html>