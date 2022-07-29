<?php

//REFENCIA CLASSES
require_once "../class/ContatosRecebidos.class.php";

//INSTANCIA CLASSES PARA OBJETOS
$ContatosRecebidos = new ContatosRecebidos();

//ALIMENTA VARIAVEIS PARA CADASTRO NO BANCO
$ContatosRecebidos->setId_contatos_recebidos($_POST['viIdContatosRecebidos']);
$ContatosRecebidos->setStatus(2);

//VERIFICA SE CADASTROU NO BANCO
if ($ContatosRecebidos->atualiza_status()) {
    print 1;
} else {
    print 0;
}
