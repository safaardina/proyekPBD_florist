
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Bloomify</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #fff1f6, #f8d8e6);
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 950px;
            min-height: 550px;
            display: flex;
            background: white;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 12px 40px rgba(180, 90, 130, 0.15);
        }

        .login-left {
            width: 50%;
            background: linear-gradient(145deg, #d96c9d, #b94e80);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 45px;
            text-align: center;
        }

        .flower {
            font-size: 90px;
            margin-bottom: 20px;
        }

        .login-left h1 {
            font-size: 38px;
            margin-bottom: 15px;
            letter-spacing: 2px;
        }

        .login-left p {
            font-size: 15px;
            line-height: 1.7;
            opacity: 0.9;
        }

        .login-right {
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 55px;
        }

        .login-right h2 {
            color: #49313d;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #999;
            font-size: 14px;
            margin-bottom: 35px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            color: #49313d;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 9px;
        }

        .form-group input {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #edc6d8;
            border-radius: 9px;
            outline: none;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: #d96c9d;
            box-shadow: 0 0 0 3px rgba(217, 108, 157, 0.12);
        }

        .login-button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 9px;
            background: #d96c9d;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
        }

        .login-button:hover {
            background: #bd5687;
        }

        .error-message {
            background: #fff0f0;
            color: #c0395a;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            color: #aaa;
            font-size: 12px;
        }

        @media (max-width: 700px) {
            .login-container {
                flex-direction: column;
            }

            .login-left,
            .login-right {
                width: 100%;
            }

            .login-left {
                padding: 35px 20px;
            }

            .flower {
                font-size: 55px;
            }

            .login-left h1 {
                font-size: 30px;
            }

            .login-right {
                padding: 35px 25px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="login-left">
        <div class="flower">🌸</div>

        <h1>Bloomify</h1>

        <p>
            Bring Beauty to Every Bloom.
            <br>
            Kelola bisnis florist dengan lebih mudah,
            teratur, dan efisien.
        </p>
    </div>

    <div class="login-right">

        <h2>Welcome Back!</h2>

        <p class="subtitle">
            Silakan login untuk melanjutkan ke Bloomify.
        </p>

        @if (session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-message">
                Mohon isi username dan password dengan benar.
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf

            <div class="form-group">
                <label>Username</label>
                <input
                    type="text"
                    name="username"
                    placeholder="Masukkan username"
                    value="{{ old('username') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label>Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <button type="submit" class="login-button">
                Login
            </button>
        </form>

        <div class="footer">
            © {{ date('Y') }} Bloomify. All Rights Reserved.
        </div>

    </div>

</div>

</body>
</html>
