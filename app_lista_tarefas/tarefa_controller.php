<?php

    require "../app_lista_tarefas/tarefa.model.php";
    require "../app_lista_tarefas/tarefa.service.php";
    require "../app_lista_tarefas/connection.php";


$acao = isset($_GET["acao"]) ? $_GET["acao"] : $acao;

$id = isset($_GET["id"]) ? $_GET["id"] : $id;

if($_GET["acao"] == "inserir"){

    $tarefa = new Tarefa();
    $tarefa->__set("tarefa", $_POST["tarefa"]);

    $conn = new Conexao();

    $tarefaService = new TarefaService($conn, $tarefa);  
    
    $tarefaService->inserir();

    header("Location: nova_tarefa.php?inclusao=1");

}else if($acao== "recuperar"){

    $tarefa = new Tarefa();
    $conn = new Conexao();

    $tarefaService = new TarefaService($conn, $tarefa);

    $tarefas = $tarefaService -> recuperar();
    
    
}else if($acao == "atualizar"){

    $tarefa = new Tarefa();
    $tarefa->__set("id", $_POST["id"]);
    $tarefa->__set("tarefa", $_POST["editTarefa"]);
    $conn = new Conexao();
    $tarefaService = new TarefaService($conn, $tarefa);
    $tarefaService -> atualizar();
    header("Location: todas_tarefas.php?inclusao=2");


}else if($acao == "remover"){

    $tarefa = new Tarefa();
    $tarefa->__set("id", $id);
    $conn = new Conexao();
    $tarefaService = new TarefaService($conn, $tarefa);
    $tarefaService -> remover();
    header("Location: todas_tarefas.php?inclusao=3");


}else if($acao == "tarefaFinalizada"){
    $tarefa = new Tarefa();
    $tarefa->__set("id", $id);
    $tarefa->__set("id_status", 2);
    $conn = new Conexao();
    $tarefaService = new TarefaService($conn, $tarefa);
    $tarefaService -> tarefaFinalizada();
    header("Location: todas_tarefas.php");
}


    
?>