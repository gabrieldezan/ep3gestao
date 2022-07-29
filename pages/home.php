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
    <meta property="og:title" content="<?php echo $voResultadoConfiguracoes->titulo ?>">
    <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 200), ' ')) . '...'; ?>">
    <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL ?>" />
    <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_principal ?>" />
    <title><?php echo $voResultadoConfiguracoes->titulo ?></title>
</head>

<body class="horizontal_layout high_mobile_performance">

    <?php
    // LOADER
    include 'php/loader.php';
    ?>

    <div class="header menuType2 mini_menu mini showHide_content">
        <div class="container">
            <div class="row-fluid">
                <div class="col-md-2 removePadding">
                    <div class="logo">
                        <a href="#!home">
                            <img src="<?php echo URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_principal ?>" title="<?php echo $voResultadoConfiguracoes->nome_empresa ?>" alt="<?php echo $voResultadoConfiguracoes->nome_empresa ?>">
                        </a>
                    </div>
                    <div class="mobile_menu_btn"> </div>
                </div>
                <div class="col-md-10 mobi">
                    <div class="container-fluid mobi">
                        <div class="row mobi">
                            <div class="col-md-12 mobi">
                                <nav class="header_content">
                                    <ul class="nav">
                                        <li><a href="#!home" class="first active">Home</a></li>
                                        <li><a href="#!quem-somos">Quem Somos</a></li>
                                        <li><a href="#!nosso-time">Nosso Time</a></li>
                                        <li><a href="#!nossas-solucoes">Soluções</a></li>
                                        <li><a href="#!clientes-parceiros">Clientes</a></li>
                                        <li><a href="#!blog">Blog</a></li>
                                        <li><a href="#!contato" class="last">Contato</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pageNavigation hideBtn">
        <div class="previousPage autoPosition">
            <span class="btn_icon"></span>
        </div>
        <div class="nextPage autoPosition">
            <span class="btn_icon"></span>
        </div>
    </div>

    <div class="bodyContainer">
        <div class="mainContent">
            <div data-id="!home" class="contentWrapper m-Scrollbar backGround" data-src="<?php echo URL . "images/home_slider/home_slide_image4.jpg" ?>" data-src-small="<?php echo URL . "images/home_slider/home_slide_image4.jpg" ?>">
                <div class="big_video" data-background-video="<?php echo URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->video_banner ?>">
                    <div class="mobile_topSpc"></div>
                    <div class="container-fluid">
                        <hr class="separator_mini">
                        <div class="row">
                            <hr class="space_max right_spacing">
                            <div class="col-md-12">
                                <a class="fxEmbossBtn fa_btn vidPlyPauBtn">
                                    <span id="botao_mute" class="btn_icon"><i class="fas fa-volume-xmark"></i></span>
                                    <span class="btn_hover"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="overlayPattern"></div>
                    <div class="fullScreenSlider fullWidth hideForLoad">
                        <hr class="separator_desktop">
                        <hr class="separator_max">
                        <div class="container-fluid homeslider_topheading">
                            <div class="row-fluid">
                                <div class="col-md-12">
                                    <div class="slideshow_cycle textAlignCenter whiteLines" data-animated-in="animated fadeInUp" data-animated-out="animated fadeOutDown" data-animated-time="25">
                                        <div class="slide">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div data-id="!quem-somos" class="contentWrapper autoPosition fullHeight m-Scrollbar backGround">
                <div class="top_space"> </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" data-animated-in="animated fadeInUp" data-animated-time="5" data-animated-innerContent="yes">
                            <div class="heading_stroke">
                                <div class="heading_stroke_wrapper">
                                    <div class="stroke-text single_line">
                                        <h1>Quem Somos</h1>
                                    </div>
                                    <div class="stroke-holder half_transparent">
                                        <div class="stroke-line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="space_mini">
                <div class="container">
                    <div class="row">
                        <?php
                        $vsSqlSobre = "SELECT texto, imagem FROM sobre";
                        $vrsExecutaSobre = mysqli_query($Conexao, $vsSqlSobre) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                        while ($voResultadoSobre = mysqli_fetch_object($vrsExecutaSobre)) {
                        ?>
                            <div class="col-md-6" data-animated-in="animated fadeInLeftBig">
                                <img class="img-responsive quem_somos_img" src="<?php echo URL . "wdadmin/uploads/sobre/" . $voResultadoSobre->imagem ?>" title="Sobre" alt="Sobre">
                            </div>
                            <div class="col-md-6" data-animated-in="animated fadeInRightBig" data-animated-time="10">
                                <?php echo $voResultadoSobre->texto ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div data-id="!nosso-time" class="contentWrapper autoPosition m-Scrollbar backGround">
                <div class="top_space"> </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" data-animated-in="animated fadeInUp" data-animated-time="5" data-animated-innerContent="yes">
                            <div class="heading_stroke">
                                <div class="heading_stroke_wrapper">
                                    <div class="stroke-text single_line">
                                        <h1>Nosso Time</h1>
                                    </div>
                                    <div class="stroke-holder half_transparent">
                                        <div class="stroke-line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="space_mini">
                <div class="container">
                    <div class="row carousel_container thumbItem_holder medium_size">
                        <ul class="carousel_thumbails" data-animated-time="0" data-animated-in="animated fadeInUp" data-animated-innerContent="yes" data-anchor-to="parent.parent">
                            <?php
                            $vsSqlTime = "SELECT id_equipe, nome, imagem, formacao, experiencia, historia FROM equipe WHERE status = 1 ORDER BY ordem";
                            $vrsExecutaTime = mysqli_query($Conexao, $vsSqlTime) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                            while ($voResultadoTime = mysqli_fetch_object($vrsExecutaTime)) {
                            ?>
                                <li class="thumbItem itemOver">
                                    <div class="medium_image">
                                        <img alt="image_alt_text" class="preload scale-with-grid" src="<?php echo URL . "wdadmin/uploads/equipe/" . $voResultadoTime->imagem ?>" data-src="<?php echo URL . "wdadmin/uploads/equipe/" . $voResultadoTime->imagem ?>" title="<?php echo $voResultadoTime->nome ?>" alt="<?php echo $voResultadoTime->nome ?>">
                                    </div>
                                    <div class="thumb_desc">
                                        <h4 class="item_title"><?php echo $voResultadoTime->nome ?></h4>
                                        <ul class="font_awesome addFxEmbossBtn">
                                            <?php
                                            $vsSqlTimeRedesSociais = "SELECT titulo, icone, link FROM equipe_contato WHERE tipo = 3 AND id_equipe = $voResultadoTime->id_equipe";
                                            $vrsExecutaTimeRedesSociais = mysqli_query($Conexao, $vsSqlTimeRedesSociais) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                                            while ($voResultadoTimeRedesSociais = mysqli_fetch_object($vrsExecutaTimeRedesSociais)) {
                                            ?>
                                                <li><a href="<?php echo $voResultadoTimeRedesSociais->link ?>" target="_blank"><i class="<?php echo $voResultadoTimeRedesSociais->icone ?>"></i></a></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="section">
                                        <input class="modal-btn" type="checkbox" id="<?php echo "modal-btn" . $voResultadoTime->id_equipe ?>" name="<?php echo "modal-btn" . $voResultadoTime->id_equipe ?>" />
                                        <label for="<?php echo "modal-btn" . $voResultadoTime->id_equipe ?>"><?php echo "Veja mais sobre " . $voResultadoTime->nome ?> <i class="uil uil-expand-arrows"></i></label>
                                        <div class="modal">
                                            <div class="container">
                                                <div class="modal-wrap">
                                                    <div class="col-lg-6">
                                                        <img src="<?php echo URL . "wdadmin/uploads/equipe/" . $voResultadoTime->imagem ?>" title="<?php echo $voResultadoTime->nome ?>" alt="<?php echo $voResultadoTime->nome ?>">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="informacoes-time">
                                                            <div class="informacao-time titulo-secao">
                                                                <img src="<?php echo URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->favicon ?>" title="<?php echo $voResultadoConfiguracoes->nome_empresa ?>" alt="<?php echo $voResultadoConfiguracoes->nome_empresa ?>">
                                                                <h2><?php echo $voResultadoTime->nome ?></h2>
                                                            </div>
                                                            <?php if (!empty($voResultadoTime->experiencia)) { ?>
                                                                <div class="informacao-time">
                                                                    <h2>Experiência na área</h2>
                                                                    <p><?php echo $voResultadoTime->experiencia ?></p>
                                                                </div>
                                                            <?php }
                                                            if (!empty($voResultadoTime->formacao)) { ?>
                                                                <div class="informacao-time">
                                                                    <h2>Formação acadêmica</h2>
                                                                    <p><?php echo $voResultadoTime->formacao ?></p>
                                                                </div>
                                                            <?php }
                                                            if (!empty($voResultadoTime->historia)) { ?>
                                                                <div class="informacao-time">
                                                                    <h2>Minha história</h2>
                                                                    <?php echo $voResultadoTime->historia ?>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div data-id="!nossas-solucoes" class="contentWrapper autoPosition fullHeight m-Scrollbar backGround">
                <div class="top_space"> </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" data-animated-in="animated fadeInUp" data-animated-time="5" data-animated-innerContent="yes">
                            <div class="heading_stroke">
                                <div class="heading_stroke_wrapper">
                                    <div class="stroke-text single_line">
                                        <h1>Nossas Soluções</h1>
                                    </div>
                                    <div class="stroke-holder half_transparent">
                                        <div class="stroke-line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="space_mini">
                <div class="container ">
                    <div class="row" data-animated-time="0" data-animated-in="animated fadeInUp" data-animated-innerContent="yes">
                        <?php
                        $vsSqlSolucoes = "SELECT titulo, descricao, imagem FROM servicos WHERE status = 1 ORDER BY id_servicos";
                        $vrsExecutaSolucoes = mysqli_query($Conexao, $vsSqlSolucoes) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                        while ($voResultadoSolucoes = mysqli_fetch_object($vrsExecutaSolucoes)) {
                        ?>
                            <div class="col-md-4 services_list">
                                <span class="rectangle_icon">
                                    <img src="<?php echo URL . "wdadmin/uploads/servicos/" . $voResultadoSolucoes->imagem ?>" title="<?php echo $voResultadoSolucoes->titulo ?>" alt="<?php echo $voResultadoSolucoes->titulo ?>">
                                </span>
                                <div class="desc">
                                    <h4><?php echo $voResultadoSolucoes->titulo ?></h4>
                                    <?php echo $voResultadoSolucoes->descricao ?>
                                </div>
                                <br>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div data-id="!clientes-parceiros" class="contentWrapper autoPosition m-Scrollbar backGround">
                <div class="top_space"> </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" data-animated-in="animated fadeInUp" data-animated-time="5" data-animated-innerContent="yes">
                            <div class="heading_stroke">
                                <div class="heading_stroke_wrapper">
                                    <div class="stroke-text single_line">
                                        <h1>Clientes e Parceiros</h1>
                                    </div>
                                    <div class="stroke-holder half_transparent">
                                        <div class="stroke-line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="space_mini">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="clients_logo" data-animated-time="5" data-animated-in="animated fadeInUp" data-animated-innerContent="yes" data-anchor-to="parent">
                                <?php
                                $vsSqlClientesParceiros = "SELECT descricao, imagem FROM clientes WHERE status = 1 ORDER BY id_clientes";
                                $vrsExecutaClientesParceiros = mysqli_query($Conexao, $vsSqlClientesParceiros) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                                while ($voResultadoClientesParceiros = mysqli_fetch_object($vrsExecutaClientesParceiros)) {
                                ?>
                                    <img class="preload" src="<?php echo URL . "wdadmin/uploads/clientes/" . $voResultadoClientesParceiros->imagem ?>" data-src="<?php echo URL . "wdadmin/uploads/clientes/" . $voResultadoClientesParceiros->imagem ?>" title="<?php echo $voResultadoClientesParceiros->descricao ?>" alt="<?php echo $voResultadoClientesParceiros->descricao ?>">
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div data-id="!blog" class="contentWrapper autoPosition m-Scrollbar backGround">
                <div class="top_space"> </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 thumbItem_holder large_size gridType col3 content" data-animated-time="10" data-animated-in="animated fadeInUp" data-animated-innerContent="yes">
                            <div class="heading_stroke">
                                <div class="heading_stroke_wrapper">
                                    <div class="stroke-text single_line">
                                        <h1>Blog</h1>
                                    </div>
                                    <div class="stroke-holder half_transparent">
                                        <div class="stroke-line"></div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $vsSqlBlog = "
                                SELECT
                                    titulo,
                                    url_amigavel,
                                    imagem,
                                    DATE_FORMAT(data_publicacao, '%d/%m/%Y') AS data_publicacao_formatada,
                                    texto
                                FROM
                                    blog_postagem
                                WHERE
                                    data_publicacao < '$data_hora_atual'
                                ORDER BY
                                    data_publicacao DESC
                                LIMIT 9
                            ";
                            $vrsExecutaBlog = mysqli_query($Conexao, $vsSqlBlog) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
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
                                            <h5 class="item_title"><?php echo $voResultadoBlog->titulo ?></h5>
                                        </a>
                                        <?php echo substr(strip_tags(trim($voResultadoBlog->texto)), 0, strrpos(substr(strip_tags(trim($voResultadoBlog->texto)), 0, 100), ' ')) . '...'; ?>
                                        <a href="<?php echo URL . "post/" . $voResultadoBlog->url_amigavel ?>" class="smoothPageLoad readMore">Veja mais</a>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <center>
                    <a href="<?php echo URL . "blog" ?>" class="fxButton">
                        <div class="btn_icon"><i class="fas fa-2x fa-arrow-circle-right"></i>
                            <h5>Veja mais</h5>
                        </div>
                        <div class="btn_hover"></div>
                    </a>
                </center>
            </div>

            <?php
            $vsSqlImagemContato = "SELECT imagem FROM informacoes WHERE id_conteudo_personalizado = 6";
            $vrsExecutaImagemContato = mysqli_query($Conexao, $vsSqlImagemContato) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
            while ($voResultadoImagemContato = mysqli_fetch_object($vrsExecutaImagemContato)) {
            ?>
                <div data-id="!contato" data-src="<?php echo URL . "wdadmin/uploads/informacoes/" . $voResultadoImagemContato->imagem ?>" data-src-small="<?php echo URL . "wdadmin/uploads/informacoes/" . $voResultadoImagemContato->imagem ?>" class="contentWrapper autoPosition contactPage fullWidth removePadding m-Scrollbar backGround parallax">
                <?php
            }
                ?>
                <div class="overlayPattern"></div>
                <div class="top_space"> </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" data-animated-in="animated fadeInUp" data-animated-time="0" data-animated-innerContent="yes">
                            <div class="heading_stroke">
                                <div class="heading_stroke_wrapper">
                                    <div class="stroke-text single_line">
                                        <h1>CONTATO</h1>
                                    </div>
                                    <div class="stroke-holder half_transparent">
                                        <div class="stroke-line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="space_mini">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <div data-animated-in="animated fadeInUp" data-animated-time="0" data-animated-innerContent="yes" data-anchor-to="parent">
                            </div>
                            <?php
                            $vsSqlEndereco = "SELECT endereco, cidade, estado, link, mapa FROM enderecos WHERE status = 1";
                            $vrsExecutaEndereco = mysqli_query($Conexao, $vsSqlEndereco) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                            while ($voResultadoEndereco = mysqli_fetch_object($vrsExecutaEndereco)) {
                            ?>
                                <ul class="item_feature no_border redes-sociais" data-animated-time="10" data-animated-in="animated fadeInUp" data-animated-innerContent="yes" data-anchor-to="parent">
                                    <li><span class="title"><i class="fas fa-map-marker-alt"></i></span><a href="<?php echo $voResultadoEndereco->link ?>" target="_blank"><?php echo $voResultadoEndereco->endereco . " - " . $voResultadoEndereco->cidade . "-" . $voResultadoEndereco->estado ?></a></li>
                                    <li><span class="title"><i class="fab fa-whatsapp"></i></span><a href="<?php echo "https://api.whatsapp.com/send?l=pt_BR&phone=55" . str_replace(array("(", ")", "-", " "), "", $voResultadoConfiguracoes->whatsapp) ?>" target="_blank"><?php echo $voResultadoConfiguracoes->whatsapp ?></a></li>
                                    <li><span class="title"><i class="fas fa-phone"></i></span><a href="<?php echo "tel:55" . str_replace(array("(", ")", "-", " "), "", $voResultadoConfiguracoes->celular1) ?>"><?php echo $voResultadoConfiguracoes->celular1 ?></a></li>
                                    <li><span class="title"><i class="far fa-envelope"></i></span><a href="<?php echo "mailto:" . $voResultadoConfiguracoes->email ?>"><?php echo $voResultadoConfiguracoes->email ?></a></li>
                                    <li class="last">
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
                                    </li>
                                </ul>
                                <?php echo $voResultadoEndereco->mapa ?>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-md-7 darkBgTransparent" data-animated-time="0" data-animated-in="animated fadeInLeft" data-animated-innerContent="yes">
                            <hr>
                            <form id="form_contato" class="contactusForm" method="post">
                                <input type="hidden" id="vsUrl" name="vsUrl" value="<?php echo URL ?>">
                                <input type="hidden" id="vsEmailContato" name="vsEmailContato" value="<?php echo EMAIL_CONTATO ?>">
                                <input type="hidden" id="vsNomeEmpresa" name="vsNomeEmpresa" value="<?php echo $voResultadoConfiguracoes->nome_empresa ?>">
                                <div class="row-fluid">
                                    <div class="col-md-6">
                                        <input type="text" placeholder="Nome" id="vsNome" name="vsNome" class="col-md-12 transprentBg dashedBorder">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" placeholder="E-mail" id="vsEmail" name="vsEmail" class="col-md-12 transprentBg dashedBorder">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" placeholder="Telefone" id="vsTelefone" name="vsTelefone" class="col-md-12 transprentBg dashedBorder">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" placeholder="Assunto" id="vsAssunto" name="vsAssunto" class="col-md-12 transprentBg dashedBorder">
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="col-md-12">
                                        <textarea cols="30" rows="5" placeholder="Mensagem..." id="vsMensagem" name="vsMensagem" class="col-md-12 transprentBg dashedBorder"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row-fluid">
                                    <div class="col-md-12 textAlignCenter alignCenter">
                                        <button type="submit" id="botao_enviar_mensagem" class="button large transprentBg dashedBorder makeAnimate">
                                            <i class="far fa-envelope animated_rubberBand right_spacing"></i> Enviar Mensagem
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>

    <div class="cookie-container">
        <center>
            Para sua segurança, atualizamos nossa <a href="<?php echo URL . "politica-privacidade" ?>" target="_blank">política de privacidade</a>. Ao continuar navegando, entendemos que você está ciente e de acordo com elas.&nbsp;
            <button class="cookie-btn">
                Aceitar
            </button>
        </center>
    </div>

    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/bootstrap.min.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/bootstrap-responsive.min.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/bootstrap-theme.min.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "font-awesome/css/all.min.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/picons.min.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/animate.min.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/main.min.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/style.min.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/base.min.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/font-style1.min.css" ?>" id="set_font">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/color-night.min.css" ?>" id="set_color">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/elastislide.min.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/jquery.mCustomScrollbar.min.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/bigvideo.min.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/magnific-popup.min.css" ?>" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/flexslider.min.css" ?>" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/supersized.min.css" ?>" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "css/supersized.shutter.min.css" ?>" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo URL . "cookies/cookies.min.css" ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">

    <?php
    // JAVASCRIPT
    include 'php/javascript.php';
    ?>
    <script src="<?php echo URL . "wdadmin/js/jquery.mask.min.js" ?>" rel="stylesheet"></script>
    <script src="<?php echo URL . "wdadmin/assets/plugins/sweetalert/sweetalert.min.js" ?>"></script>
    <script src="<?php echo URL . "wdadmin/js/contato.min.js" ?>"></script>
    <link href="<?php echo URL . "wdadmin/assets/plugins/sweetalert/sweetalert.min.css" ?>" rel="stylesheet">

    <script type="text/javascript">
        $(document).ready(function() {
            jQuery(function($) {
                $("body").mainFm({
                    currentPage: "!home",
                    slideshowSpeed: 5000
                });
            });
        });

        jQuery('.modal-btn').on('click', function() {
            if ($(".carousel_thumbails").hasClass('modal-aberto')) {
                $(".carousel_thumbails").removeClass('modal-aberto');
            } else {
                $(".carousel_thumbails").addClass('modal-aberto');
            }
        });

        var botaoMute = document.querySelector("#botao_mute");
        var contadorCliques = 0;
        botaoMute.addEventListener("click", function(event) {
            volumeVideo();
            contadorCliques++;
        })

        function volumeVideo() {
            if (contadorCliques % 2 != 0) {
                var video = document.querySelector("#big-video-vid_html5_api").volume = 0.5;
                $('#botao_mute').html('<i class="fas fa-volume-high"></i>');
            } else if (contadorCliques % 2 == 0) {
                var video = document.querySelector("#big-video-vid_html5_api").volume = 0;
                $('#botao_mute').html('<i class="fas fa-volume-xmark"></i>');
            }
        }
    </script>

</body>

</html>