<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body class="login"> 
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <h1 class="text-center">Login</h1>
                @if (Session::has('status'))
                <div class="alert alert-{{ Session::get('status') == 'success' ? 'success' : 'danger' }}">
                    {{ Session::get('message') }}
                </div>
                @endif
                <form method="POST" action="">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label"></label>
                        <input id="username" class="form-control" type="text" name="username" placeholder="Masukan Username" required autofocus autocomplete="username">
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label"></label>
                        <input id="password" class="form-control" type="password" name="password" placeholder="Masukan Password" required autocomplete="current-password">
                    </div>                
                    <button class="btn btn-primary form-control">Login</button>
                </form>
                <div class="text-center mt-3">
                    don't have account? <a href="/register">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
        <script src="/js/bootstrap.js"></script>
</body>
</html>