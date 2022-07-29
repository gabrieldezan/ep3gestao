$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Tamanhos Imagens");

    $("#form_tamanho_imagens").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosTamanhoImagens.php",
            type: "POST",
            async: true,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdTamanhoImagens").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdTamanhoImagens").val(data);
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
    var id = $("#inputIdTamanhoImagens").val();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_tamanho_imagens(id);
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DO TAMANHO DA IMAGEM SELECIONADA*/
function edita_tamanho_imagens(viIdTamanhoImagens) {

    $.ajax({
        url: vsUrl + "controllers/RetornaTamanhoImagensSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdTamanhoImagens: viIdTamanhoImagens
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputTabela").val(data[0].tabela);
                $("#inputCampos").val(data[0].campo);
                $("#inputLargura").val(data[0].largura);
                $("#inputAltura").val(data[0].altura);
                CloseLoading();
            } else {
                AvisoPersonalizado("Dados não encontrados!");
                $("#inputIdTamanhoImagens").val("");
            }
            CloseLoading();
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}