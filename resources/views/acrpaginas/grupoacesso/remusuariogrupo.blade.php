@extends('acrlayout.app')

@section('titulo','Remove Usuário do Grupo')

@section('conteudo')
<main class="app-content">
    <div class="tile">
        <div class="col-md-12">
            <h3 class="tile-title">Remove Usuário do Grupo</h3>
            <div class="tile-body">
                <form action="{{ route('postremove.usuario.grupo',$role->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="users[]" id="users" multiple="multiple">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tile-footer">
                                    <div class="row">
                                        <div class="form-group col-md-12 d-flex flex-row justify-content-end">
                                            <a class="btn btn-secondary mr-2" href="{{ route('roles.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Salvar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts') <script>
    $('#users').bootstrapDualListbox({
        nonSelectedListLabel: '<b class="text-primary">Liberados</b>'
        , selectedListLabel: '<b class="text-danger">Removidos</b>'
        , preserveSelectionOnMove: 'moved'
        , moveOnSelect: 'false'
        , selectorMinimalHeight: 300
        , initialfilterfrom: ''
        , moveSelectedLabel: 'Remove'
        , filterTextClear: 'Limpar Filtro'
        , filterPlaceHolder: 'Filtrar'
        , infoTextEmpty: '<b>Nenhum registro encontrado'
        , infoText: '<b>Pesquisar</b>'
        , infoTextFiltered: '<span class="badge badge-warning">Filtro ativo</span> {0} de {1}'
    });

</script>
@endpush
