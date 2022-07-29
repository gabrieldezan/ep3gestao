$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Clientes");

    verifica_tamanho_imagens("clientes");

    $("#form_clientes").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosCliente.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdClientes").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdClientes").val(data);
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
    var id = $("#inputIdClientes").val();

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_clientes(id);
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DO USUÁRIO SELECIONADO*/
function edita_clientes(viIdClientes) {

    $.ajax({
        url: vsUrl + "controllers/RetornaClienteSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdClientes: viIdClientes
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputImagemAtual").val(data[0].imagem);
                $("#imgImagemAtual").attr("src", vsUrl + "uploads/clientes/" + data[0].imagem);
                $("#inputDescricao").val(data[0].descricao);
                $("#inputEndereco").val(data[0].endereco);
                $("#inputCidade").val(data[0].cidade);
                $("#inputEstado").val(data[0].estado);
                $("#inputTelefone").val(data[0].telefone);
                $("#inputLink").val(data[0].link);
                $("#inputStatus").val(data[0].status);
                CloseLoading();
            } else {
                $("#inputIdClientes").val("");
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