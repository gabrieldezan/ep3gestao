$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    $(this).attr("title", "WD Admin - Tamanhos Imagens");

    $('#div_tabela').hide();
    $('#div_aviso').hide();

    $('#tabela_tamanho_imagens').DataTable();

    carrega_tamanho_imagens();

});

/*PESQUISA O TAMANHO IMAGENS*/
function carrega_tamanho_imagens() {

    Loading();

    $.ajax({
        url: vsUrl + "controllers/RetornaTamanhoImagens.php",
        type: "POST",
        dataType: "json",
        async: false,
        success: function (data) {
            if (data !== 0) {
                $("#tabela_tamanho_imagens tbody").html("");
                $('#tabela_tamanho_imagens').DataTable().destroy();
                var table = $('#tabela_tamanho_imagens').DataTable({
                    "language": {
                        "url": vsUrl + "assets/plugins/datatables/Portuguese-Brasil.json"
                    },
                    "lengthMenu": [[25, 50, 100, 250, -1], [25, 50, 100, 250, "Todos"]],
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
                                window.location.href = "tamanho-imagens/cadastro";
                            }
                        }
                    ],
                    fixedHeader: false,
                    colReorder: false,
                    responsive: false,
                    "processing": true,
                    data: data,
                    "columns": [
                        {"data": "id_tamanho_imagens"},
                        {"data": "tabela"},
                        {"data": "campo"},
                        {"data": "largura"},
                        {"data": "altura"},
                        {
                            "render": function (data, type, row) {
                                return "\
                                    <a href=\"tamanho-imagens/cadastro/" + row.id_tamanho_imagens + "\" class=\"btn btn-sm btn-outline-secondary\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar " + row.tabela + "\"><i class=\"fas fa-edit\"></i></a>&nbsp;\n\
                                    <button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"confirma_exclusao_registro(" + row.id_tamanho_imagens + ", 'tamanho_imagens', '', '', '', '', '', '');\" data-toggle=\"tooltip\" title=\"Remover " + row.tabela + "\"><i class=\"far fa-trash-alt fa-fw\" aria-hidden=\"true\"></i></button>\
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
                    }
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
            $("#tabela_tamanho_imagens tbody").html("");
            CloseLoading();
            Erro();
        }
    });
}