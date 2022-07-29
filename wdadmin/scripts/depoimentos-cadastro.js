$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Depoimentos");

    verifica_tamanho_imagens("depoimentos");

    monta_select("inputIdClientes", "id_clientes", "descricao", "clientes", "WHERE status = 1", "descricao", "", false);

    $("#form_depoimentos").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosDepoimentos.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdDepoimentos").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdDepoimentos").val(data);
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
    var id = $("#inputIdDepoimentos").val();

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_depoimentos(id);
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DO USUÁRIO SELECIONADO*/
function edita_depoimentos(viIdDepoimentos) {

    $.ajax({
        url: vsUrl + "controllers/RetornaDepoimentosSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdDepoimentos: viIdDepoimentos
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputNome").val(data[0].nome);
                $("#inputTexto").val(data[0].texto);
                $("#inputImagemAtual").val(data[0].imagem);
                $("#imgImagemAtual").attr("src", vsUrl + "uploads/depoimentos/" + data[0].imagem);
                $("#inputIdClientes").val(data[0].id_clientes);
                CloseLoading();
            } else {
                $("#inputIdDepoimentos").val("");
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