<?php

require_once "../class/Arquivos.class.php";
require_once "../class/MissaoVisaoValores.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$MissaoVisaoValores = new MissaoVisaoValores();

$MissaoVisaoValores->setIcone_missao($_POST['inputIconeMissao']);
$MissaoVisaoValores->setTexto_missao($_POST['inputTextoMissao']);
$MissaoVisaoValores->setIcone_visao($_POST['inputIconeVisao']);
$MissaoVisaoValores->setTexto_visao($_POST['inputTextoVisao']);
$MissaoVisaoValores->setIcone_valores($_POST['inputIconeValores']);
$MissaoVisaoValores->setTexto_valores($_POST['inputTextoValores']);

$Arquivos->setArquivo_atual($_POST['inputImagemMissaoAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagemMissao']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputTextoMissao']));
$Arquivos->setPasta("missao_visao_valores");
$Arquivos->insere_arquivo();
$MissaoVisaoValores->setImagem_missao($Arquivos->getRetorno_arquivo());

$Arquivos->setArquivo_atual($_POST['inputImagemVisaoAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagemVisao']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputTextoVisao']));
$Arquivos->setPasta("missao_visao_valores");
$Arquivos->insere_arquivo();
$MissaoVisaoValores->setImagem_visao($Arquivos->getRetorno_arquivo());

$Arquivos->setArquivo_atual($_POST['inputImagemValoresAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagemValores']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputTextoValores']));
$Arquivos->setPasta("missao_visao_valores");
$Arquivos->insere_arquivo();
$MissaoVisaoValores->setImagem_valores($Arquivos->getRetorno_arquivo());

if ($MissaoVisaoValores->salva_dados()) {
    print $MissaoVisaoValores->getRetorno_dados();
} else {
    print 0;
}