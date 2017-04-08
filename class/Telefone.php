<?php

include_once 'AutoLoad.php';

class Telefone {

    //Atributos da Classe Telefone
    //Private só pode ser acessado na mesma classe;
    //protected só pode ser acessado na mesma classe ou em suas classes filhas;
    protected $idtelefone;
    protected $tipotelefone;
    protected $dddtelefone;
    protected $numtelefone;
    protected $operadora;
    protected $horariocontato;

    // Métodos/Funções GET e SET
    //construtor:
    public function __construct() {
        //$telefone = new Telefone(); ---não precisa desse?
        $this->objfunc = new Funcoes();
    }

    //metodos mágicos:
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function __get($atributo) {
        return $this->$atributo;
    }

    //criando metódos com os scripts da classe telefone utilizando PDO
    public function SelecionaById($id) {
        try {
            $con = new Conexao();
            $pdo = $con->conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cst = $pdo->prepare("SELECT idtelefone , tipotelefone, dddtelefone, numtelefone, operadora , horariocontato FROM tb_telefone WHERE idtelefone = :idtelefone;");
            $cst->bindParam(":idtelefone", $id, PDO::PARAM_INT);
            $cst->execute();

            //busca o retorno como objeto
            $objeto = $cst->fetchObject('Telefone');

            return $objeto;
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function Seleciona() {
        try {
            //$con = new Conexao();
            $cst = $this->con->conectar()->prepare("SELECT idtelefone , tipotelefone, dddtelefone, numtelefone, operadora , horariocontato FROM tb_telefone;");
            $cst->execute();
            return $cst->fetchAll();
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function Inclui($objeto) {
        try {
            $con = new Conexao();
            $pdo = $con->conectar();
            $this->tipotelefone = $objeto->tipotelefone;
            $this->dddtelefone = $objeto->dddtelefone;
            $this->numtelefone = $objeto->numtelefone;
            $this->operadora = $objeto->operadora;
            $this->horariocontato = $objeto->horariocontato;
            $cst = $pdo->prepare("INSERT INTO tb_telefone (tipotelefone , dddtelefone , numtelefone , operadora , horariocontato) VALUES(:tipotelefone , :dddtelefone, :numtelefone, :operadora, :horariocontato);");
            $cst->bindParam(":tipotelefone", $this->tipotelefone, PDO::PARAM_STR);
            $cst->bindParam(":dddtelefone", $this->dddtelefone, PDO::PARAM_STR);
            $cst->bindParam(":numtelefone", $this->numtelefone, PDO::PARAM_STR);
            $cst->bindParam(":operadora", $this->operadora, PDO::PARAM_STR);
            $cst->bindParam(":horariocontato", $this->horariocontato, PDO::PARAM_STR);
            
            if (!$cst->execute()) {
                print_r($cst->errorInfo(), true);
                return 0;
            };
            return $pdo->lastInsertId();
        } catch (PDOException $ex) {
            'erro' . $ex->getMessage();
            return 0;
        }
    }

    public function Altera($objeto) {
        try {
            $con = new Conexao();
            $pdo = $con->conectar();
            //$pdo->setAttribute( PDO::MYSQL_ATTR_USE_BUFFERED_QUERY  , true );
            $id = $objeto->idtelefone;
            $this->tipotelefone = $objeto->tipotelefone;
            $this->dddtelefone = $objeto->dddtelefone;
            $this->numtelefone = $objeto->numtelefone;
            $this->operadora = $objeto->operadora;
            $this->horariocontato = $objeto->horariocontato;
            $cst = $pdo->prepare("UPDATE tb_telefone SET tipotelefone= :tipotelefone , dddtelefone= :dddtelefone , numtelefone = :numtelefone , operadora = :operadora, horariocontato = :horariocontato WHERE idtelefone = :idtelefone;");
            $cst->bindParam(":idtelefone", $id, PDO::PARAM_INT);
            $cst->bindParam(":tipotelefone", $this->tipotelefone, PDO::PARAM_STR);
            $cst->bindParam(":dddtelefone", $this->dddtelefone, PDO::PARAM_STR);
            $cst->bindParam(":numtelefone", $this->numtelefone, PDO::PARAM_STR);
            $cst->bindParam(":operadora", $this->operadora, PDO::PARAM_STR);
            $cst->bindParam(":horariocontato", $this->horariocontato, PDO::PARAM_STR);
            
            //Ajuste para melhorar o que é mostrado na tela quando há erro ou não
            if (!$cst->execute()) {
                print_r($cst->errorInfo(), true);
                return false;
            };
        } catch (PDOException $ex) {
            return 'erro' . $ex->getMessage();
        }    }

    public function Exclui($objeto) {
        try {
            $con = new Conexao();
            $pdo = $con->conectar();
            $id = $objeto->telefone;
            $cst = $pdo->prepare("DELETE FROM tb_telefone WHERE idtelefone = :idtelefone;");
            $cst->bindParam(":idtelefone", $id, PDO::PARAM_INT);
            //Ajuste para melhorar o que é mostrado na tela quando há erro ou não
            if (!$cst->execute()) {
                print_r($cst->errorInfo(), true);
                return false;
            };
            return true;
        } catch (PDOException $ex) {
            return 'erro' . $ex->getMessage();
        }
    }

}
