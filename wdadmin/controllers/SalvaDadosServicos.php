<?php

require_once "../class/Arquivos.class.php";
require_once "../class/Servicos.class.php";
require_once "MontaUrlAmigavel.php";

$Arquivos = new Arquivos();
$Servicos = new Servicos();

$Servicos->setId_servicos($_POST['inputIdServicos']);
$Servicos->setTitulo($_POST['inputTitulo']);
$Servicos->setDescricao($_POST['inputDescricao']);
$Servicos->setIcone($_POST['inputIcone']);

$Arquivos->setArquivo_atual($_POST['inputImagemAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem']);
$Arquivos->setNome_amigavel("imagem-" . url_amigavel($_POST['inputTitulo']));
$Arquivos->setPasta("servicos");
$Arquivos->insere_arquivo();
$Servicos->setImagem($Arquivos->getRetorno_arquivo());

$Arquivos->setArquivo_atual($_POST['inputCapaAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputCapa']);
$Arquivos->setNome_amigavel("capa-" . url_amigavel($_POST['inputTitulo']));
$Arquivos->setPasta("servicos");
$Arquivos->insere_arquivo();
$Servicos->setCapa($Arquivos->getRetorno_arquivo());

$Servicos->setUrl_amigavel(url_amigavel($_POST['inputTitulo']));
$Servicos->setStatus($_POST['inputStatus']);

if ($Servicos->salva_dados()) {
    print $Servicos->getRetorno_dados();
} else {
    print 0;
}