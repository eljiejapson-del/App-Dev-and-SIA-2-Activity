<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Employee Portal</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>New Password</h2>
                <p>Set a secure password for your account</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <i data-lucide="alert-circle" class="alert-icon"></i>
                    <div class="alert-content">
                        @foreach ($errors->all() as $error)
                            <p class="text-sm">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update.direct') }}">
                @csrf
                
                <div class="helper-text">
                    <p>Enter your registered email and your new desired password below to update your account.</p>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="name@company.com" 
                               class="{{ $errors->has('email') ? 'input-error' : '' }}"
                               required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <div class="input-wrapper">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               placeholder="••••••••" 
                               class="{{ $errors->has('password') ? 'input-error' : '' }}"
                               required>
                        <button type="button" class="icon-button toggle-pass" data-target="password">
                            <i data-lucide="eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <div class="input-wrapper">
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               placeholder="••••••••" 
                               required>
                        <button type="button" class="icon-button toggle-pass" data-target="password_confirmation">
                            <i data-lucide="eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <span>Update Password</span>
                    <i data-lucide="refresh-cw" class="btn-icon"></i>
                </button>

                <div class="auth-footer">
                    <a href="{{ route('login') }}" class="register-link flex items-center justify-center gap-1">
                        <i data-lucide="arrow-left" style="width:14px"></i>
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Password Toggle Logic
        document.querySelectorAll('.toggle-pass').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const isPassword = input.getAttribute('type') === 'password';
                
                input.setAttribute('type', isPassword ? 'text' : 'password');
                
                // Toggle the Lucide icon visually
                if (isPassword) {
                    this.innerHTML = '<i data-lucide="eye-off"></i>';
                } else {
                    this.innerHTML = '<i data-lucide="eye"></i>';
                }
                
                // Re-run Lucide to render the new icon
                lucide.createIcons();
            });
        });
    </script>
</body>
</html>