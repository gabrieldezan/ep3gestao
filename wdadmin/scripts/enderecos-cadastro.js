$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Endereços");

    $("#form_enderecos").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosEndereco.php",
            type: "POST",
            async: true,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdEnderecos").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdEnderecos").val(data);
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
    var id = $("#inputIdEnderecos").val();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_enderecos(id);
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DO USUÁRIO SELECIONADO*/
function edita_enderecos(viIdEnderecos) {

    $.ajax({
        url: vsUrl + "controllers/RetornaEnderecoSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdEnderecos: viIdEnderecos
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputTitulo").val(data[0].titulo);
                $("#inputEndereco").val(data[0].endereco);
                $("#inputCidade").val(data[0].cidade);
                $("#inputEstado").val(data[0].estado);
                $("#inputMapa").val(data[0].mapa);
                $("#inputHorarioAtendimento").val(data[0].horario_atendimento);
                $("#inputTelefone").val(data[0].telefone);
                $("#inputWhatsapp").val(data[0].whatsapp);
                CloseLoading();
            } else {
                AvisoPersonalizado("Dados não encontrados!");
                $("#inputIdEnderecos").val("");
            }
            CloseLoading();
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}