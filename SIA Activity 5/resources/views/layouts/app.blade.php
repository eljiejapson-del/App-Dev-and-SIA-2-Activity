<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->role }} Dashboard
        </h2>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </x-slot>

    <div class="container">
        <div class="grid-container">
            <div class="card">
                <h3>My Profile</h3>
                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Role:</strong> 
                    <span class="badge {{ Auth::user()->role == 'Admin' ? 'badge-admin' : 'badge-user' }}">
                        {{ Auth::user()->role }}
                    </span>
                </p>
            </div>

            <div class="card" style="border-top-color: #f39c12;">
                <h3>Local Weather (Cebu City)</h3>
                @if($weather)
                    <div style="font-size: 2rem; font-weight: bold;">{{ $weather['temperature'] }}°C</div>
                    <p style="color: #666;">Wind Speed: {{ $weather['windspeed'] }} km/h</p>
                @else
                    <p style="color: red;">Weather API Offline</p>
                @endif
            </div>

            <div class="card" style="border-top-color: #2ecc71;">
                <h3>Internal Stats</h3>
                <p>Total Registered: <strong>{{ count($employees) }}</strong></p>
                <p>DB Connection: <span style="color: green;">MySQL Active</span></p>
            </div>
        </div>

        <div class="table-container">
            <h3>Employee Directory</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $emp)
                    <tr>
                        <td>{{ $emp->name }}</td>
                        <td>{{ $emp->email }}</td>
                        <td>
                            <span class="badge {{ $emp->role == 'Admin' ? 'badge-admin' : 'badge-user' }}">
                                {{ $emp->role }}
                            </span>
                        </td>
                        <td>{{ $emp->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</x-app-layout>