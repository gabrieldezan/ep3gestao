<?php

require_once "../class/Arquivos.class.php";
require_once "../class/Eventos.class.php";

include "FormataMoedas.php";
include "MontaUrlAmigavel.php";

$Arquivos = new Arquivos();
$Eventos = new Eventos();

$Eventos->setId_eventos($_POST['inputIdEventosCadastro']);
$Eventos->setDescricao($_POST['inputDescricao']);
$Eventos->setDetalhes($_POST['inputDetalhes']);
$Eventos->setMaisInformacoes($_POST['inputMaisInformacoes']);
$Eventos->setMapa($_POST['inputMapa']);
$Eventos->setValor(formato_ingles($_POST['inputValor']));
$Eventos->setValor_adicional(formato_ingles($_POST['inputValorAdicional']));
$Eventos->setDataEvento($_POST['inputDataEvento']);

$Arquivos->setArquivo_atual($_POST['inputImagemAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputDescricao']));
$Arquivos->setPasta("eventos");
$Arquivos->insere_arquivo();
$Eventos->setImagem($Arquivos->getRetorno_arquivo());

$Eventos->setStatus($_POST['inputStatus']);
$Eventos->setUrlAmigavel(url_amigavel($_POST['inputDescricao']));

if ($Eventos->salva_dados()) {
    print $Eventos->getRetorno_dados();
} else {
    print 0;
}
