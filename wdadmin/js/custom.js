$(function () {
    "use strict";
    $(function () {
        $(".preloader").fadeOut();
    });
    jQuery(document).on('click', '.mega-dropdown', function (e) {
        e.stopPropagation()
    });
    // ============================================================== 
    // This is for the top header part and sidebar part
    // ==============================================================  
    var set = function () {
        var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
        var topOffset = 70;
        if (width < 3170) {
            $("body").addClass("mini-sidebar");
            $('.navbar-brand span').hide();
            $(".scroll-sidebar, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible");
            $(".sidebartoggler i").addClass("ti-menu");
        } else {
            $("body").removeClass("mini-sidebar");
            $('.navbar-brand span').show();
            //$(".sidebartoggler i").removeClass("ti-menu");
        }

        var height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1)
            height = 1;
        if (height > topOffset) {
            $(".page-wrapper").css("min-height", (height) + "px");
        }

    };
    $(window).ready(set);
    $(window).on("resize", set);
    // ============================================================== 
    // Theme options
    // ==============================================================     
    $(".sidebartoggler").on('click', function () {
        if ($("body").hasClass("mini-sidebar")) {
            $("body").trigger("resize");
            $(".scroll-sidebar, .slimScrollDiv").css("overflow", "hidden").parent().css("overflow", "visible");
            $("body").removeClass("mini-sidebar");
            $('.navbar-brand span').show();
            //$(".sidebartoggler i").addClass("ti-menu");
        } else {
            $("body").trigger("resize");
            $(".scroll-sidebar, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible");
            $("body").addClass("mini-sidebar");
            $('.navbar-brand span').hide();
            //$(".sidebartoggler i").removeClass("ti-menu");
        }
    });
    // topbar stickey on scroll

    $(".fix-header .topbar").stick_in_parent({});


    // this is for close icon when navigation open in mobile view
    $(".nav-toggler").click(function () {
        $("body").toggleClass("show-sidebar");
        $(".nav-toggler i").toggleClass("mdi mdi-menu");
        $(".nav-toggler i").addClass("mdi mdi-close");
    });

    $(".search-box a, .search-box .app-search .srh-btn").on('click', function () {
        $(".app-search").toggle(200);
    });
    // ============================================================== 
    // Right sidebar options
    // ============================================================== 
    $(".right-side-toggle").click(function () {
        $(".right-sidebar").slideDown(50);
        $(".right-sidebar").toggleClass("shw-rside");
    });

    $('.floating-labels .form-control').on('focus blur', function (e) {
        $(this).parents('.form-group').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
    }).trigger('blur');

    // ============================================================== 
    // Auto select left navbar
    // ============================================================== 
    $(function () {
        var url = window.location;
        var element = $('ul#sidebarnav a').filter(function () {
            return this.href == url;
        }).addClass('active').parent().addClass('active');
        while (true) {
            if (element.is('li')) {
                element = element.parent().addClass('in').parent().addClass('active');
            } else {
                break;
            }
        }

    });
    // ============================================================== 
    //tooltip
    // ============================================================== 
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    // ============================================================== 
    //Popover
    // ============================================================== 
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
    // ============================================================== 
    // Sidebarmenu
    // ============================================================== 
    $(function () {
        $('#sidebarnav').metisMenu();
    });

    // ============================================================== 
    // Slimscrollbars
    // ============================================================== 
    $('.scroll-sidebar').slimScroll({
        position: 'left',
        size: "5px",
        height: '100%',
        color: '#dcdcdc'
    });
    $('.message-center').slimScroll({
        position: 'right',
        size: "5px"

        ,
        color: '#dcdcdc'
    });


    $('.aboutscroll').slimScroll({
        position: 'right',
        size: "5px",
        height: '80',
        color: '#dcdcdc'
    });
    $('.message-scroll').slimScroll({
        position: 'right',
        size: "5px",
        height: '570',
        color: '#dcdcdc'
    });
    $('.chat-box').slimScroll({
        position: 'right',
        size: "5px",
        height: '470',
        color: '#dcdcdc'
    });

    $('.slimscrollright').slimScroll({
        height: '100%',
        position: 'right',
        size: "5px",
        color: '#dcdcdc'
    });

    // ============================================================== 
    // Resize all elements
    // ============================================================== 
    $("body").trigger("resize");
    // ============================================================== 
    // To do list
    // ============================================================== 
    $(".list-task li label").click(function () {
        $(this).toggleClass("task-done");
    });

    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function () {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });

    // ============================================================== 
    // Collapsable cards
    // ==============================================================
    $('a[data-action="collapse"]').on('click', function (e) {
        e.preventDefault();
        $(this).closest('.card').find('[data-action="collapse"] i').toggleClass('ti-minus ti-plus');
        $(this).closest('.card').children('.card-block').collapse('toggle');

    });
    // Toggle fullscreen
    $('a[data-action="expand"]').on('click', function (e) {
        e.preventDefault();
        $(this).closest('.card').find('[data-action="expand"] i').toggleClass('mdi-arrow-expand mdi-arrow-compress');
        $(this).closest('.card').toggleClass('card-fullscreen');
    });

    // Close Card
    $('a[data-action="close"]').on('click', function () {
        $(this).closest('.card').removeClass().slideUp('fast');
    });

});

