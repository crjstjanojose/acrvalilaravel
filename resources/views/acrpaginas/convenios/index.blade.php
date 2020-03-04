@extends('acrlayout.app')
@section('titulo','Lista de Grupos')
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
            <h1 class="py-2"><i class="fa fa-list-ul"></i> Lista de Convênios </h1>
        </div>
        <h3 class="tile-title d-flex justify-content-end">
            <ul class="app-breadcrumb breadcrumb">
                <li>
                    <a class="btn btn-sm btn-primary" href="{{ route('convenios.create') }}" title="Criar novo convênio"><i class="fa fa-plus-square" aria-hidden="true"></i> Novo Convênio</a>
                </li>
            </ul>
        </h3>
    </div>
    <div class="tile">
        <div class="col-md-12">
            <div class="tile-body">
                <table class="table table-hover table-bordered table-striped table-sm" id="getConvenios">
                    <thead>
                        <tr>
                            <th width="10%" class="text-center">#</th>
                            <th width="40%" class="text-center">Denominação</th>
                            <th width="40%" class="text-center">Usuário</th>
                            <th width="40%" class="text-center">Situação</th>
                            <th width="40%" class="text-center">Ações</th>
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
    $('#getConvenios').DataTable({

        serverSide: false
        , processing: true
        , "ajax": "{{ route('datatables.lista.convenios') }}"

        , "columns": [{
                data: 'id'
            }
            , {
                data: 'denominacao'
            }
            , {
                data: 'name'
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
