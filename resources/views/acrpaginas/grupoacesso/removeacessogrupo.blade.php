@extends('acrlayout.app')

@section('conteudo')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Remove Acessos do Grupo </h1>
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
                    <div class="form-group">
                        <h3>{{ $role->name }}</h3>
                    </div>
                    <form action="{{ route('remove.permissions.grupo') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $role->id }}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <select name="permissions[]" id="permissions" multiple="multiple">
                                        @foreach ($permissions as $permission)
                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="tile-footer">
                                        <div class="row">
                                            <div class="form-group col-md-12 d-flex flex-row justify-content-end">
                                                <a class="btn btn-secondary mr-2" href="{{  route('grupos.index') }}"><i
                                                        class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                                                <button class="btn btn-primary" type="submit"><i
                                                        class="fa fa-fw fa-lg fa-check-circle"></i>Salvar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
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
    $('#permissions').bootstrapDualListbox({
        nonSelectedListLabel: 'Liberados',
        selectedListLabel: 'Removidos',
        preserveSelectionOnMove: 'moved',
        moveOnSelect: 'false',
        selectorMinimalHeight: 300,
        initialfilterfrom: '',
        moveSelectedLabel: 'Remove',
        filterTextClear: 'Limpar Filtro',
        filterPlaceHolder: 'Filtrar',
        infoTextEmpty: 'Nenhum registro encontrado',
        infoText: 'Pesquisar',
        infoTextFiltered: '<span class="label label-warning">Filtro ativo</span> {0} from {1}'
      });
</script>
@endpush
