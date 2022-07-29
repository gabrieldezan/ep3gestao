<?php

require_once "../class/BannersSlideshow.class.php";

$BannersSlideshow = new BannersSlideshow();

if ($BannersSlideshow->consulta_dados()):
    print $BannersSlideshow->getRetorno_dados();
else:
    print 0;
endif;