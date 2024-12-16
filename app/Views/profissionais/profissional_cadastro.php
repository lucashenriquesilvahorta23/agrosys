<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cadastro de Animais
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Animais</a></li>
            <li class="breadcrumb-item active">Cadastro de Animal</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">	
            <div class="col-lg-12 col-12">
                <div class="box box-solid bg-login">
                    <div class="box-header with-border">
                        <h4 class="box-title">Cadastro de Animal</h4>			
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>	
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <!-- /.box-header -->
                    <form novalidate method="POST" action="/Animais/Store" name="animal" id="frm" class="validate" enctype='multipart/form-data'>
                        <div class="box-body">
                            <!-- Linha 1 -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Lote *</label>
                                        <input type="hidden" class="form-control" name="profissional_id" value="<?php echo isset($animal->ID_PROFISSIONAL) ? $animal->ID_PROFISSIONAL : ''; ?>">

                                        <select name="lote" required class="form-control">
                                            <option value="">Escolha um lote</option>
                                            <?php 
                                                foreach($lotes as $lote){
                                                    $select = '';
                                                    if(isset($animal->FK_ID_LOTE)&&$animal->FK_ID_LOTE==$lote->ID_ANO_LETIVO){$select = 'selected';}
                                                    echo '<option value="'.$lote->ID_ANO_LETIVO.'" '.$select.'>'.$lote->NOME_LOTE.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Identificação *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($animal->IDENTIFICACAO) ? $animal->IDENTIFICACAO : ''; ?>" name="identificacao" maxlength="50" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" value="<?php echo isset($animal->NOME) ? $animal->NOME : ''; ?>" name="nome" maxlength="50">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Raça</label>
                                        <input type="text" class="form-control" value="<?php echo isset($animal->RACA) ? $animal->RACA : ''; ?>" name="raca" maxlength="50">
                                    </div>
                                </div>
                            </div>

                            <!-- Linha 2 -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Sexo *</label>
                                        <select class="form-control" name="sexo" required>
                                            <option value="">Selecione</option>
                                            <option <?php if(isset($animal->SEXO) && $animal->SEXO == 'MACHO'){echo 'selected';}?> value="MACHO">Macho</option>
                                            <option <?php if(isset($animal->SEXO) && $animal->SEXO == 'FÊMEA'){echo 'selected';}?> value="FÊMEA">Fêmea</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data de Nascimento</label>
                                        <input type="date" class="form-control" value="<?php echo isset($animal->DATA_NASCIMENTO) ? $animal->DATA_NASCIMENTO : ''; ?>" name="data_nascimento">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Idade</label>
                                        <input type="number" class="form-control" value="<?php echo isset($animal->IDADE) ? $animal->IDADE : ''; ?>" name="idade">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Peso Inicial</label>
                                        <input type="number" step="0.01" class="form-control" value="<?php echo isset($animal->PESO_INICIAL) ? $animal->PESO_INICIAL : ''; ?>" name="peso_inicial">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Peso Atual</label>
                                        <input type="number" step="0.01" class="form-control" value="<?php echo isset($animal->PESO_ATUAL) ? $animal->PESO_ATUAL : ''; ?>" name="peso_atual">
                                    </div>
                                </div>
                            </div>

                            <!-- Linha 3 -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data de Entrada</label>
                                        <input type="date" class="form-control" value="<?php echo isset($animal->DATA_ENTRADA) ? $animal->DATA_ENTRADA : ''; ?>" name="data_entrada">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status *</label>
                                        <select class="form-control" name="status" required>
                                            <option value="">Selecione</option>
                                            <option <?php if(isset($animal->STATUS) && $animal->STATUS == 'ATIVO'){echo 'selected';}?> value="ATIVO">Ativo</option>
                                            <option <?php if(isset($animal->STATUS) && $animal->STATUS == 'VENDIDO'){echo 'selected';}?> value="VENDIDO">Vendido</option>
                                            <option <?php if(isset($animal->STATUS) && $animal->STATUS == 'MORTO'){echo 'selected';}?> value="MORTO">Morto</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Linha 4 -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Histórico de Saúde</label>
                                        <textarea class="form-control" value="<?php echo isset($animal->HISTORICO_SAUDE) ? $animal->HISTORICO_SAUDE : ''; ?>" name="historico_saude" rows="4"><?php echo isset($animal->HISTORICO_SAUDE) ? $animal->HISTORICO_SAUDE : ''; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Observações</label>
                                        <textarea class="form-control" value="<?php echo isset($animal->OBSERVACOES) ? $animal->OBSERVACOES : ''; ?>" name="observacoes" rows="4"><?php echo isset($animal->OBSERVACOES) ? $animal->OBSERVACOES : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer text-right">
                            <button type="reset" class="btn btn-warning btn-outline mr-1">
                                <i class="fa fa-times"></i> Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary btn-outline">
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
