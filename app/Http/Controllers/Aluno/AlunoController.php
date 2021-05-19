<?php

namespace App\Http\Controllers\Aluno;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = Aluno::all();

        return view('alunos.index', ['alunos' => $alunos]);
    }

    public function novo(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'curso' => 'required',
                'nome' => 'required|max:255',
                'cep' => 'required|max:14',
                'logradouro' => 'required|max:255',
                'numero' => 'required|max:255',
                'complemento' => 'required|max:255',
                'bairro' => 'required|max:255',
                'uf' => 'required|max:2',
                'municipio' => 'required|max:255',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $aluno = new Aluno();
            $aluno->curso_id = $request->get('curso');
            $aluno->nome = $request->get('nome');
            $aluno->cep = $request->get('cep');
            $aluno->logradouro = $request->get('logradouro');
            $aluno->numero = $request->get('numero');
            $aluno->complemento = $request->get('complemento');
            $aluno->bairro = $request->get('bairro');
            $aluno->uf = $request->get('uf');
            $aluno->municipio = $request->get('municipio');
            $aluno->save();

            $alunos = Aluno::all();
            return view('alunos.index', ['alunos' => $alunos]);
        }

        $cursos = Curso::all();
        return view('alunos.cadastrar',  [ 'cursos' => $cursos]);
    }

    public function editar(Request $request,$id)
    {

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'curso' => 'required',
                'nome' => 'required|max:255',
                'cep' => 'required|max:14',
                'logradouro' => 'required|max:255',
                'numero' => 'required|max:255',
                'complemento' => 'required|max:255',
                'bairro' => 'required|max:255',
                'uf' => 'required|max:2',
                'municipio' => 'required|max:255',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $aluno = Aluno::find($id);
            $aluno->curso_id = $request->get('curso');
            $aluno->nome = $request->get('nome');
            $aluno->cep = $request->get('cep');
            $aluno->logradouro = $request->get('logradouro');
            $aluno->numero = $request->get('numero');
            $aluno->complemento = $request->get('complemento');
            $aluno->bairro = $request->get('bairro');
            $aluno->uf = $request->get('uf');
            $aluno->municipio = $request->get('municipio');
            $aluno->save();

            $alunos = Aluno::all();
            return view('alunos.index', ['alunos' => $alunos]);
        }

        $cursos = Curso::all();
        $aluno = Aluno::find($id);
        return view('alunos.cadastrar', ['aluno' => $aluno, 'cursos' => $cursos]);
    }

    public function remover($id)
    {
        Aluno::find($id)->delete();
        $alunos = Aluno::all();
        return view('alunos.index', ['alunos' => $alunos]);
    }
}
