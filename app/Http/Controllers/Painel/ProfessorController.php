<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Models\Professor;


class ProfessorController extends Controller
{
    public function index()
    {
        $countprof = DB::table('Professores')->count();
        $professores = Professor::get();
        return view('painel.professores.index', compact('countprof','professores'));
    }

    public function cadastro() 
    {
        return view('painel.professores.cadastro');
    }

    //esta função insere os dados na tabela professor usando a Model Professor
    public function cadastroStore(Request $request, Professor $professor) 
    {
        // Insere um novo professor, de acordo com os dados informados pelo usuário
        $insert = $professor->create($request->all());
 
        // Verifica se inseriu com sucesso
        // Redireciona para a listagem dos professores
        // Passa uma session flash success (sessão temporária)
        if ($insert)
         return redirect()
                      ->route('professor.home')
                      ->with('success', 'Professor cadastrado com sucesso!');
 
        // Redireciona de volta com uma mensagem de erro
        return redirect()
                  ->back()
                  ->with('error', 'Falha ao cadastrar, você inseriu algum dado incorreto.');
        
    }
}
