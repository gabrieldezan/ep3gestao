<?php

require_once "../class/BlogPostagensGaleria.class.php";

$BlogPostagensGaleria = new BlogPostagensGaleria();

$BlogPostagensGaleria->setId_blog_postagem($_POST['viIdBlogPostagem']);

if ($BlogPostagensGaleria->consulta_dados()):
    print $BlogPostagensGaleria->getRetorno_dados();
else:
    print 0;
endif;