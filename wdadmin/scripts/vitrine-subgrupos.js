$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    $(this).attr("title", "WD Admin - Subgrupos da Vitrine");

    $('#div_tabela').hide();
    $('#div_aviso').hide();
    
    monta_select("inputFiltroIdGrupoVitrine", "id_vitrine_grupo", "descricao", "vitrine_grupo", "WHERE status = 1", "descricao", "", true);
    
    $("#botao_pesquisa_vitrine_subgrupo").click(function () {
        Loading();
        carrega_vitrine_subgrupo();
    });
    
    $('#tabela_vitrine_subgrupo').DataTable();

    carrega_vitrine_subgrupo();

});

/*PESQUISA OS SUBGRUPOS*/
function carrega_vitrine_subgrupo() {

    $.ajax({
        url: vsUrl + "controllers/RetornaVitrineSubgrupos.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            inputFiltroIdGrupoVitrine: $("#inputFiltroIdGrupoVitrine").val()
        }),
        success: function (data) {
            if (data !== 0) {
                $("#tabela_vitrine_subgrupo tbody").html("");
                $('#tabela_vitrine_subgrupo').DataTable().destroy();
                var table = $('#tabela_vitrine_subgrupo').DataTable({
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
                                window.location.href = "vitrine-subgrupos/cadastro";
                            }
                        }
                    ],
                    fixedHeader: false,
                    colReorder: false,
                    responsive: false,
                    "processing": true,
                    data: data,
                    "columns": [
                        {"data": "id_vitrine_subgrupo"},
                        {"data": "descricao"},
                        {"data": "grupo"},
                        {
                            "render": function (data, type, row) {
                                return "<span class=\"label label-" + row.status_class + "\">" + row.status + "</span>";
                            }
                        },
                        {
                            "render": function (data, type, row) {
                                return "<a href=\"vitrine-subgrupos/cadastro/" + row.id_vitrine_subgrupo + "\" class=\"btn btn-sm btn-outline-secondary\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar " + row.descricao + "\"><i class=\"fas fa-edit\"></i></a>";
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
            $("#tabela_vitrine_subgrupo tbody").html("");
            CloseLoading();
            Erro();
        }
    });
}