$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Sobre");

    if ($("#inputTexto").length > 0) {
        tinymce.init({
            selector: "textarea#inputTexto",
            language: 'pt_BR',
            language_url: vsUrl + '/js/pt_BR.js',
            theme: "modern",
            height: 300,
            width: '100%',
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }

    verifica_tamanho_imagens("sobre");

    $("#form_sobre").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosSobre.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    edita_sobre();
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
    edita_sobre();

});

/*FUNÇÃO QUE VERIFICA SE EXISTE UM ID*/
function edita_sobre() {

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();

    $.ajax({
        url: vsUrl + "controllers/RetornaSobre.php",
        type: "POST",
        dataType: "json",
        async: false,
        success: function (data) {
            if (data !== 0) {
                $("#inputResumoTexto").val(data[0].resumo_texto);
                $("#inputTexto").val(data[0].texto);
                $("#imgImagemAtual").attr("src", vsUrl + "uploads/sobre/" + data[0].imagem);
                $("#inputImagemAtual").val(data[0].imagem);
                $("#inputLink").val(data[0].link);
            }
            CloseLoading();
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}