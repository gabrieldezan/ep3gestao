$("#botao-enviar-form").attr("disabled", true);
$("#checkTermosUso").change(function () {
    if ($('#checkTermosUso').is(':checked')) {
        $("#botao-enviar-form").attr("disabled", false);
    } else {
        $("#botao-enviar-form").attr("disabled", true);
    }
});
jQuery(function (a) {
    vsUrl = a("#vsUrl").val();

    $('#empresa-cnpj').mask("00.000.000/0000-00");
    $('#empresa-telefone').mask("(00) 00000-0000");

    $("#form_plano_empresarial").on('submit', (function (e) {

        $('#botao-enviar-form').html('<i class="fa fa-spinner fa-pulse"></i> Aguarde...');
        $("#botao-enviar-form").prop('disabled', true);

        e.preventDefault();
        $.ajax({
            url: vsUrl + "wdadmin/controllers/SalvaDadosPlanosEmpresariaisRecebidos.php",
            type: "POST",
            async: true,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (vsReturn) {
                $("#botao-enviar-form").html('Simular Planos');
                $("#botao-enviar-form").prop("disabled", false);
                if (vsReturn == "1") {
                    LimpaForm();
                    Sucesso();
                } else {
                    Aviso();
                }
            },
            error: function (vsReturn) {
                $("#botao-enviar-form").html('Simular Planos');
                $("#botao-enviar-form").prop("disabled", false);
                alert('Erro: ' + vsReturn);
            }
        });
        return false;
    }));
});

function Sucesso() {
    swal("Parabéns!", "Formulário enviado com sucesso!", "success");
}

function Aviso() {
    swal("Aviso!", "Ocorreu um erro ao enviar o formulário!", "warning");
}

function AvisoPersonalizado(mensagem) {
    swal("Aviso!", mensagem, "warning");
}