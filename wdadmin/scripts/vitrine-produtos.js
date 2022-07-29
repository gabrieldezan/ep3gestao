$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    $(this).attr("title", "WD Admin - Produtos da Vitrine");

    $('#div_tabela').hide();
    $('#div_aviso').hide();

    monta_select("inputFiltroIdGrupoVitrine", "id_vitrine_grupo", "descricao", "vitrine_grupo", "WHERE status = 1", "descricao", "", true);

    $("#inputFiltroIdGrupoVitrine").change(function () {
        if ($("#inputFiltroIdGrupoVitrine").val() !== "T") {
            monta_select("inputFiltroIdSubgrupoVitrine", "id_vitrine_subgrupo", "descricao", "vitrine_subgrupo", "WHERE status = 1 AND id_vitrine_grupo = " + $("#inputFiltroIdGrupoVitrine").val(), "descricao", "", true);
        } else {
            $('#inputFiltroIdSubgrupoVitrine option[value!="T"]').remove();
        }
    });

    $("#botao_pesquisa_vitrine_produtos").click(function () {
        Loading();
        carrega_vitrine_produtos();
    });

    $('#tabela_vitrine_produtos').DataTable();

    carrega_vitrine_produtos();

});

/*PESQUISA OS PRODUTOS*/
function carrega_vitrine_produtos() {

    $.ajax({
        url: vsUrl + "controllers/RetornaVitrineProdutos.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viFiltroIdGrupoVitrine: $("#inputFiltroIdGrupoVitrine").val(),
            viFiltroIdSubgrupoVitrine: $("#inputFiltroIdSubgrupoVitrine").val()
        }),
        success: function (data) {
            if (data !== 0) {
                $("#tabela_vitrine_produtos tbody").html("");
                $('#tabela_vitrine_produtos').DataTable().destroy();
                var table = $('#tabela_vitrine_produtos').DataTable({
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
                                window.location.href = "vitrine-produtos/cadastro";
                            }
                        }
                    ],
                    fixedHeader: false,
                    colReorder: false,
                    responsive: false,
                    "processing": true,
                    data: data,
                    "columns": [
                        {"data": "id_vitrine_produto"},
                        {"data": "descricao"},
                        {"data": "grupo"},
                        {"data": "subgrupo"},
                        {
                            "render": function (data, type, row) {
                                return "<span class=\"label label-" + row.situacao_class + "\">" + row.situacao + "</span>";
                            }
                        },
                        {
                            "render": function (data, type, row) {
                                return "<span class=\"label label-" + row.status_class + "\">" + row.status + "</span>";
                            }
                        },
                        {"data": "valor"},
                        {
                            "render": function (data, type, row) {
                                return "<a href=\"vitrine-produtos/cadastro/" + row.id_vitrine_produto + "\" class=\"btn btn-sm btn-outline-secondary\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar " + row.descricao + "\"><i class=\"fas fa-edit\"></i></a>";
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
                        },
                        {
                            "targets": 7,
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
            $("#tabela_vitrine_produtos tbody").html("");
            CloseLoading();
            Erro();
        }
    });
}