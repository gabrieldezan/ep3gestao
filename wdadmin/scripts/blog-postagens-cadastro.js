$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Postagens do Blog");

    verifica_tamanho_imagens("blog_postagem");

    if ($("#inputTexto").length > 0) {
        tinymce.init({
            selector: "textarea#inputTexto",
            language: 'pt_BR',
            language_url: vsUrl + '/js/pt_BR.js',
            theme: "modern",
            height: 570,
            width: '100%',
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }

    monta_select("inputIdBlogCategorias", "id_blog_categorias", "descricao", "blog_categorias", "WHERE status = 1", "descricao", "", false);
    monta_select("inputIdBlogSubCategorias", "id_blog_subcategorias", "descricao", "blog_subcategorias", "WHERE status = 1 AND id_blog_categorias = " + $("#inputIdBlogCategorias").val(), "descricao", "", false);

    /*CARREGA SUBGRUPOS AO SELECIONAR O GRUPO*/
    $("#inputIdBlogCategorias").change(function () {
        if ($("#inputIdBlogCategorias").val() !== "T") {
            monta_select("inputIdBlogSubCategorias", "id_blog_subcategorias", "descricao", "blog_subcategorias", "WHERE status = 1 AND id_blog_categorias = " + $("#inputIdBlogCategorias").val(), "descricao", "", false);
        } else {
            $('#inputIdBlogSubCategorias option[value!="T"]').remove();
        }
    });
    
    /*BOTÃO NOVA IMAGEM*/
    $("#botao_nova_imagem_galeria").click(function (e) {
        limpa_form_blog_postagem_galeria();
    });

    $("#form_blog_postagens").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosBlogPostagens.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdBlogPostagens").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdBlogPostagens").val(data);
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
    
    
    /*SUBMETE FORM GALERIA POST*/
    $("#form_blog_postagem_galeria").on('submit', (function (e) {

        if ($("#inputImagemGaleria").val() === "" && $("#inputImagemGaleriaAtual").val() === "") {
            AvisoPersonalizado("Insira a Imagem!");
            return false;
        }

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosBlogPostagensGaleria.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    limpa_form_blog_postagem_galeria();
                    consulta_blog_postagem_galeria();
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
    var id = $("#inputIdBlogPostagens").val();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_blog_postagem(id);
        consulta_blog_postagem_galeria();
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DO USUÁRIO SELECIONADO*/
function edita_blog_postagem(viIdBlogPostagens) {

    $.ajax({
        url: vsUrl + "controllers/RetornaBlogPostagensSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdBlogPostagens: viIdBlogPostagens
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputTitulo").val(data[0].titulo);
                $("#inputImagemAtual").val(data[0].imagem);
                $("#imgImagemAtual").attr("src", vsUrl + "uploads/blog_postagens/" + data[0].imagem);
                $("#inputIdBlogCategorias").val(data[0].id_blog_categorias);
                monta_select("inputIdBlogSubCategorias", "id_blog_subcategorias", "descricao", "blog_subcategorias", "WHERE status = 1 AND id_blog_categorias = " + data[0].id_blog_categorias, "descricao", data[0].id_blog_subcategorias, false);
                $("#inputDataPublicacao").val(data[0].data_publicacao);
                $("#inputVideo").val(data[0].video);
                $("#inputTexto").val(data[0].texto);
                CloseLoading();
            } else {
                $("#inputIdBlogPostagens").val("");
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


/*CARREGA IMAGENS GALERIA DO POST*/
function consulta_blog_postagem_galeria() {

    var viIdBlogPostagem = $("#inputIdBlogPostagem").val();

    $.ajax({
        url: vsUrl + "controllers/RetornaBlogPostagensGaleria.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdBlogPostagem: viIdBlogPostagem
        }),
        success: function (data) {
            if (data != 0) {

                $("#tabela_galeria_post tbody").html("");
                for (i = 0; i < data.length; i++) {
                    $("#tabela_galeria_post tbody").append(
                            "<tr>" +
                            "<td>" + data[i].descricao + "</td>" +
                            "<td><img src='" + vsUrl + "uploads/blog_postagens_galeria/" + data[i].imagem + "' class='img-fluid' style='height:35px'></td>" +
                            "<td align=\"center\">" +
                            "<button type=\"button\" class=\"btn btn-secondary btn-sm\" onclick=\"edita_blog_postagem_galeria(" + data[i].id_blog_postagem_galeria + ")\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar imagem " + data[i].descricao + "\"><i class=\"far fa-edit fa-fw\" aria-hidden=\"true\"></i></button>&nbsp;" +
                            "<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"confirma_exclusao_registro(" + data[i].id_blog_postagem_galeria + ", 'blog_postagem_galeria', 'blog_postagens_galeria', '" + data[i].imagem + "', '', '', '', '');\" data-toggle=\"tooltip\" title=\"Remover " + data[i].descricao + "\"><i class=\"far fa-trash-alt fa-fw\" aria-hidden=\"true\"></i></button>" +
                            "</td>" +
                            "</tr>"
                            );
                    $('[data-toggle="tooltip"]').tooltip();
                    CloseLoading();
                }
            } else {
                $("#tabela_galeria_post tbody").html("");
                $("#tabela_galeria_post tbody").append(
                        "<tr>" +
                        "<td align=\"center\" colspan=\"10\">Nenhuma imagem encontrada!</td>" +
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

/*CARREGA IMAGENS GALERIA DO POST SELECIONADA*/
function edita_blog_postagem_galeria(viIdBlogPostagemGaleria) {

    Loading();

    $.ajax({
        url: vsUrl + "controllers/RetornaBlogPostagensGaleriaSelecionado.php",
        type: "POST",
        dataType: "json",
        data: ({
            viIdBlogPostagemGaleria: viIdBlogPostagemGaleria
        }),
        success: function (data) {
            limpa_form_blog_postagem_galeria();
            $("#inputIdBlogPostagemGaleria").val(viIdBlogPostagemGaleria);
            $("#inputDescricaoGaleria").val(data[0].descricao);
            $("#inputImagemGaleriaAtual").val(data[0].imagem);
            $("#imgImagemGaleriaAtual").attr("src", vsUrl + "uploads/blog_postagens_galeria/" + data[0].imagem);
            CloseLoading();
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}

/*LIMPA FORMULÁRIO GALERIA*/
function limpa_form_blog_postagem_galeria() {
    $(".dropify-clear").click();
    $("#inputIdBlogPostagemGaleria").val("");
    $("#inputDescricaoGaleria").val("");
    $("#inputImagemGaleriaAtual").val("");
    $("#imgImagemGaleriaAtual").attr("src", "");
    $("#inputImagemGaleria").val("");
}