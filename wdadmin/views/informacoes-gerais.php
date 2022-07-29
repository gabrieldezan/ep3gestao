<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Informações Gerais</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/inicio">Home</a></li>
            <li class="breadcrumb-item active">Informações Gerais</li>
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
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">

                        <!--PAINEL CADASTRO-->
                        <div class="tab-pane p-20 active" id="cadastro" role="tabpanel">
                            <form id="form_informacoes_gerais" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Nome da Empresa *</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" id="inputNomeEmpresa" name="inputNomeEmpresa" required />
                                    </div>
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Título do Site *</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" id="inputTitulo" name="inputTitulo" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Descrição</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="inputDescricao" name="inputDescricao" placeholder="Informe aqui a descrição que aparecerá no compartilhamento de link e pesquisas Google..." />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">WhatsApp</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control form-control-sm" id="inputWhatsApp" name="inputWhatsApp" placeholder="ex.: (00) 00000-0000" />
                                    </div>
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Celular 1</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control form-control-sm" id="inputCelular1" name="inputCelular1" placeholder="ex.: (00) 00000-0000" />
                                    </div>
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Celular 2</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control form-control-sm" id="inputCelular2" name="inputCelular2" placeholder="ex.: (00) 00000-0000" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">E-mail</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" id="inputEmail" name="inputEmail" placeholder="ex.: contato@dominio.com.br" />
                                    </div>
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">E-mail para receber contatos</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" id="inputEmailContato" name="inputEmailContato" placeholder="ex.: contato@dominio.com.br" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Envios de E-mail</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm" id="inputEnvioHost" name="inputEnvioHost" placeholder="Host" />
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="tel" class="form-control form-control-sm" id="inputEnvioPorta" name="inputEnvioPorta" placeholder="Porta" />
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="email" class="form-control form-control-sm" id="inputEnvioEmail" name="inputEnvioEmail" placeholder="E-mail" />
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="password" class="form-control form-control-sm" id="inputEnvioSenha" name="inputEnvioSenha" placeholder="Senha" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Google Search Console</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="inputGoogleSearchConsole" name="inputGoogleSearchConsole" placeholder="Informe aqui a meta tag..." />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Google Analytics</label>
                                    <div class="col-sm-4">
                                        <textarea name="inputGoogleAnalytics" id="inputGoogleAnalytics" class="form-control form-control-sm" rows="8" placeholder="Informe aqui o script..."></textarea>
                                    </div>
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Facebook Pixel</label>
                                    <div class="col-sm-4">
                                        <textarea name="inputFacebookPixel" id="inputFacebookPixel" class="form-control form-control-sm" rows="8" placeholder="Informe aqui o script..."></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Favicon</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" id="inputLogoFaviconAtual" name="inputLogoFaviconAtual" />
                                        <img id="imgLogoFaviconAtual" name="imgLogoFaviconAtual" src="" class="img-fluid" />
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="file" class="dropify" id="inputLogoFavicon" name="inputLogoFavicon" data-height="100" accept=".jpg, .jpeg, .png" />
                                        <small class="form-text text-muted">Dimensão: até 160x160px. (Deixe em branco para manter o arquivo atual)</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Logo Principal</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" id="inputLogoPrincipalAtual" name="inputLogoPrincipalAtual" />
                                        <img id="imgLogoPrincipalAtual" name="imgLogoPrincipalAtual" src="" class="img-fluid" />
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="file" class="dropify" id="inputLogoPrincipal" name="inputLogoPrincipal" data-height="100" accept=".jpg, .jpeg, .png" />
                                        <small class="fileHelp form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Logo Secundária</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" id="inputLogoSecundariaAtual" name="inputLogoSecundariaAtual" />
                                        <img id="imgLogoSecundariaAtual" name="imgLogoSecundariaAtual" src="" class="img-fluid" />
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="file" class="dropify" id="inputLogoSecundaria" name="inputLogoSecundaria" data-height="100" accept=".jpg, .jpeg, .png" />
                                        <small id="fileHelp" class="form-text text-muted">Dimensão: até 500x500px. (Deixe em branco para manter o arquivo atual)</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Vídeo</label>
                                    <div class="col-sm-3">
                                        <h2>Video Atual</h2>
                                        <a id="botao_visualizar_video" href="" target="_blank" class="btn waves-effect waves-light btn-rounded btn-outline-secondary"><i class="far fa-eye"></i> Visualizar</a>
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="hidden" id="inputVideoBannerAtual" name="inputVideoBannerAtual" />
                                        <input type="file" class="dropify" id="inputVideoBanner" name="inputVideoBanner" data-height="80" accept=".mp4, .mkv" />
                                        <small id="fileHelp" class="form-text text-muted">Deixe em branco para manter o arquivo atual.</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Políticas de Privacidade</label>
                                    <div class="col-sm-10">
                                        <textarea name="inputPoliticasPrivacidade" id="inputPoliticasPrivacidade" class="form-control form-control-sm" rows="10" placeholder="Informe aqui o texto..."></textarea>
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

<script src="<?php echo URL ?>wdadmin/scripts/informacoes-gerais.js"></script>