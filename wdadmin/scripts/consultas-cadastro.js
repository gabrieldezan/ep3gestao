$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Consultas");

    /*MONTA OS SELECT PARA TRAZER O PARCEIRO*/
    monta_select("inputIdParceiros", "id_parceiros", "nome", "parceiros", "WHERE status = 1", "nome", "", false, false);

    /*CARREGA O SERVIÇOS DO PARCEIRO SELECIONADO*/
    $("#inputIdParceiros").change(function () {
        if ($("#inputIdParceiros").val() !== "T") {
            monta_select("inputIdParceiroServicos", "id_parceiros_servicos", "descricao", "parceiros_servicos", "WHERE status = 1 AND descricao != '' AND id_parceiros = " + $("#inputIdParceiros").val(), "descricao", "", false, false);
        } else {
            $('#inputIdParceiroServicos option[value!="T"]').remove();
        }
    });
    
    /*MONTA OS SELECT PARA TRAZER O ASSOCIADO*/
    monta_select("inputIdAssociados", "id_associados", "nome", "associados", "", "nome", "", false, false);

    /*CARREGA OS DEPENDENTES*/
    $("#inputIdAssociados").change(function () {
        if ($("#inputIdAssociados").val() !== "T") {
            monta_select("inputIdDependente", "id_dependentes", "nome", "dependentes", "WHERE status = 1 AND id_associados = " + $("#inputIdAssociados").val(), "nome", "", false, true);
        } else {
            $('#inputIdAssociados option[value!="T"]').remove();
        }
    });

    /*CHAMA FUNÇÃO QUE CONSULTA VALOR DO SERVIÇO*/
    $("#inputIdParceiroServicos").change(function () {
        consulta_dados_servicos($("#inputIdParceiroServicos").val());
    });

    /*CARREGA DADOS DO PARCEIRO SERVIÇO SELECIONADO*/
    function consulta_dados_servicos(viIdParceirosServicos) {

        Loading();

        $.ajax({
            url: vsUrl + "controllers/RetornaParceirosServicosSelecionado.php",
            type: "POST",
            dataType: "json",
            data: ({
                viIdParceirosServicos: viIdParceirosServicos
            }),
            success: function (data) {
                $("#inputValor").val(data[0].valor);
                CloseLoading();
            },
            error: function () {
                CloseLoading();
                Erro();
            }
        });
    }

    /*BOTÃO NOVA CONSULTA*/
    $("#botao_nova_consulta").click(function (e) {
        limpa_form_consultas_servicos();
    });

    $("#form_consultas").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosConsultas.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdConsulta").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdConsulta").val(data);
                    verifica_edicao();
                    CloseLoading();
                    Sucesso();
                } else {
                    CloseLoading();
                    AvisoPersonalizado("Horário Indisponível!");
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
    var id = $("#inputIdConsulta").val();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_consulta(id);
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DO PARCEIRO SELECIONADO*/
function edita_consulta(viIdConsulta) {

    $.ajax({
        url: vsUrl + "controllers/RetornaConsultasSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdConsulta: viIdConsulta
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputIdAssociados").val(data[0].id_associados);
                $("#inputIdParceiros").val(data[0].id_parceiros);
                $("#inputStatus").val(data[0].status);
                $("#inputValor").val(data[0].valor.replace(".", ","));
                $("#inputDataHora").val(data[0].data_hora.replace(" ", "T"));
                monta_select("inputIdParceiroServicos", "id_parceiros_servicos", "descricao", "parceiros_servicos", "WHERE id_parceiros = " + $("#inputIdParceiros").val(), "descricao", data[0].id_parceiro_servicos, true, false);
                monta_select("inputIdDependente", "id_dependentes", "nome", "dependentes", "WHERE id_associados = " + $("#inputIdAssociados").val(), "nome", data[0].id_dependentes, true, false);
                CloseLoading();
            } else {
                $("#inputIdConsulta").val("");
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