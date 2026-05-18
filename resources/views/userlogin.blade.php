<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #fdfbfb, #ebedee);

        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 24px;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: none;
            border-radius: 5px;
            background: #f0f2f5;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            background: #fff;
            box-shadow: 0 0 5px rgba(107, 72, 255, 0.5);
        }

        .input-group label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #666;
            font-size: 16px;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .input-group input:focus+label,
        .input-group input:not(:placeholder-shown)+label {
            top: -10px;
            left: 10px;
            font-size: 12px;
            color: #6b48ff;
            background: #fff;
            padding: 0 5px;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background: linear-gradient(45deg, #6b48ff, #00ddeb);
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }

        .forgot-password a {
            color: #6b48ff;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
        #showRegister{
            text-decoration: none;
            color: darkblue;
            font-weight: 500;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 20px;
                margin: 20px;
            }
        }
    </style>
</head>

<body>
    @error('login_error')
        <div
            style="position: fixed; top: 0; left: 0; width: 100%; background-color: #ffebee; color: red; padding: 10px; text-align: center; z-index: 1000; border-bottom: 1px solid #ef9a9a;">
            {{ $message }}
        </div>
    @enderror
    <!-- Login -->
    <div class="login-container" id="loginForm">
        <h2>User-Login</h2>
        @error('user')
            <div style="color: red; margin-bottom: 12px;">{{ $message }}</div>
        @enderror
        <form action="/user-login" method="post">
            @csrf
            <div class="input-group">
                <input type="text" id="username" name="username" placeholder=" ">
                <label for="username">Username</label>
                @error('username')
                    <div style="color:red">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder=" ">
                <label for="password">Password</label>
                @error('password')
                    <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="login-btn">Sign In</button>
            <p style="margin-top: 20px;
    margin-left: 30px;">Don't have an account? <a href="#"
                    id="showRegister">SignUp</a></p>
        </form>
    </div>

    <!-- Register -->
    <div class="login-container" id="registerForm" style="display: none;">
        <h2>User-Register</h2>
        <form action="register" method="post">
            @csrf
            <div class="input-group">
                <input type="text" name="username" placeholder=" ">
                <label for="username">Username</label>
            </div>
            <div class="input-group">
                <input type="email" name="email" placeholder=" ">
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder=" ">
                <label for="password">Password</label>
            </div>
            <button type="submit" class="login-btn">Sign Up</button>
            <p style="margin-top: 15px; font-size: 14px; color: #555;">
                Already have an account?
                <a href="#" id="showLogin" style="color: #007bff; text-decoration: none; font-weight: bold;">
                    Login
                </a>
            </p>
        </form>
    </div>

    <script>
        // show register
        document.getElementById('showRegister').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('registerForm').style.display = 'block';
        });

        // show login
        document.getElementById('showLogin').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('registerForm').style.display = 'none';
            document.getElementById('loginForm').style.display = 'block';
        });
    </script>

</body>

</html>
