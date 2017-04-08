<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SistemaCadSystem</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/2-col-portfolio.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

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
                            <a href="/view/FormCadCliente.php">Cliente</a>
                        </li>
                        <li>
                            <a href="FormCadFuncionario.php">Funcionário</a>
                        </li>
                        <li>
                            <a href="FormCadOs.php">Ordem de Serviço</a>
                        </li>
                        <li>
                            <a href="FormCadUsuario.php">Usuário</a>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true">Pesquisar<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/view/FormCadCliente.php">Cliente</a></li>
                                <li class="divider"></li>
                                <li><a href="/view/FormCadFuncionario.php">Funcionário</a></li>
                                <li class="divider"></li>
                                <li><a href="/view/FormCadOs.php">Ordem de Serviço </a></li>
                                <li class="divider"></li>
                                <li><a href="/view/FormCadUsuario.php">Usuário</a></li>
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

        <div class="container">
            <!-- Jumbotron Header -->
            <header class="jumbotron hero-spacer">
                <h3 align="center">Seja Bem Vindo usuário!</h3>           
            </header>        
        </div>

        <!-- Page Content -->
        <div class="container">
            <!-- Page Header -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Selecione o serviço desejado</h3>
                </div>
            </div>
            <!-- /.row -->

            <!-- Projects Row -->
            <div class="row"> <!--Abrindo 1ªlinha do menu-->
                <div class="col-md-3"></div><!--div vazia-->
                <div class="col-md-4 portfolio-item">                
                    <a href=""><img class="img" src="img/cliente.jpg" alt="Cliente" width="120"></a>
                    <h3><a href="FormCadCliente.php">Cliente</a></h3>                
                </div>

                <div class="col-md-4 portfolio-item">
                    <a href=""><img class="img" src="img/os.PNG" alt="Oredem de Serviço" width="100"></a>
                    <h3><a href="FormCadOs.php">Ordem de Serviço</a></h3>
                </div>
            </div><!-- Fechando 1ª linha do menu-->

            <div class="row">  <!--Abrindo 2ªlinha do menu--> 
                <div class="col-md-3"></div><!--div vazia-->
                <div class="col-md-4 portfolio-item">
                    <a href=""><img class="img" src="img/funcionario.jpg" alt="Funcionário" width="80"></a>
                    <h3><a href="FormCadFuncionario.php">Funcionário</a></h3>
                </div>  

                <div class="col-md-4 portfolio-item">
                    <a href=""><img class="img" src="img/usuario.jpg" alt="Usuario" width="95"></a>
                    <h3><a href="FormCadUsuario.php">Usuário</a></h3>
                </div>
            </div><!-- Fechando 2ª linha do menu-->
            <!-- /.row -->

            <hr>

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

            <hr>

            <!-- Footer
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; Your Website 2014</p> 
                    </div>
                </div>
                 /.row
            </footer>
            -->

        </div> <!--  fechando a div class=container -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>
