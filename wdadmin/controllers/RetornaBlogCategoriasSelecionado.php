<?php

require_once "../class/BlogCategorias.class.php";

$BlogCategorias = new BlogCategorias();
$BlogCategorias->setId_blog_categorias($_POST['viIdCategoriasBlog']);

if ($BlogCategorias->edita_dados()):
    print $BlogCategorias->getRetorno_dados();
else:
    print 0;
endif;