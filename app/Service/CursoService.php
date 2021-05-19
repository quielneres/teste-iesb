<?php


namespace App\Service;


use App\Models\Curso;

class CursoService
{

    public function novoCurso($dados)
    {
        try {
            $curso = new Curso();
            $curso->codigo = rand(1000, 9999);
            $curso->nome = $dados['nome'];
            $curso->save();

        }catch (\Exception $exception){
            return $exception;
        }
    }

    public function editarCurso($id, $dados)
    {
        $curso = Curso::find($id);
        $curso->nome = $dados['nome'];
        $curso->save();
    }

    public function removerCurso($id)
    {
        $serie = Curso::find($id);
        $serie->delete();
    }
}
