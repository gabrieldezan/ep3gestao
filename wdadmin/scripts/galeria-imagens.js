$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    $(this).attr("title", "WD Admin - Imagens da Galeria");

    $('#div_tabela').hide();
    $('#div_aviso').hide();
    
    monta_select("inputFiltroIdGaleriaGrupo", "id_galeria_grupo", "descricao", "galeria_grupo", "WHERE status = 1", "descricao", "", true);
    
    $("#botao_pesquisa_galeria_itens").click(function () {
        Loading();
        carrega_galeria_imagens();
    });
    
    $('#tabela_galeria_imagens').DataTable();

    carrega_galeria_imagens();

});

/*PESQUISA O COMUNICADOS FORMAIS*/
function carrega_galeria_imagens() {

    $.ajax({
        url: vsUrl + "controllers/RetornaGaleriaImagens.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viFiltroIdGaleriaGrupo: $("#inputFiltroIdGaleriaGrupo").val()
        }),
        success: function (data) {
            if (data !== 0) {
                $("#tabela_galeria_imagens tbody").html("");
                $('#tabela_galeria_imagens').DataTable().destroy();
                var table = $('#tabela_galeria_imagens').DataTable({
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
                                window.location.href = "galeria-imagens/cadastro";
                            }
                        }
                    ],
                    fixedHeader: false,
                    colReorder: false,
                    responsive: false,
                    "processing": true,
                    data: data,
                    "columns": [
                        {"data": "id_galeria_imagem"},
                        {"data": "descricao"},
                        {
                            "render": function (data, type, row) {
                                return "<img src=\"" + vsUrl + "uploads/galeria_imagens/" + row.imagem1 + "\" class=\"img-fluid\" style=\"height:170px;\" />";
                            }
                        },
                        {"data": "titulo"},
                        {
                            "render": function (data, type, row) {
                                return "\
                                    <a href=\"galeria-imagens/cadastro/" + row.id_galeria_imagem + "\" class=\"btn btn-sm btn-outline-secondary\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar " + row.titulo + "\"><i class=\"fas fa-edit\"></i></a>&nbsp;\n\
                                    <button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"confirma_exclusao_registro(" + row.id_galeria_imagem + ", 'galeria_imagem', 'galeria_imagens', '" + row.imagem + "', '', '', '', '');\" data-toggle=\"tooltip\" title=\"Remover " + row.titulo + "\"><i class=\"far fa-trash-alt fa-fw\" aria-hidden=\"true\"></i></button>\
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
                        },
                        {
                            "targets": 4,
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
            $("#tabela_galeria_imagens tbody").html("");
            CloseLoading();
            Erro();
        }
    });
}