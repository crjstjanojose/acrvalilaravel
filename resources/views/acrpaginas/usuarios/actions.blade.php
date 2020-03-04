<a class="btn btn-sm btn-info" href="{{ route('users.edit',$id) }}" title="Editar Registro [ {{ $name }} ]"><i
        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

<a class="btn btn-sm btn-danger" href="{{ route('getremove.permissaousuario',$id) }}"
    title="Remover acesso  [ {{ $name }} ]"><i class="fa fa-minus" aria-hidden="true"></i></a>

<a class="btn btn-sm btn-primary" href="{{ route('getadiciona.permissao.usuario',$id) }}"
    title="Adicionar acesso [ {{ $name }} ]"><i class="fa fa-plus" aria-hidden="true"></i></a>


