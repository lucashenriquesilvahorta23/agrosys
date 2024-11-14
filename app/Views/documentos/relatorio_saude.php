<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-file"></i> FICHA DE SAÚDE
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
                    <form method="POST" action="/Documento/RelatorioDeSaude" id="frm" target="_blank" class="validate" enctype='multipart/form-data'>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="color: #000000" >Ano letivo</label>
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
                                <!-- <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="color: #000000" >Turma</label>
                                        <select id="turma" name="turma" class="form-control">
                                            <option value="">Escolha uma turma</option>
                                        </select>
                                    </div>
                                </div> -->

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="color: #000000" >Categoria</label>
                                        <select id="doenca" name="doenca" class="form-control">
                                            <option value="">Escolha uma categoria</option>
                                            <option value="DE">Deficiencia</option>
                                            <option value="TR">Transtorno</option>
                                            <option value="IA">Intolerância alimentar</option>
                                            <option value="AL">Alergia</option>
                                            <option value="MC">Medicamento continuo</option>
                                            <option value="TE">Tratamento especializado</option>
                                            <option value="DC">Doenças crônicas</option>
                                            <option value="AH">Superdotação</option>
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