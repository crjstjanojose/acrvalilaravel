@extends('acrlayout.app')

@section('conteudo')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="py-2"><i class="fa fa-dashboard"></i> Dashboard </h1>
        </div>
    </div>

    @can('encomenda-listar-pendente')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="widget-small warning coloured-icon">
                            <a href="{{ route('encomendas.index')}}">
                                <i class="icon fa fa-sticky-note-o fa-3x"></i>
                            </a>
                            <div class="info">
                                <h4>Pendentes</h4>
                                <p class="text-center"><b>{{ $pendente  }} </b></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="widget-small info coloured-icon">
                            <a href="{{ route('encomendas.index.solcitadas')}}">
                                <i class="icon fa fa-industry fa-3x"></i>
                            </a>
                            <div class="info">
                                <h4>Solicitadas</h4>
                                <p class="text-center"><b>{{ $solicitada }}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="widget-small primary coloured-icon">
                            <a href="{{ route('encomendas.index.entregues')}}">
                                <i class="icon fa fa-truck fa-3x"></i>
                            </a>
                            <div class="info">
                                <h4>Entregues</h4>
                                <p class="text-center"><b>{{ $entregue }}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="widget-small danger coloured-icon"><i class="icon fa fa-trash fa-3x"></i>
                            <div class="info">
                                <h4>Excluidas</h4>
                                <p class="text-center"><b>{{ $excluida }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
</main>
@endsection
