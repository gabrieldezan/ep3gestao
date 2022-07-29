$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    $(this).attr("title", "WD Admin - Redes Sociais");

    $('#div_tabela').hide();
    $('#div_aviso').hide();

    $('#tabela_redes_sociais').DataTable();

    carrega_redes_sociais();

});

/*PESQUISA OS CLIENTES*/
function carrega_redes_sociais() {

    $.ajax({
        url: vsUrl + "controllers/RetornaRedesSociais.php",
        type: "POST",
        dataType: "json",
        async: false,
        success: function (data) {
            if (data !== 0) {
                $("#tabela_redes_sociais tbody").html("");
                $('#tabela_redes_sociais').DataTable().destroy();
                var table = $('#tabela_redes_sociais').DataTable({
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
                                window.location.href = "redes-sociais/cadastro";
                            }
                        }
                    ],
                    fixedHeader: false,
                    colReorder: false,
                    responsive: false,
                    "processing": true,
                    data: data,
                    "columns": [
                        {"data": "id_redes_sociais"},
                        {
                            "render": function (data, type, row) {
                                return "<img src=\"" + vsUrl + "uploads/redes-sociais/" + row.imagem + "\" class=\"img-fluid\" style=\"max-height:40px;\" />";
                            }
                        },
                        {"data": "titulo"},
                        {
                            "render": function (data, type, row) {
                                return "<a href=\"" + row.link + "\" target=\"_blank\">" + row.link + "</a>";
                            }
                        },
                        {
                            "render": function (data, type, row) {
                                return "\
                                    <a href=\"redes-sociais/cadastro/" + row.id_redes_sociais + "\" class=\"btn btn-sm btn-outline-secondary\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar " + row.titulo + "\"><i class=\"fas fa-edit\"></i></a>&nbsp;\n\
                                    <button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"confirma_exclusao_registro(" + row.id_redes_sociais + ", 'redes_sociais', 'redes-sociais', '" + row.imagem + "', '', '', '', '');\" data-toggle=\"tooltip\" title=\"Remover " + row.titulo + "\"><i class=\"far fa-trash-alt fa-fw\" aria-hidden=\"true\"></i></button>\
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
                            "targets": 1,
                            "className": "text-center"
                        },
                        {
                            "targets": 3,
                            "className": "text-center"
                        },
                        {
                            "targets": 4,
                            "className": "text-center"
                        }
                    ],
                    "drawCallback": function (settings) {
                        $('[data-toggle="tooltip"]').tooltip();
                    },
                    "order": [[2, "asc"]]
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
            $("#tabela_redes_sociais tbody").html("");
            CloseLoading();
            Erro();
        }
    });
}