$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*FORM PERFIL USUÁRIO*/
    $("#form_perfil_usuario").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosPerfilUsuario.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                CloseLoading();
                $("#modal_ver_perfil").modal("hide");
                /*LIMPA AREA DE IMAGEM*/
                $(".dropify-clear").click();
                if (data > 0) {
                    Sucesso();
                } else {
                    Aviso();
                }
            },
            error: function () {
                CloseLoading();
                Erro();
            }
        });
        return false;
    }));

    $('#abre_modal_sair').click(function () {
        swal({
            title: "Você deseja realmente sair do WD Admin?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sim, quero sair.",
            closeOnConfirm: false
        }, function () {
            logoff();
        });
    });

    $('.dropify').dropify();

    verifica_acessos();
    lista_conteudo_personalizado_menu();

});

function AtualizaIdUrl(id) {
    window.history.pushState({url: "" + $(this).attr('href')}, $(this).attr('title'), "cadastro/" + id);
}

function Loading() {
    $(".preloader").fadeIn();
}
function CloseLoading() {
    $(".preloader").fadeOut();
}
function Sucesso() {
    swal("Parabéns!", "Dados salvos com sucesso.", "success");
}
function Aviso() {
    swal("Aviso!", "Ocorreu um erro ao salvar os dados.", "warning");
}
function Erro() {
    swal("Erro!", "Se o problema persistir contate o T.I.", "error");
}
function AvisoPersonalizado(mensagem) {
    swal("Aviso!", mensagem, "warning");
}

/*MONTA SELECT*/
function monta_select(componente, id, campo, tabela, filtro, ordem, selecionado, todos, nenhum) {

    $('#' + componente + ' option[value!="0"]').remove();

    $.ajax({
        url: vsUrl + "controllers/MontaSelect.php",
        type: 'POST',
        dataType: "json",
        async: false,
        data: ({
            viId: id,
            vsCampo: campo,
            vsTabela: tabela,
            vsFiltro: filtro,
            vsOrdem: ordem
        }),
        success: function (data) {
            if (todos === true) {
                $("#" + componente + "").append($("<option>", {
                    value: "T",
                    text: "Todos"
                }));
            }
            if (nenhum === true) {
                $("#" + componente + "").append($("<option>", {
                    value: "0",
                    text: "Nenhum"
                }));
            }
            if (data !== 0) {
                var i;
                for (i = 0; i < data.length; i++) {
                    if (data[i].id === selecionado) {
                        $("#" + componente + "").append($("<option>", {
                            value: data[i].id,
                            text: data[i].texto,
                            selected: true
                        }));
                    } else {
                        $("#" + componente + "").append($("<option>", {
                            value: data[i].id,
                            text: data[i].texto
                        }));
                    }
                }
            }
        },
        error: function () {
            Erro();
        }
    });

}

