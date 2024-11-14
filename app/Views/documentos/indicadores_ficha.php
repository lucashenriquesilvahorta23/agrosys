<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-file"></i> INDICADORES DE FICHA DE OBSERVAÇÃO
      </h1>
    </section>
    <style>
.chartdiv {
  width: 100%;
  height: 500px;
}
</style>
<!-- Resources -->

    <!-- Main content -->
    <section class="content">
        <div class="row">		
            <div class="col-12">         
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Filtro</h3>
                    </div>
                    <!-- /.box-header -->

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
                                        <label style="color: #000000" >Bimestre</label>
                                        <select id="bimestre" name="bimestre" class="form-control">
                                            <option value="1">1º Bimestre</option>
                                            <option value="2">2º Bimestre</option>
                                            <option value="3">3º Bimestre</option>
                                            <option value="4">4º Bimestre</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label style="color: #000000">Tipo</label>
                                        <select id="aspectos" name="aspectos" class="form-control">
                                            <option value="1">Aspectos Físicos</option>
                                            <option value="2">Aspectos da Coordenação Motora Fina</option>
                                            <option value="3">Aspectos Sociais e Emocionais</option>
                                            <option value="4">Aspectos de Autonomia</option>
                                            <option value="5">Aspectos Cognitivos</option>
                                            <option value="6">Aspectos da Relação Família x Escola</option>
                                        </select>
                                    </div>
                                </div>


                                <input type="hidden" name="pesquisa" value="S">
                                </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-controls pull-right">
                                        <!-- <button id="row-remove" class="btn btn-xs btn-danger">Delete selected row</button> -->
                                        <button type="button" id="gerar_grafico" class="btn btn-md btn-info"><i class="fa fa-file"></i> Gerar</button>
                                    </div>              
                                </div>

                            </div>
                        </div>
                    <!-- /.box-body -->
                </div>
            <!-- /.box -->          
            </div>
            <!-- /.col -->
        </div>

        <div class="row">		
            <div class="col-12">         
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Resultado</h3>
                    </div>
                    <!-- /.box-header -->

                        <div class="box-body">
                            <div class="row">
                                <div class="chartdiv" id="chartdiv1"></div>
                                <div class="chartdiv" id="chartdiv2"></div>
                                <div class="chartdiv" id="chartdiv3"></div>
                                <div class="chartdiv" id="chartdiv4"></div>
                                <div class="chartdiv" id="chartdiv5"></div>
                                <div class="chartdiv" id="chartdiv6"></div>
                                <div class="chartdiv" id="chartdiv7"></div>
                            </div>
                        </div>
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