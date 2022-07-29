<?php
error_reporting(0);

date_default_timezone_set('America/Sao_Paulo');

include_once "config.php";
require_once "./class/Conexao.class.php";
require_once "./class/Login.class.php";

$getUrl = strip_tags(trim(filter_input(INPUT_GET, "url", FILTER_DEFAULT)));
$setUrl = (empty($getUrl) ? "inicio" : $getUrl);
$Url = explode("/", $setUrl);

if ($_COOKIE['wd_logado']):
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
            <title>WD Admin - Principal</title>

            <!-- Favicon -->
            <link rel="icon" type="image/png" href="<?php echo URL ?>wdadmin/assets/images/logo-icon-50.png" sizes="50x50">
            <link rel="icon" type="image/png" href="<?php echo URL ?>wdadmin/assets/images/logo-icon-72.png" sizes="72x72">
            <link rel="icon" type="image/png" href="<?php echo URL ?>wdadmin/assets/images/logo-icon-114.png" sizes="114x114">
            <link rel="icon" type="image/png" href="<?php echo URL ?>wdadmin/assets/images/logo-icon-120.png" sizes="120x120">
            <link rel="icon" type="image/png" href="<?php echo URL ?>wdadmin/assets/images/logo-icon-144.png" sizes="144x144">

            <!-- CSS -->
            <link href="<?php echo URL ?>wdadmin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <!-- morris CSS -->
            <link href="<?php echo URL ?>wdadmin/assets/plugins/morrisjs/morris.css" rel="stylesheet">
            <link href="<?php echo URL ?>wdadmin/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
            <link href="<?php echo URL ?>wdadmin/assets/plugins/dropify/dist/css/dropify.min.css" rel="stylesheet">
            <link href="<?php echo URL ?>wdadmin/assets/plugins/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
            <!-- FontAwesome -->
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
            <link rel="stylesheet" href="<?php echo URL ?>wdadmin/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
            <link rel="stylesheet" href="<?php echo URL ?>wdadmin/assets/plugins/score/jQuery.score.css" />
            <!-- Custom CSS -->
            <link href="<?php echo URL ?>wdadmin/css/style.css" rel="stylesheet">
            <!-- You can change the theme colors from here -->
            <!--<link href="<?php echo URL ?>wdadmin/css/colors/blue.css" id="theme" rel="stylesheet">-->
            <link href="<?php echo URL ?>wdadmin/css/colors/default.css" id="theme" rel="stylesheet">

            <!-- Script -->
            <script src="<?php echo URL ?>wdadmin/assets/plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap tether Core JavaScript -->
            <script src="<?php echo URL ?>wdadmin/assets/plugins/bootstrap/js/popper.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/dropify/dist/js/dropify.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/score/jQuery.score.js"></script>
            <!-- slimscrollbar scrollbar JavaScript -->
            <script src="<?php echo URL ?>wdadmin/js/jquery.slimscroll.js"></script>
            <!--Wave Effects -->
            <script src="<?php echo URL ?>wdadmin/js/waves.js"></script>
            <!--Menu sidebar -->
            <script src="<?php echo URL ?>wdadmin/js/sidebarmenu.js"></script>
            <!--stickey kit -->
            <script src="<?php echo URL ?>wdadmin/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
            <!-- Sweet-Alert  -->
            <script src="<?php echo URL ?>wdadmin/assets/plugins/sweetalert/sweetalert.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
            <!-- ============================================================== -->
            <!-- This page plugins -->
            <!-- ============================================================== -->
            <!--sparkline JavaScript -->
            <script src="<?php echo URL ?>wdadmin/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
            <!--morris JavaScript -->
            <script src="<?php echo URL ?>wdadmin/assets/plugins/raphael/raphael-min.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/morrisjs/morris.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/js/jquery.mask.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/js/jquery.fullscreen.min.js"></script>
            <!--<script src="<?php echo URL ?>wdadmin/js/jquery.printElement.min.js"></script>-->
            <!-- start - This is for export functionality only -->
            <script src="<?php echo URL ?>wdadmin/assets/plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/datatables/dataTables.buttons.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/datatables/buttons.flash.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/datatables/jszip.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/datatables/pdfmake.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/datatables/vfs_fonts.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/datatables/buttons.html5.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/datatables/buttons.print.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/datatables/dataTables.responsive.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/tinymce/tinymce.min.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
            <script src="<?php echo URL ?>wdadmin/assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
            <script src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/date-uk.js"></script>
            <!--Custom JavaScript -->
            <script src="<?php echo URL ?>wdadmin/js/custom.js"></script>
        </head>

        <body class="fix-header fix-sidebar card-no-border mini-sidebar">
            <input type="hidden" id="vsUrl" value="<?php echo URL ?>wdadmin/"/>
            <!-- ============================================================== -->
            <!-- Preloader - style you can find in spinners.css -->
            <!-- ============================================================== -->
            <div class="preloader">
                <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
            </div>
            <!-- ============================================================== -->
            <!-- Main wrapper - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <div id="main-wrapper">
                <!-- ============================================================== -->
                <!-- Topbar header - style you can find in pages.scss -->
                <!-- ============================================================== -->
                <header class="topbar">
                    <nav class="navbar top-navbar navbar-expand-md navbar-light">
                        <!-- ============================================================== -->
                        <!-- Logo -->
                        <!-- ============================================================== -->
                        <div class="navbar-header">
                            <a class="navbar-brand" href="<?php echo URL ?>wdadmin/inicio">
                                <b>
                                    <img src="<?php echo URL ?>wdadmin/assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                                </b>
                                <span>
                                    <img src="<?php echo URL ?>wdadmin/assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                                </span>
                            </a>
                        </div>
                        <!-- ============================================================== -->
                        <!-- End Logo -->
                        <!-- ============================================================== -->
                        <div class="navbar-collapse">
                            <!-- ============================================================== -->
                            <!-- toggle and nav items -->
                            <!-- ============================================================== -->
                            <ul class="navbar-nav mr-auto mt-md-0">
                                <!-- This is -->
                                <li class="nav-item">
                                    <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a>
                                </li>
                                <li class="nav-item m-l-10">
                                    <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a>
                                </li>
                            </ul>
                            <ul class="navbar-nav my-lg-0">
                                <?php /* ATALHOS */ ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-th fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right mailbox scale-up" aria-labelledby="2">
                                        <ul>
                                            <li>
                                                <div class="drop-title">Atalhos</div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-4 icone">
                                                        <a href="<?php echo URL ?>" target="_blank">
                                                            <center>
                                                                <i class="fas fa-globe fa-2x"></i>
                                                                <h6>Site</h6>
                                                            </center>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 icone">
                                                        <a href="<?php echo URL . "cpanel" ?>" target="_blank">
                                                            <center>
                                                                <i class="fab fa-cpanel fa-2x"></i>
                                                                <h6>cPanel</h6>
                                                            </center>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 icone">
                                                        <a href="<?php echo URL . "webmail" ?>" target="_blank">
                                                            <center>
                                                                <i class="fas fa-at fa-2x"></i>
                                                                <h6>Webmail</h6>
                                                            </center>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 icone">
                                                        <a href="https://analytics.google.com/" target="_blank">
                                                            <center>
                                                                <i class="fas fa-chart-line fa-2x"></i>
                                                                <h6>Analytics</h6>
                                                            </center>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 icone">
                                                        <a href="https://search.google.com/search-console" target="_blank">
                                                            <center>
                                                                <i class="fab fa-searchengin fa-2x"></i>
                                                                <h6>Search Console</h6>
                                                            </center>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 icone">
                                                        <a href="https://business.google.com/dashboard" target="_blank">
                                                            <center>
                                                                <i class="fas fa-store-alt fa-2x"></i>
                                                                <h6>Meu Negócio</h6>
                                                            </center>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo URL ?>wdadmin/uploads/usuarios/<?php echo $_COOKIE['wd_imagem_perfil'] ?>" alt="user" class="profile-pic" /></a>
                                    <div class="dropdown-menu dropdown-menu-right scale-up">
                                        <ul class="dropdown-user">
                                            <li>
                                                <div class="dw-user-box">
                                                    <div class="u-img"><img src="<?php echo URL ?>wdadmin/uploads/usuarios/<?php echo $_COOKIE['wd_imagem_perfil'] ?>" alt="user"></div>
                                                    <div class="u-text">
                                                        <h4><?php echo $_COOKIE['wd_nome'] ?></h4>
                                                        <p class="text-muted"><?php echo $_COOKIE['wd_login'] ?></p>
                                                        <input type="hidden" id="id_usuario_logado" value="<?php echo $_COOKIE['wd_id_usuario'] ?>"/>
                                                    </div>
                                                </div>
                                            </li>
                                            <li role="separator" class="divider"></li>
                                            <li><a onclick="ver_perfil_usuario($('#id_usuario_logado').val())"><i class="fas fa-user-circle fa-fw"></i> Perfil</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li id="abre_modal_sair"><a><i class="fas fa-sign-out-alt fa-fw"></i> Sair</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>

                <?php /* MENU ESQUERDO */ ?>
                <aside class="left-sidebar">
                    <div class="scroll-sidebar">
                        <div class="user-profile">
                            <div class="profile-img">
                                <img src="<?php echo URL ?>wdadmin/uploads/informacoes_gerais/<?php echo $_COOKIE['wd_logo_principal'] ?>" />
                            </div>
                        </div>
                        <nav class="sidebar-nav">
                            <ul id="sidebarnav">
                                <li class="nav-small-cap">MENU</li>
                                <li><a class="waves-effect waves-dark" href="<?php echo URL ?>wdadmin/inicio"><i class="mdi mdi-home"></i><span class="hide-menu">Inicio</span></a></li>
                                <li>
                                    <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-store"></i><span class="hide-menu">Empresa</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="<?php echo URL ?>wdadmin/sobre">Sobre</a></li>
                                        <li><a href="<?php echo URL ?>wdadmin/missao-visao-valores">Missão, Visão e Valores</a></li>
                                        <li><a href="<?php echo URL ?>wdadmin/equipe">Equipe</a></li>
                                        <li><a href="<?php echo URL ?>wdadmin/enderecos">Endereços</a></li>
                                        <li><a href="<?php echo URL ?>wdadmin/redes-sociais">Redes Sociais</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Conteúdo Personalizado</span></a>
                                    <ul id="lista_conteudo_personalizado" aria-expanded="false" class="collapse"></ul>
                                </li>
                                <li id="menu_banners_slideshow"><a class="waves-effect waves-dark" href="<?php echo URL ?>wdadmin/banners-slideshow"><i class="mdi mdi-image"></i><span class="hide-menu">Banners Slideshow</span></a></li>
                                <li id="menu_central_servicos">
                                    <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-widgets"></i><span class="hide-menu">Central de Serviços</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="<?php echo URL ?>wdadmin/servicos">Serviços</a></li>
                                        <li><a href="<?php echo URL ?>wdadmin/perguntas-frequentes">Perguntas Frequentes</a></li>
                                    </ul>
                                </li>
                                <li id="menu_relacao_cliente">
                                    <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-account-star-variant"></i><span class="hide-menu">Relação com Clientes</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="<?php echo URL ?>wdadmin/clientes">Clientes</a></li>
                                        <li><a href="<?php echo URL ?>wdadmin/cases">Cases</a></li>
                                        <li><a href="<?php echo URL ?>wdadmin/depoimentos">Depoimentos</a></li>
                                    </ul>
                                </li>
                                <li id="menu_galeria">
                                    <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-image-multiple"></i><span class="hide-menu">Galeria</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="<?php echo URL ?>wdadmin/galeria-grupos">Grupos</a></li>
                                        <li><a href="<?php echo URL ?>wdadmin/galeria-imagens">Imagens</a></li>
                                    </ul>
                                </li>
                                <li id="menu_vitrine">
                                    <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-cart"></i><span class="hide-menu">Vitrine</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="<?php echo URL ?>wdadmin/vitrine-grupos">Grupos</a></li>
                                        <li><a href="<?php echo URL ?>wdadmin/vitrine-subgrupos">Subgrupos</a></li>
                                        <li><a href="<?php echo URL ?>wdadmin/vitrine-produtos">Produtos</a></li>
                                    </ul>
                                </li>
                                <li id="menu_eventos"><a class="waves-effect waves-dark" href="<?php echo URL ?>wdadmin/eventos"><i class="mdi mdi-calendar-check"></i><span class="hide-menu">Eventos</span></a></li>
                                <li id="menu_blog">
                                    <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-library-books"></i><span class="hide-menu">Blog</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="<?php echo URL ?>wdadmin/blog-categorias">Categorias</a></li>
                                        <li><a href="<?php echo URL ?>wdadmin/blog-postagens">Postagens</a></li>
                                        <li><a href="<?php echo URL ?>wdadmin/blog-imagens">Imagens</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-wrench"></i><span class="hide-menu">Ferramentas</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="<?php echo URL ?>wdadmin/informacoes-gerais">Informações Gerais</a></li>
                                        <li><a href="<?php echo URL ?>wdadmin/contatos-recebidos">Contatos Recebidos</a></li>
                                        <li><a href="<?php echo URL ?>wdadmin/orcamentos-recebidos">Orçamentos Recebidos</a></li>
                                        <li><a href="<?php echo URL ?>wdadmin/usuario-cliente">Usuário Cliente</a></li>
                                    </ul>
                                </li>
                                <?php if ($_COOKIE['wd_id_usuario'] == 1) { ?>
                                    <li>
                                        <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Adiminstrador</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="<?php echo URL ?>wdadmin/usuarios">Usuários</a></li>
                                            <li><a href="<?php echo URL ?>wdadmin/tamanho-imagens">Tamanho Imagens</a></li>
                                            <li><a href="<?php echo URL ?>wdadmin/acessos">Acessos</a></li>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                </aside>

                <?php /* CORPO PÁGINAS */ ?>
                <div class="page-wrapper">
                    <?php
                    if (isset($Url[0]) && isset($Url[1])) {
                        $pagina = $Url[0] . "-" . $Url[1];
                        $id = (isset($Url[2])) ? $Url[2] : "";
                    } else if (isset($Url[0])) {
                        $pagina = $Url[0];
                        $id = "";
                    } else {
                        $pagina = "inicio";
                        $id = "";
                    }

                    if (file_exists("views/$pagina.php")) {
                        include "views/$pagina.php";
                    } else {
                        include "views/404.php";
                    }
                    ?>
                    <footer class="footer"><?php echo date("Y") ?> © Web Dezan</footer>
                </div>
            </div>

            <!-- MODAL VER PERFIL -->
            <div class="modal fade" id="modal_ver_perfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal_titulo_nome_usuario"></h4>
                        </div>
                        <form id="form_perfil_usuario" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="container">
                                    <input type="hidden" id="inputIdUsuarioPerfilUsuario" name="inputIdUsuarioPerfilUsuario" />
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Nome *</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" id="inputNomePerfilUsuario" name="inputNomePerfilUsuario" placeholder="ex.: José da Silva" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Imagem Perfil *</label>
                                        <div class="col-sm-2">
                                            <center>
                                                <img id="imgImagemPerfilAtualPerfilUsuario" src="" class="img-fluid rounded-circle">
                                                <input type="hidden" id="inputImagemPerfilAtualPerfilUsuario" name="inputImagemPerfilAtualPerfilUsuario" />
                                            </center>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="file" class="dropify" id="inputImagemPerfilPerfilUsuario" name="inputImagemPerfilPerfilUsuario" data-height="98" accept=".jpg, .jpeg, .png" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save" aria-hidden="true"></i>&nbsp;Salvar</button>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!--MODAL VISUALIZAR CONTATO-->
            <div class="modal fade" id="modal_visualizar_contato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="far fa-eye fa-fw"></i> Visualizar Contato</h5>
                        </div>
                        <div class="modal-body">
                            <p><small>Recebido em <span id="vsDataRecebimento"></span></small></p>
                            <p><b>Nome: </b> <span id="vsNome"></span></p>
                            <p><b>E-mail: </b> <span id="vsEmail"></span></p>
                            <p><b>Telefone: </b> <span id="vsTelefone"></span></p>
                            <p><b>Assunto: </b> <span id="vsAssunto"></span></p>
                            <p><b>Mensagem: </b><br/><span id="vsMensagem"></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--MODAL VISUALIZAR CONTATO-->
            <div class="modal fade" id="modal_visualizar_orcamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="far fa-eye fa-fw"></i> Visualizar solicitação de orçamento</h5>
                        </div>
                        <div class="modal-body">
                            <p><small>Recebido em <span id="data-recebimento"></span></small></p>
                            <p><b>Nome: </b> <span id="orcamento-nome"></span></p>
                            <p><b>Cidade-UF: </b> <span id="orcamento-cidade"></span></p>
                            <p><b>E-Mail: </b> <span id="orcamento-email"></span></p>
                            <p><b>Gasto médio mensal: </b> <span id="orcamento-gasto"></span></p>
                            <p><b>Telefone: </b> <span id="orcamento-telefone"></span></p>
                            <b><p>Anexo: <a id="orcamento-anexo" target="_blank">Clique aqui para acessar o anexo</a></p></b>
                            <p><b>Mensagem: </b> <span id="orcamento-mensagem"></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--MODAL EXCLUIR ARQUIVO-->
            <div class="modal fade" id="modal_confirma_exclusao_arquivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="far fa-trash-alt fa-fw"></i> Exluir Arquivo</h5>
                        </div>
                        <div class="modal-body">
                            Deseja realmente excluir este arquivo?
                            <input type="hidden" id="id_arquivo_excluido" />
                            <input type="hidden" id="tabela" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success btn-sm" id="botao_confirma_exclusao"><i class="fas fa-check" aria-hidden="true"></i>&nbsp;Sim</button>
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-times" aria-hidden="true"></i>&nbsp;Não</button>
                        </div>
                    </div>
                </div>
            </div>

        </body>
    </html>
    <?php
else:
    header("Location: " . URL);
endif;