<?php

//DEFINE TIMEZONE
date_default_timezone_set('America/Sao_Paulo');

//REFENCIA CLASSES
require_once "../class/OrcamentosRecebidos.class.php";
require_once "../class/InformacoesGerais.class.php";
require_once "../class/EnviosEmailOrcamento.class.php";
require_once "../class/Arquivos.class.php";

include 'MontaUrlAmigavel.php';

//INSTANCIA CLASSES PARA OBJETOS
$OrcamentosRecebidos = new OrcamentosRecebidos();
$InformacoesGerais = new InformacoesGerais();
$EnviosEmailOrcamento = new EnviosEmailOrcamento();
$Arquivos = new Arquivos();

//ALIMENTA VARIAVEIS PARA CADASTRO NO BANCO
$OrcamentosRecebidos->setNome($_POST['orcamento-nome']);
$OrcamentosRecebidos->setCidade_uf($_POST['orcamento-cidade']);
$OrcamentosRecebidos->setEmail($_POST['orcamento-email']);
$OrcamentosRecebidos->setGasto_mensal($_POST['orcamento-gasto']);
$OrcamentosRecebidos->setTelefone($_POST['orcamento-telefone']);
$OrcamentosRecebidos->setMensagem($_POST['orcamento-mensagem']);
$OrcamentosRecebidos->setData_recebimento(date("Y/m/d H:i:s", time()));
$OrcamentosRecebidos->setStatus(1);

$Arquivos->setArquivo_atual("");
$Arquivos->setNovo_arquivo($_FILES['orcamento-anexo']);
$Arquivos->setNome_amigavel("anexo-orcamento-" . url_amigavel($_POST['orcamento-nome']));
$Arquivos->setPasta("orcamentos");
$Arquivos->insere_arquivo();
$OrcamentosRecebidos->setAnexo($Arquivos->getRetorno_arquivo());

//VERIFICA SE CADASTROU NO BANCO
if ($OrcamentosRecebidos->insere_dados()) {

//  BUSCA DADOS DE NOME DE EMPRESA E E-MAIL CONTATO
    $InformacoesGerais->edita_dados();
    $DadosInfoGerais = json_decode($InformacoesGerais->getRetorno_dados(), true);

//  ENVIA E-MAIL PARA A EMPRESA
    $EnviosEmailOrcamento->setNome($_POST['orcamento-nome']);
    $EnviosEmailOrcamento->setCidade_uf($_POST['orcamento-cidade']);
    $EnviosEmailOrcamento->setEmail($_POST['orcamento-email']);
    $EnviosEmailOrcamento->setGasto_mensal($_POST['orcamento-gasto']);
    $EnviosEmailOrcamento->setTelefone($_POST['orcamento-telefone']);
    $EnviosEmailOrcamento->setMensagem($_POST['orcamento-mensagem']);
    $EnviosEmailOrcamento->setAnexo(URL_SITE . "/wdadmin/uploads/orcamentos/" . $Arquivos->getRetorno_arquivo());
    $EnviosEmailOrcamento->setNome_empresa($DadosInfoGerais[0]["nome_empresa"]);
    $EnviosEmailOrcamento->setEmail_envio($DadosInfoGerais[0]["email_orcamento"]);

//  SE O E-MAIL FOI ENVIADO RETORNA SUCESSO
    if ($EnviosEmailOrcamento->envia_email_orcamento()) {
        print 1;
    } else {
        print 0;
    }
} else {
    print 0;
}