function ver_perfil_usuario(viIdUsuario) {

    Loading();

    $.ajax({
        url: vsUrl + "controllers/RetornaUsuarioSelecionado.php",
        type: "POST",
        dataType: "json",
        data: ({
            viIdUsuario: viIdUsuario
        }),
        success: function (data) {
            $("#modal_titulo_nome_usuario").text("");
            if (data !== 0) {
                $("#inputIdUsuarioPerfilUsuario").val(viIdUsuario);
                $("#inputNomePerfilUsuario").val(data[0].nome);
                $("#imgImagemPerfilAtualPerfilUsuario").attr("src", vsUrl + "uploads/usuarios/" + data[0].imagem_perfil);
                $("#inputImagemPerfilAtualPerfilUsuario").val(data[0].imagem_perfil);
                CloseLoading();
                $("#modal_titulo_nome_usuario").text("Perfil de " + data[0].nome);
                $("#modal_ver_perfil").modal("show");
            } else {
                CloseLoading();
                AvisoPersonalizado("Dados não encontrados!");
            }
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}

function lista_conteudo_personalizado_menu() {

    $.ajax({
        url: vsUrl + "controllers/RetornaConteudoPersonalizado.php",
        type: "POST",
        dataType: "json",
        success: function (data) {
            $("#lista_conteudo_personalizado").html("");
            $("#lista_conteudo_personalizado").append("<li><a href=\"" + vsUrl + "titulos-personalizados\">Títulos Personalizados</a></li>");
            $("#lista_conteudo_personalizado").append("<li><a href=\"" + vsUrl + "conteudo-personalizado-gerenciamento\">Gerenciamento</a></li>");
            if (data != 0) {
                for (i = 0; i < data.length; i++) {
                    $("#lista_conteudo_personalizado").append("<li onclick=\"set_id_conteudo_personalizado_session('" + data[i].id_conteudo_personalizado + "', '" + data[i].titulo + "', '" + data[i].imagem_largura + "', '" + data[i].imagem_altura + "')\"><a href=\"" + vsUrl + "informacoes\">" + data[i].titulo + "</a></li>");
                }
            }
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}

function verifica_acessos() {

    $.ajax({
        url: vsUrl + "controllers/RetornaAcessosBloqueados.php",
        type: "POST",
        dataType: "json",
        success: function (data) {
            if (data != 0) {
                for (i = 0; i < data.length; i++) {
                    $("#" + data[i].funcao + "").hide();
                }
            }
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}

function set_id_conteudo_personalizado_session(vsId, vsTitulo, vsImagemLargura, vsImagemAltura) {
    $.ajax({
        type: 'POST',
        url: vsUrl + "controllers/SetIdPaginaSession.php",
        async: false,
        data: {'id': vsId, 'titulo': vsTitulo, 'largura': vsImagemLargura, 'altura': vsImagemAltura}
    });
}

/*ABRE MODAL PARA CONFIRMAR A EXCLUSÃO DO ARQUIVO*/
function confirma_exclusao_registro(IdRegistro, vsTabela, vsPasta, vsArquivoAtual, vsArquivoAtual2, vsArquivoAtual3, vsArquivoAtual4, vsArquivoAtual5) {
    swal({
        title: "Atenção!",
        text: "Você realmente deseja excluir este registro?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim, quero excluir!",
        closeOnConfirm: false
    }, function () {
        exclui_registro(IdRegistro, vsTabela, vsPasta, vsArquivoAtual, vsArquivoAtual2, vsArquivoAtual3, vsArquivoAtual4, vsArquivoAtual5);
    });
}

/*EXCLUI REGISTRO*/
function exclui_registro(IdRegistro, vsTabela, vsPasta, vsArquivoAtual, vsArquivoAtual2, vsArquivoAtual3, vsArquivoAtual4, vsArquivoAtual5) {

    Loading();

    $.ajax({
        url: vsUrl + "controllers/ExcluiRegistro.php",
        type: "POST",
        dataType: "json",
        data: ({
            IdRegistro: IdRegistro,
            vsTabela: vsTabela,
            vsPasta: vsPasta,
            vsArquivoAtual: vsArquivoAtual,
            vsArquivoAtual2: vsArquivoAtual2,
            vsArquivoAtual3: vsArquivoAtual3,
            vsArquivoAtual4: vsArquivoAtual4,
            vsArquivoAtual5: vsArquivoAtual5
        }),
        success: function (data) {
            if (data === 1) {
                if (vsTabela === "banner") {
                    carrega_banners_slideshow();
                } else if (vsTabela === "galeria_imagem") {
                    carrega_galeria_imagens();
                } else if (vsTabela === "enderecos") {
                    carrega_enderecos();
                } else if (vsTabela === "blog_postagem") {
                    carrega_blog_postagens();
                } else if (vsTabela === "depoimentos") {
                    carrega_depoimentos();
                } else if (vsTabela === "cases") {
                    carrega_cases();
                } else if (vsTabela === "servicos") {
                    carrega_servicos();
                } else if (vsTabela === "solucoes") {
                    consulta_solucoes();
                } else if (vsTabela === "perguntas_frequentes") {
                    carrega_perguntas_frequentes();
                } else if (vsTabela === "informacoes") {
                    carrega_informacoes();
                } else if (vsTabela === "blog_imagens") {
                    carrega_blog_imagens();
                } else if (vsTabela === "vitrine_produto_cores") {
                    consulta_cores_produtos();
                } else if (vsTabela === "equipe_contato") {
                    consulta_contato_equipe();
                } else if (vsTabela === "blog_postagem_galeria") {
                    consulta_blog_postagem_galeria();
                } else if (vsTabela === "redes_sociais") {
                    carrega_redes_sociais();
                } else if (vsTabela === "tamanho_imagens") {
                    carrega_tamanho_imagens();
                } else if (vsTabela === "acessos") {
                    carrega_acessos();
                }
                swal("Parabéns!", "Registro deletado com sucesso.", "success");
            } else {
                Aviso();
            }
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });

}

/*ABRE MODAL VISUALIZAR CONTATO*/
function abre_modal_visualizar_contato(viIdContatosRecebidos, vsDataRecebimento, vsNome, vsEmail, vsTelefone, vsAssunto, vsMensagem) {
    $("#vsDataRecebimento").html(vsDataRecebimento);
    $("#vsNome").html(vsNome);
    $("#vsEmail").html(vsEmail);
    $("#vsTelefone").html(vsTelefone);
    $("#vsAssunto").html(vsAssunto);
    $("#vsMensagem").html(vsMensagem);
    atualiza_status_contatos_recebidos(viIdContatosRecebidos);
    $("#modal_visualizar_contato").modal("show");
}


/*ABRE MODAL VISUALIZAR CURRÍCULO*/
function abre_modal_visualizar_orcamento(viIdOrcamentosRecebidos, data_recebimento, orcamento_nome, orcamento_cidade, orcamento_email, orcamento_gasto, orcamento_telefone, orcamento_anexo, orcamento_mensagem) {
    $("#data-recebimento").html(data_recebimento);
    $("#orcamento-nome").html(orcamento_nome);
    $("#orcamento-cidade").html(orcamento_cidade);
    $("#orcamento-email").html(orcamento_email);
    $("#orcamento-gasto").html(orcamento_gasto);
    $("#orcamento-telefone").html(orcamento_telefone);
    $("#orcamento-anexo").html(orcamento_anexo);
    $("#orcamento-mensagem").html(orcamento_mensagem);
    atualiza_status_orcamentos(viIdOrcamentosRecebidos);
    $("#modal_visualizar_orcamento").modal("show");
    document.getElementById("orcamento-anexo").setAttribute("href", "uploads/orcamentos/" + orcamento_anexo);
}

/*ATUALIZA STATUS CONTATOS RECEBIDOS*/
function atualiza_status_contatos_recebidos(viIdContatosRecebidos) {

    $.ajax({
        url: vsUrl + "controllers/AtualizaStatusContatosRecebidos.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdContatosRecebidos: viIdContatosRecebidos
        }),
        success: function (data) {
            if (data == 0) {
                AvisoPersonalizado("Status não atualizado!");
            }
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}

/*ATUALIZA STATUS SOLICITAÇÕES DE PLANOS EMPRESARIAIS RECEBIDOS*/
function atualiza_status_orcamentos(viIdOrcamentosRecebidos) {

    $.ajax({
        url: vsUrl + "controllers/AtualizaStatusOrcamentosRecebidos.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdOrcamentosRecebidos: viIdOrcamentosRecebidos
        }),
        success: function (data) {
            if (data == 0) {
                AvisoPersonalizado("Status não atualizado!");
            }
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}

/*ABRE MODAL PARA CONFIRMAR A ENVIO DE NEWSLETTER*/
function confirma_envio_newsletter(IdRegistro) {
    swal({
        title: "Atenção!",
        text: "Você realmente deseja enviar newsletter deste registro?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim, quero enviar!",
        closeOnConfirm: false
    }, function () {
        swal.close();
        envia_newsletter(IdRegistro);
    });
}

/*ENVIA NEWSLETTER*/
function envia_newsletter(IdRegistro) {

    Loading();

    $.ajax({
        url: vsUrl + "controllers/EnviaEmailNewsletter.php",
        type: "POST",
        dataType: "json",
        data: ({
            IdRegistro: IdRegistro
        }),
        success: function (data) {
            CloseLoading();
            if (data === 1) {
                swal("Parabéns!", "E-mail(s) enviado(s) com sucesso.", "success");
            } else if (data === 2) {
                AvisoPersonalizado("Nenhuma conta de e-mail para enviar!");
            } else {
                Aviso();
            }
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });

}

/*FUNÇÃO QUE VERIFICA O TAMANHO DA IMAGEM*/
function verifica_tamanho_imagens(vsNomeTabela) {

    $.ajax({
        url: vsUrl + "controllers/RetornaTamanhoImagensTela.php",
        type: "POST",
        dataType: "json",
        data: ({
            vsNomeTabela: vsNomeTabela
        }),
        success: function (data) {
            if (data !== 0) {
                largura = data[0].largura;
                altura = data[0].altura;
                $(".fileHelp").html("Dimensão: " + largura + "x" + altura + "px. (Deixe em branco para manter o arquivo atual)");

                $(data[0].campo).change(function () {

                    if (this.files[0].size > 2000000) {
                        AvisoPersonalizado("A imagem não pode ter mais que 2MB de tamanho.");
                        $("#botao_salvar").attr("disabled", true);
                    } else {
                        var fr = new FileReader;

                        fr.onload = function () {
                            var img = new Image;

                            img.onload = function () {
                                if (img.width != "" + largura + "" && this.height != "" + altura + "") {
                                    AvisoPersonalizado("A imagem não está no tamanho adequado. Dimensão exata: " + largura + "x" + altura + " pixels.");
                                    $("#botao_salvar").attr("disabled", true);
                                } else {
                                    $("#botao_salvar").removeAttr("disabled");
                                }
                            };
                            img.src = fr.result;
                        };
                        fr.readAsDataURL(this.files[0]);
                    }
                });
            }
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}

/*FUNÇÃO FAZ LOGOFF DO USUARIO*/
function logoff() {

    $.ajax({
        url: vsUrl + "controllers/LogoffUsuarios.php",
        type: "POST",
        dataType: "json",
        success: function (data) {
            if (data == 1) {
                $(location).attr('href', vsUrl + "wdadmin");
            } else {
                AvisoPersonalizado("Ocorreu um erro ao tentar fazer logoff no WD Admin");
            }
        },
        error: function () {
            Erro();
        }
    });
}