<?php

require_once "../class/Arquivos.class.php";
require_once "../class/VitrineSubgrupos.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$VitrineSubgrupos = new VitrineSubgrupos();

$VitrineSubgrupos->setId_vitrine_subgrupo($_POST['inputIdVitrineSubgrupo']);
$VitrineSubgrupos->setDescricao($_POST['inputDescricao']);
$VitrineSubgrupos->setNome_pagina($_POST['inputNomePagina']);


$Arquivos->setArquivo_atual($_POST['inputImagemCapaAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagemCapa']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputDescricao']));
$Arquivos->setPasta("vitrine_subgrupo");
$Arquivos->insere_arquivo();
$VitrineSubgrupos->setImagem_capa($Arquivos->getRetorno_arquivo());

$VitrineSubgrupos->setStatus($_POST['inputStatus']);
$VitrineSubgrupos->setUrl_amigavel(url_amigavel($_POST['inputDescricao']));
$VitrineSubgrupos->setId_vitrine_grupo($_POST['inputIdGrupoVitrine']);

if ($VitrineSubgrupos->salva_dados()) {
    print $VitrineSubgrupos->getRetorno_dados();
} else {
    print 0;
}