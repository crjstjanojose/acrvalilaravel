@extends('acrlayout.app')

@section('titulo','Edição de Usuário')

@section('conteudo')
<div class="app-content">
    <div class="tile">
        <div class="col-md-12">
            <h3 class="tile-title">
                Edição de Permissão
            </h3>
            <div class="tile-body">
                <form class="form-horizontal" method="POST" action="{{ route('permissions.update', $permission->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label class="control-label col-md-3" for="name">Nome</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" placeholder="Nome" name="name" required id="name" value="{{ $permission->name }}">

                        </div>
                    </div>
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Salvar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{ route('permissions.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Retornar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
