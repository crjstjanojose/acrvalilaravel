@can('encomenda-visualizar-entregue')
<a class="btn btn-sm btn-dark text-center" href="{{ route('encomendas.show',$id) }}" data-toggle="tooltip"
    data-placement="top" title="Visualizar Encomenda"> <i class="fa fa-search" aria-hidden="true"></i></a>
@endcan
@can('encomenda-cancelar-entrega')
<a class="btn btn-sm btn-info text-center" href="{{ route('encomendas.prepara.cancela.entrega',$id) }}"
    data-toggle="tooltip" data-placement="top" title="Cancela Entrega">
    <i class="fa fa-check-circle" aria-hidden="true"></i></a>
@endcan
