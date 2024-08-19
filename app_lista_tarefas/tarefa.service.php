<?php

    class TarefaService{

        private $conn;
        private $tarefa;

        public function __construct(Conexao $conn, Tarefa $tarefa)
        {
            $this->conn = $conn->conectar();
            $this->tarefa = $tarefa;
        }

        public function inserir(){

            $query = "INSERT INTO tb_tarefas(tarefa) VALUES (:tarefa)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":tarefa", $this->tarefa->__get("tarefa"));
            $stmt->execute();

        }

        public function recuperar(){

            $query= "SELECT t.id, t.tarefa, s.status FROM tb_tarefas as t 
            left join tb_status as s on (t.id_status = s.id)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }

        public function atualizar(){

            $query = "UPDATE tb_tarefas SET tarefa = :tarefa WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":tarefa", $this->tarefa->__get("tarefa"));
            $stmt->bindParam(":id", $this->tarefa->__get("id"));
            $stmt->execute();


        }

        public function remover(){
            
            $query= "DELETE FROM tb_tarefas WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $this->tarefa->__get("id"));
            $stmt->execute();

        }

        public function tarefaFinalizada(){

            $query= "UPDATE tb_tarefas SET id_status = :id_status WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":id_status", $this->tarefa->__get("id_status"));
            $stmt->bindParam(":id", $this->tarefa->__get("id"));
            $stmt->execute();
        }

    }

?>