$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Parceiros");

    /*VALIDA TAMANHO E DIMENSÃO DOS PLANOS*/
    verifica_tamanho_imagens("parceiros");

    /*VALIDA TAMANHO E DIMENSÃO DAS IMAGENS DOS DOCUMENTOS CPF E RG*/
    $("#inputCpfFrente, #inputCpfVerso, #inputRgFrente, #inputRgVerso").change(function () {

        if (this.files[0].size > 2000000) {
            AvisoPersonalizado("A imagem não pode ter mais que 2MB de tamanho.");
            $("#botao_salvar").attr("disabled", true);
        } else {
            var fr = new FileReader;

            fr.onload = function () {
                var img = new Image;

                img.onload = function () {};
                img.src = fr.result;
            };
            fr.readAsDataURL(this.files[0]);
        }
    });

    /*APLICA MASCARAS NOS CAMPOS*/
    $('#inputCep').mask("00.000-000", {reverse: false});
    $('#inputTelefone').mask("(00) 0000-0000", {reverse: false});
    $('#inputWhatsApp').mask("(00) 00000-0000", {reverse: false});

    $('#inputValorParceirosServicos').mask("000.000.000.000.000,00", {reverse: true});

    /*MONTA OS SELECTS*/
    monta_select("inputIdEstado", "id_estado", "nome", "estado", "", "nome", "", true);
    monta_select("inputAreaAtuacao", "id_area_atuacao", "descricao", "area_atuacao", "", "descricao", "WHERE status = 1", false);
    monta_select("inputIdParceirosCategoriaServicos", "id_parceiros_categoria_servicos", "titulo", "parceiros_categoria_servicos", "WHERE status = 1", "titulo", "", false, false);

    /*CARREGA SUBGRUPOS AO SELECIONAR O GRUPO*/
    $("#inputIdEstado").change(function () {
        if ($("#inputIdEstado").val() !== "T") {
            monta_select("inputIdCidade", "id_cidade", "nome", "cidade", "WHERE id_estado = " + $("#inputIdEstado").val(), "nome", "", true);
        } else {
            $('#inputIdCidade option[value!="T"]').remove();
        }
    });

    /*BOTÃO NOVO PARCEIRO SERVIÇO*/
    $("#botao_novo_parceiros_servicos").click(function (e) {
        limpa_form_parceiros_servicos();
    });

    /*BOTÃO IMPORTAR*/
    $("#botao_importar").click(function (e) {
        $("#div_importacao").show("slow");
        $("#div_cadastro").hide();
    });

    /*BOTÃO CADASTRAR*/
    $("#botao_cadastrar").click(function (e) {
        $("#div_cadastro").show("slow");
        $("#div_importacao").hide();
    });

    $("#form_parceiros").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosParceiros.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data === "CE") {
                    CloseLoading();
                    AvisoPersonalizado("E-mail ou CPF/CNPJ já cadastrado!");
                } else if (data > 0) {
                    $("#inputIdParceiros").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdParceiros").val(data);
                    $("#inputIdParceirosServicos").val(data);
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

    /*SUBMETE FORM PARCEIRO SERVIÇOS*/
    $("#form_parceiros_servicos").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosParceirosServicos.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    limpa_form_parceiros_servicos();
                    consulta_parceiros_servicos();
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

    /*SUBMETE FORM PARCEIRO SERVIÇOS*/
    $("#form_importar_parceiros_servicos").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/ImportaParceirosServicos.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    limpa_form_importar_parceiros_servicos();
                    consulta_parceiros_servicos();
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
    
    /*CHAMA FUNÇÃO PARA VERIFICAR EDIÇÃO OU CADASTRO*/
    verifica_edicao_servicos();

});

/*FUNÇÃO QUE VERIFICA SE EXISTE UM ID*/
function verifica_edicao() {

    /*PEGA ID*/
    var id = $("#inputIdParceiros").val();

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();
    $("#div_importacao").hide();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_parceiros(id);
        consulta_parceiros_servicos();
        $("#inputLogin").attr("readonly", true);
        $("#inputSenha").attr("required", false);
        $('ul li a[href="#parceiros-servicos"]').removeClass("disabled");
    } else {
        $("#inputLogin").attr("readonly", false);
        $("#inputSenha").attr("required", true);
        $('ul li a[href="#parceiros-servicos"]').addClass("disabled");
        CloseLoading();
    }
}

