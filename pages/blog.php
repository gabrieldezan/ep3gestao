<?php
// definir o numero de itens por pagina
$itens_por_pagina = 10;

// pegar a pagina atual
$pagina = intval($numero_pagina - 1 . "0");

//verifica se a página é menor que 0
if ($pagina < 0) {
    include "pages/404.php";
} else {

    // pega a quantidade total de objetos no banco de dados
    $vsSqlTotal = "
        SELECT
            titulo,
            texto,
            imagem,
            url_amigavel,
            DATE_FORMAT(data_publicacao, '%d/%m/%Y') AS data_publicacao_formatada
        FROM
            blog_postagem
        WHERE
            data_publicacao < '$data_hora_atual'
        ORDER BY
            data_publicacao DESC
    ";
    $vrsExecutaTotal = mysqli_query($Conexao, $vsSqlTotal) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
    $viNumRowsTotal = mysqli_num_rows($vrsExecutaTotal);
    $voResultadoTotal = mysqli_fetch_object($vrsExecutaTotal);

    // puxar produtos do banco
    $vsSqlBlog = "
        $vsSqlTotal
        LIMIT $pagina, $itens_por_pagina
    ";
    $vrsExecutaBlog = mysqli_query($Conexao, $vsSqlBlog) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
    $viNumRowsBlog = mysqli_num_rows($vrsExecutaBlog);

    // definir numero de páginas
    $num_paginas = ceil($viNumRowsTotal / $itens_por_pagina);

    // verifica se existe resultado e se a página é maior que a quantidade total de páginas
    if ($viNumRowsTotal == 0 || $numero_pagina > $num_paginas) {
        include "pages/404.php";
    } else {
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
            <meta name="description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 200), ' ')) . '...'; ?>">
            <meta property="og:title" content="<?php echo "Blog - " . $voResultadoConfiguracoes->titulo ?>">
            <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 200), ' ')) . '...'; ?>">
            <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "blog" ?>" />
            <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_principal ?>" />
            <title><?php echo "Blog - " . $voResultadoConfiguracoes->titulo ?></title>
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
                                    <h1 class="white_color">Blog</h1>
                                </div>
                            </div>
                        </div>
                        </div>
                        <hr>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 thumbItem_holder large_size gridType col2 content" data-animated-time="5" data-animated-in="animated fadeInUp" data-animated-innerContent="yes">
                                    <?php
                                    // CONSULTA POSTS
                                    while ($voResultadoBlog = mysqli_fetch_object($vrsExecutaBlog)) {
                                    ?>
                                        <div class="thumbItem">
                                            <div class="large_image">
                                                <figure class="itemOver">
                                                    <div class="overlay">
                                                        <span class="popup_overlay">
                                                            <span class="popup_links">
                                                                <a href="<?php echo URL . "post/" . $voResultadoBlog->url_amigavel ?>" class="smoothPageLoad"><span class="link_link"></span> </a>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <img class="preload alignCenter resize-with-grid" src="<?php echo URL . "wdadmin/uploads/blog_postagens/" . $voResultadoBlog->imagem ?>" title="<?php echo $voResultadoBlog->titulo ?>" alt="<?php echo $voResultadoBlog->titulo ?>" data-src="<?php echo URL . "wdadmin/uploads/blog_postagens/" . $voResultadoBlog->imagem ?>">
                                                </figure>
                                            </div>
                                            <div class="thumb_desc">
                                                <ul class="tools">
                                                    <li class="date"><i class="fas fa-calendar-days"></i><?php echo $voResultadoBlog->data_publicacao_formatada ?></li>
                                                </ul>
                                                <a href="<?php echo URL . "post/" . $voResultadoBlog->url_amigavel ?>">
                                                    <h5 class="item_title blog-title"><?php echo $voResultadoBlog->titulo ?></h5>
                                                </a>
                                                <?php echo substr(strip_tags(trim($voResultadoBlog->texto)), 0, strrpos(substr(strip_tags(trim($voResultadoBlog->texto)), 0, 100), ' ')) . '...'; ?>
                                                <a href="<?php echo URL . "post/" . $voResultadoBlog->url_amigavel ?>" class="smoothPageLoad readMore">Veja mais</a>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <hr class="separator_bar dark">

                                    <div class="pagination" data-animated-time="0" data-animated-in="animated fadeInUp" data-animated-innerContent="yes" data-anchor-to="parent">
                                        <ul>
                                            <li> <a href="<?php echo URL . "blog/" ?>">Primeiro</a> </li>
                                            <?php
                                            $limite = 10;

                                            if ($num_paginas <= $limite) {
                                                $minimo = 0;
                                                $maximo = $num_paginas;
                                            } else if ($numero_pagina < $limite) {
                                                $minimo = 0;
                                                $maximo = $limite;
                                            } else if ($numero_pagina > ($num_paginas - 9)) {
                                                $minimo = $num_paginas - $limite;
                                                $maximo = $num_paginas;
                                            } else {
                                                $minimo = $numero_pagina - 6;
                                                $maximo = $numero_pagina + 5;
                                            }

                                            for ($i = $minimo; $i < $maximo; $i++) {
                                                $estilo = "";
                                                if ($numero_pagina == $i + 1)
                                                    $estilo = "active";
                                            ?>
                                                <li> <a href="<?php echo URL . "blog/" ?><?php echo $i + 1 ?>" class="<?php echo $estilo ?>"><?php echo $i + 1 ?></a></li>
                                            <?php } ?>
                                            <li> <a href="<?php echo URL . "blog/" . $num_paginas ?>">Último</a> </li>
                                        </ul>
                                    </div>
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
                            currentPage: "blog",
                            slideshowSpeed: 5000
                        });
                    });
                });
            </script>

        </body>

        </html>
<?php
    }
}
