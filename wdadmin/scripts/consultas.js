$(document).ready(function () {

    vsUrl = $("#vsUrl").val();
    
    $(this).attr("title", "WD Admin - Consultas");

    $('#div_tabela').hide();
    $('#div_aviso').hide();
       
    $('#tabela_consultas').DataTable();

    carrega_consultas();

});

/*PESQUISA OS SERVIÇOS*/
function carrega_consultas() {
    
    $.ajax({
        url: vsUrl + "controllers/RetornaConsultas.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viIdParceiro: ("")
        }),
        success: function (data) {
            if (data !== 0) {
                $("#tabela_consultas tbody").html("");
                $('#tabela_consultas').DataTable().destroy();
                var table = $('#tabela_consultas').DataTable({
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
                                window.location.href = "consultas/cadastro";
                            }
                        }
                    ],
                    fixedHeader: false,
                    colReorder: false,
                    responsive: false,
                    "processing": true,
                    data: data,
                    "columns": [
                        {"data": "id_consulta"},
                        {"data": "data_hora"},
                        {"data": "valor"},
                        {
                            "render": function (data, type, row) {
                                return "<span class=\"label label-" + row.status_class + "\">" + row.status + "</span>";
                            }
                        },
                        {
                            "render": function (data, type, row) {
                                return "<a href=\"consultas/cadastro/" + row.id_consulta + "\" class=\"btn btn-sm btn-outline-secondary\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar " + row.id_consulta + "\"><i class=\"fas fa-edit\"></i></a>";
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
            $("#tabela_consultas tbody").html("");
            CloseLoading();
            Erro();
        }
    });
}