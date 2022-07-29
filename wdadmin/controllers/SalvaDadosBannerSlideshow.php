<?php

require_once "../class/Arquivos.class.php";
require_once "../class/BannersSlideshow.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$Arquivos->setArquivo_atual($_POST['inputImagemAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputTitulo']));
$Arquivos->setPasta("banners_slideshow");

$Arquivos->insere_arquivo();

if ($Arquivos->getErro() == 0 || $Arquivos->getErro() == 4) {
    $BannersSlideshow = new BannersSlideshow();
    $BannersSlideshow->setId_banner($_POST['inputIdBannersSlideshow']);
    $BannersSlideshow->setImagem($Arquivos->getRetorno_arquivo());
    $BannersSlideshow->setTitulo($_POST['inputTitulo']);
    $BannersSlideshow->setDescricao($_POST['inputDescricao']);
    $BannersSlideshow->setLink($_POST['inputLink']);
    $BannersSlideshow->setTexto_botao($_POST['inputTextoBotao']);
    $BannersSlideshow->setLink_nova_aba($_POST['inputLinkNovaAba']);
    $BannersSlideshow->setPosicao($_POST['inputPosicao']);

    if ($BannersSlideshow->salva_dados()) {
        print $BannersSlideshow->getRetorno_dados();
    } else {
        print 0;
    }
} else {
    print 0;
}