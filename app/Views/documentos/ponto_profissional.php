<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-file"></i> FOLHA DE PONTO DO PROFISSIONAL
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
                    <form method="POST" action="/Documento/RelatorioPontoDeProfissional" id="frm" target="_blank" class="validate" enctype='multipart/form-data'>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="color: #000000" >Ano</label>
                                        <select id="ano" name="ano" class="form-control">
                                            <?php
                                                $currentYear = date("Y");
                                                $startYear = $currentYear;
                                                $endYear = $currentYear + 20;

                                                for ($year = $startYear; $year <= $endYear; $year++) {
                                                    $selected = (isset($anoLetivo->ANO_LETIVO) && $anoLetivo->ANO_LETIVO == $year) ? 'selected' : '';
                                                    echo "<option value='$year' $selected>$year</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="color: #000000" >Mês</label>
                                        <select name="mes" id="mes" class="form-control">
                                            <option value="01">Janeiro</option>
                                            <option value="02">Fevereiro</option>
                                            <option value="03">Março</option>
                                            <option value="04">Abril</option>
                                            <option value="05">Maio</option>
                                            <option value="06">Junho</option>
                                            <option value="07">Julho</option>
                                            <option value="08">Agosto</option>
                                            <option value="09">Setembro</option>
                                            <option value="10">Outubro</option>
                                            <option value="11">Novembro</option>
                                            <option value="12">Dezembro</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="color: #000000" >Profissional</label>
                                        <select id="profissional" name="profissional" class="form-control">
                                            <option value="">Escolha um profissional</option>
                                            <?php

                                                foreach($resultados as $professor) {
                                                    $selected = (isset($usuario->FK_ID_PROFISSIONAL) && $usuario->FK_ID_PROFISSIONAL == $professor->ID_PROFISSIONAL) ? 'selected' : '';
                                                    echo "<option value='$professor->ID_PROFISSIONAL' $selected>$professor->NOME_PROFISSIONAL</option>";
                                                }
                                            ?>
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