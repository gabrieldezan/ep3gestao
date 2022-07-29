<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Cadastro de Conteúdo Personalizado</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/inicio">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/conteudo-personalizado-gerenciamento">Conteúdo Personalizado</a></li>
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
                        <li class="botao_novo">
                            <a class="btn btn-info btn-sm" href="<?php echo URL ?>wdadmin/conteudo-personalizado-gerenciamento/cadastro">
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
                            <form id="form_conteudo_personalizado" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="inputIdConteudoPersonalizado" name="inputIdConteudoPersonalizado" value="<?php echo $id ?>" />
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Título *</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputTitulo" name="inputTitulo" placeholder="ex.: Sessão Sobre" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Ícone *</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm" id="inputIcone" name="inputIcone">
                                            <option value="0">Não</option>
                                            <option value="1">Sim</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Imagem *</label>
                                    <div class="col-sm-4">
                                        <select class="form-control form-control-sm" id="inputImagem" name="inputImagem">
                                            <option value="0">Não</option>
                                            <option value="1">Sim</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Dimensões *</label>
                                    <div class="col-sm-2">
                                        <div class="input-group input-group-sm">
                                            <input type="number" class="form-control form-control-sm" id="inputImagemLargura" name="inputImagemLargura" required />
                                            <div class="input-group-prepend"><span class="input-group-text">x</span></div>
                                            <input type="number" class="form-control form-control-sm" id="inputImagemAltura" name="inputImagemAltura" required />
                                            <div class="input-group-prepend"><span class="input-group-text">px</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Texto *</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm" id="inputTexto" name="inputTexto">
                                            <option value="0">Não</option>
                                            <option value="1">Sim</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Link *</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm" id="inputLink" name="inputLink">
                                            <option value="0">Não</option>
                                            <option value="1">Sim</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Data *</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm" id="inputData" name="inputData">
                                            <option value="0">Não</option>
                                            <option value="1">Sim</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Hora *</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm" id="inputHora" name="inputHora">
                                            <option value="0">Não</option>
                                            <option value="1">Sim</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Número *</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm" id="inputNumero" name="inputNumero">
                                            <option value="0">Não</option>
                                            <option value="1">Sim</option>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?php echo URL ?>wdadmin/scripts/conteudo-personalizado-gerenciamento-cadastro.js"></script>