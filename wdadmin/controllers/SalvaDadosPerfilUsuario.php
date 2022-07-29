<?php

require_once "../class/Arquivos.class.php";
require_once "../class/Usuarios.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$Arquivos->setArquivo_atual($_POST['inputImagemPerfilAtualPerfilUsuario']);
$Arquivos->setNovo_arquivo($_FILES['inputImagemPerfilPerfilUsuario']);
$Arquivos->setNome_amigavel("perfil-" . url_amigavel($_POST['inputNomePerfilUsuario']));
$Arquivos->setPasta("usuarios");

$Arquivos->insere_arquivo();

if ($Arquivos->getErro() == 0 || $Arquivos->getErro() == 4) {

    $Usuarios = new Usuarios();
    $Usuarios->setId_usuarios($_POST['inputIdUsuarioPerfilUsuario']);
    $Usuarios->setNome($_POST['inputNomePerfilUsuario']);
    $Usuarios->setImagem_perfil($Arquivos->getRetorno_arquivo());

    if ($Usuarios->salva_dados_perfil()) {
        print $Usuarios->getRetorno_dados();
    } else {
        print 0;
    }
}