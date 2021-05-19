<?php

namespace App\Http\Controllers\Curso;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Service\CursoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CursoController extends Controller
{
    public function index()
    {
        $cusros = Curso::all();
        return view('cursos.index', ['cursos' => $cusros]);
    }

    public function novo(CursoService $service, Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nome' => 'required|max:255',
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
             $service->novoCurso($request);
        }

        return view('cursos.cadastrar');
    }

    public function editar(CursoService $service, Request $request, $id)
    {
        $curso = Curso::find($id);

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nome' => 'required|max:255',
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $service->editarCurso($id, $request);

            return back();
        }

        return view('cursos.cadastrar', ['curso' => $curso]);
    }

    public function remover(CursoService $service, $id)
    {
        $service->removerCurso($id);
        return back();
    }
}
