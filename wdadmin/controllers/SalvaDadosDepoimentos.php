<?php

require_once "../class/Arquivos.class.php";
require_once "../class/Depoimentos.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$Arquivos->setArquivo_atual($_POST['inputImagemAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputNome']));
$Arquivos->setPasta("depoimentos");

$Arquivos->insere_arquivo();

if ($Arquivos->getErro() == 0 || $Arquivos->getErro() == 4) {
    $Depoimentos = new Depoimentos();
    $Depoimentos->setId_depoimentos($_POST['inputIdDepoimentos']);
    $Depoimentos->setNome($_POST['inputNome']);
    $Depoimentos->setTexto($_POST['inputTexto']);
    $Depoimentos->setImagem($Arquivos->getRetorno_arquivo());
    $Depoimentos->setId_clientes($_POST['inputIdClientes']);

    if ($Depoimentos->salva_dados()) {
        print $Depoimentos->getRetorno_dados();
    } else {
        print 0;
    }
} else {
    print 0;
}