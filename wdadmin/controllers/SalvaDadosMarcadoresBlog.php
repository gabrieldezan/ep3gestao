<?php

require_once "../class/BlogMarcadores.class.php";

include 'MontaUrlAmigavel.php';

$BlogMarcadores = new BlogMarcadores();
$BlogMarcadores->setId_blog_marcadores($_POST['inputIdMarcadoresBlog']);
$BlogMarcadores->setDescricao($_POST['inputDescricao']);
$BlogMarcadores->setPosicao($_POST['inputPosicao']);
$BlogMarcadores->setUrl_amigavel(url_amigavel($_POST['inputDescricao']));
$BlogMarcadores->setStatus($_POST['inputStatus']);

if ($BlogMarcadores->salva_dados()):
    print $BlogMarcadores->getRetorno_dados();
else:
    print 0;
endif;