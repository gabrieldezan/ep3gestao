<?php

require_once "../class/Arquivos.class.php";
require_once "../class/Usuarios.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$Arquivos->setArquivo_atual($_POST['inputImagemPerfilAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagemPerfil']);
$Arquivos->setNome_amigavel("perfil-" . url_amigavel($_POST['inputNome']));
$Arquivos->setPasta("usuarios");

$Arquivos->insere_arquivo();

if ($Arquivos->getErro() == 0 || $Arquivos->getErro() == 4) {
    $Usuarios = new Usuarios();
    $Usuarios->setId_usuarios($_POST['inputIdUsuario']);
    $Usuarios->setNome($_POST['inputNome']);
    $Usuarios->setLogin($_POST['inputLogin']);
    $Usuarios->setImagem_perfil($Arquivos->getRetorno_arquivo());
    $Usuarios->setStatus($_POST['inputStatus']);

    if ($Usuarios->salva_dados()) {
        if ($_POST['inputNovaSenha'] !== "") {
            $Usuarios->setSenha(md5($_POST['inputNovaSenha']));
            $Usuarios->atualiza_senha();
        }
        print $Usuarios->getRetorno_dados();
    } else {
        print 0;
    }
}