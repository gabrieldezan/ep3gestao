<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Cadastro de Produtos da Vitrine</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/inicio">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo URL ?>wdadmin/vitrine-produtos">Produtos da Vitrine</a></li>
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
                            <a class="nav-link" data-toggle="tab" href="#cores" role="tab">
                                <span class="hidden-sm-up"><i class="fas fa-palette"></i></span>
                                <span class="hidden-xs-down"><i class="fas fa-palette"></i>&nbsp;Cores</span>
                            </a>
                        </li>
                        <li class="botao_novo">
                            <a class="btn btn-info btn-sm" href="<?php echo URL ?>wdadmin/vitrine-produtos/cadastro">
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
                            <form id="form_vitrine_produtos_cadastro" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="inputIdVitrineProdutosCadastro" name="inputIdVitrineProdutosCadastro" value="<?php echo $id ?>" />
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Descrição *</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="inputDescricao" name="inputDescricao" placeholder="ex.: iPhone X" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Detalhes</label>
                                    <div class="col-sm-10">
                                        <textarea name="inputDetalhes" id="inputDetalhes" class="form-control form-control-sm" rows="10" placeholder="Descreva os detalhes aqui..."></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Garantia</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" id="inputGarantia" name="inputGarantia" placeholder="ex.: 03 Meses" />
                                    </div>
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Peso</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm" id="inputPeso" name="inputPeso" placeholder="ex.: 1,73kg" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Dimensões</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm" id="inputDimensoes" name="inputDimensoes" placeholder="ex.: 100x37x100 cm" />
                                    </div>
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Materiais</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" id="inputMateriais" name="inputMateriais" placeholder="ex.: Madeira" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Imagem</label>
                                    <div class="col-sm-3">
                                        <input type="hidden" id="inputImagemAtual" name="inputImagemAtual" />
                                        <img id="imgImagemAtual" name="imgImagemAtual" src="" class="img-fluid" />
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="file" class="dropify" id="inputImagem" name="inputImagem" data-height="100" accept=".jpg, .jpeg" />
                                        <small class="fileHelp form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Manual</label>
                                    <div class="col-sm-3">
                                        <h2>Manual Atual</h2>
                                        <a id="botao_visualizar_manual" href="" target="_blank" class="btn waves-effect waves-light btn-rounded btn-outline-secondary"><i class="far fa-eye"></i> Visualizar</a>
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="hidden" id="inputManualAtual" name="inputManualAtual" />
                                        <input type="file" class="dropify" id="inputManual" name="inputManual" data-height="80" accept=".pdf" />
                                        <small id="fileHelp" class="form-text text-muted">Deixe em branco para manter o arquivo atual.</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Informação Adicional 1</label>
                                    <div class="col-sm-10">
                                        <textarea name="inputInformacaoAdicional1" id="inputInformacaoAdicional1" class="form-control form-control-sm"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Informação Adicional 2</label>
                                    <div class="col-sm-10">
                                        <textarea name="inputInformacaoAdicional2" id="inputInformacaoAdicional2" class="form-control form-control-sm"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Informação Adicional 3</label>
                                    <div class="col-sm-10">
                                        <textarea name="inputInformacaoAdicional3" id="inputInformacaoAdicional3" class="form-control form-control-sm"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Link</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" id="inputLink" name="inputLink" placeholder="https://www.youtube.com/watch?v=ZGhw3mEuCh4" />
                                    </div>
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Link Secundário</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" id="inputLinkSecundario" name="inputLinkSecundario" placeholder="https://www.youtube.com/watch?v=ZGhw3mEuCh4" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Valor</label>
                                    <div class="col-sm-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend"><span class="input-group-text">R$</span></div>
                                            <input type="tel" class="form-control form-control-sm" id="inputValor" name="inputValor" placeholder="0,00" />
                                        </div>
                                    </div>
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Grupo *</label>
                                    <div class="col-sm-2">
                                        <select class="form-control form-control-sm" id="inputIdVitrineGrupo" name="inputIdVitrineGrupo" required></select>
                                    </div>
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Subgrupo *</label>
                                    <div class="col-sm-2">
                                        <select class="form-control form-control-sm" id="inputIdVitrineSubgrupo" name="inputIdVitrineSubgrupo" required>
                                            <option value="T">Todos</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">      
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Situação *</label>
                                    <div class="col-md-2">                          
                                        <select class="form-control form-control-sm" id="inputSituacao" name="inputSituacao" required>
                                            <option value="1" selected="">Novo</option>                
                                            <option value="0">Usado</option>  
                                        </select>                            
                                    </div>
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Destaque *</label>
                                    <div class="col-md-2">                          
                                        <select class="form-control form-control-sm" id="inputDestaque" name="inputDestaque" required>
                                            <option value="0" selected="">Não</option>
                                            <option value="1">Sim</option>
                                        </select>                            
                                    </div>
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Status *</label>
                                    <div class="col-md-2">                          
                                        <select class="form-control form-control-sm" id="inputStatus" name="inputStatus" required>
                                            <option value="1" selected="">Ativo</option>                
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

                        <!--PAINEL CORES-->
                        <div class="tab-pane p-20" id="cores" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="table-responsive">
                                        <table id="tabela_cores_produtos" class="table table-sm table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Cor</th>
                                                    <th>Descrição</th>
                                                    <th>Referência</th>
                                                    <th>Imagem 1</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <form id="form_vitrine_produtos_cores" method="post" enctype="multipart/form-data">
                                        <input type="hidden" id="inputIdVitrineProdutosCores" name="inputIdVitrineProdutosCores" value="" />
                                        <input type="hidden" id="inputIdVitrineProduto" name="inputIdVitrineProduto" value="<?php echo $id ?>" />
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Descrição *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" id="inputDescricaoCor" name="inputDescricaoCor" placeholder="ex.: Vermelho" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Exemplo</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" id="inputExemplo" name="inputExemplo" placeholder="ex.: #fff00" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Referência</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" id="inputReferencia" name="inputReferencia" placeholder="ex.: fx0115" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Imagem 1 *</label>
                                            <div class="col-sm-3">
                                                <input type="hidden" id="inputImagem1Atual" name="inputImagem1Atual" />
                                                <img id="imgImagem1Atual" name="imgImagem1Atual" src="" class="img-fluid" />
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="file" class="dropify" id="inputImagem1" name="inputImagem1" data-height="100" accept=".jpg, .jpeg" />
                                                <small class="fileHelp form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Imagem 2</label>
                                            <div class="col-sm-3">
                                                <input type="hidden" id="inputImagem2Atual" name="inputImagem2Atual" />
                                                <img id="imgImagem2Atual" name="imgImagem2Atual" src="" class="img-fluid" />
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="file" class="dropify" id="inputImagem2" name="inputImagem2" data-height="100" accept=".jpg, .jpeg" />
                                                <small class="fileHelp form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Imagem 3</label>
                                            <div class="col-sm-3">
                                                <input type="hidden" id="inputImagem3Atual" name="inputImagem3Atual" />
                                                <img id="imgImagem3Atual" name="imgImagem3Atual" src="" class="img-fluid" />
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="file" class="dropify" id="inputImagem3" name="inputImagem3" data-height="100" accept=".jpg, .jpeg" />
                                                <small class="fileHelp form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Imagem 4</label>
                                            <div class="col-sm-3">
                                                <input type="hidden" id="inputImagem4Atual" name="inputImagem4Atual" />
                                                <img id="imgImagem4Atual" name="imgImagem4Atual" src="" class="img-fluid" />
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="file" class="dropify" id="inputImagem4" name="inputImagem4" data-height="100" accept=".jpg, .jpeg" />
                                                <small class="fileHelp form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Imagem 5</label>
                                            <div class="col-sm-3">
                                                <input type="hidden" id="inputImagem5Atual" name="inputImagem5Atual" />
                                                <img id="imgImagem5Atual" name="imgImagem5Atual" src="" class="img-fluid" />
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="file" class="dropify" id="inputImagem5" name="inputImagem5" data-height="100" accept=".jpg, .jpeg" />
                                                <small class="fileHelp form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="form-group row text-right">
                                            <div class="col-sm-12">
                                                <button id="botao_salvar_cor_produto" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save" aria-hidden="true"></i>&nbsp;Salvar</button>
                                                <button id="botao_nova_cor_produto" type="button" class="btn btn-info btn-sm"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;Nova Cor</button>
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

<script src="<?php echo URL ?>wdadmin/scripts/vitrine-produtos-cadastro.js"></script>