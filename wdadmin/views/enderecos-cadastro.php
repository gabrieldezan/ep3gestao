<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Cadastro de Endereços</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/inicio">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/enderecos">Endereços</a></li>
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
                            <a class="btn btn-info btn-sm" href="<?php echo URL ?>wdadmin/enderecos/cadastro">
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
                            <form id="form_enderecos" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="inputIdEnderecos" name="inputIdEnderecos" value="<?php echo $id ?>" />
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Título *</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="inputTitulo" name="inputTitulo" placeholder="ex.: Unidade Cascavel" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Endereço *</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" id="inputEndereco" name="inputEndereco" placeholder="ex.: Av. Brasil, 1234 - Centro" required>
                                    </div>
                                    <label class="col-sm-1 col-form-label col-form-label-sm text-right">Cidade</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control form-control-sm" id="inputCidade" name="inputCidade" placeholder="ex.: Cascavel">
                                    </div>
                                    <label class="col-sm-1 col-form-label col-form-label-sm text-right">Estado</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control form-control-sm" id="inputEstado" name="inputEstado" placeholder="ex.: PR">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Mapa</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="inputMapa" name="inputMapa" placeholder="(iframe do Google Maps)" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Link</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="inputLink" name="inputLink" placeholder="ex.: https://g.page/WebDezan?share" />
                                    </div>
                                </div>
                                <div class="form-group row text-right">
                                    <div class="col-sm-12">
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

<script src="<?php echo URL ?>wdadmin/scripts/enderecos-cadastro.js"></script>