<?php

require_once "../class/Arquivos.class.php";
require_once "../class/Clientes.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$Arquivos->setArquivo_atual($_POST['inputImagemAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputDescricao']));
$Arquivos->setPasta("clientes");

$Arquivos->insere_arquivo();

if ($Arquivos->getErro() == 0 || $Arquivos->getErro() == 4) {
    $Clientes = new Clientes();
    $Clientes->setId_clientes($_POST['inputIdClientes']);
    $Clientes->setImagem($Arquivos->getRetorno_arquivo());
    $Clientes->setDescricao($_POST['inputDescricao']);
    $Clientes->setEndereco($_POST['inputEndereco']);
    $Clientes->setCidade($_POST['inputCidade']);
    $Clientes->setEstado($_POST['inputEstado']);
    $Clientes->setTelefone($_POST['inputTelefone']);
    $Clientes->setLink($_POST['inputLink']);
    $Clientes->setStatus($_POST['inputStatus']);

    if ($Clientes->salva_dados()) {
        print $Clientes->getRetorno_dados();
    } else {
        print 0;
    }
} else {
    print 0;
}