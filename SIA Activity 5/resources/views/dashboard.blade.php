<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integration Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <h1 class="text-xl font-bold text-indigo-600 uppercase tracking-wider">Employee Portal</h1>
                <div class="flex items-center gap-4">
                    <span class="text-gray-600 text-sm">Hello, {{ $user->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900">{{ $user->role }} Dashboard</h2>
            <p class="text-gray-500 mt-1">System Integration Overview & Activity Output</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="space-y-8">
                <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-indigo-500">
                    <h3 class="text-sm font-bold text-gray-400 uppercase mb-4">My Profile</h3>
                    <div class="flex items-center space-x-4">
                        <div class="h-12 w-12 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 font-bold">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t">
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $user->role == 'Admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                            Role: {{ $user->role }}
                        </span>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-green-500">
                    <h3 class="text-sm font-bold text-gray-400 uppercase mb-4">Internal API Data</h3>
                    <p class="text-3xl font-black text-gray-800">{{ count($employees) }}</p>
                    <p class="text-sm text-gray-500">Total Registered Employees</p>
                    <a href="/api/users" target="_blank" class="text-xs text-indigo-500 mt-3 block hover:underline">View JSON Output &rarr;</a>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Employee Directory</h3>
                        <input type="text" id="searchInput" placeholder="Search employees..." 
                               class="text-sm border border-gray-200 p-2 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="employeeTable">
                            <thead>
                                <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <th class="pb-3">Name</th>
                                    <th class="pb-3">Role</th>
                                    <th class="pb-3 text-right">Joined</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($employees as $emp)
                                <tr class="text-sm text-gray-700">
                                    <td class="py-3 font-medium">{{ $emp->name }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase border {{ $emp->role == 'Admin' ? 'border-red-200 text-red-600' : 'border-blue-200 text-blue-600' }}">
                                            {{ $emp->role }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right text-gray-400">{{ $emp->created_at->format('M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-yellow-500">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">External API Data (JSONPlaceholder)</h3>
                        @if($externalPosts && count($externalPosts) > 0)
                            <span class="text-[10px] bg-yellow-100 text-yellow-700 px-2 py-1 rounded font-bold uppercase tracking-widest">Cached</span>
                        @endif
                    </div>
                    
                    @if($externalPosts && count($externalPosts) > 0)
                        <div class="space-y-3">
                            @foreach($externalPosts as $post)
                                <div class="p-4 bg-gray-50 rounded-lg border border-gray-100 hover:bg-white transition shadow-sm">
                                    <h4 class="font-bold text-indigo-600 capitalize text-sm mb-1">{{ $post['title'] }}</h4>
                                    <p class="text-xs text-gray-600 leading-relaxed">{{ $post['body'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center p-8 border-2 border-dashed border-gray-200 rounded-xl">
                            <div class="mb-3 text-red-500 flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <p class="text-gray-800 text-sm font-semibold">⚠️ Connection to JSONPlaceholder Failed</p>
                            <p class="text-gray-400 text-xs mt-1 mb-6">We couldn't retrieve the latest posts. Please check your internet or SSL settings.</p>
                            <button onclick="window.location.reload();" class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-xs font-bold hover:bg-indigo-700 transition shadow-md uppercase tracking-tighter">
                                Retry Connection
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#employeeTable tbody tr');
            
            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
</body>
</html>