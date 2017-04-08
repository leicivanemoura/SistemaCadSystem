<?php
include_once ('../class/AutoLoad.php');
include_once '../class/Pessoa.php';

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Lista de Funcionario</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/estilo.css" rel="stylesheet">
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
                            <a href="#">Produto</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" >Pesquisar<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Cliente</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Produto</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Ordem de Serviço </a></li>
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
        <br><br><br/>
        
        <table class='table table-striped'>
            <h1 align= "center">Lista de Funcionários</h1>
            <tr>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Ação</th>
                    <th colspan="2"></th>                        
                </tr>
            </thead>
            <tbody>
                
                
                <?php
                $Seleciona = "SELECT * FROM tb_funcionario";
                $exec = $con->query($Seleciona);
                $total = $exec->rowCount();

                $limit = 5;
                $n = isset($_GET['n']) ? $_GET['n'] : 1;
                $init = ( $n * $limit) - $limit;

                $numRegistros = ceil($total / $limit);

                $sql = "SELECT * FROM tb_funcionario LIMIT $init,$limit";
                $exec = $conn->query($sql);

                $row = $exec->rowCount();

                if ($row == 0):
                    ?>                    
                    <tr>
                        <td colspan="6"> Não Existe Usuários no Sistema. </td>
                    </tr>
                    <?php
                else:
                    while ($r = $exec->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td><th>#</th>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th>Ação</th>
                            <td> <?= $r['nomefuncionario'] ?> </td>
                            <td> <?= $r['sobrenomefuncionario'] ?> </td>
                            <td> <?= $r['cpffuncionario'] ?> </td>
                            <td> <?= $r['emailfuncionario'] ?> </td>
                            <td>
                                <a href="?pg=editarfuncionario&id=<?= $r['idfuncionario']; ?>" class="text-warning">
                                    <span class="glyphicon glyphicon-edit"></span></a>
                            </td>
                            <td>
                                <a href="?pg=deletarfuncionario&id=<?= $r['idfuncionario']; ?>" class="text-danger">
                                    <span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                    <?php } endif; ?>
            </tbody>
        </table>
        
         <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>

