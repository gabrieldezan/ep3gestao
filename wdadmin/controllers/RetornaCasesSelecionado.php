<?php

require_once "../class/Cases.class.php";

$Cases = new Cases();
$Cases->setId_cases($_POST['viIdCases']);

if ($Cases->edita_dados()):
    print $Cases->getRetorno_dados();
else:
    print 0;
endif;