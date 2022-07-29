$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    $(this).attr("title", "WD Admin - Imagens do Blog");

    $('#div_tabela').hide();
    $('#div_aviso').hide();

    $('#tabela_blog_imagens').DataTable();

    carrega_blog_imagens();

});

/*PESQUISA O COMUNICADOS FORMAIS*/
function carrega_blog_imagens() {

    $.ajax({
        url: vsUrl + "controllers/RetornaBlogImagens.php",
        type: "POST",
        dataType: "json",
        async: false,
        success: function (data) {
            if (data !== 0) {
                $("#tabela_blog_imagens tbody").html("");
                $('#tabela_blog_imagens').DataTable().destroy();
                var table = $('#tabela_blog_imagens').DataTable({
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
                                window.location.href = "blog-imagens/cadastro";
                            }
                        }
                    ],
                    fixedHeader: false,
                    colReorder: false,
                    responsive: false,
                    "processing": true,
                    data: data,
                    "columns": [
                        {
                            "render": function (data, type, row) {
                                return "<img src=\"" + vsUrl + "uploads/blog_imagens/" + row.imagem + "\" class=\"img-fluid\" style=\"max-height:170px;\" />";
                            }
                        },
                        {"data": "titulo"},
                        {
                            "render": function (data, type, row) {
                                return "\
                                    <input type=\"text\" class=\"form-control form-control-sm\" value=\"" + vsUrl + "uploads/blog_imagens/" + row.imagem + "\" readonly />\
                                ";
                            }
                        },
                        {
                            "render": function (data, type, row) {
                                return "\
                                    <button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"confirma_exclusao_registro(" + row.id_blog_imagens + ", 'blog_imagens', 'blog_imagens', '" + row.imagem + "', '', '', '', '');\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Remover " + row.titulo + "\"><i class=\"far fa-trash-alt fa-fw\" aria-hidden=\"true\"></i></button>\
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
            $("#tabela_blog_imagens tbody").html("");
            CloseLoading();
            Erro();
        }
    });
}