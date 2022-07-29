<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Cadastro de Eventos</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL ?>inicio">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo URL ?>eventos">Eventos</a></li>
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
                            <a class="btn btn-info btn-sm" href="<?php echo URL ?>eventos/cadastro">
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
                            <form id="form_eventos_cadastro" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="inputIdEventosCadastro" name="inputIdEventosCadastro" value="<?php echo $id ?>" />
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Descrição *</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="inputDescricao" name="inputDescricao" placeholder="ex.: Operação PaperClip II" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Detalhes</label>
                                    <div class="col-sm-8">
                                        <textarea name="inputDetalhes" id="inputDetalhes" class="form-control form-control-sm" rows="10" placeholder="Descreva os detalhes aqui..."></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Mais informações</label>
                                    <div class="col-sm-8">
                                        <textarea name="inputMaisInformacoes" id="inputMaisInformacoes" class="form-control form-control-sm" rows="10" placeholder="Descreva mais informações aqui..."></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Mapa</label>
                                    <div class="col-sm-8">
                                        <textarea  rows="3" class="form-control form-control-sm" id="inputMapa" name="inputMapa" placeholder="<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3599.157569570895!2d-49.319699685852235!3d-25.56642398372577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjXCsDMzJzU5LjEiUyA0OcKwMTknMDMuMCJX!5e0!3m2!1spt-BR!2sbr!4v1574213039076!5m2!1spt-BR!2sbr' width='600' height='450' frameborder='0' style='border:0;' allowfullscreen=''></iframe>
                                                   " ></textarea>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Valor *</label>
                                    <div class="col-sm-8">
                                        <input type="number" step="0.010" class="form-control form-control-sm" required id="inputValor" name="inputValor" placeholder="ex.: A partir de 70,00 R$" />
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Data do Evento *</label>
                                    <div class="col-sm-8">
                                        <input type="datetime-local" class="form-control form-control-sm" id="inputDataEvento" name="inputDataEvento" required="">
                                    </div>
                                </div>
                                <div class="form-group row">      
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Etiqueta </label>
                                    <div class="col-md-3">                          
                                        <select class="form-control form-control-sm" id="inputEtiqueta" name="inputEtiqueta" >
                                            <option value="" selected=""></option>    
                                            <option value="1" >Destaque</option>                
                                            <option value="0">Novo</option>  
                                        </select>                            
                                    </div>                          
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-right">Cor etiqueta </label>
                                    <div class="col-md-3">                          
                                        <select class="form-control form-control-sm" id="inputCorEtiqueta" name="inputCorEtiqueta" >
                                            <option value="" selected=""></option> 
                                            <option value="1" >Vermelho</option>                
                                            <option value="0">Verde</option>  
                                        </select>                            
                                    </div>                     
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Imagem </label>
                                    <div class="col-sm-2">
                                        <input type="hidden" id="inputImagem" name="inputImagem" />
                                        <img id="imgImagem" name="imgImagem" src="" class="img-fluid" />
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="file"  class="dropify" id="inputImagem" name="inputImagem" data-height="100" accept=".jpg, .jpeg" />
                                        <small id="fileHelp" class="form-text text-muted">Deixe em branco para manter o arquivo atual.</small>
                                    </div>
                                </div>
                                <div class="form-group row">  
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Status *</label>
                                    <div class="col-md-8">                          
                                        <select class="form-control form-control-sm" id="inputStatus" name="inputStatus" required>
                                            <option value="1" selected="">Ativo</option>                
                                            <option value="0">Inativo</option>  
                                        </select>                            
                                    </div>             
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

<script src="<?php echo URL ?>scripts/eventos-cadastro.js"></script>