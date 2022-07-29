<?php

require_once "../class/BlogPostagens.class.php";

$BlogPostagens = new BlogPostagens();
$BlogPostagens->setId_blog_categorias($_POST['viFiltroIdBlogCategorias']);
$BlogPostagens->setId_blog_subcategorias($_POST['viFiltroIdBlogSubcategorias']);

if ($BlogPostagens->consulta_dados()):
    print $BlogPostagens->getRetorno_dados();
else:
    print 0;
endif;