$(document).ready(function () {

    ell = document.getElementById("inputValor");
    if (ell) {
        ell.addEventListener("DOMContentLoaded", function () {
            this.value = parseFloat(this.value).toFixed(2);
        });
    }

    vsUrl = $("#vsUrl").val();

    $(this).attr("title", "WD Admin - Eventos");

    $('#div_tabela').hide();
    $('#div_aviso').hide();

    $("#inputFiltroIdGrupoVitrine").change(function () {
        if ($("#inputFiltroIdGrupoVitrine").val() !== "T") {
            monta_select("inputFiltroIdSubgrupoVitrine", "id_vitrine_subgrupo", "descricao", "vitrine_subgrupo", "WHERE status = 1 AND id_vitrine_grupo = " + $("#inputFiltroIdGrupoVitrine").val(), "descricao", "", true);
        } else {
            $('#inputFiltroIdSubgrupoVitrine option[value!="T"]').remove();
        }
    });

    $("#botao_pesquisa_eventos").click(function () {
        Loading();
        carrega_eventos();
    });

    $('#tabela_eventos').DataTable();

    carrega_eventos();

});

/*PESQUISA OS PRODUTOS*/
function carrega_eventos() {
  
    $.ajax({
        url: vsUrl + "controllers/RetornaEventos.php",
        type: "POST",
        dataType: "json",
        async: false,
        success: function (data) {
            if (data !== 0) {
                $("#tabela_eventos tbody").html("");
                $('#tabela_eventos').DataTable().destroy();
                var table = $('#tabela_eventos').DataTable({
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
                                window.location.href = "eventos/cadastro";
                            }
                        }
                    ],
                    fixedHeader: false,
                    colReorder: false,
                    responsive: false,
                    "processing": true,
                    data: data,
                    "columns": [
                        {"data": "id_eventos"},
                        {"data": "descricao"},
                        {"data": "data_evento"},
                        {"data": "valor"},
                        {
                            "render": function (data, type, row) {
                                return "<span class=\"label label-" + row.status_class + "\">" + row.status + "</span>";
                            }
                        },
                        {
                            "render": function (data, type, row) {
                                return "<a href=\"eventos/cadastro/" + row.id_eventos + "\" class=\"btn btn-sm btn-outline-secondary\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar " + row.descricao + "\"><i class=\"fas fa-edit\"></i></a>";
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
            $("#tabela_eventos tbody").html("");
            CloseLoading();
            Erro();
        }
    });
}