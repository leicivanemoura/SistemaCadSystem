<?php

include_once 'AutoLoad.php';

$objeto = new Pessoa();

class Pessoa {

    //Atributos da Classe Pessoa
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
    
    // Pessoa tem atributos que são objeto de outras tabelas e classes
    protected $endereco;
    protected $telefone;

    // Métodos/Funções GET e SET
    //construtor:
    public function __construct() {
       
       // $this->Inclui();
    }

    //metodos mágicos:
   /* public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function __get($atributo) {
        return $this->$atributo;
    }*/

    //criando metódos com os scripts da classe pessoa utilizando PDO
    public function SelecionaById($id) {
        try {
            $con = new Conexao();
            $pdo = $con->conectar();
            $this->idpessoa = $id;
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $cst = $pdo->prepare("SELECT idpessoa , nome, sobrenome, rg, cpf, email, sexo,datanascimento, datacadastro, tb_endereco_idendereco, tb_telefone_idtelefone FROM tb_pessoa WHERE idpessoa = :idpessoa;");
            $cst->bindParam(":idpessoa", $this->idpessoa, PDO::PARAM_INT);
            $cst->execute();

            //busca o retorno como objeto
            $objeto = $cst->fetchObject('Pessoa');

            //não entendi esse if não seria $pessoa = new pessoa e $pessoa ou é por conta do tb_endereco_id_endereco da linha 46? 
            if (isset($objeto->idpessoa)) {
                $endereco = new Endereco();
                $endereco->idendereco = $objeto->tb_endereco_idendereco;

                //acrescentei tel por minha conta
                $telefone = new Telefone();
                $endereco->idtelefone = $objeto->tb_telefone_idtelefone;

                //Busca o Objeto do Endereço
                $objeto->endereco = $endereco->SelecionaById($endereco->idendereco);
                unset($objeto->tb_endereco_idendereco);

                //Busca o Objeto do Telefone -- acrescentei por minha conta - pq se tem isso para endereco tem que ter tb para telefone
                $objeto->telefone = $telefone->SelecionaById($telefone->idtelefone);
                unset($objeto->tb_telefone_idtelefone);
            }

            //retorna o Funcionario com Endereço e telefone ?
            return $objeto;
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function Seleciona() {
        try {
            $con = new Conexao();
            $cst = $con->conectar()->prepare("SELECT idpessoa , nome, sobrenome, rg, cpf , email, sexo, datanascimento, datacadastro FROM tb_pessoa;");
            $cst->execute();
            return $cst->fetch();
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function Inclui($objeto) {
        try {
            $con = new Conexao();
            $this->nome = $objeto->nome;
            $this->sobrenome = $objeto->sobrenome;
            $this->rg = $objeto->rg;
            $this->cpf = $objeto->cpf;
            $this->email = $objeto->email;
            $this->sexo = $objeto->sexo;
            $this->datanascimento = $objeto->datanascimento;
            $this->datacadastro = $objeto->datacadastro;
            $pdo = $con->conectar();
            $cst = $pdo->prepare("INSERT INTO tb_pessoa (nome , sobrenome ,rg, cpf , email, sexo, datanascimento, datacadastro,tb_endereco_idendereco, tb_telefone_idtelefone) VALUES(:nome , :sobrenome, :rg, :cpf, :email, sexo, datanascimento, datacadastro,:tb_endereco_idendereco, :tb_telefone_id_telefone);");
            $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $cst->bindParam(":sobrenome", $this->sobrenome, PDO::PARAM_STR);
            $cst->bindParam(":rg", $this->rg, PDO::PARAM_STR);
            $cst->bindParam(":cpf", $this->cpf, PDO::PARAM_STR);
            $cst->bindParam(":email", $this->email, PDO::PARAM_STR);
            $cst->bindParam(":sexo", $this->sexo, PDO::PARAM_STR);
            $cst->bindParam(":datanascimento", $this->datanascimento, PDO::PARAM_STR);
            $cst->bindParam(":datacadastro", $this->datacadastro, PDO::PARAM_STR);

            $idendereco = $this->endereco->Inclui($objeto->endereco);
            $idtelefone = $this->telefone->Inclui($objeto->telefone);

            if (!empty($idendereco)) {
                $cst->bindParam(":tb_endereco_idendereco", $idendereco, PDO::PARAM_STR);
                //Ajuste para melhorar o que é mostrado na tela quando há erro ou não
                if (!$cst->execute()) {
                    print_r($cst->errorInfo(), true);
                    return 0;
                };
                return $pdo->lastInsertId();
            }
            return 0;

            if (!empty($idtelefone)) {
                $cst->bindParam(":tb_telefone_idtelefone", $idtelefone, PDO::PARAM_STR);
                //Ajuste para melhorar o que é mostrado na tela quando há erro ou não
                if (!$cst->execute()) {
                    print_r($cst->errorInfo(), true);
                    return 0;
                };
                return $pdo->lastInsertId();
            }
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
            $id = $objeto->idpessoa;
            $this->nome = $objeto->nome;
            $this->sobrenome = $objeto->sobrenome;
            $this->rg = $objeto->rg;
            $this->email = $objeto->email;
            $this->sexo = $objeto->sexo;
            $this->datanascimento = $objeto->datanascimento;
            $cst = $pdo->prepare("UPDATE tb_pessoa SET nome= :nome , sobrenome= :sobrenome , rg = :rg , email = :email, sexo = :sexo, datanascimento = :datanascimento WHERE idpessoa = :idpessoa;");
            $cst->bindParam(":idpessoa", $id, PDO::PARAM_INT);
            $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $cst->bindParam(":sobrenome", $this->sobrenome, PDO::PARAM_STR);
            $cst->bindParam(":rg", $this->rg, PDO::PARAM_STR);
            $cst->bindParam(":email", $this->email, PDO::PARAM_STR);
            $cst->bindParam(":sexo", $this->sexo, PDO::PARAM_STR);
            $cst->bindParam(":datanascimento", $this->datanascimento, PDO::PARAM_STR);

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
            $id = $objeto->idpessoa;
            $cst = $pdo->prepare("DELETE FROM tb_pessoa WHERE idpessoa = :idpessoa;");
            $cst->bindParam(":idpessoa", $id, PDO::PARAM_INT);
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