/*FUNÇÃO QUE VERIFICA SE EXISTE UM ID*/
function verifica_edicao_servicos() {

    /*PEGA ID*/
    var id = $("#inputIdParceirosServicos").val();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_parceiros_servicos(id);
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DO PARCEIRO SELECIONADO*/
function edita_parceiros(viIdParceiros) {

    $.ajax({
        url: vsUrl + "controllers/RetornaParceirosSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdParceiros: viIdParceiros
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputNome").val(data[0].nome);
                $("#inputLogin").val(data[0].login);
                $("#inputSenha").val("");
                $("#inputRua").val(data[0].rua);
                $("#inputNumero").val(data[0].numero);
                $("#inputComplemento").val(data[0].complemento);
                $("#inputBairro").val(data[0].bairro);
                $("#inputCep").val(data[0].cep);
                $("#inputIdEstado").val(data[0].id_estado);
                monta_select("inputIdCidade", "id_cidade", "nome", "cidade", "WHERE id_estado = " + $("#inputIdEstado").val(), "nome", data[0].id_cidade, true, false);
                $("#inputTelefone").val(data[0].telefone);
                $("#inputWhatsApp").val(data[0].whatsapp);
                $("#inputEmail").val(data[0].email);
                $("#inputImagemAtual").val(data[0].imagem);
                $("#imgImagemAtual").attr("src", vsUrl + "uploads/parceiros/" + data[0].imagem);
                $("#inputAreaAtuacao").val(data[0].id_area_atuacao);
                $("#inputStatus").val(data[0].status);
                CloseLoading();
            } else {
                $("#inputIdParceiros").val("");
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

/*CARREGA PARCEIRO SERVIÇOS*/
function consulta_parceiros_servicos() {

    var viIdParceiros = $("#inputIdParceiros").val();

    $.ajax({
        url: vsUrl + "controllers/RetornaParceirosServicos.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdParceiros: viIdParceiros
        }),
        success: function (data) {
            if (data !== 0) {

                $("#tabela_parceiros_servicos tbody").html("");
                for (i = 0; i < data.length; i++) {
                    $("#tabela_parceiros_servicos tbody").append(
                            "<tr>" +
                            "<td>" + data[i].descricao + "</td>" +
                            "<td>" + data[i].grupo + "</td>" +
                            "<td>" + data[i].valor + "</td>" +
                            "<td><span class=\"label label-" + data[i].status_class + "\">" + data[i].status + "</span></td>" +
                            "<td align=\"center\">" +
                            "<button type=\"button\" class=\"btn btn-secondary btn-sm\" onclick=\"edita_parceiros_servicos(" + data[i].id_parceiros_servicos + ")\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar " + data[i].descricao + "\"><i class=\"far fa-edit fa-fw\" aria-hidden=\"true\"></i></button>" +
                            "</td>" +
                            "</tr>"
                            );
                }
                $('[data-toggle="tooltip"]').tooltip();
            } else {
                $("#tabela_parceiros_servicos tbody").html("");
                $("#tabela_parceiros_servicos tbody").append(
                        "<tr>" +
                        "<td align=\"center\" colspan=\"6\">Nenhum serviço encontrado!</td>" +
                        "</tr>"
                        );
            }
            CloseLoading();
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}

/*CARREGA DADOS DO PARCEIRO SERVIÇO SELECIONADO*/
function edita_parceiros_servicos(viIdParceirosServicos) {

    Loading();

    $.ajax({
        url: vsUrl + "controllers/RetornaParceirosServicosSelecionado.php",
        type: "POST",
        dataType: "json",
        data: ({
            viIdParceirosServicos: viIdParceirosServicos
        }),
        success: function (data) {
            if (data !== 0) {
                limpa_form_parceiros_servicos();
                $("#inputIdParceirosServicos").val(viIdParceirosServicos);
                $("#inputDescricaoParceirosServicos").val(data[0].descricao);
                $("#inputIdParceirosCategoriaServicos").val(data[0].id_parceiros_categoria_servicos);
                monta_select("inputIdParceirosCategoriaServicos", "id_parceiros_categoria_servicos", "titulo", "parceiros_categoria_servicos", "", "titulo", data[0].id_parceiros_categoria_servicos, false, false);
                $("#inputValorParceirosServicos").val(data[0].valor);
                $("#inputStatusParceirosServicos").val(data[0].status);
                CloseLoading();
            } else {
                $("#inputIdParceirosServicos").val("");
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

/*LIMPA FORMULÁRIO PARCEIRO SERVIÇOS*/
function limpa_form_parceiros_servicos() {
    $("#inputIdParceirosServicos").val("");
    $("#inputDescricaoParceirosServicos").val("");
    $("#inputValorParceirosServicos").val("");
    $("#inputStatusParceirosServicos").val("1");
}

/*LIMPA FORMULÁRIO PARCEIRO SERVIÇOS*/
function limpa_form_importar_parceiros_servicos() {
    $(".dropify-clear").click();
}