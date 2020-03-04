<?php

namespace App\Http\Controllers\Admin;

use App\Conveniado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DataTables;
use DB;
use App\Http\Requests\Admin\ConveniadoStore;
use App\Http\Requests\Admin\ConveniadoUpdate;

class ConveniadoController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:cliente-listar'], ['only' => ['index']]);
        $this->middleware(['permission:cliente-incluir'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:cliente-atualizar'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:cliente-visualizar'], ['only' => ['show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('acrpaginas.conveniados.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acrpaginas.conveniados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConveniadoStore $request)
    {

        try {

            DB::beginTransaction();
            $conveniado = new Conveniado;
            $conveniado->nome = strtoupper($request->nome);
            $conveniado->cpf = $request->cpf;
            $conveniado->telefone = $request->telefone;
            $conveniado->telefone = $request->telefone;
            $conveniado->telefone_secundario = $request->telefone_secundario;
            $conveniado->endereco = $request->endereco;
            $conveniado->bloco = $request->bloco;
            $conveniado->apartamento = $request->apartamento;
            $conveniado->observacao = $request->observacao;
            $conveniado->user_id = Auth::user()->id;
            $conveniado->convenio_id = Auth::user()->convenio->id;

            $conveniado->save();

            DB::commit();

            return redirect()->route('conveniados.index')->with('msgSucesso', 'Conveniado cadastrado com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('conveniados.index')->with('msgErro', 'Ops! Conveniado não cadastrado !');
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
        $conveniado = Conveniado::find($id);
        return view('acrpaginas.conveniados.show', compact('conveniado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conveniado = Conveniado::find($id);
        return view('acrpaginas.conveniados.edit', compact('conveniado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConveniadoUpdate $request, $id)
    {
        try {
            $conveniado = Conveniado::find($id);
            DB::beginTransaction();
            $conveniado->nome = strtoupper($request->nome);
            $conveniado->cpf = $request->cpf;
            $conveniado->telefone = $request->telefone;
            $conveniado->telefone_secundario = $request->telefone_secundario;
            $conveniado->endereco = $request->endereco;
            $conveniado->bloco = $request->bloco;
            $conveniado->apartamento = $request->apartamento;
            $conveniado->observacao = $request->observacao;
            $conveniado->situacao = $request->situacao;
            $conveniado->email = $request->email;
            $conveniado->user_edicao = Auth::user()->id;

            $conveniado->save();

            DB::commit();

            return redirect()->route('conveniados.index')->with('msgSucesso', 'Conveniado alterado com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('conveniados.index')->with('msgErro', 'Ops! Conveniado não alterado !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getViewConveniados()
    {
        $conveniados = Conveniado::select(['id', 'nome', 'cpf', 'telefone', 'situacao'])
            ->where('user_id', Auth::user()->id);

        return Datatables::of($conveniados)
            ->addColumn('btns', 'acrpaginas.conveniados.actions')
            ->rawColumns(['btns'])
            ->toJson();
    }
}
