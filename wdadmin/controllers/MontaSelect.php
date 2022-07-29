<?php

require_once "../class/MontaSelect.class.php";

$MontaSelect = new MontaSelect();
$MontaSelect->setId($_POST['viId']);
$MontaSelect->setCampo($_POST["vsCampo"]);
$MontaSelect->setTabela($_POST['vsTabela']);
$MontaSelect->setFiltro($_POST['vsFiltro']);
$MontaSelect->setOrdem($_POST['vsOrdem']);

if ($MontaSelect->consulta_dados()):
    print $MontaSelect->getRetorno();
else:
    print 0;
endif;
?>