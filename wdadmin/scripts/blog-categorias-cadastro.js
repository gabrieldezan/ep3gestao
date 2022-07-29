$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Categorias do Blog");

    /*BOTÃO NOVO*/
    $("#botao_nova_subcategoria_blog").click(function (e) {
        limpa_form_subcategorias();
    });

    $("#form_blog_categorias").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosBlogCategorias.php",
            type: "POST",
            async: true,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdCategoriasBlog").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdCategoriasBlog").val(data);
                    $("#inputIdCategoriasSubBlog").val(data);
                    verifica_edicao();
                    Sucesso();
                } else {
                    CloseLoading();
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

    $("#form_blog_subcategorias").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosBlogSubcategorias.php",
            type: "POST",
            async: true,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdSubcategoriasBlog").val(data);
                    consulta_blog_subcategorias();
                    Sucesso();
                } else {
                    CloseLoading();
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

    /*CHAMA FUNÇÃO PARA VERIFICAR EDIÇÃO OU CADASTRO*/
    verifica_edicao();

});

/*FUNÇÃO QUE VERIFICA SE EXISTE UM ID*/
function verifica_edicao() {

    /*PEGA ID*/
    var id = $("#inputIdCategoriasBlog").val();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_blog_categorias(id);
        consulta_blog_subcategorias();
        $('ul li a[href="#subcategorias"]').removeClass("disabled");
    } else {
        $('ul li a[href="#subcategorias"]').addClass("disabled");
        CloseLoading();
    }
}

/*CARREGA DADOS DO USUÁRIO SELECIONADO*/
function edita_blog_categorias(viIdCategoriasBlog) {

    $.ajax({
        url: vsUrl + "controllers/RetornaBlogCategoriasSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdCategoriasBlog: viIdCategoriasBlog
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputDescricao").val(data[0].descricao);
                $("#inputPosicao").val(data[0].posicao);
                $("#inputStatus").val(data[0].status);
            } else {
                AvisoPersonalizado("Dados não encontrados!");
                $("#inputIdCategoriasBlog").val("");
            }
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}

/*CARREGA SUBCATEGORIAS*/
function consulta_blog_subcategorias() {

    var viIdCategoria = $("#inputIdCategoriasBlog").val();

    $.ajax({
        url: vsUrl + "controllers/RetornaBlogSubcategorias.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdCategoria: viIdCategoria
        }),
        success: function (data) {
            if (data != 0) {

                $("#tabela_subcategorias tbody").html("");
                for (i = 0; i < data.length; i++) {
                    $("#tabela_subcategorias tbody").append(
                            "<tr>" +
                            "<td>" + data[i].descricao + "</td>" +
                            "<td>" + data[i].posicao + "</td>" +
                            "<td><span class=\"label label-" + data[i].status_class + "\">" + data[i].status + "</span></td>" +
                            "<td align=\"center\">" +
                            "<button type=\"button\" class=\"btn btn-secondary btn-sm\" onclick=\"edita_blog_subcategorias(" + data[i].id_blog_subcategorias + ")\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar subcategoria " + data[i].descricao + "\"><i class=\"far fa-edit fa-fw\" aria-hidden=\"true\"></i></button>&nbsp;" +
                            "</td>" +
                            "</tr>"
                            );
                    $('[data-toggle="tooltip"]').tooltip();
                    CloseLoading();
                }
            } else {
                $("#tabela_subcategorias tbody").html("");
                $("#tabela_subcategorias tbody").append(
                        "<tr>" +
                        "<td align=\"center\" colspan=\"10\">Nenhuma subcategoria encontrada!</td>" +
                        "</tr>"
                        );
                CloseLoading();
            }
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}

/*CARREGA DADOS DO USUÁRIO SELECIONADO*/
function edita_blog_subcategorias(viIdBlogSubCategorias) {

    $.ajax({
        url: vsUrl + "controllers/RetornaBlogSubCategoriasSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdBlogSubCategorias: viIdBlogSubCategorias
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputIdSubcategoriasBlog").val(viIdBlogSubCategorias);
                $("#inputDescricaoSub").val(data[0].descricao);
                $("#inputPosicaoSub").val(data[0].posicao);
                $("#inputStatusSub").val(data[0].status);
                CloseLoading();
            } else {
                $("#inputIdSubcategoriasBlog").val("");
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

/*LIMPA FORMULÁRIO SUBGRUPOS*/
function limpa_form_subcategorias() {
    $("#inputIdSubcategoriasBlog").val("");
    $("#inputDescricaoSub").val("");
    $("#inputPosicaoSub").val("");
    $("#inputStatusSub").val("1");
}