<?php

require_once "../class/Enderecos.class.php";

$Enderecos = new Enderecos();
$Enderecos->setId_enderecos($_POST['inputIdEnderecos']);
$Enderecos->setTitulo($_POST['inputTitulo']);
$Enderecos->setEndereco($_POST['inputEndereco']);
$Enderecos->setCidade($_POST['inputCidade']);
$Enderecos->setEstado($_POST['inputEstado']);
$Enderecos->setMapa($_POST['inputMapa']);
$Enderecos->setLink($_POST['inputLink']);

if ($Enderecos->salva_dados()):
    print $Enderecos->getRetorno_dados();
else:
    print 0;
endif;