<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

require_once "../class/Arquivos.class.php";
require_once "../class/BlogPostagens.class.php";

include 'MontaUrlAmigavel.php';

$Arquivos = new Arquivos();
$Arquivos->setArquivo_atual($_POST['inputImagemAtual']);
$Arquivos->setNovo_arquivo($_FILES['inputImagem']);
$Arquivos->setNome_amigavel(url_amigavel($_POST['inputTitulo']));
$Arquivos->setPasta("blog_postagens");

$Arquivos->insere_arquivo();

if ($Arquivos->getErro() == 0 || $Arquivos->getErro() == 4) {
    $BlogPostagens = new BlogPostagens();
    $BlogPostagens->setId_blog_postagem($_POST['inputIdBlogPostagens']);
    $BlogPostagens->setTitulo($_POST['inputTitulo']);
    $BlogPostagens->setTexto(str_replace('src="../uploads', 'src="../../uploads', $_POST['inputTexto']));
    $BlogPostagens->setImagem($Arquivos->getRetorno_arquivo());
    $BlogPostagens->setData_criacao(date("Y/m/d H:i:s", time()));
    $BlogPostagens->setData_publicacao($_POST['inputDataPublicacao']);
    $BlogPostagens->setVideo($_POST['inputVideo']);
    $BlogPostagens->setUrl_amigavel(url_amigavel($_POST['inputTitulo']));
    $BlogPostagens->setId_usuarios($_COOKIE['wd_id_usuario']);
    $BlogPostagens->setId_blog_subcategorias($_POST['inputIdBlogSubCategorias']);

    if ($BlogPostagens->salva_dados()) {
        print $BlogPostagens->getRetorno_dados();
    } else {
        print 0;
    }
} else {
    print 0;
}