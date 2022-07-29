<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Cadastro de Categorias do Blog</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/inicio">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/blog-categorias">Categorias do Blog</a></li>
            <li class="breadcrumb-item active">Cadastro</li>
        </ol>
    </div>
</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#cadastro" role="tab">
                                <span class="hidden-sm-up"><i class="far fa-edit" aria-hidden="true"></i></span>
                                <span class="hidden-xs-down"><i class="far fa-edit" aria-hidden="true"></i>&nbsp;Cadastro</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#subcategorias" role="tab">
                                <span class="hidden-sm-up"><i class="fas fa-chevron-circle-down"></i></span>
                                <span class="hidden-xs-down"><i class="fas fa-chevron-circle-down"></i>&nbsp;Subcategorias</span>
                            </a>
                        </li>
                        <li class="botao_novo">
                            <a class="btn btn-info btn-sm" href="<?php echo URL ?>wdadmin/blog-categorias/cadastro">
                                <span class="hidden-sm-up"><i class="fas fa-plus" aria-hidden="true"></i></span>
                                <span class="hidden-xs-down"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;Novo</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">

                        <!--PAINEL CADASTRO-->
                        <div class="tab-pane p-20 active" id="cadastro" role="tabpanel">
                            <form id="form_blog_categorias" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="inputIdCategoriasBlog" name="inputIdCategoriasBlog" value="<?php echo $id ?>" />
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Descrição *</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputDescricao" name="inputDescricao" placeholder="ex.: Artigos" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Posição</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control form-control-sm" id="inputPosicao" name="inputPosicao">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Status *</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm" id="inputStatus" name="inputStatus">
                                            <option value="1">Ativo</option>
                                            <option value="0">Inativo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row text-right">
                                    <div class="col-sm-11">
                                        <button id="botao_salvar" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save" aria-hidden="true"></i>&nbsp;Salvar</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!--PAINEL SUBCATEGORIAS-->
                        <div class="tab-pane p-20" id="subcategorias" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-6">
                                    <table id="tabela_subcategorias" class="table table-sm table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Descrição</th>
                                                <th>Posição</th>
                                                <th>Status</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                    <form id="form_blog_subcategorias" method="post" enctype="multipart/form-data">
                                        <input type="hidden" id="inputIdSubcategoriasBlog" name="inputIdSubcategoriasBlog" value="" />
                                        <input type="hidden" id="inputIdCategoriasSubBlog" name="inputIdCategoriasSubBlog" value="<?php echo $id ?>" />
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Descrição *</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm" id="inputDescricaoSub" name="inputDescricaoSub" placeholder="ex.: Artigos" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Posição</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control form-control-sm" id="inputPosicaoSub" name="inputPosicaoSub">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Status *</label>
                                            <div class="col-sm-8">
                                                <select class="form-control form-control-sm" id="inputStatusSub" name="inputStatusSub">
                                                    <option value="1">Ativo</option>
                                                    <option value="0">Inativo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row text-right">
                                            <div class="col-sm-11">
                                                <button id="botao_salvar_subcategoria_blog" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save" aria-hidden="true"></i>&nbsp;Salvar</button>
                                                <button id="botao_nova_subcategoria_blog" type="button" class="btn btn-info btn-sm"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;Nova Subcategoria</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?php echo URL ?>wdadmin/scripts/blog-categorias-cadastro.js"></script>