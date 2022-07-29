$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Banners do Slideshow");

    verifica_tamanho_imagens("banner");

    $("#form_banners_slideshow").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosBannerSlideshow.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdBannersSlideshow").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdBannersSlideshow").val(data);
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
    var id = $("#inputIdBannersSlideshow").val();

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_banner_slideshow(id);
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DO USUÁRIO SELECIONADO*/
function edita_banner_slideshow(viIdBannersSlideshow) {

    $.ajax({
        url: vsUrl + "controllers/RetornaBannerSlideshowSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdBannersSlideshow: viIdBannersSlideshow
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputImagemAtual").val(data[0].imagem);
                $("#imgImagemAtual").attr("src", vsUrl + "uploads/banners_slideshow/" + data[0].imagem);
                $("#inputTitulo").val(data[0].titulo);
                $("#inputDescricao").val(data[0].descricao);
                $("#inputLink").val(data[0].link);
                $("#inputTextoBotao").val(data[0].texto_botao);
                $("#inputLinkNovaAba").val(data[0].link_nova_aba);
                $("#inputPosicao").val(data[0].posicao);
                CloseLoading();
            } else {
                $("#inputIdBannersSlideshow").val("");
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