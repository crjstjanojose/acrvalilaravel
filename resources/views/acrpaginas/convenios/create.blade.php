@extends('acrlayout.app')

@section('titulo','Novo usuário')

@section('conteudo')
<main class="app-content">

    <div class="tile">
        <div class="col-md-12">
            <h3 class="tile-title">Adicionar Convênio </h3>

            <div class="tile-body">
                <form class="form-horizontal" method="POST" action="{{ route('convenios.store') }}" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <label class="control-label col-md-3" for="denominacao">Denominação</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" placeholder="Denominacao" name="denominacao" required id="Denominação" value="{{ old('denominacao') }}">
                            <span id="error-cpf" class="help-block text-danger">{{ $errors->first('denominacao') }}</span>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3" for="user_id">Usuário</label>
                        <div class="col-md-8">
                            <select name="user_id" id="user_id" class="form-control">
                                @foreach ($usuarios as $user)
                                <option value="{{ $user->id}}">{{ $user->name }} </option>
                                @endforeach
                            </select>
                            <span id="error-cpf" class="help-block text-danger">{{ $errors->first('convenio') }}</span>

                        </div>
                    </div>
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Salvar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{ route('convenios.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Retornar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
