$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Cases");

    verifica_tamanho_imagens("cases");

    monta_select("inputIdClientes", "id_clientes", "descricao", "clientes", "WHERE status = 1", "descricao", "", false);

    $("#form_cases").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosCases.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdCases").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdCases").val(data);
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

    /*CHAMA FUNÇÃO PARA VERIFICAR EDIÇÃO OU CADASTRO*/
    verifica_edicao();

});

/*FUNÇÃO QUE VERIFICA SE EXISTE UM ID*/
function verifica_edicao() {

    /*PEGA ID*/
    var id = $("#inputIdCases").val();

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_cases(id);
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DO CASE SELECIONADO*/
function edita_cases(viIdCases) {

    $.ajax({
        url: vsUrl + "controllers/RetornaCasesSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdCases: viIdCases
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputServico").val(data[0].servico);
                $("#inputArquivoAtual").val(data[0].arquivo);
                $("#inputImagemAtual").val(data[0].imagem);
                $("#imgImagemAtual").attr("src", vsUrl + "uploads/cases/" + data[0].imagem);
                $("#inputIdClientes").val(data[0].id_clientes);
                CloseLoading();
            } else {
                $("#inputIdCases").val("");
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