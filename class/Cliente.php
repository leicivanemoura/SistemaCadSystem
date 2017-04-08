<?php
include_once 'AutoLoad.php';

class Cliente extends Pessoa {

    //Atributos da Classe Cliente
    //Private só pode ser acessado na mesma classe;
    //protected só pode ser acessado na mesma classe ou em suas classes filhas;
    
    protected $idcliente;
        
         //O funcionario tem atributos que são objeto de outras tabelas e classes
    
    protected $pessoa;
    protected $endereco;
    protected $telefone;   
    
    // Métodos/Funções GET e SET
    //construtor:
    public function __construct() {
        //$this->Pessoa = new Pessoa();
        //$cliente = new cliente(); ---não precisa desse?
       $this->objfunc = new Funcoes();
    }
    
//metodos mágicos:
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
    public function __get($atributo) {
        return $this->$atributo;
        
    }    //criando metódos com os scripts da classe funcionario utilizando PDO
    public function SelecionaById($id) {
        try {
            $con = new Conexao();
            $pdo = $con->conectar();
            $this->idcliente = $id;
            $pdo->setAttribute (PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION ) ; 
            //em dúvida como colocar os dados do cliente que é uma pessoa, na linha abaixo:
            $cst = $pdo->prepare("SELECT idcliente FROM tb_cliente WHERE idcliente = :idcliente;");
            $cst->bindParam(":idcliente", $this->idcliente , PDO::PARAM_INT);
            $cst->execute();

            //busca o retorno como objeto
            $objeto = $cst->fetchObject('Cliente');
            
              if (isset($objeto->idcliente)){
                $endereco = new Endereco(); // não seria $cliente = newcliente
                $endereco->idendereco = $objeto->tb_endereco_idendereco; // não seria cliente->idcliente = $cliente->tb_cliente_idcliente ou pessoa já que o id desse cliente pertence a um id pessoa?

                //Busca o Objeto do Endereço
                $objeto->endereco = $endereco->SelecionaById($endereco->idendereco);//idem
                unset($objeto->tb_endereco_idendereco);
            }

            return $objeto;
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function Seleciona() {
        try {
            $con = new Conexao();
            $cst = $con->conectar()->prepare("SELECT idcliente FROM tb_cliente;");
            $cst->execute();
            return $cst->fetch();
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function Inclui($objeto) {
        try {
            $con = new Conexao();
            /*
             * em dúvida:
            $this->tipofuncionario = $objeto->tipofuncionario;
            $this->setorfuncionario = $this->objfunc->tratarCaracter($objeto->setorfuncionario, 1);
            $this->funcaofuncionario = $this->objfunc->trararCaracter($objeto->funcaofuncionario, 1);
            $this->statusfuncionario = $objeto->statusfuncionario;
            $this->motivoinativo = $this->objfunc->trararCaracter($objeto->motivoinativo, 1);
            $pdo = $con->conectar();
            $cst = $pdo->prepare("INSERT INTO tb_funcionario (tipofuncionario , setorfuncionario , funcaofuncionario , statusfuncionario , motivoinativo) VALUES(:tipofuncionario , :setorfuncionario, :funcaofuncionario, :statusfuncionario, :motivoinativo);");
            $cst->bindParam(":tipofuncionario", $this->tipofuncionario, PDO::PARAM_STR);
            $cst->bindParam(":setorfuncionario", $this->setorfuncionario, PDO::PARAM_STR);
            $cst->bindParam(":funcaofuncionario", $this->funcaofuncionario, PDO::PARAM_STR);
            $cst->bindParam(":statusfuncionario", $this->statusfuncionario, PDO::PARAM_STR);
            $cst->bindParam(":motivoinativo", $this->motivoinativo, PDO::PARAM_STR);
                        
          if (!$cst->execute()) {
                print_r($cst->errorInfo(), true);
                return 0;
            };
            return $pdo->lastInsertId();
             * 
             */
        } catch (PDOException $ex) {
            'erro' . $ex->getMessage();
            return 0;
        }
    }

    public function Altera($objeto) {
        try {
            $con = new Conexao();
            $pdo = $con->conectar();
            $pdo->setAttribute( PDO::MYSQL_ATTR_USE_BUFFERED_QUERY  , true );
            $id = $objeto->idcliente;
            /*
            $this->tipofuncionario = $objeto->tipofuncionario;
            $this->setorfuncionario = $this->objfunc->tratarCaracter($objeto->setorfuncionario, 1);
            $this->funcaofuncionario = $this->objfunc->trararCaracter($objeto->funcaofuncionario, 1);
            $this->statusfuncionario = $objeto->statusfuncionario;
            $this->motivoinativo = $this->objfunc->trararCaracter($objeto->motivoinativo, 1);
            $cst = $pdo->prepare("UPDATE tb_funcionario SET tipofuncionario= :tipofuncionario , setorfuncionario= :setorfuncionario , funcaofuncionario = :funcaofuncionario , statusfuncionario = :statusfuncionario , motivoinativo = :motivoinativo  WHERE idfuncionario = :idfuncionario;");
            $cst->bindParam(":idfuncionario", $id, PDO::PARAM_INT);
            $cst->bindParam(":tipofuncionario", $this->tipofuncionario, PDO::PARAM_STR);
            $cst->bindParam(":setorfuncionario", $this->setorfuncionario, PDO::PARAM_STR);
            $cst->bindParam(":funcaofuncionario", $this->funcaofuncionario, PDO::PARAM_STR);
            $cst->bindParam(":statusfuncionario", $this->statusfuncionario, PDO::PARAM_STR);
            $cst->bindParam(":motivoinativo", $this->motivoinativo, PDO::PARAM_STR);
*/
            
            //Ajuste para melhorar o que é mostrado na tela quando há erro ou não
            if(! $cst->execute()){
                print_r($cst->errorInfo(),true);
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
            $id = $objeto->idcliente;
            $cst = $pdo->prepare("DELETE FROM tb_cliente WHERE idcliente = :idcliente;");
            $cst->bindParam(":idcliente", $id, PDO::PARAM_INT);
            //Ajuste para melhorar o que é mostrado na tela quando há erro ou não
            if(! $cst->execute()){
                print_r($cst->errorInfo(),true);
                return; 
            };
        } catch (PDOException $ex) {
            return 'erro' . $ex->getMessage();
        }
    }

}


