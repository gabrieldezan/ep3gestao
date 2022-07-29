        <!DOCTYPE html>
        <html lang="pt-BR">

        <head>
            <?php
            // HEAD
            include 'php/head.php';
            ?>
            <meta name="robots" content="noindex" />
            <meta name="googlebot" content="noindex" />
            <meta name="description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 200), ' ')) . '...'; ?>">
            <meta property="og:title" content="<?php echo "404 - " . $voResultadoConfiguracoes->titulo ?>">
            <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 200), ' ')) . '...'; ?>">
            <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "404" ?>" />
            <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_principal ?>" />
            <title><?php echo "404 - " . $voResultadoConfiguracoes->titulo ?></title>
        </head>

        <body class="not_onepage_ver">

            <?php
            // LOADER
            include 'php/loader.php';
            ?>

            <div class="bodyContainer">
                <div class="contentWrapper autoPosition m-Scrollbar">
                    <section class="pg-404">
                        <center>
                            <div class="box-wrap-ab wow fadeInUp">
                                <img src="<?php echo URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_secundaria ?>" title="<?php echo $voResultadoConfiguracoes->nome_empresa ?>" alt="<?php echo $voResultadoConfiguracoes->nome_empresa ?>">
                                <h1>404</h1>
                                <h3>Página não encontrada</h3>
                                <a href="<?php echo URL ?>" class="fxButton w-auto">
                                    <div class="btn_icon"><i class="fas fa-2x fa-arrow-circle-left"></i>
                                        <h5>Voltar a página inicial</h5>
                                    </div>
                                    <div class="btn_hover"></div>
                                </a>
                            </div>
                        </center>
                    </section>
                </div>
            </div>

            <?php
            // CSS
            include 'php/css.php';

            // JAVASCRIPT
            include 'php/javascript.php';
            ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    jQuery(function($) {
                        $("body").mainFm({
                            currentPage: "404",
                            slideshowSpeed: 5000
                        });
                    });
                });
            </script>

        </body>

        </html>