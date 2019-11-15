@can('encomenda-visualizar-pendente')
<a class="btn btn-sm btn-dark text-center" href="{{ route('encomendas.show',$id) }}" data-toggle="tooltip"
    data-placement="top" title="Visualizar Encomenda"> <i class="fa fa-search" aria-hidden="true"></i></a>
@endcan
@can('encomenda-confirmar-compra')
<a class="btn btn-sm btn-primary text-center" href="{{ route('encomendas.comprar',$id) }}" data-toggle="tooltip"
    data-placement="top" title="Solicitar Compra">
    <i class="fa fa-check-circle" aria-hidden="true"></i></a>
@endcan

@can('encomenda-excluir')
<a class="btn btn-sm btn-danger" href="{{ route('encomendas.delete',$id) }}" data-toggle="tooltip" data-placement="top"
    title="Excluir registro"> <i class="fa fa-trash" aria-hidden="true"></i></a>
@endcan
