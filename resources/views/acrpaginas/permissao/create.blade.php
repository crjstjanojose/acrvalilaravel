@extends('acrlayout.app')

@section('titulo','Novo usuário')

@section('conteudo')
<div class="col-md-12">
    <h3 class="tile-title">
        Nova Permissão
    </h3>
    <div class="tile-body">
        <form class="form-horizontal" method="POST" action="{{ route('permissions.store') }}">
            @csrf
            <div class="form-group row">
                <label class="control-label col-md-3" for="name">Nome</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" placeholder="Nome" name="name" required id="name" value="{{ old('name') }}">
                    @if ($errors->register->has('name'))
                    <span class="text-danger">
                        <strong>{{ $errors->register->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="tile-footer">
                <div class="row">
                    <div class="col-md-8 col-md-offset-3">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Salvar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{ route('roles.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Retornar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
