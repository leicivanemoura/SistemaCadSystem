<?php

include_once 'AutoLoad.php';

$objeto = new Funcionario();

class Funcionario {

    //Atributos da Classe Funcionario
    //Private só pode ser acessado na mesma classe;
    //protected só pode ser acessado na mesma classe ou em suas classes filhas;

    protected $idpessoa;
    protected $nome;
    protected $sobrenome;
    protected $rg;
    protected $cpf;
    protected $email;
    protected $sexo;
    protected $datanascimento;
    protected $datacadastro;
    protected $datavalida;
    protected $datavalidaNacimento;
    
    protected $idendereco;
    protected $endereco;
    protected $bairro;
    protected $cidade;
    protected $uf;
    protected $cep;
    protected $ptreferencia;
    
    protected $idtelefone;
    protected $tipotelefone;
    protected $dddtelefone;
    protected $numtelefone;
    protected $operadora;
    protected $horariocontato;
    
    protected $idtelefone2;
    protected $tipotelefone2;
    protected $dddtelefone2;
    protected $numtelefone2;
    protected $operadora2;
    protected $horariocontato2;
    
    protected $idfuncionario;
    protected $tipofuncionario;
    protected $setorfuncionario;
    protected $funcaofuncionario;
    protected $statusfuncionario;
    protected $motivoinativo;

    // Métodos/Funções GET e SET
    //construtor:
    public function __construct() {

        $this->Inclui();
    }

//metodos mágicos:
    /*  public function __set($atributo, $valor) {
      $this->atributo = $valor;
      }
      public function __get($atributo) {
      return $this->atributo;
      }
     *   
     */
    //criando metódos com os scripts da classe funcionario utilizando PDO
    public function SelecionaById($id) {
        try {
            $con = new Conexao();
            $pdo = $con->conectar();
            $this->idfuncionario = $id;
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cst = $pdo->prepare("SELECT idfuncionario , tipofuncionario , setorfuncionario , funcaofuncionario , statusfuncionario , motivoinativo FROM tb_funcionario WHERE idfuncionario = :idfuncionario;");
            $cst->bindParam(":idfuncionario", $this->idfuncionario, PDO::PARAM_INT);
            $cst->execute();

            //busca o retorno como objeto
            $objeto = $cst->fetchObject('Funcionario');

            if (isset($objeto->idfuncionario)) {
                $endereco = new Endereco();
                $endereco->idendereco = $objeto->tb_endereco_idendereco;
                //Busca o Objeto do Endereço
                $objeto->endereco = $endereco->SelecionaById($endereco->idendereco);
                unset($objeto->tb_endereco_idendereco);
            }

            //retorna o Funcionario com Endereço
            return $objeto;
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function Seleciona() {
        try {
            $con = new Conexao();
            $cst = $con->conectar()->prepare("SELECT idfuncionario , tipofuncionario , setorfuncionario , funcaofuncionario , statusfuncionario , motivoinativo FROM tb_funcionario;");
            $cst->execute();
            return $cst->fetch();
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function Inclui() {
        //pessoa
        /* @var $_POST type */

        $this->nome = $_POST['nome'];
        $this->sobrenome = $_POST['sobrenome'];
        $this->rg = $_POST['rg'];
        $this->cpf = $_POST['cpf'];
        $this->email = $_POST['email'];
        $this->sexo = $_POST['sexo'];
        $this->datanascimento = $_POST['datanascimento'];
        $this->datavalidaNacimento = date('d/m/Y', strtotime($this->datanascimento));
        $this->datacadastro = $_POST['datacadastro'];
        $this->datavalida = date('d/m/Y', strtotime($this->datacadastro));
        if (empty($this->nome)) {
            echo "<script>alert('Campos obrigatórios em branco!Nome')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }
        if (empty($this->sobrenome)) {
            echo "<script>alert('Campos obrigatórios em branco!Sobrenome')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }
        if (empty($this->cpf)) {
            echo "<script>alert('Campos obrigatórios em branco!CPF')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }
        if (empty($this->datacadastro)) {
            echo "<script>alert('Campos obrigatórios em branco!Data de Cadastro')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }
        if (empty($this->datavalida)) {
            echo "<script>alert('Campos obrigatórios em branco!Data de Cadastro')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }

        $this->endereco = $_POST['endereco'];
        $this->bairro = $_POST['bairro'];
        $this->cidade = $_POST['cidade'];
        $this->uf = $_POST['uf'];
        $this->cep = $_POST['cep'];
        $this->ptreferencia = $_POST['ptreferencia'];
        if (empty($this->endereco)) {
            echo "<script>alert('Campos obrigatórios em branco!Endereco')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }
        if (empty($this->bairro)) {
            echo "<script>alert('Campos obrigatórios em branco!Bairro')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }
        if (empty($this->cidade)) {
            echo "<script>alert('Campos obrigatórios em branco!Cidade')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }
        if (empty($this->uf)) {
            echo "<script>alert('Campos obrigatórios em branco!UF')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }

        $this->tipotelefone = $_POST['tipotelefone1'];
        $this->dddtelefone = $_POST['dddtelefone1'];
        $this->numtelefone = $_POST['numtelefone1'];
        $this->operadora = $_POST['operadora1'];
        $this->horariocontato = $_POST['horariocontato1'];
        if (empty($this->dddtelefone)) {
            echo "<script>alert('Campos obrigatórios em branco!DDD1')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }
        if (empty($this->numtelefone)) {
            echo "<script>alert('Campos obrigatórios em branco!NºTelefone1')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }
        
        $this->tipotelefone2 = $_POST['tipotelefone2'];
        $this->dddtelefone2 = $_POST['dddtelefone2'];
        $this->numtelefone2 = $_POST['numtelefone2'];
        $this->operadora2 = $_POST['operadora2'];
        $this->horariocontato2 = $_POST['horariocontato2'];

        $this->tipofuncionario = $_POST['tipofuncionario'];
        $this->statusfuncionario = $_POST['statusfuncionario'];
        $this->motivoinativo = $_POST['motivoinativo'];
        $this->setorfuncionario = $_POST['setorfuncionario'];
        $this->funcaofuncionario = $_POST['funcaofuncionario'];

        if (empty($this->tipofuncionario)) {
            echo "<script>alert('Campos obrigatórios em branco!Tipo')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }
        if (empty($this->setorfuncionario)) {
            echo "<script>alert('Campos obrigatórios em branco!Setor')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }
        if (empty($this->funcaofuncionario)) {
            echo "<script>alert('Campos obrigatórios em branco!Função')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }

        try {
            $con = new Conexao();
            $pdo = $con->conectar();

            //inserindo dados na tb_funcionario:
            $cst = $pdo->prepare("INSERT INTO tb_funcionario (tipofuncionario , setorfuncionario , funcaofuncionario , statusfuncionario , motivoinativo)"
                    . " VALUES(:tipofuncionario , :setorfuncionario, :funcaofuncionario, :statusfuncionario, :motivoinativo);");
            $cst->bindParam(":tipofuncionario", $this->tipofuncionario, PDO::PARAM_STR);
            $cst->bindParam(":setorfuncionario", $this->setorfuncionario, PDO::PARAM_STR);
            $cst->bindParam(":funcaofuncionario", $this->funcaofuncionario, PDO::PARAM_STR);
            $cst->bindParam(":statusfuncionario", $this->statusfuncionario, PDO::PARAM_STR);
            $cst->bindParam(":motivoinativo", $this->motivoinativo, PDO::PARAM_STR);
            //print_r($cst);
            $id = $pdo->lastInsertId();
            if ($cst->execute()) {
            //inserindo dados na tb_pessoa                         
            // print_r($_POST);
            //exit();
            $cst1 = $pdo->prepare("INSERT INTO tb_pessoa (nome , sobrenome ,rg, cpf , email, sexo, datanascimento, datacadastro,tb_funcionario_idfuncionario)"
                      . "VALUES(:nome , :sobrenome, :rg, :cpf, :email, :sexo, :datanascimento, :datacadastro,:tb_funcionario);");
            $cst1->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $cst1->bindParam(":sobrenome", $this->sobrenome, PDO::PARAM_STR);
            $cst1->bindParam(":rg", $this->rg, PDO::PARAM_STR);
            $cst1->bindParam(":cpf", $this->cpf, PDO::PARAM_STR);
            $cst1->bindParam(":email", $this->email, PDO::PARAM_STR);
            $cst1->bindParam(":sexo", $this->sexo, PDO::PARAM_STR);
            $cst1->bindParam(":datanascimento", $this->datavalidaNacimento, PDO::PARAM_STR);
            $cst1->bindParam(":datacadastro", $this->datavalida, PDO::PARAM_STR);
            $cst1->bindParam(":tb_funcionario", $id, PDO::PARAM_STR);
            // print_r($cst); 
            $id = $pdo->lastInsertId();
            if ($cst1->execute()) {
            //inserindo dados na tb_endereco   
            $cst2 = $pdo->prepare("INSERT INTO tb_endereco (endereco , bairro ,cidade , uf , cep, ptreferencia, tb_funcionario_idfuncionario)"
                        . " VALUES(:endereco , :bairro, :cidade, :uf, :cep, :ptreferencia, :tb_funcionario);");
            $cst2->bindParam(":endereco", $this->endereco, PDO::PARAM_STR);
            $cst2->bindParam(":bairro", $this->bairro, PDO::PARAM_STR);
            $cst2->bindParam(":cidade", $this->cidade, PDO::PARAM_STR);
            $cst2->bindParam(":uf", $this->uf, PDO::PARAM_STR);
            $cst2->bindParam(":cep", $this->cep, PDO::PARAM_STR);
            $cst2->bindParam(":ptreferencia", $this->ptreferencia, PDO::PARAM_STR);
            $cst2->bindParam(":tb_funcionario", $id, PDO::PARAM_STR);
            //print_r($cst);  
            $id = $pdo->lastInsertId();
            if ($cst2->execute()){
            //inserindo dados na tb_telefone   - tel1              
            $cst3 = $pdo->prepare("INSERT INTO tb_telefone (tipotelefone , dddtelefone , numtelefone , operadora , horariocontato, tb_funcionario_idfuncionario)"
                        . " VALUES(:tipotelefone1 , :dddtelefone1, :numtelefone1, :operadora1, :horariocontato1, :tb_funcionario);");
            $cst3->bindParam(":tipotelefone1", $this->tipotelefone, PDO::PARAM_STR);
            $cst3->bindParam(":dddtelefone1", $this->dddtelefone, PDO::PARAM_STR);
            $cst3->bindParam(":numtelefone1", $this->numtelefone, PDO::PARAM_STR);
            $cst3->bindParam(":operadora1", $this->operadora, PDO::PARAM_STR);
            $cst3->bindParam(":horariocontato1", $this->horariocontato, PDO::PARAM_STR);
            $cst3->bindParam(":tb_funcionario", $id, PDO::PARAM_STR);
            //print_r($cst);  
            $id = $pdo->lastInsertId();
            if ($cst3->execute()){
            //inserindo dados na tb_telefone - tel 2
            $cst4 = $pdo->prepare("INSERT INTO tb_telefone (tipotelefone , dddtelefone , numtelefone , operadora , horariocontato, tb_funcionario_idfuncionario)"
                        . " VALUES(:tipotelefone2 , :dddtelefone2, :numtelefone2, :operadora2, :horariocontato2, :tb_funcionario);");
            $cst4->bindParam(":tipotelefone2", $this->tipotelefone2, PDO::PARAM_STR);
            $cst4->bindParam(":dddtelefone2", $this->dddtelefone2, PDO::PARAM_STR);
            $cst4->bindParam(":numtelefone2", $this->numtelefone2, PDO::PARAM_STR);
            $cst4->bindParam(":operadora2", $this->operadora2, PDO::PARAM_STR);
            $cst4->bindParam(":horariocontato2", $this->horariocontato2, PDO::PARAM_STR);
            $cst4->bindParam(":tb_funcionario", $id, PDO::PARAM_STR);
              }                
             }
            }
            //return 0;
           };

            print_r($pdo->lastInsertId());
            exit();
            return $pdo->lastInsertId();

            return 0;
        } catch (PDOException $ex) {
            'erro' . $ex->getMessage();
            return 0;
        }
    }

    public function Altera($objeto) {
        try {
            $con = new Conexao();
            $pdo = $con->conectar();
            $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $id = $objeto->idfuncionario;
            $this->tipofuncionario = $objeto->tipofuncionario;
            $this->setorfuncionario = $objeto->setorfuncionario;
            $this->funcaofuncionario = $objeto->funcaofuncionario;
            $this->statusfuncionario = $objeto->statusfuncionario;
            $this->motivoinativo = $objeto->motivoinativo;
            $cst = $pdo->prepare("UPDATE tb_funcionario SET tipofuncionario= :tipofuncionario , setorfuncionario= :setorfuncionario , funcaofuncionario = :funcaofuncionario , statusfuncionario = :statusfuncionario , motivoinativo = :motivoinativo  WHERE idfuncionario = :idfuncionario;");
            $cst->bindParam(":idfuncionario", $id, PDO::PARAM_INT);
            $cst->bindParam(":tipofuncionario", $this->tipofuncionario, PDO::PARAM_STR);
            $cst->bindParam(":setorfuncionario", $this->setorfuncionario, PDO::PARAM_STR);
            $cst->bindParam(":funcaofuncionario", $this->funcaofuncionario, PDO::PARAM_STR);
            $cst->bindParam(":statusfuncionario", $this->statusfuncionario, PDO::PARAM_STR);
            $cst->bindParam(":motivoinativo", $this->motivoinativo, PDO::PARAM_STR);

            //Ajuste para melhorar o que é mostrado na tela quando há erro ou não
            if (!$cst->execute()) {
                print_r($cst->errorInfo(), true);
                return;
            };
        } catch (PDOException $ex) {
            return 'erro' . $ex->getMessage();
        }
    }

    public function Exclui($objeto) {
        try {
            $con = new Conexao();
            $pdo = $con->conectar();
            $id = $objeto->idfuncionario;
            $cst = $pdo->prepare("DELETE FROM tb_funcionario WHERE idfuncionario = :idfuncionario;");
            $cst->bindParam(":idfuncionario", $id, PDO::PARAM_INT);
            //Ajuste para melhorar o que é mostrado na tela quando há erro ou não
            if (!$cst->execute()) {
                print_r($cst->errorInfo(), true);
                return;
            };
        } catch (PDOException $ex) {
            return 'erro' . $ex->getMessage();
        }
    }

}
