<?php

require_once "../class/BlogPostagensGaleria.class.php";

$BlogPostagensGaleria = new BlogPostagensGaleria();
$BlogPostagensGaleria->setId_blog_postagem_galeria($_POST['viIdBlogPostagemGaleria']);

if ($BlogPostagensGaleria->edita_dados()):
    print $BlogPostagensGaleria->getRetorno_dados();
else:
    print 0;
endif;