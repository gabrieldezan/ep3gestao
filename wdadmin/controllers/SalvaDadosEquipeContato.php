<?php

require_once "../class/EquipeContato.class.php";

$EquipeContato = new EquipeContato();

$EquipeContato->setId_equipe_contato($_POST['inputIdEquipeContato']);
$EquipeContato->setId_equipe($_POST['inputIdEquipe']);
$EquipeContato->setTitulo($_POST['inputTitulo']);
$EquipeContato->setIcone($_POST['inputIcone']);
$EquipeContato->setLink($_POST['inputLink']);
$EquipeContato->setTipo($_POST['inputTipo']);

if ($EquipeContato->salva_dados()) {
    print $EquipeContato->getRetorno_dados();
} else {
    print 0;
}