 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ocorrência
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Escolas</a></li>
        <li class="breadcrumb-item active"><?php echo isset($ocorrencia->ID_OCORRENCIA) ? 'Edição' : 'Cadastro';?> de ocorrência</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
        <div class="row">	
            <div class="col-lg-12 col-12">
                    <div class="box box-solid bg-login">
                    <div class="box-header with-border">
                        <h4 class="box-title"><?php echo isset($ocorrencia->ID_OCORRENCIA) ? 'Edição' : 'Cadastro';?> de Ocorrência</h4>			
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>	
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <!-- /.box-header -->
                    <form class="form" method="POST" action="/Ocorrencia/Store" id="frm" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Descrição</label> <span class="text-danger">*</span>
                                        <input type="hidden" class="form-control" value="<?php echo isset($ocorrencia->ID_OCORRENCIA) ? $ocorrencia->ID_OCORRENCIA : '';?>" name="ocorrencia_id">
                                        <input type="text" class="form-control" name="descricao" required id="descricao" value="<?php echo isset($ocorrencia->DESCRICAO) ? $ocorrencia->DESCRICAO : '';?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Data*</label>
                                        <input type="date" class="form-control" value="<?php echo isset($ocorrencia->DATA) ? $ocorrencia->DATA : '';?>" name="data" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Horário *</label>
                                        <input type="text" class="form-control horario" value="<?php echo isset($ocorrencia->HORA) ? $ocorrencia->HORA : '';?>" name="hora" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
    
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Ano letivo</label>
                                        <select id="ano_letivo" name="ano_letivo" class="form-control">
                                            <option value="">Escolha um ano letivo</option>
                                            <?php
                                                foreach($anos as $ano) {
                                                    $selected = (isset($ocorrencia->FK_ID_ANO_LETIVO) && $ocorrencia->FK_ID_ANO_LETIVO == $ano->ID_ANO_LETIVO) ? 'selected' : '';
                                                    echo "<option value='$ano->ID_ANO_LETIVO' $selected>$ano->ANO_LETIVO</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Etapa</label> 
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

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Turma</label> 
                                        <select id="turma" name="turma" class="form-control">
                                            <option value="">Escolha uma turma</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Aluno</label> 
                                        <select id="aluno" name="alunos[]" class="form-control select2" multiple="multiple" >
                                            <?php
                                                if($dados_envolvidos_ocorrencia != ""){

                                                    foreach($dados_envolvidos_ocorrencia as $envolvidos) {
                                                        echo "<option value='$envolvidos->FK_ID_ALUNO' selected='selected' >$envolvidos->NOME_ALUNO</option>";
                                                    }
                                                }
                                            ?>
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