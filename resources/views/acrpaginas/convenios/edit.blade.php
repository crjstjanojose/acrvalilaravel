@extends('acrlayout.app')

@section('titulo','Edição de Usuário')

@section('conteudo')

<main class="app-content">

    <div class="app-title">
        <div>
            <h1 class="py-2"><i class="fa fa-dashboard"></i> Edição de Convênio </h1>
        </div>
    </div>

    <div class="tile">
        <div class="col-md-12">
            <h3 class="tile-title"></h3>
            <div class="tile-body">
                <form class="form-horizontal" method="POST" action="{{ route('convenios.update', $convenio->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label class="control-label col-md-3" for="denominacao">Denominacao</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" placeholder="Denominação" name="denominacao" required id="denominacao" value="{{ old('denominacao') ? old('denominacao') : $convenio->denominacao }}">
                            <span id="error-denominacao" class="help-block text-danger">{{ $errors->first('denominacao') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3" for="situacao">Situação</label>
                        <div class="col-md-8">
                            <select name="situacao" id="situacao" class="form-control">
                                <option value="Ativo" {{ $convenio->situacao == 'Ativo' ? 'selected' : '' }}> Ativo</option>
                                <option value="Inativo" {{ $convenio->situacao == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                            </select>
                            <span id="error-situacao" class="help-block text-danger">{{ $errors->first('situacao') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3" for="user_id">Responsável</label>

                        <div class="col-md-8">
                            <select name="user_id" id="user_id" class="form-control">
                                @foreach ($usuarios as $user)
                                <option value="{{ $user->id  }}" {{  $convenio->user_id == $user->id ? 'selected' : ''  }}> {{ $user->name }} </option>
                                @endforeach
                            </select>
                            <span id="error-user_id" class="help-block text-danger">{{ $errors->first('user_id') }}</span>
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
