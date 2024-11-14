 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Turma
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Turma</a></li>
        <li class="breadcrumb-item active"><?php echo isset($turma->ID_TURMA) ? 'Edição' : 'Cadastro';?> de turma</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
        <div class="row">	
            <div class="col-lg-12 col-12">
                    <div class="box box-solid bg-login">
                    <div class="box-header with-border">
                        <h4 class="box-title"><?php echo isset($turma->ID_TURMA) ? 'Edição' : 'Cadastro';?> de turma</h4>			
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>	
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <!-- /.box-header -->
                    <form novalidate method="POST" action="/Turma/Store" id="frm" class="validate" enctype='multipart/form-data'>
                        <div class="box-body">
                            <!-- Linha 1 -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Código</label>
                                        <input disabled="disabled" type="text" class="form-control" value="<?php echo isset($turma->ID_TURMA) ? $turma->ID_TURMA : '';?>" >
                                        <input type="hidden" class="form-control" value="<?php echo isset($turma->ID_TURMA) ? $turma->ID_TURMA : '';?>" name="turma_id">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Ano letivo *</label>
                                        <select id="ano_letivo" name="ano_letivo" class="form-control">
                                            <?php

                                                foreach($ano_letivo as $ano) {
                                                    $selected = (isset($turma->FK_ID_ANO_LETIVO) && $turma->FK_ID_ANO_LETIVO == $ano->ID_ANO_LETIVO) ? 'selected' : '';
                                                    echo "<option value='$ano->ID_ANO_LETIVO' $selected>$ano->ANO_LETIVO</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Etapa *</label>
                                        <select class="form-control" name="etapa_escolar">
                                            <option <?php if(isset($turma->ETAPA) && $turma->ETAPA == 'I1'){echo 'selected';}?> value="I1">Ed. Infantil I</option>
                                            <option <?php if(isset($turma->ETAPA) && $turma->ETAPA == 'I2'){echo 'selected';}?> value="I2">Ed. Infantil II</option>
                                            <option <?php if(isset($turma->ETAPA) && $turma->ETAPA == 'C1'){echo 'selected';}?> value="C1">Creche I</option>
                                            <option <?php if(isset($turma->ETAPA) && $turma->ETAPA == 'C2'){echo 'selected';}?> value="C2">Creche II</option>
                                            <option <?php if(isset($turma->ETAPA) && $turma->ETAPA == 'C3'){echo 'selected';}?> value="C3">Creche III</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nome da turma *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($turma->NOME_TURMA) ? $turma->NOME_TURMA : '';?>" name="nome_turma" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Turno *</label>
                                        <select class="form-control" name="tipo_atendimento">
                                            <option <?php if(isset($turma->TIPO_ATENDIMENTO) && $turma->TIPO_ATENDIMENTO == 'IN'){echo 'selected';}?> value="IN">Integral</option>
                                            <option <?php if(isset($turma->TIPO_ATENDIMENTO) && $turma->TIPO_ATENDIMENTO == 'PM'){echo 'selected';}?> value="PM">Parcial Matutino</option>
                                            <option <?php if(isset($turma->TIPO_ATENDIMENTO) && $turma->TIPO_ATENDIMENTO == 'PV'){echo 'selected';}?> value="PV">Parcial Vespertino</option>
                                            <option <?php if(isset($turma->TIPO_ATENDIMENTO) && $turma->TIPO_ATENDIMENTO == 'PA'){echo 'selected';}?> value="PA">Parcial</option>
                                            <option <?php if(isset($turma->TIPO_ATENDIMENTO) && $turma->TIPO_ATENDIMENTO == 'ND'){echo 'selected';}?> value="ND">Noturno</option>
                                            <option <?php if(isset($turma->TIPO_ATENDIMENTO) && $turma->TIPO_ATENDIMENTO == 'DU'){echo 'selected';}?> value="DU">Dupla Jornada</option>
                                            <option <?php if(isset($turma->TIPO_ATENDIMENTO) && $turma->TIPO_ATENDIMENTO == 'SE'){echo 'selected';}?> value="SE">Semi-integral</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Horário entrada *</label>
                                        <input type="text" class="form-control horario" value="<?php echo isset($turma->ENTRADA) ? $turma->ENTRADA : '';?>" name="horario_entrada" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Horário saída *</label>
                                        <input type="text" class="form-control horario" value="<?php echo isset($turma->SAIDA) ? $turma->SAIDA : '';?>" name="horario_saida" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Professor </label>
                                        <select id="profissional_cargo" name="profissional_cargo" class="form-control">
                                            <option value="">Escolha um professor</option>
                                            <?php

                                                foreach($professores as $professor) {
                                                    $selected = (isset($turma->FK_ID_PROFISSIONAL) && $turma->FK_ID_PROFISSIONAL == $professor->ID_PROFISSIONAL) ? 'selected' : '';
                                                    echo "<option value='$professor->ID_PROFISSIONAL' $selected>$professor->NOME_PROFISSIONAL</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Quantidade de vagas *</label>
                                        <input type="int" class="form-control" value="<?php echo isset($turma->QTD_VAGAS) ? $turma->QTD_VAGAS : '';?>" name="qtd_vagas" required>
                                    </div>
                                </div>

                                
                            </div>


                            
                            

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-right">
                            <button type="submit" class="btn btn-warning btn-outline mr-1">
                                <i class="fa fa-times"></i> Cancelar
                            </button>
                            <button id="gravar" type="button" class="btn btn-primary btn-outline">
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

  <script src="/template/js/escola.js"></script>