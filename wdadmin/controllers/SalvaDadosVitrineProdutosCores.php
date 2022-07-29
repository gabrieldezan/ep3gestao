<?php

require_once "../class/Arquivos.class.php";
require_once "../class/VitrineProdutosCores.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$VitrineProdutosCores = new VitrineProdutosCores();

$VitrineProdutosCores->setId_vitrine_produto_cores($_POST['inputIdVitrineProdutosCores']);
$VitrineProdutosCores->setId_vitrine_produto($_POST['inputIdVitrineProduto']);
$VitrineProdutosCores->setDescricao($_POST['inputDescricaoCor']);
$VitrineProdutosCores->setCor_hexadecimal($_POST['inputExemplo']);
$VitrineProdutosCores->setReferencia($_POST['inputReferencia']);

$Arquivos->setArquivo_atual($_POST['inputImagem1Atual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem1']);
$Arquivos->setNome_amigavel("imagem1-" . url_amigavel($_POST['inputDescricaoCor']));
$Arquivos->setPasta("vitrine_produtos");
$Arquivos->insere_arquivo();
$VitrineProdutosCores->setImagem1($Arquivos->getRetorno_arquivo());

$Arquivos->setArquivo_atual($_POST['inputImagem2Atual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem2']);
$Arquivos->setNome_amigavel("imagem2-" . url_amigavel($_POST['inputDescricaoCor']));
$Arquivos->setPasta("vitrine_produtos");
$Arquivos->insere_arquivo();
$VitrineProdutosCores->setImagem2($Arquivos->getRetorno_arquivo());

$Arquivos->setArquivo_atual($_POST['inputImagem3Atual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem3']);
$Arquivos->setNome_amigavel("imagem3-" . url_amigavel($_POST['inputDescricaoCor']));
$Arquivos->setPasta("vitrine_produtos");
$Arquivos->insere_arquivo();
$VitrineProdutosCores->setImagem3($Arquivos->getRetorno_arquivo());

$Arquivos->setArquivo_atual($_POST['inputImagem4Atual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem4']);
$Arquivos->setNome_amigavel("imagem4-" . url_amigavel($_POST['inputDescricaoCor']));
$Arquivos->setPasta("vitrine_produtos");
$Arquivos->insere_arquivo();
$VitrineProdutosCores->setImagem4($Arquivos->getRetorno_arquivo());

$Arquivos->setArquivo_atual($_POST['inputImagem5Atual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem5']);
$Arquivos->setNome_amigavel("imagem5-" . url_amigavel($_POST['inputDescricaoCor']));
$Arquivos->setPasta("vitrine_produtos");
$Arquivos->insere_arquivo();
$VitrineProdutosCores->setImagem5($Arquivos->getRetorno_arquivo());

if ($VitrineProdutosCores->salva_dados()) {
    print $VitrineProdutosCores->getRetorno_dados();
} else {
    print 0;
}