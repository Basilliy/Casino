<html lang="en">
    <head>
        <title>Register</title>
    </head>
    <body>
    <style>
        * {box-sizing: border-box}

        .container {
            padding: 16px;
        }

        input[type=text], input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus, input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        .registerbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .error {
            background-color: #ff0000;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            width: 100%;
            opacity: 0.9;
        }

        .link {
            background-color: #38ff00;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            width: 100%;
            opacity: 0.9;
        }

        .registerbtn:hover {
            opacity:1;
        }

        a {
            color: dodgerblue;
        }
    </style>

    @if (session()->has('success'))
        <div class="link">
            <a href="{{session('success')[0]}}">Game link</a>
        </div>
    @endif
    <form action="{{route('user.create')}}" method="POST">
        {{csrf_field()}}
        <div class="container">
            <h1>Register</h1>

            <hr>

            @if($errors->has('user_name'))
                <div class="error">{{ $errors->first('user_name') }}</div>
            @endif
            <label for="email"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="user_name" required>

            @if($errors->has('phone_number'))
                <div class="error">{{ $errors->first('phone_number') }}</div>
            @endif
            <label for="psw"><b>Phone number</b></label>
            <input type="text" placeholder="Enter phone number" name="phone_number" required>
            <hr>

            <button type="submit" class="registerbtn">Register</button>
        </div>
    </form>

    </body>
</html>
