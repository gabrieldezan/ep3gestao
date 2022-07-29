$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    $(this).attr("title", "WD Admin - Perguntas Frequentes");

    $('#div_tabela').hide();
    $('#div_aviso').hide();
    
    monta_select("inputFiltroIdServicos", "id_servicos", "titulo", "servicos", "WHERE status = 1", "titulo", "", true);
    
    $("#botao_pesquisa_perguntas_frequentes").click(function () {
        Loading();
        carrega_perguntas_frequentes();
    });
    
    $('#tabela_perguntas_frequentes').DataTable();

    carrega_perguntas_frequentes();

});

/*PESQUISA OS PERGUNTAS FREQUENTES*/
function carrega_perguntas_frequentes() {

    $.ajax({
        url: vsUrl + "controllers/RetornaPerguntasFrequentes.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viFiltroIdServicos: $("#inputFiltroIdServicos").val()
        }),
        success: function (data) {
            if (data !== 0) {
                $("#tabela_perguntas_frequentes tbody").html("");
                $('#tabela_perguntas_frequentes').DataTable().destroy();
                var table = $('#tabela_perguntas_frequentes').DataTable({
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
                                window.location.href = "perguntas-frequentes/cadastro";
                            }
                        }
                    ],
                    fixedHeader: false,
                    colReorder: false,
                    responsive: false,
                    "processing": true,
                    data: data,
                    "columns": [
                        {"data": "id_perguntas_frequentes"},
                        {"data": "numero"},
                        {"data": "pergunta"},
                        {
                            "render": function (data, type, row) {
                                return "\
                                    <a href=\"perguntas-frequentes/cadastro/" + row.id_perguntas_frequentes + "\" class=\"btn btn-sm btn-outline-secondary\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar pergunta " + row.numero + " de " + row.solucao + "\"><i class=\"fas fa-edit\"></i></a>&nbsp;\n\
                                    <button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"confirma_exclusao_registro(" + row.id_perguntas_frequentes + ", 'perguntas_frequentes', '', '', '', '', '', '');\" data-toggle=\"tooltip\" title=\"Remover pergunta " + row.numero + " de " + row.solucao + "\"><i class=\"far fa-trash-alt fa-fw\" aria-hidden=\"true\"></i></button>\
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
                            "targets": 2,
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
            $("#tabela_perguntas_frequentes tbody").html("");
            CloseLoading();
            Erro();
        }
    });
}