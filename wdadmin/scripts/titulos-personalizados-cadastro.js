$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Títulos Personalizados");

    verifica_tamanho_imagens("titulos_personalizados");

    /*SUBMETE FORM CADASTRO*/
    $("#form_titulos_personalizados_cadastro").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosTitulosPersonalizados.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdTitulosPersonalizados").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdTitulosPersonalizados").val(data);
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
    var id = $("#inputIdTitulosPersonalizados").val();

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_titulos_personalizados(id);
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DO USUÁRIO SELECIONADO*/
function edita_titulos_personalizados(viIdTitulosPersonalizados) {

    $.ajax({
        url: vsUrl + "controllers/RetornaTitulosPersonalizadosSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdTitulosPersonalizados: viIdTitulosPersonalizados
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputTitulo").val(data[0].titulo);
                $("#inputSubtitulo").val(data[0].subtitulo);
                $("#inputImagemAtual").val(data[0].imagem);
                $("#imgImagemAtual").attr("src", vsUrl + "uploads/titulos_personalizados/" + data[0].imagem);
                $("#inputIcone").val(data[0].icone);
                $("#inputStatus").val(data[0].status);
                CloseLoading();
            } else {
                $("#inputIdTitulosPersonalizados").val("");
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
