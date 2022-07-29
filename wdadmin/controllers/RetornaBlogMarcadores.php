<?php

require_once "../class/BlogMarcadores.class.php";

$BlogMarcadores = new BlogMarcadores();

if ($BlogMarcadores->consulta_dados()):
    print $BlogMarcadores->getRetorno_dados();
else:
    print 0;
endif;