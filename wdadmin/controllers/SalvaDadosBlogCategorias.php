<?php

require_once "../class/BlogCategorias.class.php";

include 'MontaUrlAmigavel.php';

$BlogCategorias = new BlogCategorias();
$BlogCategorias->setId_blog_categorias($_POST['inputIdCategoriasBlog']);
$BlogCategorias->setDescricao($_POST['inputDescricao']);
$BlogCategorias->setPosicao($_POST['inputPosicao']);
$BlogCategorias->setUrl_amigavel(url_amigavel($_POST['inputDescricao']));
$BlogCategorias->setStatus($_POST['inputStatus']);

if ($BlogCategorias->salva_dados()):
    print $BlogCategorias->getRetorno_dados();
else:
    print 0;
endif;