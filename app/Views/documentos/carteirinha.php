<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-file"></i> CARTEIRINHA DE IDENTIFICAÇÃO
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">		
            <div class="col-12">         
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Filtro</h3>
                    </div>
                    <!-- /.box-header -->
                    <form method="POST" action="/Documento/RelatorioCarteirinha" id="frm" target="_blank" class="validate" enctype='multipart/form-data'>

                        <div class="box-body">
                            <div class="row">

                                <!-- Campo Ano Letivo -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="color: #000000">Ano letivo</label>
                                        <select id="ano_letivo" name="ano_letivo" class="form-control">
                                            <option value="">Escolha um ano letivo</option>
                                            <?php
                                                foreach($ano_letivo as $ano) {
                                                    $selected = (isset($turma->FK_ID_ANO_LETIVO) && $turma->FK_ID_ANO_LETIVO == $ano->ID_ANO_LETIVO) ? 'selected' : '';
                                                    echo "<option value='$ano->ID_ANO_LETIVO' $selected>$ano->ANO_LETIVO</option>";
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
                                        <label style="color: #000000" >Aluno</label>
                                        <select id="aluno" name="aluno" class="form-control">
                                            <option value="">Escolha um aluno</option>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="pesquisa" value="S">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-controls pull-right">
                                        <!-- <button id="row-remove" class="btn btn-xs btn-danger">Delete selected row</button> -->
                                        <button type="submit" class="btn btn-md btn-info"><i class="fa fa-file"></i> Gerar</button>
                                    </div>              
                                </div>

                            </div>
                        </div>
                    </form>
                    <!-- /.box-body -->
                </div>
            <!-- /.box -->          
            </div>
            <!-- /.col -->
        </div>

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="/template/js/escola.js"></script>