<?php

include('BD_model.php');

$dados = new BD_model;

if(!isset($_GET['modulo'])) { 
    $modulo = "";
} else {
    $modulo = $_GET['modulo'];
}

$perguntas = $dados->lista_perguntas();

include('frame_top.php');

if ($modulo==='resultado') { 
    include("resultado.php");
} else if(!$_POST) {
    include("pesquisa.php");
} else  {
    $respostas = $_POST;
    $dados->salvar_testes($respostas);

    echo "Pesquisa salva com sucesso";
}

include('frame_bottom.php');

?>

