$(document).ready(function () {

    vsUrl = $("#vsUrl").val();
    vsIdConteudoPersonalizado = $("#hiddenIdConteudoPersonalizado").val();
    vsTitulo = $("#hiddenTitulo").val();

    $(this).attr("title", "WD Admin - Informações: " + vsTitulo);

    $('#div_tabela').hide();
    $('#div_aviso').hide();

    $('#tabela_informacoes').DataTable();

    carrega_informacoes();

});

/*PESQUISA AS INFORMAÇÕES DA PÁGINA SELECIONADA*/
function carrega_informacoes() {

    $.ajax({
        url: vsUrl + "controllers/RetornaInformacoes.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: {'vsIdConteudoPersonalizado': vsIdConteudoPersonalizado},
        success: function (data) {
            if (data !== 0) {
                $("#tabela_informacoes tbody").html("");
                $('#tabela_informacoes').DataTable().destroy();
                var table = $('#tabela_informacoes').DataTable({
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
                                window.location.href = "informacoes/cadastro";
                            }
                        }
                    ],
                    fixedHeader: false,
                    colReorder: false,
                    responsive: false,
                    "processing": true,
                    data: data,
                    "columns": [
                        {"data": "id_informacoes"},
                        {"data": "titulo"},
                        {
                            "render": function (data, type, row) {
                                return "\
                                    <a href=\"informacoes/cadastro/" + row.id_informacoes + "\" class=\"btn btn-sm btn-outline-secondary\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar " + row.titulo + "\"><i class=\"fas fa-edit\"></i></a>&nbsp;\n\
                                    <button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"confirma_exclusao_registro(" + row.id_informacoes + ", 'informacoes', 'informacoes', '" + row.imagem + "', '', '', '', '');\" data-toggle=\"tooltip\" title=\"Remover " + row.titulo + "\"><i class=\"far fa-trash-alt fa-fw\" aria-hidden=\"true\"></i></button>\
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
            $("#tabela_informacoes tbody").html("");
            CloseLoading();
            Erro();
        }
    });
}