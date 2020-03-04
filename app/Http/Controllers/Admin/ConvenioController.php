<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Convenio;
use App\User;
use DataTables;
use DB;
use App\Http\Requests\Admin\ConvenioStore;
use App\Http\Requests\Admin\ConvenioUpdate;

class ConvenioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('acrpaginas.convenios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::select(['id', 'name'])->where('situacao', 'Ativo')->orderBy('name')->get();
        return view('acrpaginas.convenios.create', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConvenioStore $request)
    {

        try {

            DB::beginTransaction();
            $convenio = new Convenio();
            $convenio->denominacao = $request->get('denominacao');
            $convenio->user_id = $request->get('user_id');

            $convenio->save();

            DB::commit();

            return redirect()->route('convenios.index')->with('msgSucesso', 'Convênio cadastrado com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('convenios.index')->with('msgErro', 'Ops! Convênio não cadastrado !');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $convenio = Convenio::find($id);
        $usuarios = User::select(['id', 'name'])->where('situacao', 'Ativo')->orderBy('name')->get();
        return view('acrpaginas.convenios.edit', compact('convenio', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConvenioUpdate $request, $id)
    {
        try {

            DB::beginTransaction();
            $convenio = Convenio::find($id);
            $convenio->denominacao = $request->get('denominacao');
            $convenio->situacao = $request->get('situacao');
            $convenio->user_id = $request->get('user_id');
            $convenio->save();

            DB::commit();

            return redirect()->route('convenios.index')->with('msgSucesso', 'Conv~enio alterado com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('convenios.index')->with('msgErro', 'Ops! Convênio não alterado !');
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

    public function getViewConvenios()
    {

        $convenios = Convenio::select(['convenios.id', 'convenios.denominacao', 'convenios.situacao', 'users.name'])
            ->join('users', 'users.id', '=', 'convenios.user_id');

        return Datatables::of($convenios)
            ->addColumn('btns', 'acrpaginas.convenios.actions')
            ->rawColumns(['btns'])
            ->toJson();
    }
}
