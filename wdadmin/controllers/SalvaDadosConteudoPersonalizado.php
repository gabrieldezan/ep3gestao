<?php

require_once "../class/ConteudoPersonalizado.class.php";

$ConteudoPersonalizado = new ConteudoPersonalizado();
$ConteudoPersonalizado->setId_conteudo_personalizado($_POST['inputIdConteudoPersonalizado']);
$ConteudoPersonalizado->setTitulo($_POST['inputTitulo']);
$ConteudoPersonalizado->setIcone($_POST['inputIcone']);
$ConteudoPersonalizado->setImagem($_POST['inputImagem']);
$ConteudoPersonalizado->setImagem_largura($_POST['inputImagemLargura']);
$ConteudoPersonalizado->setImagem_altura($_POST['inputImagemAltura']);
$ConteudoPersonalizado->setTexto($_POST['inputTexto']);
$ConteudoPersonalizado->setLink($_POST['inputLink']);
$ConteudoPersonalizado->setData($_POST['inputData']);
$ConteudoPersonalizado->setHora($_POST['inputHora']);
$ConteudoPersonalizado->setNumero($_POST['inputNumero']);

if ($ConteudoPersonalizado->salva_dados()):
    print $ConteudoPersonalizado->getRetorno_dados();
else:
    print 0;
endif;