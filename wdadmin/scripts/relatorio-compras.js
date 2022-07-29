$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    $(this).attr("title", "WD Admin - Relatório de Compras");

    $('#div_tabela').hide();
    $('#div_aviso').hide();


    $("#botao_pesquisa_relatorio_eventos").click(function () {
        Loading();
        carrega_relatorio_compras();
    });

    $('#tabela_relatorio_compras').DataTable();

    carrega_relatorio_compras();

});

/*PESQUISA OS PRODUTOS*/
function carrega_relatorio_compras() {

    $.ajax({
        url: vsUrl + "controllers/RetornaRelatorioCompras.php",
        type: "POST",
        dataType: "json",
        async: false,
        success: function (data) {
            if (data !== 0) {
                $("#tabela_relatorio_compras tbody").html("");
                $('#tabela_relatorio_compras').DataTable().destroy();
                var table = $('#tabela_relatorio_compras').DataTable({
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
                        {"data": "idvenda"},
                        {"data": "evento"},
                        {"data": "comprador"},
                        {"data": "time"},
                        {"data": "participante"},
                        {"data": "cpf"},
                        {"data": "valor"},
                        {
                            "render": function (data, type, row) {
                                return "<span class=\"label label-" + row.status_class + "\">" + row.status + "</span>";
                            }
                        },
                        {"data": "camiseta"}

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
                        },
                        {
                            "targets": 8,
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
            $("#tabela_relatorio_compras tbody").html("");
            CloseLoading();
            Erro();
        }
    });
}