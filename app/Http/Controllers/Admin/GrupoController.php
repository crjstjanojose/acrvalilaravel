<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DataTables;
use DB;

class GrupoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:grupo-listar'], ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('acrpaginas.grupoacesso.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    public function getTableGrupos()
    {
        $grupos = Role::select(['id', 'name']);

        return Datatables::of($grupos)
            ->addColumn('btns', 'acrpaginas.grupoacesso.actions')
            ->rawColumns(['btns'])
            ->toJson();
    }

    public function postRemovePermission(Request $request)
    {
        $role = Role::find($request->input('id'));

        try {
            DB::beginTransaction();
            foreach ($request->permissions as $permission) {
                $role->revokePermissionTo($permission);
            }
            DB::commit();
            return redirect()->route('grupos.index')->with('msgSucesso', 'Acesso(s) excluídos com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('grupos.index')->with('msgErro', 'Ops! Erro ao remover acessos do grupo !');
        }
    }

    public function viewRemoveAcessoGrupo($id)
    {
        $role = Role::find($id);
        $permissions = $role->permissions;
        return view('acrpaginas.grupoacesso.removeacessogrupo', compact('permissions', 'role'));
    }

    public function viewAdicionaAcessoGrupo($id)
    {
        $role = Role::find($id);
        $opcoes = Permission::all();
        $permissions = [];
        foreach ($opcoes as $opcao) {
            if (!$role->hasPermissionTo($opcao)) {
                array_push($permissions, $opcao);
            }
        }

        return view('acrpaginas.grupoacesso.atribuiacessogrupo', compact('permissions', 'role'));
    }


    public function postAdicionaPermission(Request $request)
    {
        $role = Role::find($request->input('id'));

        try {
            DB::beginTransaction();
            foreach ($request->permissions as $permission) {
                $role->givePermissionTo($permission);
            }
            DB::commit();
            return redirect()->route('grupos.index')->with('msgSucesso', 'Acesso(s) excluídos com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('grupos.index')->with('msgErro', 'Ops! Erro ao remover acessos do grupo !');
        }
    }
}
