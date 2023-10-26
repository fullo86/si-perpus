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
<body class="register my-5"> 
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h1 class="text-center">Register</h1>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>                    
            @endif
            <form method="POST" action="" method="POST">
                    @csrf
                    <div class="mb-1">
                        <label for="nama" class="form-label"></label>
                        <input id="nama" class="form-control" type="text" name="name" placeholder="Masukan Nama Lengkap" required autofocus autocomplete="name">
                    </div>
                    <div class="mb-1">
                        <label for="username" class="form-label"></label>
                        <input id="username" class="form-control" type="text" name="username" placeholder="Masukan Username" required autofocus autocomplete="username">
                    </div>
                    <div class="mb-1">
                        <label for="password" class="form-label"></label>
                        <input id="password" class="form-control" type="password" name="password" placeholder="Masukan Password" required autocomplete="current-password">
                    </div>                
                    <div class="mb-1">
                        <label for="phone" class="form-label"></label>
                        <input id="phone" class="form-control" type="text" name="phone" placeholder="Masukan No Hp" required autofocus autocomplete="phone">
                    </div>
                    <div class="mb-1">
                        <label for="email" class="form-label"></label>
                        <input id="email" class="form-control" type="email" name="email" placeholder="Masukan Email" required autofocus autocomplete="email">
                    </div>                    
                    <div class="mb-3">
                        <label for="address" class="form-label"></label>
                        <textarea id="address" class="form-control" type="text" name="address" placeholder="Masukan Alamat" rows="5" required autofocus autocomplete="address"></textarea>
                    </div>
                    <button class="btn btn-primary form-control">Submit</button>
                </form>                
                <div class="text-center mt-3">
                    already have account? <a href="/login">Login</a>
                </div>
            </div>
        </div>
    </div>
        <script src="/js/bootstrap.js"></script>
</body>
</html>