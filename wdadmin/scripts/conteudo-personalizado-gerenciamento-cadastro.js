$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Conteúdo Personalizado");

    $("#form_conteudo_personalizado").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosConteudoPersonalizado.php",
            type: "POST",
            async: true,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdConteudoPersonalizado").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdConteudoPersonalizado").val(data);
                    lista_conteudo_personalizado_menu();
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
    var id = $("#inputIdConteudoPersonalizado").val();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_conteudo_personalizado(id);
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DO CONTEÚDO PERSONALIZADO SELECIONADO*/
function edita_conteudo_personalizado(viIdConteudoPersonalizado) {

    $.ajax({
        url: vsUrl + "controllers/RetornaConteudoPersonalizadoSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdConteudoPersonalizado: viIdConteudoPersonalizado
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputTitulo").val(data[0].titulo);
                $("#inputIcone").val(data[0].icone);
                $("#inputImagem").val(data[0].imagem);
                $("#inputImagemLargura").val(data[0].imagem_largura);
                $("#inputImagemAltura").val(data[0].imagem_altura);
                $("#inputTexto").val(data[0].texto);
                $("#inputLink").val(data[0].link);
                $("#inputData").val(data[0].data);
                $("#inputHora").val(data[0].hora);
                $("#inputNumero").val(data[0].numero);
                $("#inputUrl").val(data[0].url);
                CloseLoading();
            } else {
                AvisoPersonalizado("Dados não encontrados!");
                $("#inputIdConteudoPersonalizado").val("");
            }
            CloseLoading();
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}