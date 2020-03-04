@extends('acrlayout.app')

@section('conteudo')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="my-2"><i class="fa fa-users"></i> Conveniados</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
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
                                    <th width="5%">#</th>
                                    <th width="20%">Cliente</th>
                                    <th width="10%">Situação</th>
                                    <th width="10%">CPF</th>
                                    <th width="8%">Telefone</th>
                                    <th width="10%">Responsável</th>
                                    <th width="15%">Convênio</th>
                                    <th width="10%">Status</th>
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
        , "ajax": "{{ route('datatables.lista.admconveniados') }}"

        , "columns": [{
                data: 'id'

            }
            , {
                data: 'nome'
            }
            , {
                data: 'situacao'
            }

            , {
                data: 'cpf'
            }
            , {
                data: 'telefone'
            }

            , {
                data: 'name'
            }
            , {
                data: 'denominacao'
            }
            , {
                data: 'situacao_convenio'

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
