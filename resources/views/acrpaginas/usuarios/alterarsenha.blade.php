<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login</title>
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <div class="container my-2">
            @if (session('msgSucesso'))
            <div class="alert alert-dismissible alert-primary">
                <button class="close" type="button" data-dismiss="alert">×</button>
                <b>{{ session('msgSucesso') }}</b>
            </div>
            @endif
            @if (session('msgErro'))
            <div class="alert alert-dismissible alert-info">
                <button class="close" type="button" data-dismiss="alert">×</button>
                <b>{{ session('msgErro') }}</b>
            </div>
            @endif
        </div>
    <section class="login-content">
        <div class="login-box">
            <form class="login-form" method="POST" action="{{ route('usuario.update.senha') }}" autocapitalize="false">
                @csrf
               <h5 class="text-center"><i class="fa fa-lg fa-fw fa-user"></i>Alteração de Senha</h5>
                <div class="form-group">
                    <label class="">Senha Atual</label>
                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                        placeholder="Senha" name="password" required>
                </div>
                <div class="form-group">
                    <label class="">Nova Senha</label>
                    <input class="form-control @error('confirma') is-invalid @enderror" type="password"
                        placeholder="Nova senha" name="nova" required>
                </div>
                <div class="form-group">
                    <label class="">Senha Atual</label>
                    <input class="form-control @error('confirma') is-invalid @enderror" type="password"
                        placeholder="Confirmação" name="confirma" required>
                        <span id="error-confirma"
                                    class="help-block text-danger">{{ $errors->first('confirma') }}</span>
                </div>
                <div class="form-group ">
                    <div class="row">
                        <div class="col-md-5">
                            <p class="semibold-text mb-2"><a href="{{ route('home') }}"
                                data-toggle="flip"> Retornar</a></p>
                        </div>
                        <div class="col-md-7">
                            <button class="btn btn-primary btr-sm mb-4"><i class="fa fa-check"></i> Alterar
                        </div>
                    </div>
                    </button>
                </div>
            </form>
        </div>
    </section>
</body>
<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</html>
