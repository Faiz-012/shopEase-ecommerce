<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin Login page.</title>
    <style>
        body {
            background-color: #f9f5f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .form-container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            color: #555;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
            margin-bottom: 8px;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        button {
            width: 100%;
            padding: 0.75rem;
            background-color: #ff7f50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ff6333;
        }
    </style>
</head>

<body>
    @error('login_error')
    <div style="
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #f44336;
        color: white;
        padding: 12px;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
        z-index: 9999;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);">
        {{ $message }}
    </div>
@enderror

    <div class="form-container">
        <h2>Login</h2>
        @error('user')
            <div style="color: red">{{ $message }}</div>
        @enderror
        <form action="Authentication" method="post">
            @csrf
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" id="name" name="name" placeholder="Admin name">
                @error('name')
                    <div style="color: red">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password">
                @error('password')
                    <div style="color:red">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
