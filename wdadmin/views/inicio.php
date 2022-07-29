<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Inicio</h3>
    </div>
</div>

<div class="container-fluid">

    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="m-b-0"><i class="mdi mdi-settings text-danger"></i></h2>
                        <h3 class="">Informações Gerais</h3>
                        <h6 class="card-subtitle"><a href="informacoes-gerais">Acessar ></a></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="m-b-0"><i class="mdi mdi-store text-danger"></i></h2>
                        <h3 class="">Sobre a Empresa</h3>
                        <h6 class="card-subtitle"><a href="sobre">Acessar ></a></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="m-b-0"><i class="mdi mdi-account text-danger"></i></h2>
                        <h3 class="">Usuários</h3>
                        <h6 class="card-subtitle"><a href="usuarios">Acessar ></a></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="m-b-0"><i class="mdi mdi-whatsapp text-danger"></i></h2>
                        <h3 class="">Suporte</h3>
                        <h6 class="card-subtitle"><a href="https://api.whatsapp.com/send?l=pt_BR&phone=5545998483073" target="_blank">Acessar ></a></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <h4 class="card-title">Contatos Recebidos<br><small class="text-muted">Últimos Contatos</small></h4>
                    </div>
                    <div id="div_tabela_contatos_recebidos" class="table-responsive">
                        <table id="tabela_contatos_recebidos" class="table table-sm table-hover table-striped table-bordered" cellspacing="0" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Data Recebimento</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div id="div_aviso_contatos_recebidos" class="row">
                        <div class="col-sm">
                            <div class="alert alert-warning" role="alert">
                                <center>
                                    Nenhum resultado encontrado!
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="<?php echo URL ?>wdadmin/scripts/inicio.js"></script>