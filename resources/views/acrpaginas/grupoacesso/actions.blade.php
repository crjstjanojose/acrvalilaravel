<a class="btn btn-sm btn-info" href="{{ route('roles.edit',$id) }}" title="Editar Registro [ {{ $name }} ]"><i
        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

<a class="btn btn-sm btn-danger text-center" href="{{ route('getremove.permissao.grupo',$id) }}" data-toggle="tooltip"
    data-placement="top" title="Remover Acesso [ {{ $name }} ]"> <i class="fa fa-minus" aria-hidden="true"></i></a>

<a class="btn btn-sm btn-primary text-center" href="{{ route('getadiciona.permissao.grupo',$id) }}"
    data-toggle="tooltip" data-placement="top" title="Adicionar Acesso [ {{ $name }} ]">
    <i class="fa fa-plus" aria-hidden="true"></i></a>


<a class="btn btn-sm btn-danger text-center" href="{{ route('getrenove.usuario.grupo',$id) }}" data-toggle="tooltip"
    data-placement="top" title="Remover Usuário Grupo Acesso [ {{ $name }} ]"> <i class="fa fa-user-times"
        aria-hidden="true"></i></a>

<a class="btn btn-sm btn-primary text-center" href="{{ route('getadiciona.usuario.grupo',$id) }}" data-toggle="tooltip"
    data-placement="top" title="Adicionar Usuário Grupo  Acesso [ {{ $name }} ]">
    <i class="fa fa-user-plus" aria-hidden="true"></i></a>
