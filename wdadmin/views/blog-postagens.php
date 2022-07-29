<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Postagens do Blog</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="inicio">Home</a></li>
            <li class="breadcrumb-item active">Postagens do Blog</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend"><span class="input-group-text">Categoria</span></div>
                                    <select id="inputFiltroIdBlogCategorias" name="inputFiltroIdBlogCategorias" class="form-control form-control-sm"></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend"><span class="input-group-text">Subcategoria</span></div>
                                    <select id="inputFiltroIdBlogSubcategorias" name="inputFiltroIdBlogSubcategorias" class="form-control form-control-sm">
                                        <option value="T">Todos</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button id="botao_pesquisa_blog_postagens" class="btn btn-primary" type="button">        
                                            <i class="fa fa-search" aria-hidden="true"></i>      
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="div_tabela" class="table-responsive">
                        <table id="tabela_blog_postagens" class="table table-sm table-hover table-striped table-bordered" cellspacing="0" style="width:100%">
                            <thead>
                                <tr>
                                    <th><i class="far fa-eye fa-fw"></i></th>
                                    <th>Título</th>
                                    <th>Categoria</th>
                                    <th>Subcategoria</th>
                                    <th>Escrito por</th>
                                    <th>Data de Criação</th>
                                    <th>Data Publicação</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div id="div_aviso" class="row">
                        <div class="col-sm">
                            <div class="alert alert-warning" role="alert">
                                <center>
                                    Nenhum resultado encontrado! Utilize o botão ao lado para cadastrar.&nbsp;
                                    <a class="btn btn-info btn-sm" href="<?php echo URL ?>wdadmin/blog-postagens/cadastro">
                                        <span class="hidden-sm-up"><i class="fas fa-plus" aria-hidden="true"></i></span>
                                        <span class="hidden-xs-down"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;Novo</span>
                                    </a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo URL ?>wdadmin/scripts/blog-postagens.js"></script>