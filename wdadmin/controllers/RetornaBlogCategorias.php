<?php

require_once "../class/BlogCategorias.class.php";

$BlogCategorias = new BlogCategorias();

if ($BlogCategorias->consulta_dados()):
    print $BlogCategorias->getRetorno_dados();
else:
    print 0;
endif;