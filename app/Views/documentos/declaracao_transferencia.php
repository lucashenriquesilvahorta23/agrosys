<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-file"></i> DECLARAÇÃO DE TRANSFERÊNCIA DE ALUNO
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
                    <form method="POST" action="/Documento/RelatorioDeclaracaoParaTransferenciaEmCurso" id="frm" target="_blank" class="validate" enctype='multipart/form-data'>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="color: #000000" >Turma</label>
                                        <select id="turma" name="turma" class="form-control">
                                            <option value="">Escolha uma turma</option>
                                            <?php

                                                foreach($turmas as $turma) {
                                                    $selected = (isset($aluno_vinculo->FK_ID_TURMA) && $aluno_vinculo->FK_ID_TURMA == $turma->ID_TURMA) ? 'selected' : '';
                                                    echo "<option value='$turma->ID_TURMA' $selected>$turma->NOME_TURMA</option>";
                                                }
                                            ?>
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