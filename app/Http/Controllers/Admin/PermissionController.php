<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use DataTables;
use DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('acrpaginas.permissao.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acrpaginas.permissao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();
            $permission = new Permission();
            $permission->name = $request->get('name');

            $permission->save();

            DB::commit();

            return redirect()->route('permissions.index')->with('msgSucesso', 'Permissão cadastrado com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('permissions.index')->with('msgErro', 'Ops! Permissão não cadastrado !');
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
        $permission = Permission::find($id);
        return view('acrpaginas.permissao.edit', compact('permission'));
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
        try {

            DB::beginTransaction();
            $permission = Permission::find($id);

            $permission->name = $request->get('name');

            $permission->save();

            DB::commit();

            return redirect()->route('permissions.index')->with('msgSucesso', 'Permissão alterado com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('permissions.index')->with('msgErro', 'Ops! Permissão não alterada !');
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

    public function getTablePermissoes()
    {
        $permissoes = Permission::select(['id', 'name']);

        return Datatables::of($permissoes)
            ->addColumn('btns', 'acrpaginas.permissao.actions')
            ->rawColumns(['btns'])
            ->toJson();
    }
}
