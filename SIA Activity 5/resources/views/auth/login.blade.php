<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Employee Portal</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Welcome Back</h2>
                <p>Please enter your details to sign in</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success" style="background-color: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                    <i data-lucide="check-circle" style="width: 18px; flex-shrink: 0;"></i>
                    <div class="alert-content">
                        {{ session('status') }}
                    </div>
                    <button type="button" class="alert-close" style="margin-left: auto; background: none; border: none; cursor: pointer; color: #166534; opacity: 0.6;" onclick="this.parentElement.style.display='none'">&times;</button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-container">
                    <div class="alert alert-danger" style="background-color: #fef2f2; border: 1px solid #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; display: flex; align-items: flex-start; gap: 8px;">
                        <i data-lucide="alert-circle" class="alert-icon" style="width: 18px; margin-top: 2px; flex-shrink: 0;"></i>
                        <div class="alert-content">
                            @foreach ($errors->all() as $error)
                                <div style="margin-bottom: 2px;">{{ $error }}</div>
                            @endforeach
                        </div>
                        <button type="button" class="alert-close" style="margin-left: auto; background: none; border: none; cursor: pointer; color: #991b1b; opacity: 0.6;" onclick="this.parentElement.parentElement.style.display='none'">&times;</button>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
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
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               placeholder="••••••••"
                               class="{{ $errors->has('password') ? 'input-error' : '' }}"
                               required>
                        <button type="button" id="togglePassword" class="icon-button">
                            <i data-lucide="eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    <div class="field-footer">
                        <a href="{{ route('password.direct') }}" class="forgot-link">Forgot password?</a>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <span>Sign In</span>
                    <i data-lucide="arrow-right" class="btn-icon"></i>
                </button>

                <div class="auth-footer">
                    <span>Don't have an account?</span>
                    <a href="{{ route('register') }}" class="register-link">Create account</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Password Toggle Logic
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // toggle icon
            if (type === 'text') {
                this.innerHTML = '<i data-lucide="eye-off"></i>';
            } else {
                this.innerHTML = '<i data-lucide="eye"></i>';
            }
            lucide.createIcons(); // refresh icons after change
        });
    </script>
</body>
</html>