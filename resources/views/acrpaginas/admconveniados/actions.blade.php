@can('adm-cliente-editar')
<a class="btn btn-sm btn-secondary  text-center" href="{{ route('admconveniados.edit',$id) }}" data-toggle="tooltip" data-placement="top" title="Editar Cadastro"> <i class="fa fa-edit" aria-hidden="true"></i></a>
@endcan

@can('adm-cliente-visualizar')
<a class="btn btn-sm btn-success text-center" href="{{ route('admconveniados.show',$id) }}" data-toggle="tooltip" data-placement="top" title="Visualizar Cadastro">
    <i class="fa fa-eye" aria-hidden="true"></i></a>
@endcan
