$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Perguntas Frequentes");

    monta_select("inputIdServicos", "id_servicos", "titulo", "servicos", "WHERE status = 1", "titulo", "", false);

    $("#form_perguntas_frequentes").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosPerguntasFrequentes.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdPerguntasFrequentes").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdPerguntasFrequentes").val(data);
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
    var id = $("#inputIdPerguntasFrequentes").val();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_perguntas_frequentes(id);
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DO PERGUNTAS FREQUENTES SELECIONADO*/
function edita_perguntas_frequentes(viIdPerguntasFrequentes) {

    $.ajax({
        url: vsUrl + "controllers/RetornaPerguntasFrequentesSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdPerguntasFrequentes: viIdPerguntasFrequentes
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputNumero").val(data[0].numero);
                $("#inputPergunta").val(data[0].pergunta);
                $("#inputResposta").val(data[0].resposta);
                $("#inputIdServicos").val(data[0].id_servicos);
                CloseLoading();
            } else {
                $("#inputIdPerguntasFrequentes").val("");
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