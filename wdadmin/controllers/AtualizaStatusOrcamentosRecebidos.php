<?php

//REFENCIA CLASSES
require_once "../class/OrcamentosRecebidos.class.php";

//INSTANCIA CLASSES PARA OBJETOS
$OrcamentosRecebidos = new OrcamentosRecebidos();

//ALIMENTA VARIAVEIS PARA CADASTRO NO BANCO
$OrcamentosRecebidos->setId_orcamentos_recebidos($_POST['viIdOrcamentosRecebidos']);
$OrcamentosRecebidos->setStatus(2);

//VERIFICA SE CADASTROU NO BANCO
if ($OrcamentosRecebidos->atualiza_status_orcamentos()) {
    print 1;
} else {
    print 0;
}
