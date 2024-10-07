<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Method Not Allowed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        h1 {
            font-size: 48px;
            color: #333;
        }
        p {
            font-size: 18px;
            color: #666;
        }
        a {
            text-decoration: none;
            color: #007BFF;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>405 | Method Not Allowed</h1>
        <p>Oops! The request method is not allowed for the requested route.</p>
        <a href="{{ url('/') }}">Go Back to Homepage</a>
    </div>
</body>
</html>
