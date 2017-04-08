<?php

/**
 * CLASSE DE CONEXÃO AO BANCO DE DADOS: 
 * Utilizaremos PDO na conexãO
 */
class Conexao {

    private $usuario;
    private $senha;
    private $banco;
    private $servidor;
    private static $pdo;

    public function __construct() {
        $this->servidor = "localhost";
        $this->banco = "dfsystem";
        $this->usuario = "root";
        $this->senha = "mysql";
    }

    public function conectar() {
        try {
            if (is_null(self::$pdo)) {
                self::$pdo = new PDO("mysql:host=" . $this->servidor . ";dbname=" . $this->banco, $this->usuario, $this->senha);
            }
            return self::$pdo;
        } catch (PDOException $ex) {
            echo ($ex);
        }
    }

   public function get_pdo(){
        return self::$pdo;
    }
}

