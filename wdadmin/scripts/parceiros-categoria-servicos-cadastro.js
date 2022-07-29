$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Categoria de Serviços de parceiros");
    
    $("#form_parceiros_categoria_servicos").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosParceirosCategoriaServicos.php",
            type: "POST",
            async: true,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdParceirosCategoriaServicos").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdParceirosCategoriaServicos").val(data);
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
    var id = $("#inputIdParceirosCategoriaServicos").val();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_parceiros_categoria_servicos(id);
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DO USUÁRIO SELECIONADO*/
function edita_parceiros_categoria_servicos(viIdParceirosCategoriaServicos) {

    $.ajax({
        url: vsUrl + "controllers/RetornaParceirosCategoriaServicosSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdParceirosCategoriaServicos: viIdParceirosCategoriaServicos
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputTituloParceirosCategoriaServicos").val(data[0].titulo);
                $("#inputStatusParceirosCategoriaServicos").val(data[0].status);
                CloseLoading();
            } else {
                AvisoPersonalizado("Dados não encontrados!");
                $("#inputIdParceirosCategoriaServicos").val("");
            }
            CloseLoading();
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}