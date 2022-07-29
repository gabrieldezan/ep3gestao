<?php

require_once "../class/UsuarioCliente.class.php";

$UsuarioCliente = new UsuarioCliente();
$UsuarioCliente->setId_usuario_cliente($_POST['inputIdUsuarioCliente']);
$UsuarioCliente->setNome($_POST['inputNome']);
$UsuarioCliente->setEmail($_POST['inputEmail']);
$UsuarioCliente->setSenha(md5($_POST['inputSenha']));
$UsuarioCliente->setReceber_novidades_email($_POST['inputReceberNovidadesEmail']);
$UsuarioCliente->setStatus($_POST['inputStatus']);

/* VERIFICA SE É INSERT OU UPDATE */
if ($_POST['inputIdUsuarioCliente'] === "") {
    /* VERIFICA SE JÁ EXISTE UM CADASTRO COM BASE NO EMAIL */
    if ($UsuarioCliente->verifica_cadastro_existente() == false) {
        /* INSERE DADOS */
        if ($UsuarioCliente->insere_dados()) {
            print $UsuarioCliente->getRetorno_dados();
        } else {
            print 0;
        }
    } else {
        print "CE";
    }
} else {
    /* ATUALIZA DADOS */
    if ($UsuarioCliente->atualiza_dados()) {
        /* ATUALIZA SENHA CASO O USUÁRIO INFORME UMA NOVA SENHA */
        if (!empty($_POST['inputSenha']) || $_POST['inputSenha'] !== "") {
            $UsuarioCliente->setId_usuario_cliente($UsuarioCliente->getRetorno_dados());
            $UsuarioCliente->atualiza_senha();
        }
        print $UsuarioCliente->getRetorno_dados();
    } else {
        print 0;
    }
}