<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Laravel Auth</title>
  <style>
    body {
      background: #f9f9f9;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .auth-container {
      background: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .auth-container h2 {
      margin-bottom: 25px;
      color: #333;
    }

    .auth-container a {
      padding: 12px 24px;
      margin: 10px;
      border: none;
      border-radius: 8px;
      background-color: #4CAF50;
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
      text-decoration: none;
    }

    .auth-container a:hover {
      background-color: #45a049;
      transform: scale(1.05);
    }
  </style>
</head>
<body>

<div class="auth-container">
  <h2>Laravel Authentication</h2>
  <div>
    <a href="/register">Register</a>
     <a href="/login">Login</a>

  </div>
</div>

</body>
</html>
