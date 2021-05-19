@extends('layout')

@section('cabecalho')
    Prova Analista
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cadastrar Alunos</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="curso">Curso</label>
                                    <select id="curso" class="form-control" name="curso">
                                        <option selected>Selcione um curso...</option>
                                        @foreach($cursos as $curso)
                                            <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nome">Nome Aluno</label>
                                    <input type="text" class="form-control" id="nome" placeholder="Nome Aluno"
                                           name="nome"
                                           value="{{ !empty($aluno) ? $aluno->nome : null }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cep">Cep</label>
                                    <input type="text" class="form-control" id="cep" placeholder="CEP" name="cep"
                                           value="{{ !empty($aluno) ? $aluno->cep : null }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="rua">Rua</label>
                                    <input type="text" class="form-control" id="rua" placeholder="Rua" name="logradouro"
                                           value="{{ !empty($aluno) ? $aluno->logradouro : null }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="complemento">Complemento</label>
                                    <input type="text" class="form-control" id="complemento" placeholder="Complemento"
                                           name="complemento"
                                           value="{{ !empty($aluno) ? $aluno->complemento : null }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="numero">Numero</label>
                                    <input type="text" class="form-control" id="numero" placeholder="Numero"
                                           name="numero"
                                           value="{{ !empty($aluno) ? $aluno->numero : null }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" class="form-control" id="bairro" placeholder="Bairro"
                                           name="bairro"
                                           value="{{ !empty($aluno) ? $aluno->bairro : null }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" placeholder="Cidade"
                                           name="municipio"
                                           value="{{ !empty($aluno) ? $aluno->municipio : null }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="uf">Estado</label>
                                    <input type="text" class="form-control" id="uf" placeholder="Estado" name="uf"
                                           value="{{ !empty($aluno) ? $aluno->uf : null }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            @if(!empty($aluno))
                            <button type="button" class="btn btn-danger">Deletar</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#ibge").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep").blur(function () {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#uf").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });
    });

</script>
