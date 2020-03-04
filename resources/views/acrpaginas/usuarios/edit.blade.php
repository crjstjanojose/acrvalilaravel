@extends('acrlayout.app')

@section('titulo','Edição de Usuário')

@section('conteudo')
<main class="app-content">
    <div class="tile">
        <div class="col-md-12">
            <h3 class="tile-title">
                Edição de Usuário
            </h3>
            <div class="tile-body">
                <form class="form-horizontal" method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label class="control-label col-md-3" for="name">Nome</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" placeholder="Nome" name="name" required id="name" value="{{ $user->name }}">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3">E-mail</label>
                        <div class="col-md-8">
                            <input class="form-control" type="email" placeholder="E-mail" name="email" required value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3" for="situacao">Situação</label>
                        <div class="col-md-8">
                            <select name="situacao" id="situacao" class="form-control">
                                <option value="Ativo" {{ $user->situacao == 'Ativo' ? 'selected' : '' }}> Ativo</option>
                                <option value="Inativo" {{ $user->situacao == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>
                    </div>

                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Salvar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{ route('users.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Retornar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
