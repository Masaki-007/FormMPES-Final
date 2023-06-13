<?php

if (!empty($_GET['id_tratamento'])) {

include_once('../formulario/config.php');

$id = $_GET['id_tratamento'];

$sqlSelect = "SELECT t.id_tratamento ,bl.base_legal, t.sensivel ,t.compartilhamento , t.objetivo , t.retencao, t.armazenamento FROM tratamento as t INNER JOIN base_legal as bl on bl.id_base = t.id_base WHERE t.id_tratamento=$id";
//Condição onde id_tratamento seja a variavel id  

$result = $conexao->query($sqlSelect);
//print_r($result);

if ($result->num_rows > 0) {
   $sqlDelete = "SELECT t.id_tratamento ,bl.base_legal, t.sensivel ,t.compartilhamento , t.objetivo , t.retencao, t.armazenamento FROM tratamento as t INNER JOIN base_legal as bl on bl.id_base = t.id_base WHERE t.id_tratamento=$id";
   $resultDelete = $conexao->query($sqlSelect);
} else {
    $edicao = dirname($_SERVER['sistema.php']);
    header("Location: $edicao");
    exit;
}
} else {
$edicao = 'sistema.php';
header("Location: $edicao");
exit;
}
?>