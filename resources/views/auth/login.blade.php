<?php
// Set Referrer-Policy header
header("Referrer-Policy: strict-origin-when-cross-origin");

// Set Permissions-Policy header
header("Permissions-Policy: accelerometer=(), autoplay=(), camera=(), encrypted-media=(), fullscreen=(), geolocation=(), gyroscope=(), magnetometer=(), microphone=(), midi=(), payment=(), usb=()");

// Set Content-Security-Policy header



// Generate a random nonce value for each request
$nonce = base64_encode(random_bytes(16));

// Ensure the nonce value is safe to use in HTML attributes
$nonce = htmlspecialchars($nonce, ENT_QUOTES);


// Set Content-Security-Policy header with nonce value and img-src directive
//header("Content-Security-Policy: default-src 'self'; img-src https://cvchd.doh.gov.ph; style-src 'self' 'nonce-$nonce' 'unsafe-inline'; script-src 'self'; object-src 'none'; font-src 'self'; frame-ancestors 'self'; form-action 'self';");
header("Content-Security-Policy: default-src 'self'; img-src https://cvchdis.doh.gov.ph/helpdesk/public; style-src 'self' 'nonce-$nonce' 'unsafe-inline' https://fonts.googleapis.com; script-src 'self' 'nonce-$nonce'; object-src 'none'; font-src 'self' https://fonts.gstatic.com; frame-ancestors 'self'; form-action 'self';");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Department of Health</title>
    <!-- Google Font for styling -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" nonce="{{ $nonce }}">
    <style nonce="{{ $nonce }}">
       /* General Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f3f4f6, #e0e7ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Login Container */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 20px;
        }

        /* Login Box */
        .login-box {
            background-color: #ffffff;
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        /* Headings */
        h1 {
            font-size: 26px;
            font-weight: 700;
            color: #2b3a42;
            margin-bottom: 20px;
        }

        /* Form Fields */
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            font-size: 14px;
            font-weight: 500;
            color: #2b3a42;
            margin-bottom: 5px;
            display: block;
        }

        /* Input Fields */
        .input-field {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .input-field:focus {
            border-color: #007BFF;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
            outline: none;
        }

        /* Error Message Styling */
        .error-message {
            color: #d9534f;
            font-size: 12px;
            margin-top: 5px;
            text-align: left;
            padding-left: 5px;
        }

        .error-message ul {
            list-style-type: none;
            padding: 0;
        }

        .error-message li {
            margin: 5px 0;
        }

        .input-field.error {
            border-color: #d9534f;
            background-color: #f8d7da;
        }

        /* Remember Me Checkbox */
        .remember-me {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .checkbox {
            margin-right: 8px;
        }

        /* Login Button */
        .login-button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #0c9223, #03b403);
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .login-button:hover {
            background: linear-gradient(90deg, #09b426, #05970d);
            transform: scale(1.02);
        }

        /* Responsive Adjustments */
        @media (max-width: 600px) {
            .login-box {
                padding: 20px;
            }

            h1 {
                font-size: 22px;
            }

            .input-field {
                font-size: 16px;
            }

            .login-button {
                font-size: 18px;
            }
        }
    </style>
    
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>{{ env('APP_NAME') }}</h1>
            
            <br>

            <form method="POST" action="{{ route('login') }}">
                @csrf
            
                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required 
                        class="input-field {{ $errors->has('email') ? 'error' : '' }}" 
                        value="{{ old('email') }}">
                    
                    @if ($errors->has('email'))
                        <div class="error-message">
                            <ul>
                                @foreach ($errors->get('email') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif (session('error') && session('error') == 'invalid_credentials')
                        <div class="error-message">
                            <p>These credentials do not match our records.</p>
                        </div>
                    @endif
                </div>
            
                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        class="input-field {{ $errors->has('password') ? 'error' : '' }}">
            
                    @if ($errors->has('password'))
                        <div class="error-message">
                            <ul>
                                @foreach ($errors->get('password') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            
                <div class="form-group remember-me">
                    <input type="checkbox" name="remember" id="remember" class="checkbox">
                    <label for="remember">Remember me</label>
                </div>
            
                <button type="submit" class="login-button">Login</button>
            </form>
        </div>
    </div>
</body>
</html>