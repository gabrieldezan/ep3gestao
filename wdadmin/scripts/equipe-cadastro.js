$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Equipe");

    $('#inputFormacao').wysihtml5();

    if ($("#inputHistoria").length > 0) {
        tinymce.init({
            selector: "textarea#inputHistoria",
            language: 'pt_BR',
            language_url: vsUrl + '/js/pt_BR.js',
            theme: "modern",
            height: 300,
            width: '100%',
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }

    /*BOTÃO NOVO*/
    $("#botao_nova_contato_equipe").click(function (e) {
        limpa_form_contato_equipe();
    });

    verifica_tamanho_imagens("equipe");

    /*SUBMETE FORM CADASTRO*/
    $("#form_equipe_cadastro").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosEquipe.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdEquipe").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdEquipeCadastro").val(data);
                    $("#inputIdEquipe").val(data);
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

    /*SUBMETE FORM CONTATO*/
    $("#form_equipe_contato").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosEquipeContato.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    limpa_form_contato_equipe();
                    consulta_contato_equipe();
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
    var id = $("#inputIdEquipeCadastro").val();

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_equipe(id);
        consulta_contato_equipe();
        $('ul li a[href="#contato"]').removeClass("disabled");
    } else {
        $('ul li a[href="#contato"]').addClass("disabled");
        $("#botao_visualizar_manual").addClass('disabled');
        CloseLoading();
    }
}

/*CARREGA DADOS DO USUÁRIO SELECIONADO*/
function edita_equipe(viIdEquipe) {

    $.ajax({
        url: vsUrl + "controllers/RetornaEquipeSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdEquipe: viIdEquipe
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputNome").val(data[0].nome);
                $("#inputExperiencia").val(data[0].experiencia);
                $("#inputFormacao").val(data[0].formacao);
                $("#inputHistoria").val(data[0].historia);
                $("#inputImagemAtual").val(data[0].imagem);
                $("#imgImagemAtual").attr("src", vsUrl + "uploads/equipe/" + data[0].imagem);
                $("#inputOrdem").val(data[0].ordem);
                $("#inputStatus").val(data[0].status);
                CloseLoading();
            } else {
                $("#inputIdEquipeCadastro").val("");
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
function consulta_contato_equipe() {

    var viIdEquipe = $("#inputIdEquipe").val();

    $.ajax({
        url: vsUrl + "controllers/RetornaEquipeContato.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdEquipe: viIdEquipe
        }),
        success: function (data) {
            if (data != 0) {
                $("#tabela_contato_equipe tbody").html("");
                for (i = 0; i < data.length; i++) {
                    $("#tabela_contato_equipe tbody").append(
                            "<tr>" +
                            "<td>" + data[i].titulo + "</td>" +
                            "<td>" + data[i].icone + "</td>" +
                            "<td><a href=\"" + data[i].link + "\" target=\"_blank\">" + data[i].link + "</a></td>" +
                            "<td>" + data[i].tipo + "</td>" +
                            "<td align=\"center\">" +
                            "<button type=\"button\" class=\"btn btn-secondary btn-sm\" onclick=\"edita_contato_equipe(" + data[i].id_equipe_contato + ")\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar " + data[i].titulo + "\"><i class=\"far fa-edit fa-fw\" aria-hidden=\"true\"></i></button>&nbsp;" +
                            "<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"confirma_exclusao_registro(" + data[i].id_equipe_contato + ", 'equipe_contato', '', '', '', '', '', '');\" data-toggle=\"tooltip\" title=\"Remover " + data[i].titulo + "\"><i class=\"far fa-trash-alt fa-fw\" aria-hidden=\"true\"></i></button>" +
                            "</td>" +
                            "</tr>"
                            );
                    $('[data-toggle="tooltip"]').tooltip();
                    CloseLoading();
                }
            } else {
                $("#tabela_contato_equipe tbody").html("");
                $("#tabela_contato_equipe tbody").append(
                        "<tr>" +
                        "<td align=\"center\" colspan=\"10\">Nenhum contato encontrado!</td>" +
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
function edita_contato_equipe(IdEquipeContato) {

    Loading();

    $.ajax({
        url: vsUrl + "controllers/RetornaEquipeContatoSelecionado.php",
        type: "POST",
        dataType: "json",
        data: ({
            IdEquipeContato: IdEquipeContato
        }),
        success: function (data) {
            limpa_form_contato_equipe();
            $("#inputIdEquipeContato").val(IdEquipeContato);
            $("#inputTitulo").val(data[0].titulo);
            $("#inputIcone").val(data[0].icone);
            $("#inputLink").val(data[0].link);
            $("#inputTipo").val(data[0].tipo);
            CloseLoading();
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}

/*LIMPA FORMULÁRIO CORES PRODUTOS*/
function limpa_form_contato_equipe() {
    $("#inputIdEquipeContato").val("");
    $("#inputTitulo").val("");
    $("#inputIcone").val("");
    $("#inputLink").val("");
    $("#inputTipo").val("1");
}