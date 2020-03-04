@can('encomenda-visualizar-solicitada')
<a class="btn btn-sm btn-dark text-center" href="{{ route('encomendas.show',$id) }}" data-toggle="tooltip"
    data-placement="top" title="Visualizar Encomenda"> <i class="fa fa-search" aria-hidden="true"></i></a>
@endcan
@can('encomenda-comfirmar-entrega')
<a class="btn btn-sm btn-primary text-center" href="{{ route('encomendas.preparar.entrega',$id) }}"
    data-toggle="tooltip" data-placement="top" title="Confirmar Entrega">
    <i class="fa fa-truck" aria-hidden="true"></i></a>
@endcan
@can('encomenda-excluir')
<a class="btn btn-sm btn-danger" href="{{ route('encomendas.delete',$id) }}" data-toggle="tooltip" data-placement="top"
    title="Excluir registro"> <i class="fa fa-trash" aria-hidden="true"></i></a>
@endcan
