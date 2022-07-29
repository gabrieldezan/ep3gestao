<?php

require_once "../class/Arquivos.class.php";
require_once "../class/GaleriaImagens.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$GaleriaImagens = new GaleriaImagens();

$GaleriaImagens->setId_galeria_imagem($_POST['inputIdGaleriaImagens']);
$GaleriaImagens->setTitulo($_POST['inputTitulo']);

$Arquivos->setArquivo_atual($_POST['inputImagem1Atual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem1']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputTitulo']) . "-1");
$Arquivos->setPasta("galeria_imagens");
$Arquivos->insere_arquivo();
$GaleriaImagens->setImagem1($Arquivos->getRetorno_arquivo());

$Arquivos->setArquivo_atual($_POST['inputImagem2Atual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem2']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputTitulo']) . "-2");
$Arquivos->setPasta("galeria_imagens");
$Arquivos->insere_arquivo();
$GaleriaImagens->setImagem2($Arquivos->getRetorno_arquivo());

$Arquivos->setArquivo_atual($_POST['inputImagem3Atual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem3']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputTitulo']) . "-3");
$Arquivos->setPasta("galeria_imagens");
$Arquivos->insere_arquivo();
$GaleriaImagens->setImagem3($Arquivos->getRetorno_arquivo());

$Arquivos->setArquivo_atual($_POST['inputImagem4Atual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem4']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputTitulo']) . "-4");
$Arquivos->setPasta("galeria_imagens");
$Arquivos->insere_arquivo();
$GaleriaImagens->setImagem4($Arquivos->getRetorno_arquivo());

$Arquivos->setArquivo_atual($_POST['inputImagem5Atual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem5']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputTitulo']) . "-5");
$Arquivos->setPasta("galeria_imagens");
$Arquivos->insere_arquivo();
$GaleriaImagens->setImagem5($Arquivos->getRetorno_arquivo());

$GaleriaImagens->setDescricao($_POST['inputDescricao']);
$GaleriaImagens->setDetalhes($_POST['inputDetalhes']);
$GaleriaImagens->setLink1($_POST['inputLink1']);
$GaleriaImagens->setLink2($_POST['inputLink2']);
$GaleriaImagens->setYoutube($_POST['inputYoutube']);
$GaleriaImagens->setUrl_amigavel(url_amigavel($_POST['inputTitulo']));
$GaleriaImagens->setId_galeria_grupo($_POST['inputIdGaleriaGrupo']);

if ($GaleriaImagens->salva_dados()) {
    print $GaleriaImagens->getRetorno_dados();
} else {
    print 0;
}