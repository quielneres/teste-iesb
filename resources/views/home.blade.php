@extends('layout')

@section('cabecalho')
    Prova Analista
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class=" clearfix">
                            <a href="{{ route('cursos.index') }}" class="btn btn-secondary float-left">
                                Gerenciar Cursos
                            </a>
                            <a href="{{ route('alunos.index') }}" class="btn btn-secondary float-right">
                                Gerenciar Alunos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
