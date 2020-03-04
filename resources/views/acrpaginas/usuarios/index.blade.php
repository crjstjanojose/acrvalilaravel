@extends('acrlayout.app')

@section('titulo','Lista de Usuários')

@section('conteudo')
<main class="app-content">
    <div class="tile">
        <div class="col-md-12">
            <h3>Lista de Usuários</h3>
            <h3 class="tile-title d-flex justify-content-end">
                <ul class="app-breadcrumb breadcrumb">
                    <li>
                        <a class="btn btn-sm btn-primary" href="{{ route('users.create') }}" title="Criar novo usuário"><i class="fa fa-plus-square" aria-hidden="true"></i> Novo usuário</a>
                    </li>
                </ul>
            </h3>
            <div class="tile-body">
                <table class="table table-hover table-bordered table-striped table-sm" id="table-grupos">
                    <thead>
                        <tr>
                            <th width="10%" class="text-center">#</th>
                            <th width="60%">Nome</th>
                            <th width="15%" class="text-center">Situação</th>
                            <th width="15%" class="text-center">Ações</th>
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
    $('#table-grupos').DataTable({
        serverSide: false
        , processing: true
        , "ajax": "{{ route('datatable.getusuarios') }}"
        , "columns": [{
                data: 'id'
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
