<?php
include_once ('../class/AutoLoad.php');
include_once '../class/Pessoa.php';

/* $objPessoa = new Pessoa();
  $objEndereco = new Endereco();
  $objTelefone = new Telefone();
  $objOs = new Os();

  if(isset($_POST['btSalvar'])){
  if($objPessoa->queryInsert($_POST) == 'ok'){
  header('location: /SistemaCadSystem');
  }else{
  //        echo '<script type="text/javascript">alert("Erro ao cadastrar");</script>';
  echo $objPessoa->queryInsert($_POST);

  }
  } */
?>

<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Cadastro de Ordem de Serviço</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
    </head>

    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href=""><img class="img" src="img/home.png" alt="Home" width="35"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav" >
                        <li>
                            <a href="#">Cliente</a>
                        </li>
                        <li>
                            <a href="#">Funcionário</a>
                        </li>
                        <li>
                            <a href="#">Ordem de Serviço</a>
                        </li>
                        <li>
                            <a href="#">Usuário</a>
                        </li>
                      <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true">Pesquisar<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Cliente</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Funcionário</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Ordem de Serviço </a></li>
                                <li class="divider"></li>
                                <li><a href="#">Usuário</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Sair</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <div class="container theme-showcase" role="main">
            <div class="page-header">
                <br>
                <h1>Cadastro de Odem de Serviço</h1>
            </div>
            <div id="formulario">
                <form name="formControl" id="os" action="../class/Os.php" method="POST">
                <form name="formControl" action="" method="POST"> 
                    <div class="row"><!-- Abrindo 1ª linha  do formulario -->                   
                        <div class="col-md-2">
                            <label>Data de Abertura:</label>
                            <input type="date" id="dataabertura" name="dataabertura" class="form-control"/>
                        </div> <!-- Fechando div do campo Data de abertura -->                    
                       

                        <div class="col-md-2">
                            <label>Nº OS:</label>
                            <input type="text" id="numos" name="numos" class="form-control" placeholder="Nº OS"/>
                        </div> <!-- Fechando div do campo Nº OS -->

                        <div class="col-md-2">
                            <label>Atendente:</label>
                            <input type="text" id="atendente" name="atendente" class="form-control" placeholder="Atendente"/>
                        </div> <!-- Fechando div do campo Atendente -->  

                        <div class='col-md-2'>
                            <label>Status da OS:</label>
                            <select id='statusos' name="statusos" class="form-control">
                                <option value="">Selecione...</option>
                                <option value="1">Aguardando Avaliação Técnica</option>
                                <option value="2">Em Andamento</option>
                                <option value="3">Finalizado</option>
                            </select>
                        </div><!-- Fechando div do campo Status da OS -->

                        <div class="col-md-2">
                            <label>Executor:</label> <br>
                            <input type="text" id="executoros" name="executoros" class="form-control" placeholder="Executor"/>
                        </div> <!-- Fechando div do campo RG -->

                        <div class="col-md-2">
                            <label>Data de Finalização:</label>
                            <input type="date" id="datafinal" name="datafinal" class="form-control"/>
                        </div> <!-- Fechando div do campo Data de finalização -->

                    </div><!-- Fechando 2ª linha do formulario:dataaberturaOS / NºOS / atendendente--> 

                    <br/> 

                    <div class="row"><!-- Abrindo 2ª linha do formulário-->
                        <div class="col-md-3">
                            <label>Nome:</label>
                            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome"/>
                        </div> <!-- Fechando div do campo nome -->

                        <div class="col-md-3">
                            <label>Sobrenome:</label>
                            <input type="text" id="sobrenome" name="sobrenome" class="form-control" placeholder="Sobrenome"/>
                        </div> <!-- Fechando div do campo sobrenome -->

                        <div class="col-md-3">
                            <label>CPF:</label>
                            <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF"/>
                        </div> <!-- Fechando div do campo CPF --> 

                        <div class="col-md-3">
                            <label>RG:</label>
                            <input type="text" id="rg" name="rg" class="form-control" placeholder="RG"/>
                        </div> <!-- Fechando div do campo RG -->                    
                    </div><!-- Fechando 2ª linha do formulário -->

                    <br/>
                    <div class="row"><!-- Abrindo 3ª linha do formulário-->
                        <div class='col-md-5'>   
                            <label>Endereço:</label>
                            <input type="text" id="endereco" name="endereco" class="form-control" placeholder="Endereço"/>
                        </div><!-- Fechando div do campo endereço -->

                        <div class='col-md-4'>    
                            <label>Bairro:</label>
                            <input type="text" id="bairro" name="bairro" class="form-control" placeholder="Bairro"/>
                        </div><!-- Fechando div do campo bairro -->                           

                        <div class='col-md-2'>    
                            <label>Cidade:</label>
                            <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade"/>
                        </div><!-- Fechando div do campo cidade -->

                        <div class='col-md-1'>    
                            <label>UF:</label>
                            <select id='uf' name="uf" class="form-control">
                                <option value="">UF</option>
                                <option value="1">AC</option>
                                <option value="2">AL</option>
                                <option value="3">AP</option>
                                <option value="4">AM</option>
                                <option value="5">BA</option>
                                <option value="6">CE</option>
                                <option value="7">DF</option>
                                <option value="8">ES</option>
                                <option value="9">GO</option>
                                <option value="10">MA</option>
                                <option value="11">MG</option>
                                <option value="12">MS</option>
                                <option value="13">MT</option>
                                <option value="14">PA</option>
                                <option value="15">PB</option>
                                <option value="16">PE</option>
                                <option value="17">PI</option>
                                <option value="18">PR</option>
                                <option value="19">RJ</option>
                                <option value="20">RN</option>
                                <option value="21">RO</option>
                                <option value="22">RR</option>
                                <option value="23">RS</option>
                                <option value="24">SC</option>
                                <option value="25">SE</option>
                                <option value="26">SP</option>
                                <option value="27">TO</option>    
                            </select>
                        </div><!-- Fechando div do campo UF -->                    
                    </div> <!-- Fechando 3ª linha do formulário -->

                    <br/>
                    <div class="row"> <!-- Abrindo 4ª linha do formulário --> 
                        <div class='col-md-12'>
                            <label>Ponto de Referência:</label> 
                            <input type="text" id="ptreferencia" name="ptreferencia" class="form-control" placeholder="Ponto de Referência"/> 
                        </div><!-- Fechando div do campo Ponto de referência -->
                    </div> <!-- Fechando 4ª linha do formulário -->

                    <br>
                    <div class="row"> <!-- Abrindo 5ª linha do formulário -->
                        <div class='col-md-2'>
                            <label>Tipo de Telefone:</label>
                            <select id='tipotelefone1' name="tipotelefone" class="form-control">
                                <option value="">Selecione...</option>
                                <option value="1">Celular</option>
                                <option value="2">Comercial</option>
                                <option value="3">Recado</option>
                                <option value="4">Residencial</option>
                            </select>
                        </div><!-- Fechando div do campo tipo  para tel 1 -->

                        <div class='col-md-1'>
                            <label>DDD:</label>                                                
                            <input type="text" id="dddtelefone1" name="dddtelefone" class="form-control" placeholder="DDD"/>
                        </div><!-- Fechando div do campo DDD para tel 1 -->

                        <div class='col-md-3'>    
                            <label>Nº Telefone</label>
                            <input type="text" id="numtelefone1" name="numtelefone" class="form-control" placeholder="NºTelefone"/>
                        </div><!-- Fechando div do campo nºtelefone para tel 1 -->
                        
                        <div class='col-md-2'>
                            <label>Operadora:</label>                                                
                            <input type="text" id="operadora1" name="operadora" class="form-control" placeholder="Operadora"/>
                        </div><!-- Fechando div do campo operadora para tel 1 -->

                        <div class='col-md-4'>
                            <label>Melhor Horário para contato:</label>                                                
                            <input type="text" id="horariocontato1" name="horariocontato" class="form-control" placeholder="Melhor Horário"/>
                        </div><!-- Fechando div do campo melhor horário para tel 2 -->
                    </div> <!--Fechando 5ª linha -->
                    <br/>
                    <div class="row"><!--Abrindo 6ª linha -->

                        <div class='col-md-2'>
                            <label>Tipo de Telefone:</label>
                            <select id='tipotelefone2' name="tipotelefone" class="form-control">
                                <option value="">Selecione...</option>
                                <option value="1">Celular</option>
                                <option value="2">Comercial</option>
                                <option value="3">Recado</option>
                                <option value="4">Residencial</option>
                            </select>
                        </div><!-- Fechando div do campo tipo  para tel 2 -->

                        <div class='col-md-1'>
                            <label>DDD:</label>                                                
                            <input type="text" id="dddtelefone2" name="dddtelefone" class="form-control" placeholder="DDD"/>
                        </div><!-- Fechando div do campo DDD para tel 2 -->

                        <div class='col-md-3'>    
                            <label>Nº Telefone</label>
                            <input type="text" id="numtelefone2" name="numtelefone" class="form-control" placeholder="NºTelefone"/>
                        </div><!-- Fechando div do campo nºtelefone para tel 2 -->
                        
                        <div class='col-md-2'>
                            <label>Operadora:</label>                                                
                            <input type="text" id="operadora2" name="operadora" class="form-control" placeholder="Operadora"/>
                        </div><!-- Fechando div do campo operadora para tel 1 -->

                        <div class='col-md-4'>
                            <label>Melhor Horário para contato:</label>                                                
                            <input type="text" id="horariocontato2" name="horariocontato" class="form-control" placeholder="Melhor Horário"/>
                        </div><!-- Fechando div do campo melhor horário para tel 2 -->
                    
                    </div><!-- Fechando 6ª linha do formulário -->

                    <br>
                    <div class="row"> <!-- Abrindo 7ª linha do formulário-->                 
                        <div class='col-md-12'>
                            <label>Descrição do Serviço:</label>
                            <textarea name="descricaoos" cols="148" rows="5" class="form-control"></textarea>
                        </div><!-- Fechando div do campo descrição do serviço -->                  
                    </div><!-- Fechando 7ª linha do formulário -->

                    <br/> 
                    <div class="row"> <!-- Abrindo 8ª linha do formulário-->
                        <div class='col-md-2'>
                            <label>Valor:</label>
                            <input type="text" id="valor" name="valor" class="form-control" placeholder="Valor"/>
                        </div><!-- Fechando div do campo valor -->                  

                        <div class='col-md-2'>
                            <label>Forma de Pagamento:</label>
                            <select id='formapagamento' name="formapagamento" class="form-control">
                                <option value="">Selecione...</option>
                                <option value="1">À Vista - Dinheiro</option>
                                <option value="2">À Vista - Dédito</option>
                                <option value="3">Crédito À Vista</option>
                                <option value="3">Crédito Parcelado</option>
                                <option value="3">Cheque À Vista</option>
                                <option value="3">Cheque Pré-Datado</option>
                            </select>
                        </div><!-- Fechando div do campo Forma de pagamento -->  

                        <div class='col-md-8'>
                            <label>Observações:</label>
                            <input type="text" id="observacoes" name="observacoes" class="form-control" placeholder="Observações"/>
                        </div><!-- Fechando div do campo valor -->                     
                    </div><!-- Fechando 8ª linha do formulário -->

                    <br>
                    <div class="row"> <!-- Abrindo 9ª linha do formulário -->
                        <div class="col-md-2"></div> <!-- Div vazia -->

                        <div class="col-md-2">
                            <br>
                            <input type="button" name="btCancelar" id="txCancelar" style="width: 100%;" 
                                   class="btn btn-warning" value="Cancelar" onclick=""/>
                        </div> <!-- Fechando o botão cancelar -->

                        <div class="col-md-2">
                            <br>
                            <input type="reset" name="btLimpar" id="txLimpar" style="width: 100%;" 
                                   class="btn btn-info" value="Limpar"/>
                        </div> <!-- Fechando o botão limpar -->                

                        <div class="col-md-2">
                            <br>
                            <input type="submit" name="btSalvar" id="txGravar" style="width: 100%;" 
                                   class="btn btn-success" value="Salvar"/>
                        </div> <!-- Fechando o botão Salvar -->

                        <div class="col-md-2">
                            <br>
                            <input type="submit" name="btImptimi" id="txImptimir" style="width: 100%;" 
                                   class="btn btn-primary" value="Imprimir"/>
                        </div> <!-- Fechando o botão Salvar -->
                    </div><!-- Fechando 9ª linha do formulário -->
                </form> 
            </div> <!-- fechando a div formulário -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="js/bootstrap.min.js"></script>
        </div> <!-- fechando a div class="container theme-showcase" -->
    </body>
</html>



