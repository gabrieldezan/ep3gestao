$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Usuários");

    $("#inputImagemPerfil").change(function () {

        var fr = new FileReader;

        fr.onload = function () {
            var img = new Image;

            img.onload = function () {
                if (img.width !== 100 && this.height !== 100) {
                    AvisoPersonalizado("A imagem de perfil deve ter 100x100 pixels de dimensão.");
                    $("#botao_salvar").attr("disabled", true);
                } else {
                    $("#botao_salvar").removeAttr("disabled");
                }
            };
            img.src = fr.result;
        };
        fr.readAsDataURL(this.files[0]);
    });

    /*FORM CADASTRO*/
    $("#form-usuario").on('submit', (function (e) {

        if ($("#inputNovaSenha").val() !== $("#inputConfirmaSenha").val()) {
            $("#inputNovaSenha").val("");
            $("#inputConfirmaSenha").val("");
            AvisoPersonalizado("As senhas não coincidem.");
            return false;
        }

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosUsuario.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                CloseLoading();
                if (data > 0) {
                    $("#inputIdUsuario").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdUsuario").val(data);
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
    var id = $("#inputIdUsuario").val();

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_usuarios(id);
        $("#inputLogin").attr("readonly", "true");
    } else {
        $("#inputLogin").removeAttr("readonly");
        CloseLoading();
    }
}

/*CARREGA DADOS DO USUÁRIO SELECIONADO*/
function edita_usuarios(viIdUsuario) {

    $.ajax({
        url: vsUrl + "controllers/RetornaUsuarioSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdUsuario: viIdUsuario
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputNome").val(data[0].nome);
                $("#inputLogin").val(data[0].login);
                $("#imgImagemPerfilAtual").attr("src", vsUrl + "uploads/usuarios/" + data[0].imagem_perfil);
                $("#inputImagemPerfilAtual").val(data[0].imagem_perfil);
                $("#inputStatus").val(data[0].status);
            } else {
                AvisoPersonalizado("Dados não encontrados!");
                $("#inputIdUsuario").val("");
            }
            CloseLoading();
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}