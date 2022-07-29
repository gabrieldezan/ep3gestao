<?php

//DEFINE TIMEZONE
date_default_timezone_set('America/Sao_Paulo');

//REFENCIA CLASSES
require_once "../class/ContatosRecebidos.class.php";
require_once "../class/InformacoesGerais.class.php";
require_once "../class/EnviosEmail.class.php";

//INSTANCIA CLASSES PARA OBJETOS
$ContatosRecebidos = new ContatosRecebidos();
$InformacoesGerais = new InformacoesGerais();
$EnviosEmail = new EnviosEmail();

//ALIMENTA VARIAVEIS PARA CADASTRO NO BANCO
$ContatosRecebidos->setNome($_POST['vsNome']);
$ContatosRecebidos->setEmail($_POST['vsEmail']);
$ContatosRecebidos->setTelefone($_POST['vsTelefone']);
$ContatosRecebidos->setAssunto($_POST['vsAssunto']);
$ContatosRecebidos->setMensagem($_POST['vsMensagem']);
$ContatosRecebidos->setData_recebimento(date("Y/m/d H:i:s", time()));
$ContatosRecebidos->setStatus(1);

//VERIFICA SE CADASTROU NO BANCO
if ($ContatosRecebidos->insere_dados()) {

//  BUSCA DADOS DE NOME DE EMPRESA E E-MAIL CONTATO
    $InformacoesGerais->edita_dados();
    $DadosInfoGerais = json_decode($InformacoesGerais->getRetorno_dados(), true);

//  ENVIA E-MAIL PARA A EMPRESA
    $EnviosEmail->setNome($_POST['vsNome']);
    $EnviosEmail->setEmail($_POST['vsEmail']);
    $EnviosEmail->setTelefone($_POST['vsTelefone']);
    $EnviosEmail->setAssunto($_POST['vsAssunto']);
    $EnviosEmail->setMensagem($_POST['vsMensagem']);
    $EnviosEmail->setNome_empresa($DadosInfoGerais[0]["nome_empresa"]);
    $EnviosEmail->setEmail_envio($DadosInfoGerais[0]["email_contato"]);

//  SE O E-MAIL FOI ENVIADO RETORNA SUCESSO
    if ($EnviosEmail->envia_email_contato()) {
        print 1;
    } else {
        print 0;
    }
} else {
    print 0;
}
