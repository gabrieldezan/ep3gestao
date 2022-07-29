<?php

require_once "../class/BlogSubcategorias.class.php";

$BlogSubcategorias = new BlogSubcategorias();
$BlogSubcategorias->setId_blog_subcategorias($_POST['viIdBlogSubCategorias']);

if ($BlogSubcategorias->edita_dados()):
    print $BlogSubcategorias->getRetorno_dados();
else:
    print 0;
endif;