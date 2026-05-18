<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Employee Portal</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Create Account</h2>
                <p>Join the portal to manage your dashboard</p>
            </div>

            @if ($errors->any())
                <div class="alert-container">
                    <div class="alert alert-danger">
                        <i data-lucide="alert-circle" class="alert-icon"></i>
                        <div class="alert-content">
                            @foreach ($errors->all() as $error)
                                <span>{{ $error }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <div class="input-wrapper">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="name@company.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Select Your Role</label>
                    <div class="role-selector">
                        <label class="role-option">
                            <input type="radio" name="role" value="User" checked>
                            <div class="role-card">
                                <div class="dot"></div>
                                <span>Employee (User)</span>
                            </div>
                        </label>
                        <label class="role-option">
                            <input type="radio" name="role" value="Admin">
                            <div class="role-card">
                                <div class="dot"></div>
                                <span>Manager (Admin)</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                        <button type="button" class="icon-button toggle-pass" data-target="password">
                            <i data-lucide="eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                        <button type="button" class="icon-button toggle-pass" data-target="password_confirmation">
                            <i data-lucide="eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <span>Register Account</span>
                    <i data-lucide="user-plus" class="btn-icon"></i>
                </button>

                <div class="auth-footer">
                    <span>Already have an account?</span>
                    <a href="{{ route('login') }}" class="register-link">Login here</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();

        // Password Toggle Logic for both fields
        document.querySelectorAll('.toggle-pass').forEach(button => {
            button.addEventListener('click', function() {
                const inputId = this.getAttribute('data-target');
                const input = document.getElementById(inputId);
                const isPassword = input.getAttribute('type') === 'password';
                
                input.setAttribute('type', isPassword ? 'text' : 'password');
                this.innerHTML = isPassword ? '<i data-lucide="eye-off"></i>' : '<i data-lucide="eye"></i>';
                lucide.createIcons();
            });
        });
    </script>
</body>
</html>