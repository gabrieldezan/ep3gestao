$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    $('#inputValor').mask("000.000.000.000.000,00", {reverse: true});
    $('#inputValorAdicional').mask("000.000.000.000.000,00", {reverse: true});

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Eventos");

    verifica_tamanho_imagens("eventos");

    /*APLICA CAIXA DE TEXTO*/
    $('#inputDetalhes').wysihtml5();
    $('#inputMaisInformacoes').wysihtml5();

    /*SUBMETE FORM CADASTRO*/
    $("#form_eventos_cadastro").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosEventos.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdEvento").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdEventosCadastro").val(data);
                    $("#inputIdEvento").val(data);
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
    var id = $("#inputIdEventosCadastro").val();

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_eventos(id);
        $('ul li a[href="#times"]').removeClass("disabled");
    } else {
        $('ul li a[href="#times"]').addClass("disabled");
        CloseLoading();
    }
}

/*CARREGA DADOS DO USUÁRIO SELECIONADO*/
function edita_eventos(viIdEventos) {

    $.ajax({
        url: vsUrl + "controllers/RetornaEventosSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdEventos: viIdEventos
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputDescricao").val(data[0].descricao);
                $("#inputDetalhes").val(data[0].detalhes);
                $("#inputMaisInformacoes").val(data[0].mais_informacoes);
                $("#inputMapa").val(data[0].mapa);
                $("#inputValor").val(data[0].valor);
                $("#inputValorAdicional").val(data[0].valor_adicional);
                $("#inputDataEvento").val(data[0].data_evento);
                $("#inputImagemAtual").val(data[0].imagem);
                $("#imgImagemAtual").attr("src", vsUrl + "uploads/eventos/" + data[0].imagem);
                $("#inputStatus").val(data[0].status);
                CloseLoading();
            } else {
                $("#inputIdEventosCadastro").val("");
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