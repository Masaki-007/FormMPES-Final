<?php

include_once('../formulario/config.php');

if(isset($_POST['update'])) {
//verificação se existe o update=(botão enviar, o nome foi alterado) no edit.php 
    // se existir algo preenchido ele vai atualizar esse registro 

    $idToUpdate  = $_POST['id_tratamento'];
    $processo = $_POST['processo'];
    $baseLegal = $_POST['baseLegal'];
    $sensiveis = $_POST['sensiveis'];
    $compartilhamento = $_POST['compartilhamento'];
    $objetivo = $_POST['objetivo'];
    $retencao = $_POST['retencao'];
    $dados = $_POST['dados'];

    $sqlUpdate = "UPDATE tratamento SET id_tratamento='$idToUpdate', processo='$processo', baseLegal='$baseLegal', sensiveis='$sensiveis', compartilhamento='$compartilhamento', objetivo='$objetivo', retencao='$retencao', dados='$dados' WHERE id_tratamento='$id'";

    $result = $conexao->query($sqlUpdate);

    if ($result) {
        header("Location: edica/sistema.php");
        exit;
    } else {
        echo "Ocorreu um erro ao atualizar o registro.";
    }
} else {
    $edicao = dirname($_SERVER['sistema.php']);
    header("Location: $edicao");
    exit;
}
    //Caso contrario ele volta para o sistema.php
?>
?>