<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Multiple Images</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: #fff;
            padding: 30px;
            width: 400px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
        }

        input[type="file"] {
            display: block;
            width: 100%;
            padding: 10px;
            border: 2px dashed #bbb;
            border-radius: 8px;
            background: #fafafa;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        input[type="file"]:hover {
            border-color: #007bff;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            border: none;
            background: #007bff;
            color: #fff;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        .alert {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="container">
        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif
        <h2>Add Images for {{ $Image->name }}</h2>

        <form action="{{ route('SendMultipleImg', $Image->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="images[]" multiple accept="image/*">   
            <input type="text" placeholder="add image name" name="color">  
            <button type="submit">Upload Images</button>
        </form>
    </div>

</body>

</html>
