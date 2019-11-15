@extends('acrlayout.app')

@section('conteudo')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1>Grupos de Acesso</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li>
                <a class="btn btn-sm btn-primary" href="{{ route('grupos.create') }}" title="Criar nova encomenda"><i class="fa fa-plus-square" aria-hidden="true"></i> Nova Grupo</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <div class="row">

                            <div class="form-group col-md-9">
                                <label class="control-label">Nome</label>
                                <input class="form-control @error('nome') is-invalid @enderror" type="text" required placeholder="Nome do Cliente..." name="nome" value="{{ old('nome') }}">
                                <span id="error-nome" class="help-block text-danger">{{ $errors->first('nome') }}</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection
