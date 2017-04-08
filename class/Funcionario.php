<?php

include_once 'AutoLoad.php';

$objeto = new Funcionario();

class Funcionario  {

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
        //aclecio colocou
        //funcionario
        /* @var $_POST type */
        $this->tipofuncionario = $_POST['tipofuncionario'];
        $this->statusfuncionario = $_POST['statusfuncionario'];
        $this->motivoinativo = $_POST['motivoinativo'];
        $this->setorfuncionario = $_POST['setorfuncionario'];
        $this->funcaofuncionario = $_POST['funcaofuncionario'];
     
        
        
         if (empty($this->tipofuncionario)) {
            echo "<script>alert('tipofuncionario de fuincioanrio obrigatio!')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }
           if (empty($this->funcaofuncionario)){
            echo "<script>alert('funcaofuncionario preecha o campo!')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }
      
        if (empty($this->statusfuncionario)) {
            echo "<script>alert('statusfuncionario do funcionario vazio!')</script>";
            echo "<script>document.location = '../view/FormCadFuncionario.php'</script>";
            exit();
        }
        if (empty($this->setorfuncionario)) {
            echo "<script>alert('setorfuncionario funcionario vazio!')</script>";
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
            
            if ($cst->execute()) {
                //inserindo dados na tb_pessoa
                   //pessoa:
                
                $this->nome = $_POST['nome'];
                $this->sobrenome = $_POST['sobrenome'];
                $this->rg = $_POST['rg'];
                $this->cpf = $_POST['cpf'];
                $this->email = $_POST['email'];
                $this->sexo = $_POST['sexo'];
                $this->datanascimento = $_POST['datanascimento'];
                $this->datacadastro = $_POST['datacadastro'];
               // print_r($_POST);
                //exit();

                $cst = $pdo->prepare("INSERT INTO tb_pessoa (nome , sobrenome ,rg, cpf , email, sexo, datanascimento, datacadastro,tb_endereco_idendereco, tb_telefone_idtelefone) VALUES(:nome , :sobrenome, :rg, :cpf, :email, sexo, datanascimento, datacadastro,:tb_endereco_idendereco, :tb_telefone_id_telefone);");
                $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
                $cst->bindParam(":sobrenome", $this->sobrenome, PDO::PARAM_STR);
                $cst->bindParam(":rg", $this->rg, PDO::PARAM_STR);
                $cst->bindParam(":cpf", $this->cpf, PDO::PARAM_STR);
                $cst->bindParam(":email", $this->email, PDO::PARAM_STR);
                $cst->bindParam(":sexo", $this->sexo, PDO::PARAM_STR);
                $cst->bindParam(":datanascimento", $this->datanascimento, PDO::PARAM_STR);
                $cst->bindParam(":datacadastro", $this->datacadastro, PDO::PARAM_STR);
           // print_r($cst); 
            
            
                
            if ($cst->execute()) {
            
            //inserindo dados na tb_endereco   
                //endereco:
                $this->endereco = $_POST['endereco'];
                $this->bairro = $_POST['bairro'];
                $this->cidade = $_POST['cidade'];
                $this->uf = $_POST['uf'];
                $this->cep = $_POST['cep'];
                $this->ptreferencia = $_POST['ptreferencia'];
        
                $cst = $pdo->prepare("INSERT INTO tb_endereco (endereco , bairro ,cidade , uf , cep, ptreferencia) VALUES(:endereco , :bairro, :cidade, :uf, :cep, ptreferencia);");
                $cst->bindParam(":endereco", $this->endereco, PDO::PARAM_STR);
                $cst->bindParam(":bairro", $this->bairro, PDO::PARAM_STR);
                $cst->bindParam(":cidade", $this->cidade, PDO::PARAM_STR);
                $cst->bindParam(":uf", $this->uf, PDO::PARAM_STR);
                $cst->bindParam(":cep", $this->cep, PDO::PARAM_STR);
                $cst->bindParam(":ptreferencia", $this->ptreferencia, PDO::PARAM_STR);
             //print_r($cst);  
            
             
             if ($cst->execute()) {
            //inserindo dados na tb_telefone  
                $this->tipotelefone = $_POST['tipotelefone'];
                $this->dddtelefone = $_POST['dddtelefone'];
                $this->numtelefone = $_POST['numtelefone'];
                $this->operadora = $_POST['operadora'];
                $this->horariocontato = $_POST['horariocontato'];

                   $cst = $pdo->prepare("INSERT INTO tb_telefone (tipotelefone , dddtelefone , numtelefone , operadora , horariocontato) VALUES(:tipotelefone , :dddtelefone, :numtelefone, :operadora, :horariocontato);");
                    $cst->bindParam(":tipotelefone", $this->tipotelefone, PDO::PARAM_STR);
                    $cst->bindParam(":dddtelefone", $this->dddtelefone, PDO::PARAM_STR);
                    $cst->bindParam(":numtelefone", $this->numtelefone, PDO::PARAM_STR);
                    $cst->bindParam(":operadora", $this->operadora, PDO::PARAM_STR);
                    $cst->bindParam(":horariocontato", $this->horariocontato, PDO::PARAM_STR);
                     print_r($cst);

                        print_r($cst->errorInfo(), true);
                        echo "<script>alert('Cadastro de Funcionario efetuado com sucesso!')</script>";
                        echo"<script>document.location = '../view/FormCadFuncionario.php'</script>";
                        exit();
                }
            
               }
                        //return 0;
            };
            
            print_r($pdo->lastInsertId());
            exit();
            return $pdo->lastInsertId();
            
            return 0;
        }
         catch (PDOException $ex) {
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
