<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $pendente = DB::table('encomendas')->where('situacao_pedido', 'Pendente')->count();
        $solicitada = DB::table('encomendas')->where('situacao_pedido', 'Solicitado')->count();
        $entregue = DB::table('encomendas')->where('situacao_pedido', 'Entregue')->count();
        $excluida = DB::table('encomendas')->where('situacao_pedido', 'Cancelada')->count();
        return view('home', compact('pendente', 'solicitada', 'entregue', 'excluida'));
    }
}
