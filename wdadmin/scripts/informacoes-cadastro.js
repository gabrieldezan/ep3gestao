$(document).ready(function () {

    vsUrl = $("#vsUrl").val();
    viIdConteudoPersonalizado = $("#hiddenIdConteudoPersonalizado").val();
    vsTitulo = $("#hiddenTitulo").val();
    vsLargura = $("#hiddenLargura").val();
    vsAltura = $("#hiddenAltura").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Informações: " + vsTitulo);
    
    $(".fileHelp").html("Dimensão: " + vsLargura + "x" + vsAltura + "px. (Deixe em branco para manter o arquivo atual)");

    $("#inputImagem").change(function () {

        if (this.files[0].size > 2000000) {
            AvisoPersonalizado("A imagem não pode ter mais que 2MB de tamanho.");
            $("#botao_salvar").attr("disabled", true);
        } else {
            var fr = new FileReader;

            fr.onload = function () {
                var img = new Image;

                img.onload = function () {
                    if (img.width != "" + vsLargura + "" && this.height != "" + vsAltura + "") {
                        AvisoPersonalizado("A imagem não está no tamanho adequado. Dimensão exata: " + vsLargura + "x" + vsAltura + " pixels.");
                        $("#botao_salvar").attr("disabled", true);
                    } else {
                        $("#botao_salvar").removeAttr("disabled");
                    }
                };
                img.src = fr.result;
            };
            fr.readAsDataURL(this.files[0]);
        }
    });

    if ($("#inputTexto").length > 0) {
        tinymce.init({
            selector: "textarea#inputTexto",
            language: 'pt_BR',
            language_url: vsUrl + '/js/pt_BR.js',
            theme: "modern",
            height: 200,
            width: '100%',
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
        });
    }

    $("#form_informacoes").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosInformacoes.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    $("#inputIdInformacoes").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdInformacoes").val(data);
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
    monta_form(viIdConteudoPersonalizado);
    verifica_edicao();

});

/*FUNÇÃO QUE MONTA O FORMULÁRIO*/
function monta_form(viIdConteudoPersonalizado) {
    $.ajax({
        url: vsUrl + "controllers/RetornaConteudoPersonalizadoSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdConteudoPersonalizado: viIdConteudoPersonalizado
        }),
        success: function (data) {
            for (i = 0; i < data.length; i++) {
                if (data[i].icone == 0) {
                    $("#linha-icone").css("display", "none");
                }
                if (data[i].imagem == 0) {
                    $("#linha-imagem").css("display", "none");
                }
                if (data[i].texto == 0) {
                    $("#linha-texto").css("display", "none");
                }
                if (data[i].link == 0) {
                    $("#linha-link").css("display", "none");
                }
                if (data[i].data == 0) {
                    $("#linha-data").css("display", "none");
                }
                if (data[i].hora == 0) {
                    $("#linha-hora").css("display", "none");
                }
                if (data[i].numero == 0) {
                    $("#linha-numero").css("display", "none");
                }
            }
        },
        error: function () {
            Erro();
        }
    });
}

/*FUNÇÃO QUE VERIFICA SE EXISTE UM ID*/
function verifica_edicao() {

    /*PEGA ID*/
    var id = $("#inputIdInformacoes").val();

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_informacoes(id);
    } else {
        CloseLoading();
    }
}

/*CARREGA DADOS DAS INFORMAÇÕES SELECIONADAS*/
function edita_informacoes(viIdInformacoes) {

    $.ajax({
        url: vsUrl + "controllers/RetornaInformacoesSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdInformacoes: viIdInformacoes
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputTitulo").val(data[0].titulo);
                $("#inputIcone").val(data[0].icone);
                $("#inputImagemAtual").val(data[0].imagem);
                $("#imgImagemAtual").attr("src", vsUrl + "uploads/informacoes/" + data[0].imagem);
                $("#inputTexto").val(data[0].texto);
                $("#inputLink").val(data[0].link);
                $("#inputData").val(data[0].data);
                $("#inputHora").val(data[0].hora);
                $("#inputNumero").val(data[0].numero);
                CloseLoading();
            } else {
                $("#inputIdInformacoes").val("");
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