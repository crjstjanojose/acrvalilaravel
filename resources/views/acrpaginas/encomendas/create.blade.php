@extends('acrlayout.app')

@section('conteudo')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Criação de Nova Encomenda </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        </ul>
    </div>
    <!-- END app-title -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form method="POST" action="{{ route('encomendas.store') }}" autocomplete="off">
                        @csrf
                        <div class="row">

                            <div class="form-group col-md-9">
                                <label class="control-label">Nome</label>
                                <input class="form-control @error('nome') is-invalid @enderror" type="text" required placeholder="Nome do Cliente..." name="nome" value="{{ old('nome') }}">
                                <span id="error-nome" class="help-block text-danger">{{ $errors->first('nome') }}</span>
                            </div>

                            <div class=" form-group col-md-3">
                                <label class="control-label">Contato</label>
                                <input class="form-control @error('contato') is-invalid @enderror" type="text" placeholder="Contato..." name="contato" value="{{ old('contato') }}">
                                <span id="error-contato" class="help-block text-danger">{{ $errors->first('contato') }}</span>
                            </div>

                        </div>
                        <!-- END row Nome / Contato -->
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="descricao">Descrição</label>
                                <input type="text" name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror" required placeholder="Descrição do produto" value="{{ old('descricao') }}">
                                <span id="error-descricao" class="help-block text-danger">{{ $errors->first('descricao') }}</span>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="quantidade">Quantidade</label>
                                <input type="number" name="quantidade" id="quantidade" class="form-control @error('quantidade') is-invalid @enderror" required placeholder="Quantidade" min="1" value="{{ old('quantidade') }}">
                                <span id="error-quantidade" class="help-block text-danger">{{ $errors->first('quantidade') }}</span>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="preco">Preço</label>
                                <input type="text" name="preco" id="preco" class="form-control @error('preco') is-invalid @enderror" placeholder="Preço" value="{{ old('preco') }}" required>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="previsao">Previsão</label>
                                <input type="text" name="previsao" id="previsao" class="form-control @error('previsao') is-invalid @enderror" placeholder=" 99/99/9999" data-date-start-date="0d" required value="{{ old('previsao') }}">
                                <span id="error-previsao" class="help-block text-danger">{{ $errors->first('previsao') }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 form-group">
                                <label for="tipo_encomenda">Tipo da Encomenda</label>
                                <select name="tipo_encomenda" id="tipo_encomenda" class="form-control">
                                    <option value="Falta">FALTA NO ESTOQUE</option>
                                    <option value="Reposicao">ESTOQUE BAIXO</option>
                                    <option value="Procura">PROCURA DEMANDA DE VENDA</option>
                                    <option value="Encomenda">ENCOMENDA DE CLIENTE</option>
                                </select>
                                <span id="error-cpf" class="help-block text-danger">{{ $errors->first('convenio') }}</span>
                            </div>
                        </div>
                        <div class="tile-footer">
                            <div class="row">
                                <div class="form-group col-md-12 d-flex flex-row justify-content-end">
                                    <a class="btn btn-secondary mr-2" href="{{  route('encomendas.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
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

@push('scripts')
<script>
    $('#previsao').datepicker({
        format: "dd/mm/yyyy"
        , autoclose: true
        , todayHighlight: true
    });

</script>
@endpush
