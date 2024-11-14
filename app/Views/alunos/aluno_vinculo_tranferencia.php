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
                                        <label>Turma *</label>
                                        <input type="hidden" class="form-control" value="<?php echo isset($aluno_vinculo->ID_ALUNO_TURMA) ? $aluno_vinculo->ID_ALUNO_TURMA : '';?>" name="aluno_vinculo_id">
                                        <input type="hidden" class="form-control" value="<?php echo isset($aluno_vinculo->FK_ID_ALUNO) ? $aluno_vinculo->FK_ID_ALUNO : '';?>" name="aluno_id">
                                        <select id="turma" name="turma" class="form-control">
                                            <?php

                                                foreach($turmas as $turma) {
                                                    $selected = (isset($aluno_vinculo->FK_ID_TURMA) && $aluno_vinculo->FK_ID_TURMA == $turma->ID_TURMA) ? 'selected' : '';
                                                    echo "<option value='$turma->ID_TURMA' $selected>$turma->NOME_TURMA</option>";
                                                }
                                            ?>
                                        </select>
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