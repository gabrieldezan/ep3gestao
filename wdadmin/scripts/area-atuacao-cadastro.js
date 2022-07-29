$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Área de Atuação");

    $("#form_area_atuacao").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosAreaAtuacao.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdAreaAtuacao").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdAreaAtuacao").val(data);
                    CloseLoading();
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
    var id = $("#inputIdAreaAtuacao").val();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_area_atuacao(id);
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DO SERVIÇO SELECIONADO*/
function edita_area_atuacao(viIdAreaAtuacao) {

    $.ajax({
        url: vsUrl + "controllers/RetornaAreaAtuacaoSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdAreaAtuacao: viIdAreaAtuacao
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputDescricao").val(data[0].descricao);
                $("#inputStatus").val(data[0].status);
                CloseLoading();
            } else {
                $("#inputIdAreaAtuacao").val("");
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