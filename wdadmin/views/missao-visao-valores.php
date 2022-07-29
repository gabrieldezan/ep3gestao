<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Missão, Visão e Valores</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/inicio">Home</a></li>
            <li class="breadcrumb-item active">Missão, Visão e Valores</li>
        </ol>
    </div>
</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#cadastro" role="tab">
                                <span class="hidden-sm-up"><i class="far fa-edit" aria-hidden="true"></i></span>
                                <span class="hidden-xs-down"><i class="far fa-edit" aria-hidden="true"></i>&nbsp;Cadastro</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">

                        <!--PAINEL CADASTRO-->
                        <div class="tab-pane p-20 active" id="cadastro" role="tabpanel">
                            <form id="form_missao_visao_valores" method="post" enctype="multipart/form-data">
                                <h3 class="box-title">Missão</h3>
                                <hr class="m-t-0 m-b-40">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Ícone</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputIconeMissao" name="inputIconeMissao" placeholder="ex.: fas fa-bullseye" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Imagem</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" id="inputImagemMissaoAtual" name="inputImagemMissaoAtual" />
                                        <img id="imgImagemMissaoAtual" name="imgImagemMissaoAtual" src="" class="img-fluid" />
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="file" class="dropify" id="inputImagemMissao" name="inputImagemMissao" data-height="100" accept=".jpg, .jpeg, .png" />
                                        <small class="fileHelp form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Texto *</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputTextoMissao" name="inputTextoMissao" required placeholder="Informe aqui sua missão" />
                                    </div>
                                </div>
                                <h3 class="box-title m-t-40">Visão</h3>
                                <hr class="m-t-0 m-b-40">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Ícone</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputIconeVisao" name="inputIconeVisao" placeholder="ex.: far fa-eye" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Imagem</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" id="inputImagemVisaoAtual" name="inputImagemVisaoAtual" />
                                        <img id="imgImagemVisaoAtual" name="imgImagemVisaoAtual" src="" class="img-fluid" />
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="file" class="dropify" id="inputImagemVisao" name="inputImagemVisao" data-height="100" accept=".jpg, .jpeg, .png" />
                                        <small class="fileHelp form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Texto *</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputTextoVisao" name="inputTextoVisao" required placeholder="Informe aqui sua visão" />
                                    </div>
                                </div>
                                <h3 class="box-title m-t-40">Valores</h3>
                                <hr class="m-t-0 m-b-40">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Ícone</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputIconeValores" name="inputIconeValores" placeholder="fas fa-gem" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Imagem</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" id="inputImagemValoresAtual" name="inputImagemValoresAtual" />
                                        <img id="imgImagemValoresAtual" name="imgImagemValoresAtual" src="" class="img-fluid" />
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="file" class="dropify" id="inputImagemValores" name="inputImagemValores" data-height="100" accept=".jpg, .jpeg, .png" />
                                        <small class="fileHelp form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Texto *</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputTextoValores" name="inputTextoValores" required placeholder="Informe aqui seus valores" />
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

<script src="<?php echo URL ?>wdadmin/scripts/missao-visao-valores.js"></script>