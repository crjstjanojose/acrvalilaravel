<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsuarioController extends Controller
{
    public function viewAlterarSenha()
    {
        return view('acrpaginas.usuarios.alterarsenha');
    }

    public function updateSenha(Request $request)
    {
        $request->validate([
            'nova' => ['required','min:6'],
            'confirma' => ['required','same:nova'],
        ]);

        if(!Hash::check($request->password, auth()->user()->password)) {
            return redirect()->route('usuario.mudarsenha')->with('msgErro', 'Ops! Senha atual não confere com a informada !');
        } else {
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->nova)]);
            return redirect()->route('usuario.mudarsenha')->with('msgSucesso', 'Senha alterada com sucesso !');
        }


    }
}
