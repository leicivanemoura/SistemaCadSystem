<?php

include_once 'AutoLoad.php';

class Usuario {

    //Atributos da Classe Usuario
    //Private só pode ser acessado na mesma classe;
    //protected só pode ser acessado na mesma classe ou em suas classes filhas;
    protected $idusuario;
    protected $perfilusuario;
    protected $senha;
    //O usuario tem atributos que são objeto de outras tabelas e classes
    protected $funcionario;

    // Métodos/Funções GET e SET
    //construtor:
    public function __construct() {
        //$this->Funcionário = new Funcionário();---não precisa desse?
        //$usuario = new Usuario(); ---não precisa desse?
        $this->objfunc = new Funcoes();
    }

//metodos mágicos:
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function __get($atributo) {
        return $this->$atributo;
    }

    //criando metódos com os scripts da classe usuario utilizando PDO
    public function SelecionaById($id) {
        try {
            $con = new Conexao();
            $pdo = $con->conectar();
            $this->idusuario = $id;
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cst = $pdo->prepare("SELECT idusuario , perfilusuario , senha FROM tb_usuario WHERE idusuario = :idusuario;");
            $cst->bindParam(":idusuario", $this->idusuario, PDO::PARAM_INT);
            $cst->execute();

            //busca o retorno como objeto
            $objeto = $cst->fetchObject('Usuario');

            return $objeto;
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function Seleciona() {
        try {
            $con = new Conexao();
            $cst = $con->conectar()->prepare("SELECT idusuario , perfilusuario , senha FROM tb_usuario;");
            $cst->execute();
            return $cst->fetch();
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function Inclui($objeto) {
        try {
            $con = new Conexao();
            //so tem na class endereco:
            $pdo = $con->conectar();
            $this->perfilusuario = $this->objfunc->tratarCaracter($objeto->perfilusuario, 1);
            $this->senha = $objeto->senha;
            $pdo = $con->conectar();
            $cst = $pdo->prepare("INSERT INTO tb_usuario (perfilusuario , senha) VALUES(:perfilusuario , :senha);");
            $cst->bindParam(":perfilusuario", $this->perfilusuario, PDO::PARAM_STR);
            $cst->bindParam(":senha", $this->senha, PDO::PARAM_STR);

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
            //tem na classe funcionario
            $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $id = $objeto->idusuario;
            $this->perfilusuario = $this->objfunc->tratarCaracter($objeto->perfilusuario, 1);
            $this->senha = $objeto->senha;
            $cst = $pdo->prepare("UPDATE tb_usuario SET perfilusuario= :perfilusuario , senha= :senha WHERE idusuario = :idusuario;");
            $cst->bindParam(":idusuario", $id, PDO::PARAM_INT);
            $cst->bindParam(":perfilusuario", $this->perfilusuario, PDO::PARAM_STR);
            $cst->bindParam(":senha", $this->senha, PDO::PARAM_STR);

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
            $id = $objeto->idusuario;
            $cst = $pdo->prepare("DELETE FROM tb_usuario WHERE idusuario = :idusuario;");
            $cst->bindParam(":idusuario", $id, PDO::PARAM_INT);

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
