$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Missão, Visão e Valores");

    verifica_tamanho_imagens("missao_visao_valores");

    $("#form_missao_visao_valores").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosMissaoVisaoValores.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    edita_missao_visao_valores();
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
    edita_missao_visao_valores();

});

/*FUNÇÃO QUE VERIFICA SE EXISTE UM ID*/
function edita_missao_visao_valores() {

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();

    $.ajax({
        url: vsUrl + "controllers/RetornaMissaoVisaoValores.php",
        type: "POST",
        dataType: "json",
        async: false,
        success: function (data) {
            if (data !== 0) {
                $("#inputIconeMissao").val(data[0].icone_missao);
                $("#imgImagemMissaoAtual").attr("src", vsUrl + "uploads/missao_visao_valores/" + data[0].imagem_missao);
                $("#inputImagemMissaoAtual").val(data[0].imagem_missao);
                $("#inputTextoMissao").val(data[0].texto_missao);
                $("#inputIconeVisao").val(data[0].icone_visao);
                $("#imgImagemVisaoAtual").attr("src", vsUrl + "uploads/missao_visao_valores/" + data[0].imagem_visao);
                $("#inputImagemVisaoAtual").val(data[0].imagem_visao);
                $("#inputTextoVisao").val(data[0].texto_visao);
                $("#inputIconeValores").val(data[0].icone_valores);
                $("#imgImagemValoresAtual").attr("src", vsUrl + "uploads/missao_visao_valores/" + data[0].imagem_valores);
                $("#inputImagemValoresAtual").val(data[0].imagem_valores);
                $("#inputTextoValores").val(data[0].texto_valores);
            }
            CloseLoading();
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}