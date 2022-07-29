<?php

require_once "../class/Arquivos.class.php";
require_once "../class/RedesSociais.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$Arquivos->setArquivo_atual($_POST['inputImagemAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputTitulo']));
$Arquivos->setPasta("redes-sociais");

$Arquivos->insere_arquivo();

if ($Arquivos->getErro() == 0 || $Arquivos->getErro() == 4) {
    $RedesSociais = new RedesSociais();
    $RedesSociais->setId_redes_sociais($_POST['inputIdRedesSociais']);
    $RedesSociais->setTitulo($_POST['inputTitulo']);
    $RedesSociais->setLink($_POST['inputLink']);
    $RedesSociais->setImagem($Arquivos->getRetorno_arquivo());
    $RedesSociais->setIcone($_POST['inputIcone']);

    if ($RedesSociais->salva_dados()) {
        print $RedesSociais->getRetorno_dados();
    } else {
        print 0;
    }
} else {
    print 0;
}