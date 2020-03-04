<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use Hash;
use DataTables;
use App\http\Requests\Admin\UsuarioStoreRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('acrpaginas.usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acrpaginas.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioStoreRequest $request)
    {
        try {

            DB::beginTransaction();
            $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->remember_token = Hash::make($request->get('email'));
            $user->email_verified_at = now();

            $user->save();

            DB::commit();

            return redirect()->route('users.index')->with('msgSucesso', 'Usuario cadastrado com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('users.index')->with('msgErro', 'Ops! Usuario não cadastrada !');
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
        $user = User::find($id);
        return view('acrpaginas.usuarios.edit', compact('user'));
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
            $user = User::find($id);

            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->situacao = $request->get('situacao');

            $user->save();

            DB::commit();

            return redirect()->route('users.index')->with('msgSucesso', 'Usuario alterado com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('users.index')->with('msgErro', 'Ops! Usuario não alterado !');
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

    public function viewAlterarSenha()
    {
        return view('acrpaginas.usuarios.alterarsenha');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'situacao' => 1])) {
            if (Auth::user()->situacao == 'Ativo') {
                return redirect()->route('home');
            } else {
                return view('acrpaginas.usuarios.login');
            }
        } else {
            return view('acrpaginas.usuarios.login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.acessar');
    }


    // Metodo para carregar os usuarios na DATATABLE
    public function getTableUsuarios()
    {
        $users = User::select([
            'id', 'name', 'situacao'
        ]);

        return Datatables::of($users)
            ->addColumn('btns', 'acrpaginas.usuarios.actions')
            ->rawColumns(['btns'])
            ->toJson();
    }

    public function updateSenha(Request $request)
    {
        $request->validate([
            'nova' => ['required', 'min:6'],
            'confirma' => ['required', 'same:nova'],
        ]);

        if (!Hash::check($request->password, auth()->user()->password)) {
            return redirect()->route('alterar.senha')->with('msgErro', 'Ops! Senha atual não confere com a informada !');
        } else {
            User::find(auth()->user()->id)->update(['password' => Hash::make($request->nova)]);
            return redirect()->route('alterar.senha')->with('msgSucesso', 'Senha alterada com sucesso !');
        }
    }

    //Carrega as permissoes que o usuario tem liberadas
    public function viewAdicionaPermissaoUsuario($id)
    {
        $user = User::find($id);
        $opcoes = Permission::all();
        $permissions = [];
        foreach ($opcoes as $opcao) {
            if (!$user->hasPermissionTo($opcao)) {
                array_push($permissions, $opcao);
            }
        }
        return view('acrpaginas.usuarios.addpermissaousuario', compact('user', 'permissions'));
    }

    public function adicionaPermissaoUsuario(Request $request, $id)
    {
        $user = User::find($id);

        try {
            DB::beginTransaction();
            foreach ($request->permissions as $permission) {
                $user->givePermissionTo($permission);
            }
            DB::commit();
            return redirect()->route('users.index')->with('msgSucesso', 'Acesso(s) adicionados com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('users.index')->with('msgErro', 'Ops! Erro ao adicionar acessos do grupo !');
        }
    }

    public function viewRemovePermissaoUsuario($id)
    {
        $user = User::find($id);
        $opcoes = Permission::all();
        $permissions = [];
        foreach ($opcoes as $opcao) {
            if ($user->hasPermissionTo($opcao)) {
                array_push($permissions, $opcao);
            }
        }
        return view('acrpaginas.usuarios.rempermissaousuario', compact('user', 'permissions'));
    }

    public function removePermissaoUsuario(Request $request, $id)
    {
        $user = User::find($id);

        try {
            DB::beginTransaction();
            foreach ($request->permissions as $permission) {
                $user->revokePermissionTo($permission);
            }
            DB::commit();
            return redirect()->route('users.index')->with('msgSucesso', 'Acesso(s) removidos com sucesso !');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->route('users.index')->with('msgErro', 'Ops! Erro ao remover acessos do grupo !');
        }
    }

    public function loginView()
    {
        return view('acrpaginas.usuarios.login');
    }
}
