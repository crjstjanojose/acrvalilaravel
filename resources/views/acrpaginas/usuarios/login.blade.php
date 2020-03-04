<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login</title>
</head>
<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logos">
            <img src="{{ asset('img/logo-medio.png')}}" alt="Logo da Empresa">
        </div>
        <div class="login-box">
            <form class="login-form" action="{{ route('login.post') }}" method="POST">
                @csrf
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i> Login </h3>
                <div class="form-group">
                    <label class="control-label">E-mail</label>
                    <input class="form-control" type="text" placeholder="Email" autofocus name="email">
                </div>
                <div class="form-group">
                    <label class="control-label">Senha</label>
                    <input class="form-control" type="password" placeholder="Senha" name="password">
                </div>
                <div class="form-group">
                    <div class="utility">
                        <div class="animated-checkbox">
                            <label>
                                <input type="checkbox"><span class="label-text">Lembrar me</span>
                            </label>
                        </div>
                        <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Esqueceu a senha ?</a></p>
                    </div>
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i> Acessar </button>
                </div>
        </div>
    </section>
    <script src="{{ asset('/site/js/main.js') }}"></script>
</body>
</html>
