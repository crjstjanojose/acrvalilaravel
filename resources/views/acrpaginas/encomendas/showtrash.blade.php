@extends('acrlayout.app')

@section('conteudo')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Visualização de Encomenda Cancelada</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <a href="#">Retornar</a>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">

                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Cliente</label>
                            <input type="text" class="form-control" value="{{ $encomenda->nome }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Contato</label>
                            <input type="text" class="form-control" value="{{ $encomenda->contato }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" class="form-control" value="{{ $encomenda->descricao }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Quantidade</label>
                            <input type="text" class="form-control" value="{{ $encomenda->quantidade }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Preço</label>
                            <input type="text" class="form-control" value="{{ $encomenda->preco }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Solicitação</label>
                            <input type="text" class="form-control" value="{{ $encomenda->created_at }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Previsao</label>
                            <input type="text" class="form-control" value="{{ $encomenda->previsao }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Entrega</label>
                            <input type="text" class="form-control" value="{{ $encomenda->entrega }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Situacao</label>
                            <input type="text" class="form-control" value="{{ $encomenda->situacao_pedido }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Criador</label>
                            <input type="text" class="form-control" value="{{ $encomenda->userCriacao->name }}"
                                disabled>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Solicitador</label>
                            @if($encomenda->userSolicitacao)
                            <input type="text" class="form-control" value="{{ $encomenda->userSolicitacao->name }}"
                                disabled>
                            @else
                            <input type="text" class="form-control" value="" disabled>
                            @endif

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Entregador</label>
                            @if($encomenda->UserConfirmacao)
                            <input type="text" class="form-control" value="{{ $encomenda->UserConfirmacao->name }}"
                                disabled>
                            @else
                            <input type="text" class="form-control" value="" disabled>
                            @endif

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Excluído</label>
                            @if($encomenda->UserExclusao)
                            <input type="text" class="form-control" value="{{ $encomenda->UserExclusao->name }}"
                                disabled>
                            @else
                            <input type="text" class="form-control" value="" disabled>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="tile-footer">
                    <div class="row">

                        <div class="form-group col-md-12 d-flex flex-row justify-content-end">
                            <a class="btn btn-secondary mr-2" href="{{  route('encomendas.index.trash') }}"><i
                                    class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
