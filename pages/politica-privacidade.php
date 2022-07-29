        <!DOCTYPE html>
        <html lang="pt-BR">

        <head>
            <?php
            // HEAD
            include 'php/head.php';
            ?>
            <meta name="robots" content="index, follow" />
            <meta name="googlebot" content="index, follow" />
            <meta name="description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 200), ' ')) . '...'; ?>">
            <meta property="og:title" content="<?php echo "Política de Privacidade - " . $voResultadoConfiguracoes->titulo ?>">
            <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 200), ' ')) . '...'; ?>">
            <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "politica-privacidade" ?>" />
            <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_principal ?>" />
            <title><?php echo "Política de Privacidade - " . $voResultadoConfiguracoes->titulo ?></title>
        </head>

        <body class="not_onepage_ver">

            <?php
            //LOADER
            include 'php/loader.php';

            // MENU
            include 'php/menu.php';
            ?>

            <div class="bodyContainer">
                <div class="contentWrapper autoPosition m-Scrollbar">
                    <div class="top_space"> </div>
                    <?php
                    $vsSqlImagemFundo = "SELECT imagem FROM informacoes WHERE id_conteudo_personalizado = 7";
                    $vrsExecutaImagemFundo = mysqli_query($Conexao, $vsSqlImagemFundo) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                    while ($voResultadoImagemFundo = mysqli_fetch_object($vrsExecutaImagemFundo)) {
                    ?>
                        <div class="fullWidth parallax topHeaderBg top_bot_pad_large" data-src="<?php echo URL . "wdadmin/uploads/informacoes/" . $voResultadoImagemFundo->imagem ?>">
                        <?php
                    }
                        ?>
                        <div class="overlayBg dark"></div>
                        <div class="container">
                            <div class="row-fluid">
                                <div class="col-md-12 textAlignCenter" data-animated-time="0" data-animated-in="animated flipInX" data-animated-innerContent="yes">
                                    <h1 class="white_color">Política de Privacidade</h1>
                                </div>
                            </div>
                        </div>
                        </div>
                        <hr>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 content">
                                    <?php echo $voResultadoConfiguracoes->politicas_privacidade ?>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <?php
            // RODAPÉ
            include 'php/rodape.php';

            // CSS
            include 'php/css.php';

            // JAVASCRIPT
            include 'php/javascript.php';
            ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    /* Site Main plug-in initilize */
                    jQuery(function($) {
                        $("body").mainFm({
                            /* Set the opening page. 
                            leave it blank value if you need to show the home page as a opening page*/
                            currentPage: "blog.php",
                            /* FlexSlider slideshow speed */
                            slideshowSpeed: 5000
                        });
                    });
                });
            </script>

        </body>

        </html>