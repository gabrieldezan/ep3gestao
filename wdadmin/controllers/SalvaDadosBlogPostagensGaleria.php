<?php

require_once "../class/Arquivos.class.php";
require_once "../class/BlogPostagensGaleria.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$BlogPostagensGaleria = new BlogPostagensGaleria();

$BlogPostagensGaleria->setId_blog_postagem_galeria($_POST['inputIdBlogPostagemGaleria']);
$BlogPostagensGaleria->setId_blog_postagem($_POST['inputIdBlogPostagem']);
$BlogPostagensGaleria->setDescricao($_POST['inputDescricaoGaleria']);

$Arquivos->setArquivo_atual($_POST['inputImagemGaleriaAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagemGaleria']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputDescricaoGaleria']));
$Arquivos->setPasta("blog_postagens_galeria");
$Arquivos->insere_arquivo();
$BlogPostagensGaleria->setImagem($Arquivos->getRetorno_arquivo());

if ($BlogPostagensGaleria->salva_dados()) {
    print $BlogPostagensGaleria->getRetorno_dados();
} else {
    print 0;
}