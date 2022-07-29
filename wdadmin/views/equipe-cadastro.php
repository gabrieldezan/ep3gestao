<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Cadastro de Equipe</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/inicio">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/equipe">Equipe</a></li>
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
                            <a class="nav-link" data-toggle="tab" href="#contato" role="tab">
                                <span class="hidden-sm-up"><i class="far fa-id-card"></i></span>
                                <span class="hidden-xs-down"><i class="far fa-id-card"></i>&nbsp;Contato</span>
                            </a>
                        </li>
                        <li class="botao_novo">
                            <a class="btn btn-info btn-sm" href="<?php echo URL ?>wdadmin/equipe/cadastro">
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
                            <form id="form_equipe_cadastro" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="inputIdEquipeCadastro" name="inputIdEquipeCadastro" value="<?php echo $id ?>" />
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Nome *</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputNome" name="inputNome" placeholder="ex.: João Silva" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Experiência</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputExperiencia" name="inputExperiencia" placeholder="Experiência na área" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Formação Acadêmica</label>
                                    <div class="col-sm-8">
                                        <textarea rows="10" class="form-control form-control-sm" id="inputFormacao" name="inputFormacao" placeholder="Formação acadêmica"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">História</label>
                                    <div class="col-sm-8">
                                        <textarea id="inputHistoria" name="inputHistoria" rows="10" class="form-control form-control-sm" placeholder="Breve história sobre o profissional"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Imagem</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" id="inputImagemAtual" name="inputImagemAtual" />
                                        <img id="imgImagemAtual" name="imgImagemAtual" src="" class="img-fluid" />
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="file" class="dropify" id="inputImagem" name="inputImagem" data-height="100" accept=".jpg, .jpeg, .png" />
                                        <small class="fileHelp form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Posição *</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control form-control-sm" id="inputOrdem" name="inputOrdem">
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

                        <!--PAINEL CONTATO-->
                        <div class="tab-pane p-20" id="contato" role="tabpanel">
                            <form id="form_equipe_contato" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="inputIdEquipeContato" name="inputIdEquipeContato" value="" />
                                <input type="hidden" id="inputIdEquipe" name="inputIdEquipe" value="<?php echo $id ?>" />
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Título *</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputTitulo" name="inputTitulo" placeholder="ex.: Facebook" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Ícone</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputIcone" name="inputIcone" placeholder="ex.: fas fa-facebook" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Link</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputLink" name="inputLink" placeholder="ex.: https://www.facebook.com/webdezan/" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Tipo *</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm" id="inputTipo" name="inputTipo">
                                            <option value="1">Telefônico</option>
                                            <option value="2">E-mail</option>
                                            <option value="3">Redes Sociais</option>
                                            <option value="4">Outros</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row text-right">
                                    <div class="col-sm-11">
                                        <button id="botao_salvar_contato_equipe" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save" aria-hidden="true"></i>&nbsp;Salvar</button>
                                        <button id="botao_nova_contato_equipe" type="button" class="btn btn-info btn-sm"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;Novo Contato</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <table id="tabela_contato_equipe" class="table table-sm table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th>Ícone</th>
                                            <th>Link</th>
                                            <th>Tipo</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?php echo URL ?>wdadmin/scripts/equipe-cadastro.js"></script>