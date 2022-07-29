<?php

require_once "../class/Arquivos.class.php";
require_once "../class/BlogImagens.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$Arquivos->setArquivo_atual("");
$Arquivos->setNovo_arquivo($_FILES['inputImagem']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputTitulo']));
$Arquivos->setPasta("blog_imagens");

$Arquivos->insere_arquivo();

if ($Arquivos->getErro() == 0 || $Arquivos->getErro() == 4) {
    $BlogImagens = new BlogImagens();
    $BlogImagens->setTitulo($_POST['inputTitulo']);
    $BlogImagens->setImagem($Arquivos->getRetorno_arquivo());

    if ($BlogImagens->salva_dados()) {
        print $BlogImagens->getRetorno_dados();
    } else {
        print 0;
    }
} else {
    print 0;
}