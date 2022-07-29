<?php

require_once "../class/Arquivos.class.php";
require_once "../class/Cases.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$Cases = new Cases();

$Cases->setId_cases($_POST['inputIdCases']);
$Cases->setServico($_POST['inputServico']);

$Arquivos->setArquivo_atual($_POST['inputArquivoAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputArquivo']);
$Arquivos->setNome_amigavel("arquivo-" . url_amigavel($_POST['inputServico']));
$Arquivos->setPasta("cases");
$Arquivos->insere_arquivo();
$Cases->setArquivo($Arquivos->getRetorno_arquivo());

$Arquivos->setArquivo_atual($_POST['inputImagemAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputServico']));
$Arquivos->setPasta("cases");
$Arquivos->insere_arquivo();
$Cases->setImagem($Arquivos->getRetorno_arquivo());

$Cases->setId_clientes($_POST['inputIdClientes']);

if ($Cases->salva_dados()) {
    print $Cases->getRetorno_dados();
} else {
    print 0;
}