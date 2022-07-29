<div class="cookie-container">
    <center>
        Para sua segurança, atualizamos nossa <a href="<?php echo URL . "politica-privacidade" ?>" target="_blank">política de privacidade</a>. Ao continuar navegando, entendemos que você está ciente e de acordo com elas.&nbsp;
        <button class="cookie-btn">
            Aceitar
        </button>
    </center>
</div>

<div class="fullWidth footer backGround ">
    <div class="foooter_space border_bottom"></div>
    <hr>
    <div class="container">
        <div class="row-fluid">
            <div class="col-md-3">
                <ul class="font_awesome addFxEmbossBtn">
                    <?php
                    $vsSqlRedesSociais = "SELECT titulo, link, icone FROM redes_sociais";
                    $vrsExecutaRedesSociais = mysqli_query($Conexao, $vsSqlRedesSociais) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                    while ($voResultadoRedesSociais = mysqli_fetch_object($vrsExecutaRedesSociais)) {
                    ?>
                        <li><a href="<?php echo $voResultadoRedesSociais->link ?>" target="_blank" class="<?php echo url_amigavel($voResultadoRedesSociais->titulo) ?>"><i class="<?php echo $voResultadoRedesSociais->icone ?>"></i></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-6 text-center">
                <h6><span class="tiny_font"><?php echo "Copyright " . date("Y") . " © " . $voResultadoConfiguracoes->nome_empresa ?>. Todos os direitos reservados | <a href="<?php echo URL . "politica-privacidade" ?>">Política de privacidade</a>.</span></h6>
            </div>
            <div class="col-md-3 logo-wd">
                <a href="https://webdezan.com.br" target="_blank">
                    <img src="<?php echo URL . "images/logo-wd-preto.webp" ?>">
                </a>
            </div>
        </div>
        <hr>
    </div>
</div>