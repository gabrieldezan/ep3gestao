<?php

require_once "../class/Arquivos.class.php";
require_once "../class/Equipe.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$Equipe = new Equipe();

$Equipe->setId_equipe($_POST['inputIdEquipeCadastro']);
$Equipe->setNome($_POST['inputNome']);
$Equipe->setExperiencia($_POST['inputExperiencia']);
$Equipe->setFormacao($_POST['inputFormacao']);
$Equipe->setHistoria($_POST['inputHistoria']);

$Arquivos->setArquivo_atual($_POST['inputImagemAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputNome']));
$Arquivos->setPasta("equipe");
$Arquivos->insere_arquivo();
$Equipe->setImagem($Arquivos->getRetorno_arquivo());

$Equipe->setOrdem($_POST['inputOrdem']);
$Equipe->setUrl_amigavel(url_amigavel($_POST['inputNome']));
$Equipe->setStatus($_POST['inputStatus']);

if ($Equipe->salva_dados()) {
    print $Equipe->getRetorno_dados();
} else {
    print 0;
}