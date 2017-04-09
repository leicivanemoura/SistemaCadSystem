<?php



/* $objPessoa = new Pessoa();
  $objEndereco = new Endereco();
  $objTelefone = new Telefone();
  $objFuncionario = new Funcionario();
  $objUsuario = new Usuario();

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
        <title>Cadastro de Usuário</title>
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
                <h1>Cadastro de Usuário</h1>
            </div>
            <div id="formulario">
                <form name="formControl" id="usuario" action="../class/Usuario.php" method="POST">
                    <div class="row"><!-- Abrindo linha para datacadastropessoa-->                    

                        <div class="row">                    
                            <h3 align='center'>Informe o CPF do funcionário</h3>    
                            <div class="col-md-4"></div>  <!--div vazia -->
                            <div class="col-md-4">                       
                                <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF"/>
                                <!-- retorna os dados nome e sobrenome, setor, função, status informado e abre o formulário de cadastro de usuário -->            
                            </div> <!-- Fechando div do campo CPF -->                    
                        </div><!--fechando class=row -->

                        <hr>
                        <br>

                        <div class="row"><!-- Abrindo 1ª linha do formulário -->                                   
                            <div class="col-md-4"></div>  <!--div vazia -->
                            <div class="col-md-4">    
                                <label>Perfil:</label> <br>
                                <input type="radio" name="perfilusuario" value="1" > Gestor/Adm  
                                <input type="radio" name="perfilusuario" value="2"> Padrão
                            </div><!-- Fechando div do campo Perfil -->
                        </div><!--fechando 2ªlinha -->

                        <br>
                        <div class="row"><!-- Abrindo 2ª linha do formulário -->                                   
                            <div class="col-md-4"></div>  <!--div vazia -->
                            <div class="col-md-4">  
                                <label>Senha:</label> 
                                <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha"/>
                            </div><!-- Fechando div do campo Senha -->
                        </div><!--fechando 2ªlinha -->

                        <br>
                        <div class="row"><!-- Abrindo 3ª linha do formulário -->                                   
                            <div class="col-md-4"></div>  <!--div vazia -->
                            <div class="col-md-4">   
                                <label>Confirmação de Senha:</label> 
                                <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha"/>
                            </div><!-- Fechando div do campo Senha -->
                        </div><!-- Fechando 1ª linha do formulário -->                

                        <br>
                        <div class="row"> <!-- Abrindo 2ª linha do formulário -->
                            <div class="col-md-3"></div> <!-- Div vazia -->

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

                        </div><!-- Fechando 6ª linha do formulário -->
                </form> 
            </div> <!-- fechando a div formulário -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="js/bootstrap.min.js"></script>
        </div> <!-- fechando a div class="container theme-showcase" -->
    </body>
</html>


