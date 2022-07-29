<?php

require_once "../class/Arquivos.class.php";
require_once "../class/Sobre.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$Sobre = new Sobre();

$Sobre->setResumo_texto($_POST['inputResumoTexto']);
$Sobre->setTexto($_POST['inputTexto']);

$Arquivos->setArquivo_atual($_POST['inputImagemAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem']);
$Arquivos->setNome_amigavel(url_amigavel('sobre a empresa'));
$Arquivos->setPasta("sobre");
$Arquivos->insere_arquivo();
$Sobre->setImagem($Arquivos->getRetorno_arquivo());

$Sobre->setLink($_POST['inputLink']);

if ($Sobre->salva_dados()) {
    print $Sobre->getRetorno_dados();
} else {
    print 0;
}