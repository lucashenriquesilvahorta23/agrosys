 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Vinculo de aluno
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Ano letivo</a></li>
        <li class="breadcrumb-item active"><?php echo isset($aluno_vinculo->ID_ALUNO_TURMA) ? 'Edição' : 'Cadastro';?> de vinculo de aluno</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
        <div class="row">	
            <div class="col-lg-12 col-12">
                    <div class="box box-solid bg-login">
                    <div class="box-header with-border">
                        <h4 class="box-title"><?php echo isset($aluno_vinculo->ID_ALUNO_TURMA) ? 'Edição' : 'Cadastro';?> de vinculo de aluno</h4>			
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>	
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <!-- /.box-header -->
                    <form novalidate method="POST" action="/Aluno/StoreVinculo" id="frm" class="validate" enctype='multipart/form-data'>
                        <div class="box-body">
                            <!-- Linha 1 -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ano letivo *</label>
                                        <select id="ano_letivo" name="ano_letivo" class="form-control">
                                            <option value="">Selecione uma opção</option>
                                            <?php
                                                foreach($anos as $ano) {
                                                    echo "<option value='$ano->ID_ANO_LETIVO'>$ano->ANO_LETIVO</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Campo Etapa -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="color: #000000">Etapa</label>
                                        <select id="etapa_escolar" name="etapa_escolar" class="form-control">
                                            <option value="">Escolha uma etapa</option>
                                            <option value="C1">Creche I</option>
                                            <option value="C2">Creche II</option>
                                            <option value="C3">Creche III</option>
                                            <option value="I1">Ed. Infantil I</option>
                                            <option value="I2">Ed. Infantil II</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Campo Turma -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="color: #000000">Turma</label>
                                        <select id="turma" name="turma" class="form-control">
                                            <option value="">Escolha uma turma</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Data Matricula *</label>
                                        <input type="hidden" class="form-control" value="<?php echo isset($aluno_vinculo->ID_ALUNO_TURMA) ? $aluno_vinculo->ID_ALUNO_TURMA : '';?>" name="aluno_vinculo_id">
                                        <input type="hidden" class="form-control" value="<?php echo isset($id_aluno) ? $id_aluno : '';?>" name="aluno_id" id="aluno_id">
                                        <input type="date" class="form-control" value="<?php echo isset($aluno_vinculo->DATA_MATRICULA) ? $aluno_vinculo->DATA_MATRICULA : '';?>" name="data_matricula" id="data_matricula" required>
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