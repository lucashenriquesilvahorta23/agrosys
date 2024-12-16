<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Fazenda
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Fazendas</a></li>
            <li class="breadcrumb-item active"><?php echo isset($fazenda->ID) ? 'Edição' : 'Cadastro'; ?> de Fazenda</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">    
            <div class="col-lg-12 col-12">
                <div class="box box-solid bg-login">
                    <div class="box-header with-border">
                        <h4 class="box-title"><?php echo isset($fazenda->ID) ? 'Edição' : 'Cadastro'; ?> de Fazenda</h4>            
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>    
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <!-- /.box-header -->
                    <form class="form" method="POST" action="/Fazendas/Store" id="frm" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nome da Fazenda</label> <span class="text-danger">*</span>
                                        <input type="hidden" class="form-control" name="fazenda_id" value="<?php echo isset($fazenda->ID_ESCOLA) ? $fazenda->ID_ESCOLA : ''; ?>">
                                        <input type="text" class="form-control" placeholder="Nome da fazenda" name="nome" required value="<?php echo isset($fazenda->NOME) ? $fazenda->NOME : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Endereço</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="Endereço completo" name="endereco" required value="<?php echo isset($fazenda->ENDERECO) ? $fazenda->ENDERECO : ''; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Área Total (ha)</label>
                                        <input type="number" step="0.01" class="form-control" placeholder="Área em hectares" name="area_total" value="<?php echo isset($fazenda->AREA_TOTAL) ? $fazenda->AREA_TOTAL : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Tipo de Produção</label>
                                        <input type="text" class="form-control" placeholder="Tipo de produção" name="tipo_producao" value="<?php echo isset($fazenda->TIPO_PRODUCAO) ? $fazenda->TIPO_PRODUCAO : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nome do Responsável</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="Nome do responsável" name="contato_responsavel" required value="<?php echo isset($fazenda->CONTATO_RESPONSAVEL) ? $fazenda->CONTATO_RESPONSAVEL : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Telefone de Contato</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control tel" placeholder="(xx) xxxx-xxxx" name="telefone_contato" required value="<?php echo isset($fazenda->TELEFONE_CONTATO) ? $fazenda->TELEFONE_CONTATO : ''; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Data de Cadastro</label> <span class="text-danger">*</span>
                                        <input type="date" class="form-control" name="data_cadastro" required value="<?php echo isset($fazenda->DATA_CADASTRO) ? $fazenda->DATA_CADASTRO : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Status</label> <span class="text-danger">*</span>
                                        <select class="form-control" name="status" required>
                                            <option value="ATIVO" <?php echo (isset($fazenda->STATUS) && $fazenda->STATUS == 'ATIVO') ? 'selected' : ''; ?>>Ativo</option>
                                            <option value="INATIVO" <?php echo (isset($fazenda->STATUS) && $fazenda->STATUS == 'INATIVO') ? 'selected' : ''; ?>>Inativo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-right">
                            <button type="button" class="btn btn-warning btn-outline mr-1">
                                <i class="fa fa-times"></i> Cancelar
                            </button>
                            <button id="gravar" type="submit" class="btn btn-primary btn-outline">
                                <i class="fa fa-save"></i> Salvar
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->            
            </div>  
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="/template/js/fazenda.js"></script>
