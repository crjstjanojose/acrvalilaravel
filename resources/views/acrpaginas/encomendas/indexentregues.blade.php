@extends('acrlayout.app')

@section('conteudo')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="my-3"><i class="fa fa-list-ul"></i> Encomendas Entregues </h1>

        </div>
        <ul class="app-breadcrumb breadcrumb">
            @can('encomenda-listar-pendente')
            <li class="mx-1">
                <a class="btn btn-sm btn-info" href="{{ route('encomendas.index') }}" title="Criar nova encomenda"><i class="icon fa fa-sticky-note-o" aria-hidden="true"></i>
                    Pendentes</a>
            </li>
            @endcan
            @can('encomenda-listar-solicitada')
            <li class="mx-1">
                <a class="btn btn-sm btn-secondary" href="{{ route('encomendas.index.solcitadas') }}" title="Criar nova encomenda"><i class="fa fa-industry" aria-hidden="true"></i> Solicitadas</a>
            </li>
            @endcan
            @can('encomenda-incluir')
            <li class="mx-1">
                <a class="btn btn-sm btn-primary" href="{{ route('encomendas.create') }}" title="Criar nova encomenda"><i class="fa fa-plus-square" aria-hidden="true"></i> Nova Encomenda</a>
            </li>
            @endcan
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">

                <div class="container my-2">
                    @if (session('msgSucesso'))
                    <div class="alert alert-dismissible alert-primary">
                        <button class="close" type="button" data-dismiss="alert">×</button>
                        <b>{{ session('msgSucesso') }}</b>
                    </div>
                    @endif
                    @if (session('msgErro'))
                    <div class="alert alert-dismissible alert-danger">
                        <button class="close" type="button" data-dismiss="alert">×</button>
                        <b>{{ session('msgErro') }}</b>
                    </div>
                    @endif
                </div>

                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped table-sm" id="getPendentes">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Descrição</th>
                                    <th>Unidades</th>
                                    <th>Solicitação</th>
                                    <th>Previsão</th>
                                    <th>Entregador</th>
                                    <th>Tipo</th>
                                    <th width="15%">Ações</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
</main>
@endsection

@push('scripts')

<script type="text/javascript">
    $('#getPendentes').DataTable({
        serverSide: false
        , processing: true
        , "ajax": "{{ route('encomendas.table.entregues') }}"
        , "columns": [{
                data: 'id'
            }
            , {
                data: 'nome'
            }
            , {
                data: 'descricao'
            }
            , {
                data: 'quantidade'
            }
            , {
                data: 'created_at'
            }
            , {
                data: 'previsao'
            }
            , {
                data: 'name'
            }
            , {
                data: 'tipo_encomenda'

            }
            , {
                data: 'btns'
                , name: 'btns'
                , orderable: false
                , searchable: false
            }
        ]
        , "language": {
            "info": "_TOTAL_ registro(s)"
            , "search": "<b>Pesquisar</b>"
            , "paginate": {
                "next": "Próximo"
                , "previous": "Anterior"
            }
            , "lengthMenu": '<b>Mostrar</b> <select>' +
                '<option value="-1">Todos</option>' +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="30">30</option>' +
                '<option value="40">40</option>' +
                '<option value="50">50</option>' +
                '</select> <b> registros</b>'
            , "loadingRecords": "Carregando..."
            , "processing": "Processando..."
            , "emptyTable": "Nenhum registro encontrado."
            , "zeroRecords": "Nenhum registro encontrado com esse argumento de busca."
            , "infoEmpty": ""
            , "infoFiltered": ""
        }
    });

</script>
@endpush
