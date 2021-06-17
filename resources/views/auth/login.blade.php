<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <style>
        html,
        body {
        height: 100%;
        }

        body {
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-align: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
        }

        .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
        }
        .form-signin .checkbox {
        font-weight: 400;
        }
        .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
        }
        .form-signin .form-control:focus {
        z-index: 2;
        }
        .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }
    </style>
</head>

    <body class="text-center">
        <form class="form-signin" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <img class="mb-4" src="data:image/jpeg;base64,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" alt="" width="72" height="72">
            
            <label for="email" class="sr-only">Email address</label>
            <input name="email"  type="email" id="email" class="form-control @error('email') is-invalid @enderror"" value="{{ old('email') }}" placeholder="Email address" required autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="password" class="sr-only">Password</label>
            <input name="password" type="password" id="password" class="form-control @error('password') is-invalid @enderror"" placeholder="Password" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="checkbox mb-3">
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017-2018 | Barbara Shop</p>
        </form>
    </body>
</html>
