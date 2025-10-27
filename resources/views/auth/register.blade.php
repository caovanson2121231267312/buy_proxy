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

        /* Google Login Button Styles */
        .btn-google {
            width: 100%;
            padding: 14px;
            background-color: white;
            color: #757575;
            border: 1px solid #dadce0;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s, box-shadow 0.3s;
            margin-top: 10px;
        }

        .btn-google:hover {
            background-color: #f8f9fa;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .btn-google:active {
            background-color: #f1f3f4;
        }

        .google-icon {
            width: 18px;
            height: 18px;
            margin-right: 12px;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: var(--border);
        }

        .divider span {
            padding: 0 15px;
            color: var(--gray);
            font-size: 13px;
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

                    <div class="divider">
                        <span>OR</span>
                    </div>

                    <!-- Google Register Button -->
                    <a href="{{ route('google.login') }}" class="btn-google">
                        <svg class="google-icon" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
                            <g transform="matrix(1, 0, 0, 1, 27.009001, -39.238998)">
                                <path fill="#4285F4" d="M -3.264 51.509 C -3.264 50.719 -3.334 49.969 -3.454 49.239 L -14.754 49.239 L -14.754 53.749 L -8.284 53.749 C -8.574 55.229 -9.424 56.479 -10.684 57.329 L -10.684 60.329 L -6.824 60.329 C -4.564 58.239 -3.264 55.159 -3.264 51.509 Z"/>
                                <path fill="#34A853" d="M -14.754 63.239 C -11.514 63.239 -8.804 62.159 -6.824 60.329 L -10.684 57.329 C -11.764 58.049 -13.134 58.489 -14.754 58.489 C -17.884 58.489 -20.534 56.379 -21.484 53.529 L -25.464 53.529 L -25.464 56.619 C -23.494 60.539 -19.444 63.239 -14.754 63.239 Z"/>
                                <path fill="#FBBC05" d="M -21.484 53.529 C -21.734 52.809 -21.864 52.039 -21.864 51.239 C -21.864 50.439 -21.724 49.669 -21.484 48.949 L -21.484 45.859 L -25.464 45.859 C -26.284 47.479 -26.754 49.299 -26.754 51.239 C -26.754 53.179 -26.284 54.999 -25.464 56.619 L -21.484 53.529 Z"/>
                                <path fill="#EA4335" d="M -14.754 43.989 C -12.984 43.989 -11.404 44.599 -10.154 45.789 L -6.734 42.369 C -8.804 40.429 -11.514 39.239 -14.754 39.239 C -19.444 39.239 -23.494 41.939 -25.464 45.859 L -21.484 48.949 C -20.534 46.099 -17.884 43.989 -14.754 43.989 Z"/>
                            </g>
                        </svg>
                        Continue with Google
                    </a>

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

        // Google Register Button Handler
        document.getElementById('google-register').addEventListener('click', function() {
            // Hiển thị thông báo chức năng đang phát triển
            toastr.info('Google Sign Up is currently under development');
            
            // Trong tương lai, đây sẽ là nơi để tích hợp Google OAuth
            // window.location.href = '/auth/google';
        });
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