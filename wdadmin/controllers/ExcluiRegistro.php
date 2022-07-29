<?php

require_once "../class/Exclusao.class.php";

$Exclusao = new Exclusao();
$Exclusao->setId_registro($_POST['IdRegistro']);
$Exclusao->setTabela($_POST['vsTabela']);
$Exclusao->setPasta($_POST['vsPasta']);
$Exclusao->setArquivo_atual($_POST['vsArquivoAtual']);
$Exclusao->setArquivo_atual2($_POST['vsArquivoAtual2']);
$Exclusao->setArquivo_atual3($_POST['vsArquivoAtual3']);
$Exclusao->setArquivo_atual4($_POST['vsArquivoAtual4']);
$Exclusao->setArquivo_atual5($_POST['vsArquivoAtual5']);

if ($Exclusao->excluir_registro()):
    print 1;
else:
    print 0;
endif;