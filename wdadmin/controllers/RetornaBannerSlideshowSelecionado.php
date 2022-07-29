<?php

require_once "../class/BannersSlideshow.class.php";

$BannersSlideshow = new BannersSlideshow();
$BannersSlideshow->setId_banner($_POST['viIdBannersSlideshow']);

if ($BannersSlideshow->edita_dados()):
    print $BannersSlideshow->getRetorno_dados();
else:
    print 0;
endif;