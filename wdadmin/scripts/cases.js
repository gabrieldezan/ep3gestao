$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    $(this).attr("title", "WD Admin - Cases");

    $('#div_tabela').hide();
    $('#div_aviso').hide();

    monta_select("inputFiltroIdClientes", "id_clientes", "descricao", "clientes", "WHERE status = 1", "descricao", "", true);

    $("#botao_pesquisa_cases").click(function () {
        Loading();
        carrega_cases();
    });

    $('#tabela_cases').DataTable();

    carrega_cases();

});

/*PESQUISA OS CASES*/
function carrega_cases() {

    $.ajax({
        url: vsUrl + "controllers/RetornaCases.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viFiltroIdClientes: $("#inputFiltroIdClientes").val()
        }),
        success: function (data) {
            if (data !== 0) {
                $("#tabela_cases tbody").html("");
                $('#tabela_cases').DataTable().destroy();
                var table = $('#tabela_cases').DataTable({
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
                                window.location.href = "cases/cadastro";
                            }
                        }
                    ],
                    fixedHeader: false,
                    colReorder: false,
                    responsive: false,
                    "processing": true,
                    data: data,
                    "columns": [
                        {"data": "id_cases"},
                        {"data": "cliente"},
                        {"data": "servico"},
                        {
                            "render": function (data, type, row) {
                                return "\
                                    <a href=\"" + vsUrl + "uploads/cases/" + row.arquivo + "\" target=\"_blank\"class=\"btn btn-sm btn-primary\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Baixar case de " + row.cliente + "\"><i class=\"fas fa-download\"></i></a>&nbsp;\n\
                                    <a href=\"cases/cadastro/" + row.id_cases + "\" class=\"btn btn-sm btn-outline-secondary\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar case de " + row.cliente + "\"><i class=\"fas fa-edit\"></i></a>&nbsp;\n\
                                    <button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"confirma_exclusao_registro(" + row.id_cases + ", 'cases', 'cases', '" + row.imagem + "', '" + row.arquivo + "', '', '', '');\" data-toggle=\"tooltip\" title=\"Remover case de " + row.cliente + "\"><i class=\"far fa-trash-alt fa-fw\" aria-hidden=\"true\"></i></button>\
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
                            "targets": 3,
                            "className": "text-center"
                        }
                    ],
                    "drawCallback": function (settings) {
                        $('[data-toggle="tooltip"]').tooltip();
                    },
                    "order": [[1, "asc"], [2, "asc"]]
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
            $("#tabela_cases tbody").html("");
            CloseLoading();
            Erro();
        }
    });
}