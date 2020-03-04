<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DataTables;
use DB;
use App\User;


class GrupoController extends Controller
{
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
        return view('acrpaginas.grupoacesso.create');
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
            $role = new Role();
            $role->name = $request->get('name');

            $role->save();

            DB::commit();

            return redirect()->route('roles.index')->with('msgSucesso', 'Grupo cadastrado com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('roles.index')->with('msgErro', 'Ops! Grupo não cadastrado !');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        return view('acrpaginas.grupoacesso.edit', compact('role'));
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
            $role = Role::find($id);

            $role->name = $request->get('name');

            $role->save();

            DB::commit();

            return redirect()->route('roles.index')->with('msgSucesso', 'Grupo alterado com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('roles.index')->with('msgErro', 'Ops! Grupo não alterado !');
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


    public function getTableGrupos()
    {
        $grupos = Role::select(['id', 'name']);

        return Datatables::of($grupos)
            ->addColumn('btns', 'acrpaginas.grupoacesso.actions')
            ->rawColumns(['btns'])
            ->toJson();
    }



    public function viewRemovePermissaoGrupo($id)
    {
        $role = Role::find($id);
        $permissions = $role->permissions;
        return view('acrpaginas.grupoacesso.rempermissaogrupo', compact('permissions', 'role'));
    }

    public function removePermissaoGrupo(Request $request, $id)
    {

        $role = Role::find($id);

        try {
            DB::beginTransaction();
            foreach ($request->permissions as $permission) {
                $role->revokePermissionTo($permission);
            }
            DB::commit();
            return redirect()->route('roles.index')->with('msgSucesso', 'Acesso(s) excluídos com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('roles.index')->with('msgErro', 'Ops! Erro ao remover acessos do grupo !');
        }
    }

    public function viewAdicionaPermissaoGrupo($id)
    {
        $role = Role::find($id);
        $opcoes = Permission::all();
        $permissions = [];
        foreach ($opcoes as $opcao) {
            if (!$role->hasPermissionTo($opcao)) {
                array_push($permissions, $opcao);
            }
        }

        return view('acrpaginas.grupoacesso.addpermissaogrupo', compact('permissions', 'role'));
    }

    public function adicionaPermissaoGrupo(Request $request, $id)
    {
        $role = Role::find($id);

        try {
            DB::beginTransaction();
            foreach ($request->permissions as $permission) {
                $role->givePermissionTo($permission);
            }
            DB::commit();
            return redirect()->route('roles.index')->with('msgSucesso', 'Acesso(s) excluídos com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('roles.index')->with('msgErro', 'Ops! Erro ao remover acessos do grupo !');
        }
    }

    public function viewRemoveUsuarioGrupo($id)
    {

        $role = Role::find($id);
        $usuarios = $role->users;
        $users = [];
        foreach ($usuarios as $usuario) {
            if ($usuario->hasRole($role->name)) {
                array_push($users, $usuario);
            }
        }

        return view('acrpaginas.grupoacesso.remusuariogrupo', compact('users', 'role'));
    }

    public function removeUsuarioGrupo(Request $request, $id)
    {
        $role = Role::find($id);
        try {
            DB::beginTransaction();
            foreach ($request->users as $user) {
                $u = User::find($user);
                $u->removeRole($role->name);
            }
            DB::commit();
            return redirect()->route('roles.index')->with('msgSucesso', 'Usuáio(s) excluídos com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('roles.index')->with('msgErro', 'Ops! Erro ao remover usuário do grupo !');
        }
    }

    public function viewAdicionaUsuarioGrupo($id)
    {

        $role = Role::find($id);
        $usuarios = User::all();
        $users = [];
        foreach ($usuarios as $usuario) {
            if (!$usuario->hasRole($role->name)) {
                array_push($users, $usuario);
            }
        }

        return view('acrpaginas.grupoacesso.addusuariogrupo', compact('users', 'role'));
    }

    public function adicionaUsuarioGrupo(Request $request, $id)
    {

        $role = Role::find($id);
        try {
            DB::beginTransaction();
            foreach ($request->users as $user) {
                $u = User::find($user);
                $u->assignRole($role->name);
            }
            DB::commit();
            return redirect()->route('roles.index')->with('msgSucesso', 'Usuáio(s) adicionados com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('roles.index')->with('msgErro', 'Ops! Erro ao adiciona usuário do grupo !');
        }
    }
}
