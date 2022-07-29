<?php

require_once "../class/Arquivos.class.php";
require_once "../class/TitulosPersonalizados.class.php";
require_once "MontaUrlAmigavel.php";

$Arquivos = new Arquivos();
$TitulosPersonalizados = new TitulosPersonalizados();

$TitulosPersonalizados->setId_titulos_personalizados($_POST['inputIdTitulosPersonalizados']);
$TitulosPersonalizados->setTitulo($_POST['inputTitulo']);
$TitulosPersonalizados->setSubtitulo($_POST['inputSubtitulo']);

$Arquivos->setArquivo_atual($_POST['inputImagemAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputTitulo']));
$Arquivos->setPasta("titulos_personalizados");
$Arquivos->insere_arquivo();
$TitulosPersonalizados->setImagem($Arquivos->getRetorno_arquivo());

$TitulosPersonalizados->setIcone($_POST['inputIcone']);
$TitulosPersonalizados->setStatus($_POST['inputStatus']);

if ($TitulosPersonalizados->salva_dados()) {
    print $TitulosPersonalizados->getRetorno_dados();
} else {
    print 0;
}