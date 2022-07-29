$(document).ready(function () {

    vsUrl = $("#vsUrl").val();

    $(this).attr("title", "WD Admin - Postagens do Blog");

    $('#div_tabela').hide();
    $('#div_aviso').hide();

    monta_select("inputFiltroIdBlogCategorias", "id_blog_categorias", "descricao", "blog_categorias", "WHERE status = 1", "descricao", "", true);

    $("#inputFiltroIdBlogCategorias").change(function () {
        if ($("#inputFiltroIdBlogCategorias").val() !== "T") {
            monta_select("inputFiltroIdBlogSubcategorias", "id_blog_subcategorias", "descricao", "blog_subcategorias", "WHERE status = 1 AND id_blog_categorias = " + $("#inputFiltroIdBlogCategorias").val(), "descricao", "", true);
        } else {
            $('#inputFiltroIdBlogSubcategorias option[value!="T"]').remove();
        }
    });

    $("#botao_pesquisa_blog_postagens").click(function () {
        Loading();
        carrega_blog_postagens();
    });

    $('#tabela_blog_postagens').DataTable();
    
    carrega_blog_postagens();
    
});

/*PESQUISA O POSTAGENS DO BLOG*/
function carrega_blog_postagens() {

    $.ajax({
        url: vsUrl + "controllers/RetornaBlogPostagens.php",
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            viFiltroIdBlogCategorias: $("#inputFiltroIdBlogCategorias").val(),
            viFiltroIdBlogSubcategorias: $("#inputFiltroIdBlogSubcategorias").val()
        }),
        success: function (data) {
            if (data !== 0) {
                $("#tabela_blog_postagens tbody").html("");
                $('#tabela_blog_postagens').DataTable().destroy();
                var table = $('#tabela_blog_postagens').DataTable({
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
                                window.location.href = "blog-postagens/cadastro";
                            }
                        }
                    ],
                    fixedHeader: false,
                    colReorder: false,
                    responsive: false,
                    "processing": true,
                    data: data,
                    "createdRow": function (row, data, dataIndex) {
                        $(row).addClass('table-' + data.cor_linha);
                    },
                    "columns": [
                        {"data": "visualizacoes"},
                        {"data": "titulo"},
                        {"data": "categoria"},
                        {"data": "subcategoria"},
                        {"data": "usuario"},
                        {"data": "data_criacao"},
                        {"data": "data_publicacao"},
                        {
                            "render": function (data, type, row) {
                                return "\
                                    <a href=\"blog-postagens/cadastro/" + row.id_blog_postagem + "\" class=\"btn btn-sm btn-outline-secondary\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Editar " + row.titulo + "\"><i class=\"fas fa-edit\"></i></a>&nbsp;\n\
                                    <button type=\"button\" class=\"btn btn-primary btn-sm\" onclick=\"confirma_envio_newsletter(" + row.id_blog_postagem + ");\" data-toggle=\"tooltip\" title=\"Envia newsletter " + row.titulo + "\" " + row.bloqueia_botao + "><i class=\"far fa-newspaper fa-fw\" aria-hidden=\"true\"></i></button>\n\
                                    <button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"confirma_exclusao_registro(" + row.id_blog_postagem + ", 'blog_postagem', 'blog_postagens', '" + row.imagem + "', '', '', '', '');\" data-toggle=\"tooltip\" title=\"Remover " + row.titulo + "\"><i class=\"far fa-trash-alt fa-fw\" aria-hidden=\"true\"></i></button>\
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
                            "targets": 3,
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
                        {type: 'date-uk', targets: 0}
                    ],
                    "order": [[ 6, 'desc' ]],
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
            $("#tabela_blog_postagens tbody").html("");
            CloseLoading();
            Erro();
        }
    });
}