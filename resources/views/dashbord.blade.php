<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DashBord</title>
    <style>
        .logout{
            background: red;
            color: white;
            padding: 12px 17px;
            border-radius: 5px;
            border: none;
            cursor: pointer;   
            text-decoration: none;
        }
        body{
            margin-left: 25px;
        }
        h1 a{
            text-decoration: none;
            color: green;
            cursor: none;
        }
    </style>
</head>
<body>
    <h1>Welcome. <a href="">{{ Auth::user()->name }}</a></h1>
    
        <a href="/logout" class="logout">Logout</a>
</body>
</html>