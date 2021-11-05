<?php
    class materiais{
        private $pdo;
        public function __construct($dbname, $host, $user, $passwd) {
        try {
                $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$passwd);    
        } catch (PDOExeption $e) {
            echo "Erro com banco de dados: ".$e->getMessage();
            exit();
        } catch (Exeption $e) {
            echo "Erro generico: ".$e->getMessage();
            exit();
        }
    }
        
        public function catchDatas() {

            $res = array();
            $cmd = $this->pdo->query("SELECT * FROM materiais ORDER BY nome");
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function insertMaterial($nome, $descricao, $marca, $quantidade, $datacriacao) {
            $cmd = $this->pdo->prepare("SELECT id FROM materiais WHERE nome = :n");
            $cmd->bindValue(":n", $nome);
            $cmd->execute();

            if($cmd->rowCount() > 0) {
                return false;
            }else {
                $cmd = $this->pdo->prepare("INSERT INTO materiais (nome, descricao, marca, quantidade, datacriacao) VALUES (:n, :d, :m, :q, :dc)");
                $cmd->bindValue(":n", $nome);
                $cmd->bindValue(":d", $descricao);
                $cmd->bindValue(":m", $marca);
                $cmd->bindValue(":q", $quantidade);
                $cmd->bindValue(":dc", $datacriacao);
                $cmd->execute();
                return true;
            }
        }

    }
?>