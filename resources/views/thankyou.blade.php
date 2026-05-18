<!DOCTYPE html>
<html>
<head>
    <title>Thank You</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #fdf6e3; /* cream background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .thankyou-card {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        .thankyou-card h2 {
            color: #2c3e50;
            margin-bottom: 15px;
        }
        .thankyou-card p {
            color: #555;
            margin-bottom: 25px;
        }
        .thankyou-card a {
            display: inline-block;
            text-decoration: none;
            background: #1c2833; /* deep navy blue */
            color: #fff;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 16px;
            transition: background 0.3s;
        }
        .thankyou-card a:hover {
            background: #34495e;
        }
    </style>
</head>
<body>
    <div class="thankyou-card">
        <h2>Thank you for your order! {{ session('user') }}</h2>
        <p>Your payment was successful. We’ll process your order soon.</p>
        <a href="{{ route('product.listing') }}">Back to Home</a>
    </div>
</body>
</html>
