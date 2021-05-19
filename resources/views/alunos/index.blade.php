@extends('layout')

@section('cabecalho')
    Prova Analista
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Listagem Alunos</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{ route('alunos.novo') }}" class="btn btn-primary" data-toggle="button" aria-pressed="false"
                                autocomplete="off">
                            Novo Aluno
                        </a>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">nome</th>
                                    <th scope="col">Endereco</th>
                                    <th scope="col">Acoes</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($alunos as $aluno)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $aluno->nome }}</td>
                                        <td>{{ $aluno->cep}} {{ $aluno->logradouro}} {{ $aluno->numero}} {{ $aluno->complemento}}</td>
                                        <td>
                                            <a href="{{ route('alunos.index')  }}"><i class="fas fa-users"></i></a>
                                            <a href="{{ route('alunos.editar', $aluno->id)  }}"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('alunos.delete', $aluno->id)  }}"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
