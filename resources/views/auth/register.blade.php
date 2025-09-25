<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ProxyMarket</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --dark: #1e2a4a;
            --light: #f8f9fa;
            --gray: #718096;
            --border: #e2e8f0;
            --error: #e53e3e;
            --success: #38a169;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-image:
                radial-gradient(circle at 15% 50%, rgba(67, 97, 238, 0.1) 0%, transparent 25%),
                radial-gradient(circle at 85% 30%, rgba(67, 97, 238, 0.1) 0%, transparent 25%);
        }

        .register-container {
            width: 100%;
            max-width: 460px;
        }

        .register-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05), 0 5px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .register-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
        }

        .card-header {
            background: var(--dark);
            color: white;
            padding: 24px;
            text-align: center;
            position: relative;
        }

        .card-header h1 {
            font-size: 24px;
            font-weight: 600;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), #6c8eff);
        }

        .card-body {
            padding: 32px;
        }

        .logo {
            margin-bottom: 20px;
            text-align: center;
        }

        .logo span {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            display: inline-block;
            padding: 8px 16px;
            border: 2px solid var(--primary);
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .form-control.is-invalid {
            border-color: var(--error);
        }

        .password-strength {
            height: 5px;
            background-color: #e2e8f0;
            border-radius: 3px;
            margin-top: 8px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            border-radius: 3px;
            transition: width 0.3s, background-color 0.3s;
        }

        .invalid-feedback {
            color: var(--error);
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .password-requirements {
            margin-top: 10px;
            font-size: 13px;
            color: var(--gray);
        }

        .password-requirements ul {
            padding-left: 20px;
            margin-top: 5px;
        }

        .requirement-met {
            color: var(--success);
        }

        .btn-primary {
            width: 100%;
            padding: 14px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: var(--gray);
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .terms-notice {
            font-size: 13px;
            color: var(--gray);
            text-align: center;
            margin-top: 20px;
        }

        .terms-notice a {
            color: var(--primary);
            text-decoration: none;
        }

        .terms-notice a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .card-body {
                padding: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="card-header">
                <h1>Create Your buyproxy.vn Account</h1>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your full name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Create a strong password">
                        {{-- <div class="password-strength">
                            <div class="password-strength-bar" id="password-strength-bar"></div>
                        </div> --}}
                        {{-- <div class="password-requirements"> --}}
                            {{-- <span>Password must contain:</span>
                            <ul>
                                <li id="requirement-length">At least 8 characters</li>
                                <li id="requirement-uppercase">One uppercase letter</li>
                                <li id="requirement-number">One number</li>
                                <li id="requirement-special">One special character</li>
                            </ul> --}}
                        {{-- </div> --}}
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
                    </div>

                    <button type="submit" class="btn-primary">Create Account</button>

                    <div class="terms-notice">
                        By registering, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                    </div>

                    <div class="login-link">
                        Already have an account? <a href="{{ route('login') }}">Sign in</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        }

        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const strengthBar = document.getElementById('password-strength-bar');
            const requirements = {
                length: document.getElementById('requirement-length'),
                uppercase: document.getElementById('requirement-uppercase'),
                number: document.getElementById('requirement-number'),
                special: document.getElementById('requirement-special')
            };

            passwordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                let strength = 0;

                // Check password requirements
                const hasLength = password.length >= 8;
                const hasUppercase = /[A-Z]/.test(password);
                const hasNumber = /[0-9]/.test(password);
                const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);

                // Update requirement indicators
                requirements.length.className = hasLength ? 'requirement-met' : '';
                requirements.uppercase.className = hasUppercase ? 'requirement-met' : '';
                requirements.number.className = hasNumber ? 'requirement-met' : '';
                requirements.special.className = hasSpecial ? 'requirement-met' : '';

                // Calculate strength
                if (hasLength) strength += 25;
                if (hasUppercase) strength += 25;
                if (hasNumber) strength += 25;
                if (hasSpecial) strength += 25;

                // Update strength bar
                strengthBar.style.width = strength + '%';

                if (strength < 50) {
                    strengthBar.style.backgroundColor = '#e53e3e'; // Red for weak
                } else if (strength < 100) {
                    strengthBar.style.backgroundColor = '#d69e2e'; // Yellow for medium
                } else {
                    strengthBar.style.backgroundColor = '#38a169'; // Green for strong
                }
            });
        });
    </script>
</body>
</html>
