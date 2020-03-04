<?php

namespace App\Http\Controllers\Admin;

use App\Conveniado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DataTables;
use DB;
use App\Http\Requests\Admin\ConveniadoStore;
use App\Http\Requests\Admin\AdmConveniadoUpdate;

class AdmConveniadoController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:adm-cliente-listar'], ['only' => ['index']]);
        $this->middleware(['permission:adm-cliente-incluir'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:adm-cliente-atualizar'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:adm-cliente-visualizar'], ['only' => ['show']]);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('acrpaginas.admconveniados.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acrpaginas.admconveniados.create');
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
        return view('acrpaginas.admconveniados.show', compact('conveniado'));
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
        return view('acrpaginas.admconveniados.edit', compact('conveniado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdmConveniadoUpdate $request, $id)
    {

        try {
            $conveniado = Conveniado::find($id);
            DB::beginTransaction();
            $conveniado->nome = strtoupper($request->nome);
            $conveniado->telefone = $request->telefone;
            $conveniado->telefone_secundario = $request->telefone_secundario;
            $conveniado->endereco = strtoupper($request->endereco);
            $conveniado->bloco = strtoupper($request->bloco);
            $conveniado->apartamento = $request->apartamento;
            $conveniado->observacao = strtoupper($request->observacao);
            $conveniado->observacao_administracao = strtoupper($request->observacao_administracao);
            $conveniado->credito = $request->credito;
            $conveniado->situacao = $request->situacao;
            $conveniado->email = $request->email;
            $conveniado->user_edicao = Auth::user()->id;
            $conveniado->update();

            DB::commit();

            return redirect()->route('admconveniados.index')->with('msgSucesso', 'Conveniado alterado com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('admconveniados.index')->with('msgErro', 'Ops! Conveniado não alterado !');
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


    public function getViewAdmConveniados()
    {
        $conveniados = Conveniado::select([
            'conveniados.id', 'conveniados.nome', 'conveniados.situacao', 'conveniados.cpf', 'conveniados.telefone',
            'users.name',  'convenios.denominacao', 'convenios.situacao as situacao_convenio'
        ])
            ->join('users', 'users.id', '=', 'conveniados.user_id')
            ->join('convenios', 'convenios.id', '=', 'conveniados.convenio_id');


        return Datatables::of($conveniados)
            ->addColumn('btns', 'acrpaginas.admconveniados.actions')
            ->rawColumns(['btns'])
            ->toJson();
    }
}
