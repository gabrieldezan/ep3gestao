<?php

require_once "../class/BlogSubcategorias.class.php";

$BlogSubcategorias = new BlogSubcategorias();

$BlogSubcategorias->setId_blog_categorias($_POST['viIdCategoria']);

if ($BlogSubcategorias->consulta_dados()):
    print $BlogSubcategorias->getRetorno_dados();
else:
    print 0;
endif;