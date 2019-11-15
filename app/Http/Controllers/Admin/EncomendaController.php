<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Encomenda;
use DataTables;
use DB;
use DateTime;
use App\Http\Requests\Admin\EncomendaStore;

class EncomendaController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:encomenda-listar-pendente'], ['only' => ['index']]);
        $this->middleware(['permission:encomenda-incluir'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:encomenda-visualizar-pendente'], ['only' => ['show']]);
        $this->middleware(['permission:encomenda-excluir'], ['only' => ['prepararDelete', 'destroy']]);
        $this->middleware(['permission:encomenda-confirmar-compra'], ['only' => ['solicitarCompra', 'confirmarCompra']]);
        $this->middleware(['permission:encomenda-listar-solicitada'], ['only' => ['getViewEncomendaSolicitadas']]);
        $this->middleware(['permission:encomenda-comfirmar-entrega'], ['only' => ['prepararEntrega', 'confirmarEntrega']]);
        
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('acrpaginas.encomendas.index');
    }


    public function getViewEncomendaSolicitadas()
    {
        return view('acrpaginas.encomendas.indexsolicitadas');
    }

    public function getViewEncomendaEntregues()
    {
        return view('acrpaginas.encomendas.indexentregues');
    }

    public function getViewEncomendaTrash()
    {
        return view('acrpaginas.encomendas.indextrash');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acrpaginas.encomendas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EncomendaStore $request)
    {
        try {

            DB::beginTransaction();
            $encomenda = new Encomenda;
            $encomenda->nome = strtoupper($request->nome);
            $encomenda->contato = $request->contato;
            $encomenda->descricao = strtoupper($request->descricao);
            $encomenda->quantidade = $request->quantidade;
            $encomenda->preco = $request->preco;
            $encomenda->previsao = $request->previsao;
            $encomenda->user_criacao = Auth::user()->id;
            $encomenda->save();

            DB::commit();

            return redirect()->route('encomendas.index')->with('msgSucesso', 'Encomenda cadastrada com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('encomendas.index')->with('msgErro', 'Ops! Encomenda não cadastrada !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $encomenda = Encomenda::find($id);
        return view('acrpaginas.encomendas.show', compact('encomenda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $encomenda = Encomenda::find($id);
            $encomenda->user_exclusao = Auth::user()->id;
            $encomenda->situacao_pedido = 'Cancelada';
            $encomenda->save();

            $encomenda->delete();

            DB::commit();
            return redirect()->route('encomendas.index')->with('msgSucesso', 'Encomenda excluída com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('encomendas.index')->with('msgErro', 'Ops! Encomenda não excluída!');
        }
    }

    // Carrega a tabela com as encomendas PENDENTES

    public function showTrash($id)
    {
        $encomenda = Encomenda::where('id', $id)->withTrashed()->first();
        return view('acrpaginas.encomendas.showtrash', compact('encomenda'));
    }

    public function getEncomendaPendente()
    {
        $encomendas = Encomenda::select([
            'encomendas.id', 'encomendas.nome', 'encomendas.descricao',
            'encomendas.quantidade', 'encomendas.created_at', 'encomendas.previsao', 'users.name'
        ])
            ->join('users', 'users.id', '=', 'encomendas.user_criacao')
            ->whereIn('situacao_pedido', ['Pendente']);

        return Datatables::of($encomendas)
            ->addColumn('btns', 'acrpaginas.encomendas.actions')
            ->rawColumns(['btns'])
            ->toJson();
    }


    public function getEncomendaSolicitadas()
    {
        $encomendas = Encomenda::select([
            'encomendas.id', 'encomendas.nome', 'encomendas.descricao',
            'encomendas.quantidade', 'encomendas.created_at', 'encomendas.previsao', 'users.name'
        ])
            ->join('users', 'users.id', '=', 'encomendas.user_solicitacao')
            ->whereIn('situacao_pedido', ['Solicitado']);

        return Datatables::of($encomendas)
            ->addColumn('btns', 'acrpaginas.encomendas.actionsolicitada')
            ->rawColumns(['btns'])
            ->toJson();
    }

    public function getEncomendaEntregues()
    {
        $encomendas = Encomenda::select([
            'encomendas.id', 'encomendas.nome', 'encomendas.descricao',
            'encomendas.quantidade', 'encomendas.created_at', 'encomendas.previsao', 'users.name'
        ])
            ->join('users', 'users.id', '=', 'encomendas.user_confirmacao')
            ->whereIn('situacao_pedido', ['Entregue']);

        return Datatables::of($encomendas)
            ->addColumn('btns', 'acrpaginas.encomendas.actionsentregue')
            ->rawColumns(['btns'])
            ->toJson();
    }

    public function getEncomendaTrash()
    {
        $encomendas = Encomenda::select([
            'encomendas.id', 'encomendas.nome', 'encomendas.descricao',
            'encomendas.quantidade', 'encomendas.created_at', 'encomendas.previsao', 'users.name'
        ])
            ->join('users', 'users.id', '=', 'encomendas.user_exclusao')
            ->onlyTrashed();


        return Datatables::of($encomendas)
            ->addColumn('btns', 'acrpaginas.encomendas.actionstrash')
            ->rawColumns(['btns'])
            ->toJson();
    }

    // Prepara VIEW de solicitacao de compra
    public function solicitarCompra($id)
    {
        $encomenda = Encomenda::find($id);
        if ($encomenda->situacao_pedido == 'Solicitado') {
            return redirect()->route('encomendas.index')->with('msgSucesso', 'Encomenda já solicitada anteriormente !');
        } else {
            return view('acrpaginas.encomendas.solicitarcompra', compact('encomenda'));
        }
    }

    public function confirmarCompra($id)
    {
        $encomenda = Encomenda::find($id);
        if ($encomenda->situacao_pedido == 'Solicitado') {
            return redirect()->route('encomendas.index')->with('msgSucesso', 'Encomenda já solicitada anteriormente !');
        } else {

            try {

                DB::beginTransaction();
                $encomenda->situacao_pedido = 'Solicitado';
                $encomenda->user_solicitacao = Auth::user()->id;
                $encomenda->save();

                DB::commit();

                return redirect()->route('encomendas.index')->with('msgSucesso', 'Encomenda solicitada com sucesso !');
            } catch (exception $e) {
                DB::rollback();
                return redirect()->route('encomendas.index')->with('msgErro', 'Ops! Encomenda não solicitada !');
            }
        }
    }

    public function prepararDelete($id)
    {
        $encomenda = Encomenda::find($id);
        return view('acrpaginas.encomendas.confirmadelete', compact('encomenda'));
    }

    public function prepararEntrega($id)
    {
        $encomenda = Encomenda::find($id);
        if ($encomenda->situacao_pedido == 'Pendente') {
            return redirect()->route('encomendas.index')->with('msgSucesso', 'Encomenda ainda sem registro de solicitação !');
        } else {
            return view('acrpaginas.encomendas.confirmaentrega', compact('encomenda'));
        }
    }

    public function confirmarEntrega($id)
    {
        $encomenda = Encomenda::find($id);
        if ($encomenda->situacao_pedido == 'Entregue') {
            return redirect()->route('encomendas.index')->with('msgSucesso', 'Encomenda já solicitada anteriormente !');
        } else {

            try {
                $data = new DateTime();
                DB::beginTransaction();
                $encomenda->situacao_pedido = 'Entregue';
                $encomenda->user_confirmacao = Auth::user()->id;
                $encomenda->entrega = $data;
                $encomenda->save();

                DB::commit();

                return redirect()->route('encomendas.index')->with('msgSucesso', 'Entrega confirmada com sucesso !');
            } catch (exception $e) {
                DB::rollback();
                return redirect()->route('encomendas.index')->with('msgErro', 'Ops! Erro ao registrar entrega !');
            }
        }
    }

    public function preparaCancelaEntrega($id)
    {
        $encomenda = Encomenda::find($id);
        if ($encomenda->situacao_pedido == 'Pendente' or $encomenda->situacao_pedido == 'Cancelada') {
            return redirect()->route('encomendas.index')->with('msgSucesso', 'Encomenda com situação diferente de entregue !');
        } else {
            return view('acrpaginas.encomendas.confirmacancelaentrega', compact('encomenda'));
        }
    }

    public function confirmarCancelaEntrega($id)
    {
        $encomenda = Encomenda::find($id);
        if ($encomenda->situacao_pedido == 'Pendente' or $encomenda->situacao_pedido == 'Cancelada' or $encomenda->situacao_pedido == 'Solicitado') {
            return redirect()->route('encomendas.index')->with('msgSucesso', 'Encomenda com situação diferente de entregue !');
        } else {

            try {
                $data = new DateTime();
                DB::beginTransaction();
                $encomenda->situacao_pedido = 'Solicitado';
                $encomenda->user_confirmacao = null;
                $encomenda->entrega = null;
                $encomenda->save();

                DB::commit();

                return redirect()->route('encomendas.index')->with('msgSucesso', 'Entrega cancelada confirmada com sucesso !');
            } catch (exception $e) {
                DB::rollback();
                return redirect()->route('encomendas.index')->with('msgErro', 'Ops! Erro ao registrar cancelamento entrega !');
            }
        }
    }
}
