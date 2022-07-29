$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    /*ALTERA TITULO DA PAGINA*/
    $(this).attr("title", "WD Admin - Cadastro de Associados");

    $('#div_tabela').hide();
    $('#div_aviso').hide();

    /*VALIDA TAMANHO E DIMENSÃO DAS IMAGENS DOS DOCUMENTOS CPF E RG*/
    $("#inputCpfFrente, #inputCpfVerso, #inputRgFrente, #inputRgVerso, #inputCpfFrenteDependentes, #inputCpfVersoDependentes, #inputRgFrenteDependentes, #inputRgVersoDependentes").change(function () {

        var fr = new FileReader;

        fr.onload = function () {
            var img = new Image;

            img.onload = function () {};
            img.src = fr.result;
        };
        fr.readAsDataURL(this.files[0]);
    });

    /*APLICA MASCARAS NOS CAMPOS*/
    $('#inputCpfCnpj').mask("000.000.000-00", {reverse: false});
    $('#inputRg').mask("00.000.000-00", {reverse: false});
    $('#inputCep').mask("00.000-000", {reverse: false});

    var behavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
            options = {onKeyPress: function (val, e, field, options) {
                    field.mask(behavior.apply({}, arguments), options);
                }};
    $('#inputTelefone').mask(behavior, options);

    $('#inputCelular').mask("(00) 00000-0000", {reverse: false});

    var behavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
            options = {onKeyPress: function (val, e, field, options) {
                    field.mask(behavior.apply({}, arguments), options);
                }};
    $('#inputReferenciaTelefone').mask(behavior, options);

    $('#inputCpfDependentes').mask("000.000.000-00", {reverse: false});
    $('#inputRgDependentes').mask("00.000.000-00", {reverse: false});

    /*HABILITA/DESABILITA CAMPOS DE ACORDO COM O TIPO DE PESSOA*/
    $("#inputTipoPessoa").change(function () {
        if ($("#inputTipoPessoa").val() === "2") {
            $('#inputCpfCnpj').val("");
            $('#inputCpfCnpj').append("placeholder", "ex.: 00.000.000/0000-00");
            $('#inputCpfCnpj').mask("00.000.000/0000-00", {reverse: false});
            $('#inputRg').val("");
            $('#inputDataNascimento').val("");
            $('#inputSexo').val("1");
            $('#inputNacionalidade').val("");
            $('#inputNaturalidade').val("");
            $('#inputEstadoCivil').val("1");
            $('#inputProfissao').val("");
            $(".pessoa-fisica").hide();
        } else {
            $('#inputCpfCnpj').val("");
            $('#inputCpfCnpj').append("placeholder", "ex.: 00.000.000-00");
            $('#inputCpfCnpj').mask("000.000.000-00", {reverse: false});
            $(".pessoa-fisica").show();
        }
    });

    /*MONTA OS SELECTS*/
    monta_select("inputIdEstado", "id_estado", "nome", "estado", "", "nome", "", true);
    monta_select("inputIdPlanos", "id_planos", "titulo", "planos", "WHERE status = 1", "titulo", "", false);

    /*CARREGA SUBGRUPOS AO SELECIONAR O GRUPO*/
    $("#inputIdEstado").change(function () {
        if ($("#inputIdEstado").val() !== "T") {
            monta_select("inputIdCidade", "id_cidade", "nome", "cidade", "WHERE id_estado = " + $("#inputIdEstado").val(), "nome", "", true);
        } else {
            $('#inputIdCidade option[value!="T"]').remove();
        }
    });

    if ($("#inputObservacoes").length > 0) {
        tinymce.init({
            selector: "textarea#inputObservacoes",
            language: 'pt_BR',
            language_url: vsUrl + '/js/pt_BR.js',
            theme: "modern",
            height: 370,
            width: '100%',
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }

    /*BOTÃO NOVO DEPENDENTE*/
    $("#botao_novo_dependentes").click(function (e) {
        limpa_form_dependentes();
    });

    $('#tabela_financeiro').DataTable();

    $("#form_associados").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosAssociados.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data === "CE") {
                    CloseLoading();
                    AvisoPersonalizado("E-mail ou CPF/CNPJ já cadastrado!");
                } else if (data > 0) {
                    $("#inputIdAssociados").val() === "" ? AtualizaIdUrl(data) : "";
                    $("#inputIdAssociados").val(data);
                    $("#inputIdAssociadosDependentes").val(data);
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

    /*SUBMETE FORM DEPENDENTES*/
    $("#form_dependentes").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosDependentes.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    limpa_form_dependentes();
                    consulta_dependentes();
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
    var id = $("#inputIdAssociados").val();

    /*LIMPA AREA DE IMAGEM*/
    $(".dropify-clear").click();

    /*CASO EXISTA O ID, EXECUTA A FUNÇÃO DE EDIÇÃO*/
    if (id !== "") {
        edita_associados(id);
        consulta_dependentes();
        $('ul li a[href="#dependentes"]').removeClass("disabled");
        $('ul li a[href="#financeiro"]').removeClass("disabled");
//        $("#inputSenha").attr("required", false);
    } else {
        $('ul li a[href="#dependentes"]').addClass("disabled");
        $('ul li a[href="#financeiro"]').addClass("disabled");
//        $("#inputSenha").attr("required", true);
    }
    CloseLoading();
}

/*CARREGA DADOS DO SERVIÇO SELECIONADO*/
function edita_associados(viIdAssociados) {

    $.ajax({
        url: vsUrl + "controllers/RetornaAssociadosSelecionado.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdAssociados: viIdAssociados
        }),
        success: function (data) {
            if (data !== 0) {
                $("#inputTipoPessoa").val(data[0].tipo_pessoa);
                $("#inputNome").val(data[0].nome);
                $("#inputCpfCnpj").val(data[0].cpf_cnpj);
                $("#inputSenha").val("");
                $("#inputRg").val(data[0].rg);
                $("#inputDataNascimento").val(data[0].data_nascimento);
                $("#spanIdadeAssociado").html(data[0].idade);
                $("#inputRua").val(data[0].rua);
                $("#inputNumero").val(data[0].numero);
                $("#inputComplemento").val(data[0].complemento);
                $("#inputBairro").val(data[0].bairro);
                $("#inputCep").val(data[0].cep);
                $("#inputIdEstado").val(data[0].id_estado);
                monta_select("inputIdCidade", "id_cidade", "nome", "cidade", "WHERE id_estado = " + $("#inputIdEstado").val(), "nome", data[0].id_cidade, true, false);
                $("#inputTelefone").val(data[0].telefone);
                $("#inputCelular").val(data[0].celular);
                $("#inputEmail").val(data[0].email);
                $("#inputDataAdmissao").val(data[0].data_adesao);
                $("#inputSexo").val(data[0].sexo);
                $("#inputNacionalidade").val(data[0].nacionalidade);
                $("#inputNaturalidade").val(data[0].naturalidade);
                $("#inputEstadoCivil").val(data[0].estado_civil);
                $("#inputProfissao").val(data[0].profissao);
                $("#inputCpfFrenteAtual").val(data[0].foto_cpf_frente);
                $("#imgCpfFrenteAtual").attr("src", vsUrl + "uploads/associados/" + data[0].foto_cpf_frente);
                $("#inputCpfVersoAtual").val(data[0].foto_cpf_verso);
                $("#imgCpfVersoAtual").attr("src", vsUrl + "uploads/associados/" + data[0].foto_cpf_verso);
                $("#inputRgFrenteAtual").val(data[0].foto_cpf_frente);
                $("#imgRgFrenteAtual").attr("src", vsUrl + "uploads/associados/" + data[0].foto_rg_frente);
                $("#inputRgVersoAtual").val(data[0].foto_cpf_verso);
                $("#imgRgVersoAtual").attr("src", vsUrl + "uploads/associados/" + data[0].foto_rg_verso);
                $("#inputReferenciaNome").val(data[0].referencia_nome);
                $("#inputReferenciaTelefone").val(data[0].referencia_telefone);
                $("#inputObservacoes").val(data[0].observacoes);
                $("#inputIdPlanos").val(data[0].id_planos);
                $("#inputBanco").val(data[0].banco);
                $("#inputDiaVencimento").val(data[0].dia_vencimento);
                $("#inputStatus").val(data[0].status);
                $("#inputSeguro").val(data[0].seguro);
                consulta_financeiro(data[0].cpf_cnpj);
//                CloseLoading();
            } else {
                $("#inputIdAssociados").val("");
//                CloseLoading();
                AvisoPersonalizado("Dados não encontrados!");
            }
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}

/*CARREGA DEPENDENTES*/
function consulta_dependentes() {

    var viIdAssociado = $("#inputIdAssociadosDependentes").val();

    $.ajax({
        url: vsUrl + "controllers/RetornaDependentes.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdAssociado: viIdAssociado
        }),
        success: function (data) {
            qtdResultados = 0;
            if (data != 0) {

                $("#tabela_dependentes tbody").html("");
                for (i = 0; i < data.length; i++) {
                    $("#tabela_dependentes tbody").append(
                            "<tr>" +
                            "<td>" + data[i].codigo + "</td>" +
                            "<td>" + data[i].nome + "</td>" +
                            "<td>" + data[i].cpf + "</td>" +
                            "<td>" + data[i].rg + "</td>" +
                            "<td>" + data[i].data_nascimento_formatado + "</td>" +
                            "<td>" + data[i].idade + "</td>" +
                            "<td>" + data[i].parentesco + "</td>" +
                            "<td><span class=\"label label-" + data[i].status_class + "\">" + data[i].status + "</span></td>" +
                            "<td align=\"center\">" +
                            "<button type=\"button\" class=\"btn btn-secondary btn-sm\" onclick=\"edita_dependentes(" + data[i].id_dependentes + ")\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar " + data[i].nome + "\"><i class=\"far fa-edit fa-fw\" aria-hidden=\"true\"></i></button>" +
                            "</td>" +
                            "</tr>"
                            );
                    qtdResultados++;
                }
                $('[data-toggle="tooltip"]').tooltip();
            } else {
                $("#tabela_dependentes tbody").html("");
                $("#tabela_dependentes tbody").append(
                        "<tr>" +
                        "<td align=\"center\" colspan=\"6\">Nenhum dependente encontrado!</td>" +
                        "</tr>"
                        );
            }
            $("#inputCodigoDependente").val(qtdResultados + 1);
//            CloseLoading();
        },
        error: function () {
//            CloseLoading();
            Erro();
        }
    });
}

