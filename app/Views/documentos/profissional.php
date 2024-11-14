<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-file"></i> PROFISSIONAL
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
                    <form method="POST" action="/Documento/RelatorioProfissional" id="frm" target="_blank" class="validate" enctype='multipart/form-data'>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="color: #000000" >Situação</label>
                                        <select name="situacao_profissional" id="situacao_profissional" class="form-control">
                                            <option value="">Escolha uma situação</option>
                                            <option value="A">Admitido</option>
                                            <option value="D">Desligado</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="color: #000000" >Cargo</label>
                                        <select name="profissional_cargo" class="form-control">
                                            <option value="">Escolha um cargo</option>
                                            <?php 
                                                foreach($profissoes as $prof){
                                                    $select = '';
                                                    if(isset($profissional->CARGO)&&$profissional->CARGO==$prof->ID_PROFISSAO){$select = 'selected';}
                                                    echo '<option value="'.$prof->ID_PROFISSAO.'" '.$select.'>'.$prof->NOME.'</option>';
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