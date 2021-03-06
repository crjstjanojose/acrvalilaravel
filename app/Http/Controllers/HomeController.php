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

        $pendentes1 = DB::table('encomendas')
        ->where([
        ['situacao_pedido', '=', 'Pendente'],
        ])->count();


        $pendentes = DB::table('encomendas')
        ->where([
        ['situacao_pedido', '=', 'Pendente'],
        ['deleted_at', '<>', 'IS NULL'],
        ])->count();



        //$pendente = DB::table('/encomendas')->where('situacao_pedido', 'Pendente')->count();
        $pendente = $pendentes1 - $pendentes;
        $solicitada = DB::table('encomendas')->where('situacao_pedido', 'Solicitado')->count();
        $entregue = DB::table('encomendas')->where('situacao_pedido', 'Entregue')->count();
        $excluida = DB::table('encomendas')->where('situacao_pedido', 'Cancelada')->count();
        return view('home', compact('pendente', 'solicitada', 'entregue', 'excluida'));
    }
}
