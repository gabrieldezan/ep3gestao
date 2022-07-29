$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    $(this).attr("title", "WD Admin - Associados");

    $('#div_tabela').hide();
    $('#div_aviso').hide();

    $("#botao_imprimir_associado").click(function () {
        window.print();
    });

    $("#inputArquivo").change(function () {

        var fr = new FileReader;

        fr.onload = function () {
            var img = new Image;

            img.onload = function () {};
            img.src = fr.result;
        };
        fr.readAsDataURL(this.files[0]);
    });

    $("#botao_apagar_registros").click(function () {
        swal({
            title: "Atenção!",
            text: "Você realmente deseja remover registros financeiros?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sim, quero excluir!",
            closeOnConfirm: false
        }, function () {
            apagar_registros();
        });
    });

    $('#tabela_associados').DataTable();

    $("#form_conciliacao").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: vsUrl + "controllers/SalvaDadosConciliacao.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                CloseLoading();
                if (data === "1") {
                    $(".dropify-clear").click();
                    Sucesso();
                } else {
                    AvisoPersonalizado(data);
                }
            },
            error: function () {
                CloseLoading();
                Erro();
            }
        });
        return false;
    }));

    carrega_associados();

});

/*PESQUISA OS SERVIÇOS*/
function carrega_associados() {

    $.ajax({
        url: vsUrl + "controllers/RetornaAssociados.php",
        type: "POST",
        dataType: "json",
        async: false,
        success: function (data) {
            if (data !== 0) {
                $("#tabela_associados tbody").html("");
                $('#tabela_associados').DataTable().destroy();
                var table = $('#tabela_associados').DataTable({
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
                        },
                        {
                            text: '<i class="fas fa-plus"></i> Novo',
                            action: function () {
                                window.location.href = "associados/cadastro";
                            }
                        }
                    ],
                    fixedHeader: false,
                    colReorder: false,
                    responsive: false,
                    "processing": true,
                    data: data,
                    "columns": [
                        {"data": "id_associados"},
                        {"data": "nome"},
                        {"data": "cpf_cnpj"},
                        {"data": "data_nascimento"},
                        {"data": "idade"},
                        {"data": "telefone"},
                        {"data": "dependentes"},
                        {"data": "plano"},
                        {
                            "render": function (data, type, row) {
                                return "<span class=\"label label-" + row.status_class + "\">" + row.status + "</span>";
                            }
                        },
                        {
                            "render": function (data, type, row) {
                                return "\
                                    <a href=\"associados/cadastro/" + row.id_associados + "\" class=\"btn btn-sm btn-outline-secondary\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar " + row.nome + "\"><i class=\"fas fa-edit\"></i></a>&nbsp;\n\
                                    <button class=\"btn btn-sm btn-outline-primary\" onclick=\"ver_dados_associado(" + row.id_associados + ")\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Visualizar cadastro do Associado " + row.nome + "\"><i class=\"fas fa-eye\"></i></button>\n\
                                ";
                            }
                        }
                    ],
                    'columnDefs': [
                        {
                            "targets": 0,
                            "className": "text-center"
                        },
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
                        }
                    ],
                    "drawCallback": function (settings) {
                        $('[data-toggle="tooltip"]').tooltip();
                    },
                    "order": [[1, "asc"]]
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
            $("#tabela_associados tbody").html("");
            CloseLoading();
            Erro();
        }
    });
}

function apagar_registros() {
    Loading();

    $.ajax({
        url: vsUrl + "controllers/RemoveDadosConciliacao.php",
        type: "POST",
        dataType: "json",
        async: false,
        success: function (data) {
            CloseLoading();
            if (data > 0) {
                swal("Parabéns!", "Registros removidos com sucesso.", "success");
            } else {
                Aviso();
            }
        },
        error: function () {
            CloseLoading();
            Erro();
        }
    });
//    return false;
}