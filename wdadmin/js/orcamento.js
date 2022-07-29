jQuery(function (a) {
    vsUrl = a("#vsUrl").val();

    $("#orcamento-anexo").change(function () {

        if (this.files[0].size > 1000000) {
            AvisoPersonalizado("O arquivo não pode ter mais que 1MB de tamanho.");
            $("#checkTermosUso").attr("disabled", true);
        } else {
            $("#checkTermosUso").removeAttr("disabled");
        }
    });

    $('#orcamento-telefone').mask("(00) 00000-0000");
    $('#orcamento-gasto').mask("000.000.000.000.000,00", {reverse: true});

    $("#form-orcamento").on('submit', (function (e) {

        $('#botao-enviar-orcamento').html('<i class="fa fa-spinner fa-pulse"></i> Aguarde...');
        $("#botao-enviar-orcamento").prop('disabled', true);

        e.preventDefault();
        $.ajax({
            url: vsUrl + "wdadmin/controllers/SalvaDadosOrcamentosRecebidos.php",
            type: "POST",
            async: true,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (vsReturn) {
                $("#botao-enviar-orcamento").html('Enviar Dados');
                $("#botao-enviar-orcamento").prop("disabled", false);
                if (vsReturn == "1") {
                    LimpaForm();
                    Sucesso();
                } else {
                    Aviso();
                }
            },
            error: function (vsReturn) {
                $("#botao-enviar-orcamento").html('Enviar Dados');
                $("#botao-enviar-orcamento").prop("disabled", false);
                alert('Erro: ' + vsReturn);
            }
        });
        return false;
    }));
});

function Sucesso() {
    swal("Parabéns!", "Orçamento enviado com sucesso!", "success");
}

function Aviso() {
    swal("Aviso!", "Ocorreu um erro ao enviar o orçamento!", "warning");
}

function AvisoPersonalizado(mensagem) {
    swal("Aviso!", mensagem, "warning");
}

function LimpaForm() {
    $("#orcamento-nome").val("");
    $("#orcamento-cidade").val("");
    $("#orcamento-email").val("");
    $("#orcamento-gasto").val("");
    $("#orcamento-telefone").val("");
    $("#orcamento-anexo").val("");
    $("#orcamento-mensagem").val("");
}