$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Produtos da Vitrine");

    /*VALIDA TAMANHO E DIMENSÃO DAS IMAGENS DAS CORES*/
    verifica_tamanho_imagens("vitrine_produto");

    /*APLICA CAIXA DE TEXTO*/
    $('#inputDetalhes').wysihtml5();

    /*APLICA CAIXA DE TEXTO NAS INFORMAÇÕES ADICIONAIS*/
    if ($("#inputInformacaoAdicional1").length > 0) {
        tinymce.init({
            selector: "textarea#inputInformacaoAdicional1",
            language: 'pt_BR',
            language_url: vsUrl + '/js/pt_BR.js',
            theme: "modern",
            height: 250,
            width: '100%',
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }

    if ($("#inputInformacaoAdicional2").length > 0) {
        tinymce.init({
            selector: "textarea#inputInformacaoAdicional2",
            language: 'pt_BR',
            language_url: vsUrl + '/js/pt_BR.js',
            theme: "modern",
            height: 250,
            width: '100%',
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }

    if ($("#inputInformacaoAdicional3").length > 0) {
        tinymce.init({
            selector: "textarea#inputInformacaoAdicional3",
            language: 'pt_BR',
            language_url: vsUrl + '/js/pt_BR.js',
            theme: "modern",
            height: 250,
            width: '100%',
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }

    /*APLICA MASCARAS NOS CAMPOS*/
    $('#inputPeso').mask("000.000.000.000.000,00", {reverse: true});
    $('#inputValor').mask("000.000.000.000.000,00", {reverse: true});

    /*APLICA CAIXA DE CORES*/
    $("#inputExemplo").asColorPicker();

    /*MONTA OS SELECTS*/
    monta_select("inputIdVitrineGrupo", "id_vitrine_grupo", "descricao", "vitrine_grupo", "WHERE status = 1", "descricao", "", true);

    /*CARREGA SUBGRUPOS AO SELECIONAR O GRUPO*/
    $("#inputIdVitrineGrupo").change(function () {
        if ($("#inputIdVitrineGrupo").val() !== "T") {
            monta_select("inputIdVitrineSubgrupo", "id_vitrine_subgrupo", "descricao", "vitrine_subgrupo", "WHERE status = 1 AND id_vitrine_grupo = " + $("#inputIdVitrineGrupo").val(), "descricao", "", true);
        } else {
            $('#inputIdVitrineSubgrupo option[value!="T"]').remove();
        }
    });

    /*BOTÃO NOVO*/
    $("#botao_nova_cor_produto").click(function (e) {
        limpa_form_cores_produtos();
    });

    /*SUBMETE FORM CADASTRO*/
    $("#form_vitrine_produtos_cadastro").on('submit', (function (e) {

        if ($("#inputIdVitrineSubgrupo").val() == "T") {
            AvisoPersonalizado("Selecione um subgrupo!");
            return false;
        }

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosVitrineProdutos.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdVitrineProduto").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdVitrineProdutosCadastro").val(data); 
                    $("#inputIdVitrineProduto").val(data);
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

    /*SUBMETE FORM CORES*/
    $("#form_vitrine_produtos_cores").on('submit', (function (e) {

        if ($("#inputImagem1").val() === "" && $("#inputImagem1Atual").val() === "") {
            AvisoPersonalizado("Insira a Imagem 1!");
            return false;
        }

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosVitrineProdutosCores.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    limpa_form_cores_produtos();
                    consulta_cores_produtos();
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
    var id = $("#inputIdVitrineProdutosCadastro").val();

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_vitrine_produtos(id);
        consulta_cores_produtos();
        $('ul li a[href="#cores"]').removeClass("disabled");
    } else {
        $('ul li a[href="#cores"]').addClass("disabled");
        $("#botao_visualizar_manual").addClass('disabled');
        CloseLoading();
    }
}

/*CARREGA DADOS DO USUÁRIO SELECIONADO*/
function edita_vitrine_produtos(viIdVitrineProdutos) {

    $.ajax({
        url: vsUrl + "controllers/RetornaVitrineProdutosSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdVitrineProdutos: viIdVitrineProdutos
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputDescricao").val(data[0].descricao);
                $("#inputDetalhes").val(data[0].detalhes);
                $("#inputGarantia").val(data[0].garantia);
                $("#inputPeso").val(data[0].peso);
                $("#inputDimensoes").val(data[0].dimensoes);
                $("#inputMateriais").val(data[0].materiais);
                $("#inputImagemAtual").val(data[0].imagem);
                $("#imgImagemAtual").attr("src", vsUrl + "uploads/vitrine_produtos/" + data[0].imagem);
                if (data[0].manual !== "") {
                    $("#inputManualAtual").val(data[0].manual);
                    $("#botao_visualizar_manual").attr("href", vsUrl + "uploads/vitrine_produtos/" + data[0].manual);
                    $("#botao_visualizar_manual").removeClass('disabled');
                } else {
                    $("#botao_visualizar_manual").addClass('disabled');
                }
                $("#inputManual").val("");
                $("#inputInformacaoAdicional1").val(data[0].informacao_adicional_1);
                $("#inputInformacaoAdicional2").val(data[0].informacao_adicional_2);
                $("#inputInformacaoAdicional3").val(data[0].informacao_adicional_3);
                $("#inputLink").val(data[0].link);
                $("#inputValor").val(data[0].valor);
                $("#inputIdVitrineGrupo").val(data[0].id_vitrine_grupo);
                monta_select("inputIdVitrineSubgrupo", "id_vitrine_subgrupo", "descricao", "vitrine_subgrupo", "WHERE status = 1 AND id_vitrine_grupo = " + $("#inputIdVitrineGrupo").val(), "descricao", data[0].id_vitrine_subgrupo, true);
                $("#inputSituacao").val(data[0].situacao);
                $("#inputStatus").val(data[0].status);
                CloseLoading();
            } else {
                $("#inputIdVitrineProdutosCadastro").val("");
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

/*CARREGA CORES DO PRODUTO*/
function consulta_cores_produtos() {

    var viIdProduto = $("#inputIdVitrineProduto").val();

    $.ajax({
        url: vsUrl + "controllers/RetornaVitrineProdutosCores.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdProduto: viIdProduto
        }),
        success: function (data) {
            if (data != 0) {

                $("#tabela_cores_produtos tbody").html("");
                for (i = 0; i < data.length; i++) {
                    $("#tabela_cores_produtos tbody").append(
                            "<tr>" +
                            "<td style='background-color:" + data[i].cor_hexadecimal + "'></td>" +
                            "<td>" + data[i].descricao + "</td>" +
                            "<td>" + data[i].referencia + "</td>" +
                            "<td><img src='" + vsUrl + "uploads/vitrine_produtos/" + data[i].imagem1 + "' class='img-fluid' style='height:35px'></td>" +
                            "<td align=\"center\">" +
                            "<button type=\"button\" class=\"btn btn-secondary btn-sm\" onclick=\"edita_cores_produtos(" + data[i].id_vitrine_produto_cores + ")\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar cor " + data[i].descricao + "\"><i class=\"far fa-edit fa-fw\" aria-hidden=\"true\"></i></button>&nbsp;" +
                            "<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"confirma_exclusao_registro(" + data[i].id_vitrine_produto_cores + ", 'vitrine_produto_cores', 'vitrine_produtos', '" + data[i].imagem1 + "', '" + data[i].imagem2 + "', '" + data[i].imagem3 + "', '" + data[i].imagem4 + "', '" + data[i].imagem5 + "');\" data-toggle=\"tooltip\" title=\"Remover " + data[i].descricao + "\"><i class=\"far fa-trash-alt fa-fw\" aria-hidden=\"true\"></i></button>" +
                            "</td>" +
                            "</tr>"
                            );
                    $('[data-toggle="tooltip"]').tooltip();
                    CloseLoading();
                }
            } else {
                $("#tabela_cores_produtos tbody").html("");
                $("#tabela_cores_produtos tbody").append(
                        "<tr>" +
                        "<td align=\"center\" colspan=\"10\">Nenhuma cor encontrada!</td>" +
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

/*CARREGA DADOS DA COR SELECIONADA*/
function edita_cores_produtos(viIdProdutosCores) {

    Loading();

    $.ajax({
        url: vsUrl + "controllers/RetornaVitrineProdutosCoresSelecionado.php",
        type: "POST",
        dataType: "json",
        data: ({
            viIdProdutosCores: viIdProdutosCores
        }),
        success: function (data) {
            limpa_form_cores_produtos();
            $("#inputIdVitrineProdutosCores").val(viIdProdutosCores);
            $("#inputDescricaoCor").val(data[0].descricao);
            $("#inputExemplo").val(data[0].cor_hexadecimal);
            $("#inputReferencia").val(data[0].referencia);
            $("#inputImagem1Atual").val(data[0].imagem1);
            $("#imgImagem1Atual").attr("src", vsUrl + "uploads/vitrine_produtos/" + data[0].imagem1);
            $("#inputImagem2Atual").val(data[0].imagem2);
            $("#imgImagem2Atual").attr("src", vsUrl + "uploads/vitrine_produtos/" + data[0].imagem2);
            $("#inputImagem3Atual").val(data[0].imagem3);
            $("#imgImagem3Atual").attr("src", vsUrl + "uploads/vitrine_produtos/" + data[0].imagem3);
            $("#inputImagem4Atual").val(data[0].imagem4);
            $("#imgImagem4Atual").attr("src", vsUrl + "uploads/vitrine_produtos/" + data[0].imagem4);
            $("#inputImagem5Atual").val(data[0].imagem5);
            $("#imgImagem5Atual").attr("src", vsUrl + "uploads/vitrine_produtos/" + data[0].imagem5);
            CloseLoading();
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}

/*LIMPA FORMULÁRIO CORES PRODUTOS*/
function limpa_form_cores_produtos() {
    $(".dropify-clear").click();
    $("#inputIdVitrineProdutosCores").val("");
    $("#inputDescricaoCor").val("");
    $("#inputExemplo").val("");
    $("#inputReferencia").val("");
    $("#inputImagem1Atual").val("");
    $("#imgImagem1Atual").attr("src", "");
    $("#inputImagem1").val("");
    $("#inputImagem2Atual").val("");
    $("#imgImagem2Atual").attr("src", "");
    $("#inputImagem2").val("");
    $("#inputImagem3Atual").val("");
    $("#imgImagem3Atual").attr("src", "");
    $("#inputImagem3").val("");
    $("#inputImagem4Atual").val("");
    $("#imgImagem4Atual").attr("src", "");
    $("#inputImagem4").val("");
    $("#inputImagem5Atual").val("");
    $("#imgImagem5Atual").attr("src", "");
    $("#inputImagem5").val("");
}