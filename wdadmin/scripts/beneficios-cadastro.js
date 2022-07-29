$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Benefícios");

    $("#form_beneficios").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosBeneficios.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdBeneficios").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdBeneficios").val(data);
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
    var id = $("#inputIdBeneficios").val();

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_beneficios(id);
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DO SOLUÇÃO SELECIONADA*/
function edita_beneficios(viIdBeneficios) {

    $.ajax({
        url: vsUrl + "controllers/RetornaBeneficiosSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdBeneficios: viIdBeneficios
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputTituloBeneficiarios").val(data[0].titulo);
                $("#inputStatusBeneficiarios").val(data[0].status);
                CloseLoading();
            } else {
                $("#inputIdBeneficios").val("");
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