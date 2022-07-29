$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Usuário Cliente");

    /*FORM CADASTRO*/
    $("#form_usuario_cliente").on('submit', (function (e) {

        if ($("#inputSenha").val() !== $("#inputConfirmaSenha").val()) {
            $("#inputSenha").val("");
            $("#inputConfirmaSenha").val("");
            AvisoPersonalizado("As senhas não coincidem.");
            return false;
        }

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosUsuarioCliente.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                CloseLoading();
                if (data === "CE") {
                    AvisoPersonalizado("E-mail já cadastrado!");
                } else if (data > 0) {
                    $("#inputIdUsuarioCliente").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdUsuarioCliente").val(data);
                    verifica_edicao();
                    Sucesso();
                } else {
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
    var id = $("#inputIdUsuarioCliente").val();

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_usuario_cliente(id);
        $("#inputEmail").attr("readonly", "true");
    } else {
        $("#inputEmail").removeAttr("readonly");
        CloseLoading();
    }
}

/*CARREGA DADOS DO USUÁRIO SELECIONADO*/
function edita_usuario_cliente(viIdUsuarioCliente) {

    $.ajax({
        url: vsUrl + "controllers/RetornaUsuarioClienteSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdUsuarioCliente: viIdUsuarioCliente
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputNome").val(data[0].nome);
                $("#inputEmail").val(data[0].email);
                $("#inputStatus").val(data[0].status);
            } else {
                AvisoPersonalizado("Dados não encontrados!");
                $("#inputIdUsuarioCliente").val("");
            }
            CloseLoading();
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}