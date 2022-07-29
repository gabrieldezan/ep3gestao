<?php

require_once "../class/BlogSubcategorias.class.php";

include 'MontaUrlAmigavel.php';

$BlogSubcategorias = new BlogSubcategorias();
$BlogSubcategorias->setId_blog_subcategorias($_POST['inputIdSubcategoriasBlog']);
$BlogSubcategorias->setDescricao($_POST['inputDescricaoSub']);
$BlogSubcategorias->setPosicao($_POST['inputPosicaoSub']);
$BlogSubcategorias->setUrl_amigavel(url_amigavel($_POST['inputDescricaoSub']));
$BlogSubcategorias->setStatus($_POST['inputStatusSub']);
$BlogSubcategorias->setId_blog_categorias($_POST['inputIdCategoriasSubBlog']);

if ($BlogSubcategorias->salva_dados()):
    print $BlogSubcategorias->getRetorno_dados();
else:
    print 0;
endif;