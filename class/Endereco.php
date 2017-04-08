<?php

include_once 'AutoLoad.php';

class Endereco {

    //Atributos da Classe Endereco
    //Private só pode ser acessado na mesma classe;
    //protected só pode ser acessado na mesma classe ou em suas classes filhas;
    protected $idendereco;
    protected $endereco;
    protected $bairro;
    protected $cidade;
    protected $uf;
    protected $cep;
    protected $ptreferencia;

    // Métodos/Funções GET e SET
    //construtor:
    public function __construct() {
        //$endereco = new Endereco(); ---não precisa desse?
        $this->objfunc = new Funcoes();
    }

    //metodos mágicos:
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function __get($atributo) {
        return $this->$atributo;
    }

    //criando metódos com os scripts da classe endereco utilizando PDO
    public function SelecionaById($id) {
        try {
            $con = new Conexao();
            $pdo = $con->conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cst = $pdo->prepare("SELECT idendereco , endereco, bairro, cidade, uf, cep, ptreferencia FROM tb_endereco WHERE idendereco = :idendereco;");
            $cst->bindParam(":idendereco", $id, PDO::PARAM_INT);
            $cst->execute();

            //busca o retorno como objeto
            $objeto = $cst->fetchObject('Endereco');

            return $objeto;
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function Seleciona() {
        try {
            $cst = $this->con->conectar()->prepare("SELECT idendereco , endereco, bairro, cidade, uf , cep , ptreferencia FROM tb_endereco;");
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
            $this->endereco = $this->objfunc->tratarCaracter($objeto->endereco, 1);
            $this->bairro = $this->objfunc->tratarCaracter($objeto->bairro, 1);
            $this->cidade = $this->objfunc->tratarCaracter($objeto->cidade, 1);
            $this->uf = $objeto->uf;
            $this->cep = $objeto->cep;
            $this->ptreferencia = $this->objfunc->tratarCaracter($objeto->ptreferencia, 1);
            $cst = $pdo->prepare("INSERT INTO tb_endereco (endereco , bairro ,cidade , uf , cep, ptreferencia) VALUES(:endereco , :bairro, :cidade, :uf, :cep, ptreferencia);");
            $cst->bindParam(":endereco", $this->endereco, PDO::PARAM_STR);
            $cst->bindParam(":bairro", $this->bairro, PDO::PARAM_STR);
            $cst->bindParam(":cidade", $this->cidade, PDO::PARAM_STR);
            $cst->bindParam(":uf", $this->uf, PDO::PARAM_STR);
            $cst->bindParam(":cep", $this->cep, PDO::PARAM_STR);
            $cst->bindParam(":ptreferencia", $this->ptreferencia, PDO::PARAM_STR);

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
            $id = $objeto->idendereco;
            $this->endereco = $this->objfunc->tratarCaracter($objeto->endereco, 1);
            $this->bairro = $this->objfunc->tratarCaracter($objeto->bairro, 1);
            $this->cidade = $this->objfunc->tratarCaracter($objeto->cidade, 1);
            $this->uf = $objeto->uf;
            $this->cep = $objeto->cep;
            $this->ptreferencia = $this->objfunc->tratarCaracter($objeto->ptreferencia, 1);
            $cst = $pdo->prepare("UPDATE tb_endereco SET endereco= :endereco , bairrp= :bairro , cidade = :cidade , uf = :uf, cep = :cep, ptreferencia = :ptreferencia WHERE idendereco = :idendereco;");
            $cst->bindParam(":idendereco", $id, PDO::PARAM_INT);
            $cst->bindParam(":endereco", $this->endereco, PDO::PARAM_STR);
            $cst->bindParam(":bairro", $this->bairro, PDO::PARAM_STR);
            $cst->bindParam(":cidade", $this->cidade, PDO::PARAM_STR);
            $cst->bindParam(":uf", $this->uf, PDO::PARAM_STR);
            $cst->bindParam(":cep", $this->cep, PDO::PARAM_STR);
            $cst->bindParam(":ptreferencia", $this->ptreferencia, PDO::PARAM_STR);

            //Ajuste para melhorar o que é mostrado na tela quando há erro ou não
            if (!$cst->execute()) {
                print_r($cst->errorInfo(), true);
                return false;
            };
        } catch (PDOException $ex) {
            return 'erro' . $ex->getMessage();
        }
    }

    public function Exclui($objeto) {
        try {
            $con = new Conexao();
            $pdo = $con->conectar();
            $id = $objeto->idendereco;
            $cst = $pdo->prepare("DELETE FROM tb_endereco WHERE idendereco = :idendereco;");
            $cst->bindParam(":idendereco", $id, PDO::PARAM_INT);
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
