<?php
$vsSqlPost = "
    SELECT
        id_blog_postagem,
        titulo,
        imagem,
        texto,
        DATE_FORMAT(data_publicacao, '%d/%m/%Y') AS data_publicacao_formatada,
        url_amigavel
    FROM
        blog_postagem
    WHERE
        url_amigavel = '$parametro'
";
$vrsExecutaPost = mysqli_query($Conexao, $vsSqlPost) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
$vrsQntPost = mysqli_num_rows($vrsExecutaPost);

if ($vrsQntPost > 0) {
    $voResultadoPost = mysqli_fetch_object($vrsExecutaPost);

    $vsSqlView = "UPDATE blog_postagem SET visualizacoes = visualizacoes+1 WHERE url_amigavel= '$parametro'";
    mysqli_query($Conexao, $vsSqlView) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));

    $vsSqlPostGaleria = "SELECT descricao, imagem FROM blog_postagem_galeria WHERE id_blog_postagem = '$voResultadoPost->id_blog_postagem'";
    $vrsExecutaPostGaleria = mysqli_query($Conexao, $vsSqlPostGaleria) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
    $vrsQntPostGaleria = mysqli_num_rows($vrsExecutaPostGaleria);
?>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <?php
        // HEAD
        include 'php/head.php';
        ?>
        <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow" />
        <meta name="description" content="<?php echo substr(strip_tags(trim($voResultadoPost->texto)), 0, strrpos(substr(strip_tags(trim($voResultadoPost->texto)), 0, 200), ' ')) . '...'; ?>">
        <meta property="og:title" content="<?php echo $voResultadoPost->titulo . " - " . $voResultadoConfiguracoes->titulo ?>">
        <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoPost->texto)), 0, strrpos(substr(strip_tags(trim($voResultadoPost->texto)), 0, 200), ' ')) . '...'; ?>">
        <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "post/" . $parametro ?>" />
        <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/blog_postagens/" . $voResultadoPost->imagem ?>" />
        <title><?php echo $voResultadoPost->titulo . " - " . $voResultadoConfiguracoes->titulo ?></title>
    </head>

    <body class="not_onepage_ver">

        <?php
        // LOADER
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
                                <h1 class="white_color"><?php echo $voResultadoPost->titulo ?></h1>
                            </div>
                        </div>
                    </div>
                    </div>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 content" data-animated-time="20" data-animated-in="animated fadeInUp" data-animated-innerContent="yes">
                                <hr class="separator">
                                <div class="post_main">
                                    <figure>
                                        <img class="preload alignCenter resize-with-grid" src="<?php echo URL . "wdadmin/uploads/blog_postagens/" . $voResultadoPost->imagem ?>" data-src="<?php echo URL . "wdadmin/uploads/blog_postagens/" . $voResultadoPost->imagem ?>" title="<?php echo $voResultadoPost->titulo ?>" alt="<?php echo $voResultadoPost->titulo ?>">
                                    </figure>
                                    <h3><?php echo $voResultadoPost->titulo ?></h3>
                                    <div class="post_desc">
                                        <ul class="tools">
                                            <li><i class="fas fa-calendar-days"></i><?php echo $voResultadoPost->data_publicacao_formatada ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <hr>
                                <?php echo $voResultadoPost->texto ?>
                                <hr>
                            </div>

                            <?php
                            // COLUNA DIREITA
                            include 'php/coluna-direita.php';
                            ?>

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
                jQuery(function($) {
                    $("body").mainFm({
                        currentPage: "<?php echo "post/" . $parametro ?>",
                        slideshowSpeed: 5000
                    });
                });
            });
        </script>

    </body>

    </html>
<?php
} else {
    include "pages/404.php";
}
