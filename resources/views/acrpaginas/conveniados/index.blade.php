@extends('acrlayout.app')

@section('conteudo')
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

<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="my-3"><i class="fa fa-id-card"></i> Meus Conveniados</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            @can('cliente-incluir')
            <li>
                <a class="btn btn-sm btn-primary my-2" href="{{ route('conveniados.create') }}" title="Criar novo conveniado "><i class="fa fa-plus-square" aria-hidden="true"></i> Novo Conveniado</a>
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
                        <table class="table table-hover table-bordered table-striped table-sm" id="getConveniados">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th width="30%">Cliente</th>
                                    <th width="15%">CPF</th>
                                    <th width="5%">Fone</th>
                                    <th>Situação</th>
                                    <th>Ações</th>
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
    $('#getConveniados').DataTable({

        serverSide: false
        , processing: true
        , "ajax": "{{ route('datatables.lista.conveniados') }}"

        , "columns": [{
                data: 'id'
            }
            , {
                data: 'nome'
            }
            , {
                data: 'cpf'
            }
            , {
                data: 'telefone'
            }
            , {
                data: 'situacao'
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
