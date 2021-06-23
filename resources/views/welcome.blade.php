<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Raleway", sans-serif;
        }

        body {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: rgb(2, 0, 36);
            background: radial-gradient(circle,
                    rgba(2, 0, 36, 1) 0%,
                    rgba(75, 0, 85, 1) 100%,
                    rgba(0, 212, 255, 1) 100%);
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
        }

        .btn {
            position: relative;
            display: inline-block;
            border: none;
            border-radius: 50px;
            background: none;
            padding: 25px 75px;
            margin: 30px;
        }

        .btn a {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.05);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            color: #fff;
            z-index: 1;
            font-weight: 500;
            letter-spacing: 1px;
            text-decoration: none;
            overflow: hidden;
            text-transform: uppercase;
            transition: all 0.3s ease-in-out;
            backdrop-filter: blur(15px);
        }

        .btn:hover a {
            letter-spacing: 3px;
        }

        .btn a::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 50%;
            height: 100%;
            background: linear-gradient(to left,
                    rgba(255, 255, 255, 0.15),
                    transparent);
            transform: skewX(40deg) translateX(0);
            transition: all 0.5s ease-out;
        }

        .btn:hover a::before {
            transform: skewX(40deg) translateX(200%);
        }

        .btn::before,
        .btn::after {
            content: "";
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 10px;
            border-radius: 10px;
            background: #f00;
            transition: all 0.4s ease-in-out;
            transition-delay: 0s;
        }

        .btn::before {
            bottom: -5px;
        }

        .btn::after {
            top: -5px;
        }

        .btn:hover::before,
        .btn:hover::after {
            height: 90%;
            width: 95%;
            border-radius: 30px;
            transition-delay: 0.3s;
        }

        .btn:hover::before {
            bottom: 0;
        }

        .btn:hover::after {
            top: 0;
        }

        .btn:nth-child(1)::before,
        .btn:nth-child(1)::after {
            background: #ff7979;
            box-shadow: 0 0 5px #ff7979, 0 0 15px #ff7979, 0 0 30px #ff7979,
                0 0 60px #ff7979;
        }

        .btn:nth-child(2)::before,
        .btn:nth-child(2)::after {
            background: #29c6f2;
            box-shadow: 0 0 5px #29c6f2, 0 0 15px #29c6f2, 0 0 30px #29c6f2,
                0 0 60px #29c6f2;
        }

    </style>
</head>

<body>
    <div class="container">
        <button onclick="location.href='{{ url('login') }}'" class="btn"><a href="#">User</a></button>
        <button onclick="location.href='{{ url('admin/login') }}'" class="btn"><a href="#">Admin</a></button>
    </div>
</body>

</html>
