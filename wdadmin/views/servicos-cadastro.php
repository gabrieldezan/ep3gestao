<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Cadastro de Serviços</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/inicio">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/servicos">Serviços</a></li>
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
                            <a class="nav-link" data-toggle="tab" href="#solucoes" role="tab">
                                <span class="hidden-sm-up"><i class="fas fa-file"></i></span>
                                <span class="hidden-xs-down"><i class="fas fa-file"></i>&nbsp;Soluções</span>
                            </a>
                        </li>
                        <li class="botao_novo">
                            <a class="btn btn-info btn-sm" href="<?php echo URL ?>wdadmin/servicos/cadastro">
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
                            <form id="form_servicos" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="inputIdServicos" name="inputIdServicos" value="<?php echo $id ?>" />
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Título *</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="inputTitulo" name="inputTitulo" placeholder="ex.: Gestão Empresarial" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Descrição</label>
                                    <div class="col-sm-10">
                                        <textarea name="inputDescricao" id="inputDescricao" class="form-control form-control-sm"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Ícone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="inputIcone" name="inputIcone" placeholder="ex.: fa far-gear" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Imagem </label>
                                    <div class="col-sm-2">
                                        <input type="hidden" id="inputImagemAtual" name="inputImagemAtual" />
                                        <img id="imgImagemAtual" name="imgImagemAtual" src="" class="img-fluid" />
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="file" class="dropify" id="inputImagem" name="inputImagem" data-height="100" accept=".jpg, .jpeg, .png" />
                                        <small class="fileHelp form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Capa </label>
                                    <div class="col-sm-2">
                                        <input type="hidden" id="inputCapaAtual" name="inputCapaAtual" />
                                        <img id="imgCapaAtual" name="imgCapaAtual" src="" class="img-fluid" />
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="file" class="dropify" id="inputCapa" name="inputCapa" data-height="100" accept=".jpg, .jpeg, .png" />
                                        <small id="fileHelp" class="form-text text-muted">Deixe em branco para manter o arquivo atual.</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Status *</label>
                                    <div class="col-sm-10">
                                        <select class="form-control form-control-sm" id="inputStatus" name="inputStatus">
                                            <option value="1">Ativo</option>
                                            <option value="0">Inativo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row text-right">
                                    <div class="col-sm-12">
                                        <button id="botao_salvar" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save" aria-hidden="true"></i>&nbsp;Salvar</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane p-20" id="solucoes" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-7" style="border-right: 1px solid rgba(0,0,0,.1);">
                                    <div>
                                        <table id="tabela_solucoes" class="table table-sm table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Título</th>
                                                    <th>Link</th>
                                                    <th>Imagem</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <form id="form_solucoes" method="post" enctype="multipart/form-data">
                                        <input type="hidden" id="inputIdSolucoes" name="inputIdSolucoes" value="" />
                                        <input type="hidden" id="hiddenIdServicos" name="hiddenIdServicos" value="<?php echo $id ?>" />
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label col-form-label-sm text-right">Titulo *</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-sm" id="inputTituloSolucoes" name="inputTituloSolucoes" placeholder="ex.: Inventário Patrimonial" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label col-form-label-sm text-right">Texto</label>
                                            <div class="col-sm-10">
                                                <textarea name="inputTextoSolucoes" id="inputTextoSolucoes" class="form-control form-control-sm" rows="3" placeholder="Informe aqui o texto..."></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label col-form-label-sm text-right">Link</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-sm" id="inputLinkSolucoes" name="inputLinkSolucoes" placeholder="https://google.com" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label col-form-label-sm text-right">Imagem</label>
                                            <div class="col-sm-3">
                                                <input type="hidden" id="inputImagemSolucoesAtual" name="inputImagemSolucoesAtual" />
                                                <img id="imgImagemSolucoesAtual" name="imgImagemSolucoesAtual" src="" class="img-fluid" />
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="file" class="dropify" id="inputImagemSolucoes" name="inputImagemSolucoes" data-height="100" accept=".jpg, .jpeg" />
                                                <small class="fileHelp form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="form-group row text-right">
                                            <div class="col-sm-12">
                                                <button id="botao_salvar_solucao" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save" aria-hidden="true"></i>&nbsp;Salvar</button>
                                                <button id="botao_nova_solucao" type="button" class="btn btn-info btn-sm"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;Nova Solução</button>
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

<script src="<?php echo URL ?>wdadmin/scripts/servicos-cadastro.js"></script>