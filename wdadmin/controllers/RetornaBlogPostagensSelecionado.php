<?php

require_once "../class/BlogPostagens.class.php";

$BlogPostagens = new BlogPostagens();
$BlogPostagens->setId_blog_postagem($_POST['viIdBlogPostagens']);

if ($BlogPostagens->edita_dados()):
    print $BlogPostagens->getRetorno_dados();
else:
    print 0;
endif;