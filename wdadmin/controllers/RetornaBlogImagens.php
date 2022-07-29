<?php

require_once "../class/BlogImagens.class.php";

$BlogImagens = new BlogImagens();

if ($BlogImagens->consulta_dados()):
    print $BlogImagens->getRetorno_dados();
else:
    print 0;
endif;