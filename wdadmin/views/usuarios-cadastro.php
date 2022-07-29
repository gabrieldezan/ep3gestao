<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Cadastro de Usuários</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/inicio">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/usuarios">Usuários</a></li>
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
                            <a class="btn btn-info btn-sm" href="<?php echo URL ?>wdadmin/usuarios/cadastro">
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
                            <form id="form-usuario" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="inputIdUsuario" name="inputIdUsuario" value="<?php echo $id ?>" />
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Nome *</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputNome" name="inputNome" placeholder="ex.: José da Silva" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Login</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputLogin" name="inputLogin" placeholder="ex.: jsilva" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Nova Senha</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control form-control-sm" id="inputNovaSenha" name="inputNovaSenha" placeholder="********">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Confirma Senha</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control form-control-sm" id="inputConfirmaSenha" name="inputConfirmaSenha" placeholder="********">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Imagem Perfil</label>
                                    <div class="col-sm-2">
                                        <center>
                                            <img id="imgImagemPerfilAtual" src="" class="img-fluid rounded-circle">
                                            <input type="hidden" id="inputImagemPerfilAtual" name="inputImagemPerfilAtual" />
                                        </center>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="file" class="dropify" id="inputImagemPerfil" name="inputImagemPerfil" data-height="80" accept=".jpg, .jpeg, .png" />
                                        <small id="fileHelp" class="form-text text-muted">Deixe em branco para manter o arquivo atual.</small>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?php echo URL ?>wdadmin/scripts/usuarios-cadastro.js"></script>