/*CARREGA DADOS DA DEPENDENTE SELECIONADA*/
function edita_dependentes(viIdDependentes) {

    Loading();

    $.ajax({
        url: vsUrl + "controllers/RetornaDependentesSelecionado.php",
        type: "POST",
        dataType: "json",
        data: ({
            viIdDependentes: viIdDependentes
        }),
        success: function (data) {
            limpa_form_dependentes();
            $("#inputIdDependentes").val(viIdDependentes);
            $("#inputCodigoDependente").val(data[0].codigo);
            $("#inputNomeDependentes").val(data[0].nome);
            $("#inputCpfDependentes").val(data[0].cpf);
            $("#inputRgDependentes").val(data[0].rg);
            $("#inputCpfFrenteDependentesAtual").val(data[0].foto_cpf_frente);
            $("#imgCpfFrenteDependentesAtual").attr("src", vsUrl + "uploads/dependentes/" + data[0].foto_cpf_frente);
            $("#inputCpfVersoDependentesAtual").val(data[0].foto_cpf_verso);
            $("#imgCpfVersoDependentesAtual").attr("src", vsUrl + "uploads/dependentes/" + data[0].foto_cpf_verso);
            $("#inputRgFrenteDependentesAtual").val(data[0].foto_cpf_frente);
            $("#imgRgFrenteDependentesAtual").attr("src", vsUrl + "uploads/dependentes/" + data[0].foto_rg_frente);
            $("#inputRgVersoDependentesAtual").val(data[0].foto_cpf_verso);
            $("#imgRgVersoDependentesAtual").attr("src", vsUrl + "uploads/dependentes/" + data[0].foto_rg_verso);
            $("#inputDataNascimentoDependentes").val(data[0].data_nascimento);
            $("#inputStatusParentesco").val(data[0].parentesco);
            $("#inputStatusDependentes").val(data[0].status);
            CloseLoading();
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
}

/*LIMPA FORMULÁRIO DEPENDENTES*/
function limpa_form_dependentes() {
    $(".dropify-clear").click();
    $("#inputIdDependentes").val("");
    $("#inputNomeDependentes").val("");
    $("#inputCpfDependentes").val("");
    $("#inputRgDependentes").val("");
    $("#inputCpfFrenteDependentesAtual").val("");
    $("#imgCpfFrenteDependentesAtual").attr("src", "");
    $("#inputCpfVersoDependentesAtual").val("");
    $("#imgCpfVersoDependentesAtual").attr("src", "");
    $("#inputRgFrenteDependentesAtual").val("");
    $("#imgRgFrenteDependentesAtual").attr("src", "");
    $("#inputRgVersoDependentesAtual").val("");
    $("#imgRgVersoDependentesAtual").attr("src", "");
    $("#inputDataNascimentoDependentes").val("");
    $("#inputStatusDependentes").val("1");
}

/*CARREGA FINANCEIRO*/
function consulta_financeiro(vsCpfCnpj) {

    $.ajax({
        url: vsUrl + "controllers/RetornaAssociadosFinanceiro.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            vsCpfCnpj: vsCpfCnpj
        }),
        success: function (data) {
            if (data !== 0) {
                $("#tabela_financeiro tbody").html("");
                $('#tabela_financeiro').DataTable().destroy();
                var table = $('#tabela_financeiro').DataTable({
                    "language": {
                        "url": vsUrl + "assets/plugins/datatables/Portuguese-Brasil.json"
                    },
                    "lengthMenu": [[10, 25, 50, 100, 250, -1], [10, 25, 50, 100, 250, "Todos"]],
                    dom: 'Blfrtip',
                    buttons: [
                        {
                            extend: 'copy',
                            text: '<i class="far fa-copy fa-fw"></i> Copiar',
                            exportOptions: {
                                modifier: {
                                    page: 'current'
                                }
                            }
                        },
                        {
                            extend: 'excel',
                            text: '<i class="far fa-file-excel fa-fw"></i> Excel',
                            exportOptions: {
                                modifier: {
                                    page: 'current'
                                }
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="far fa-file-pdf fa-fw"></i> PDF',
                            exportOptions: {
                                modifier: {
                                    page: 'current'
                                }
                            },
                            orientation: 'landscape',
                            pageSize: 'LEGAL'
                        },
                        {
                            extend: 'print',
                            text: '<i class="far fas fa-print fa-fw"></i> Imprimir',
                            exportOptions: {
                                modifier: {
                                    page: 'current'
                                }
                            },
                            orientation: 'landscape',
                            pageSize: 'LEGAL'
                        }
                    ],
                    fixedHeader: false,
                    colReorder: false,
                    responsive: false,
                    "processing": true,
                    data: data,
                    "columns": [
                        {"data": "identificador"},
                        {"data": "titulo"},
                        {"data": "tipo_cobranca"},
                        {"data": "data_vencimento_formatada"},
                        {"data": "data_pagamento_formatada"},
                        {"data": "valor_titulo"},
                        {"data": "valor_pago"},
                        {
                            "render": function (data, type, row) {
                                return "<span class=\"label label-" + row.status_class + "\">" + row.status + "</span>";
                            }
                        }
                    ],
                    'columnDefs': [
                        {
                            "targets": 2,
                            "className": "text-center"
                        },
                        {
                            "targets": 3,
                            "className": "text-center"
                        },
                        {
                            "targets": 4,
                            "className": "text-center"
                        },
                        {
                            "targets": 5,
                            "className": "text-center"
                        },
                        {
                            "targets": 6,
                            "className": "text-center"
                        },
                        {
                            "targets": 7,
                            "className": "text-center"
                        }
                    ],
                    "drawCallback": function (settings) {
                        $('[data-toggle="tooltip"]').tooltip();
                    },
                    "footerCallback": function (row, data, start, end, display) {
                        var api = this.api(), data;

                        // Remove the formatting to get integer data for summation
                        var intVal = function (i) {
                            return typeof i === 'string' ?
                                    i.replace(/[\$,.]/g, '') * 1 :
                                    typeof i === 'number' ?
                                    i : 0;
                        };

                        var formatReal = function (int) {
                            var tmp = int + '';
                            tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
                            if (tmp.length > 6)
                                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
                            return tmp;
                        };


                        // Total over all pages
                        total = api
                                .column(5)
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);
                        // Total over this page
                        pageTotal = api
                                .column(5, {page: 'current'})
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);
                        // Update footer
                        $(api.column(5).footer()).html(
                                'R$ ' + formatReal(pageTotal)
                                );


                        // Total over all pages
                        total = api
                                .column(6)
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);
                        // Total over this page
                        pageTotal = api
                                .column(6, {page: 'current'})
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);
                        // Update footer
                        $(api.column(6).footer()).html(
                                'R$ ' + formatReal(pageTotal)
                                );
                    }
                });
                $('#div_aviso').hide();
                $('#div_tabela').show();
            } else {
                $('#div_tabela').hide();
                $('#div_aviso').show();
            }
            CloseLoading();
        },
        error: function () {
            $("#tabela_financeiro tbody").html("");
            CloseLoading();
            Erro();
        }
    });

}