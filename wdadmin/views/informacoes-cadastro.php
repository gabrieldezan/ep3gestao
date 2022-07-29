<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Cadastro de Informações: <?php echo $_COOKIE['titulo_conteudo_personalizado'] ?></h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/inicio">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/informacoes">Informações</a></li>
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
                            <a class="btn btn-info btn-sm" href="<?php echo URL ?>wdadmin/informacoes/cadastro">
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
                            <form id="form_informacoes" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="inputIdInformacoes" name="inputIdInformacoes" value="<?php echo $id ?>" />
                                <input type="hidden" id="hiddenIdConteudoPersonalizado" name="hiddenIdConteudoPersonalizado" value="<?php echo $_COOKIE['id_conteudo_personalizado'] ?>" />
                                <input type="hidden" id="hiddenTitulo" name="hiddenTitulo" value="<?php echo $_COOKIE['titulo_conteudo_personalizado'] ?>" />
                                <input type="hidden" id="hiddenLargura" name="hiddenLargura" value="<?php echo $_COOKIE['largura_conteudo_personalizado'] ?>" />
                                <input type="hidden" id="hiddenAltura" name="hiddenAltura" value="<?php echo $_COOKIE['altura_conteudo_personalizado'] ?>" />
                                <div id="linha-titulo" class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Título *</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputTitulo" name="inputTitulo" required />
                                    </div>
                                </div>
                                <div id="linha-icone" class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Ícone</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputIcone" name="inputIcone" />
                                    </div>
                                </div>
                                <div id="linha-imagem" class="form-group row">
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
                                <div id="linha-texto" class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Texto</label>
                                    <div class="col-sm-8">
                                        <textarea name="inputTexto" id="inputTexto" class="form-control form-control-sm"></textarea>
                                    </div>
                                </div>
                                <div id="linha-link" class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Link</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputLink" name="inputLink" />
                                    </div>
                                </div>
                                <div id="linha-data" class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Data</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control form-control-sm" id="inputData" name="inputData" />
                                    </div>
                                </div>
                                <div id="linha-hora" class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Hora</label>
                                    <div class="col-sm-8">
                                        <input type="time" class="form-control form-control-sm" id="inputHora" name="inputHora" />
                                    </div>
                                </div>
                                <div id="linha-numero" class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Número</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control form-control-sm" id="inputNumero" name="inputNumero" />
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

<script src="<?php echo URL ?>wdadmin/scripts/informacoes-cadastro.js"></script>