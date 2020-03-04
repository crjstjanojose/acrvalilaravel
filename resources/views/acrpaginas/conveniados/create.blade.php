@extends('acrlayout.app')

@section('conteudo')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="my-2"><i class="fa fa-user"></i> Criação de Novo Conveniado </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <!-- END app-title -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form method="POST" action="{{ route('conveniados.store') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label class="control-label" for="nome">Nome</label>
                                <input class="form-control @error('nome') is-invalid @enderror" type="text" required placeholder="Nome do Cliente" name="nome" value="{{ old('nome') }}" id="nome" autofocus>
                                <span id="error-nome" class="help-block text-danger">{{ $errors->first('nome') }}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label" for="cpf">CPF</label>
                                <input class="form-control @error('cpf') is-invalid @enderror" type="text" required placeholder="CPF" name="cpf" value="{{ old('cpf') }}" id="cpf" maxlength="11" minlength="11">
                                <span id="error-cpf" class="help-block text-danger">{{ $errors->first('cpf') }}</span>
                            </div>
                        </div>
                        <!-- END ROW -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" control-label" for="endereco">Endereço</label>
                                <input class="form-control @error('endereco') is-invalid @enderror" type="text" required placeholder="Endereço" name="endereco" value="{{ old('endereco') }}" id="endereco">
                                <span id="error-endereco" class="help-block text-danger">{{ $errors->first('endereco') }}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label class=" control-label" for="bloco">Bloco</label>
                                <input class="form-control @error('bloco') is-invalid @enderror" type="text" required placeholder="Bloco" name="bloco" value="{{ old('bloco') }}" id="bloco">
                                <span id="error-bloco" class="help-block text-danger">{{ $errors->first('bloco') }}</span>
                            </div>
                            <div class="form-group col-md-2">
                                <label class=" control-label" for="apartamento">Apartamento</label>
                                <input class="form-control @error('apartamento') is-invalid @enderror" type="text" required placeholder="Apto" name="apartamento" value="{{ old('apartamento') }}" id="apartamento">
                                <span id="error-apartamento" class="help-block text-danger">{{ $errors->first('apartamento') }}</span>
                            </div>
                        </div>
                        <!-- END ROW -->
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="control-label" for="telefone">Telefone Principal</label>
                                <input class="form-control @error('telefone') is-invalid @enderror" type="text" required placeholder="Telefone" name="telefone" value="{{ old('telefone') }}" id="telefone" maxlength="10">
                                <span id="error-telefone" class="help-block text-danger">{{ $errors->first('telefone') }}</span>
                            </div>
                            <div class="form-group col-md-3">
                                <label class=" control-label" for="telefone_secundario">Telefone Secundário</label>
                                <input class="form-control @error('telefone_secundario') is-invalid @enderror" type="text" placeholder="Telefone Secundário" name="telefone_secundario" value="{{ old('telefone_secundario') }}" id="telefone_secundario">
                                <span id="error-telefone_secundario" class="help-block text-danger">{{ $errors->first('telefone_secundario') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class=" control-label" for="email">E-mail</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Email" name="email" value="{{ old('email') }}" id="email">
                                <span id="error-email" class="help-block text-danger">{{ $errors->first('email') }}</span>
                            </div>


                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class=" control-label" for="observacao">Observação</label>
                                <textarea class="form-control" name="observacao" id="observacao" rows="3"></textarea>
                            </div>
                        </div>

                </div>
                <!-- END ROW -->
                <div class="tile-footer">
                    <div class="row">
                        <div class="form-group col-md-12 d-flex flex-row justify-content-end">
                            <a class="btn btn-secondary mr-2" href="{{  route('conveniados.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Salvar</button>
                        </div>
                    </div>
                </div>

                </form>
                <!-- END form -->
            </div>
            <!-- END tile-body -->
        </div>
        <!-- END tile -->
    </div>
    <!-- END col-md-12 -->
    </div>
    <!-- END row -->
</main>
@endsection
