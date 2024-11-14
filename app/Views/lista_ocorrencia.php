<!-- Content Wrapper. Contains page content -->
<div style="background-color: #FFFFFF;" class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section  class="">
      <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
        <h4 style="color: #000; margin-top: 15px; margin-left: 15px;"><img onclick="window.location.href='/Aplicativo/Ocorrencia'" src="/template/img/seta_esquerda.png" style="max-width: 5%;" alt=""> Turmas</h4>
      </div>

      <div style="display: flex; flex-direction: row; align-items: center; justify-content: center; margin-bottom: 20px">
        <a href="/Aplicativo/OcorrenciaNovo/<?php echo $turma->ID_TURMA; ?>/0" type="button" style="background-color: #415e4a; width: 410px" class="btn mb-5">Nova ocorrência</a>       
      </div>

      <form action="/Aplicativo/ListaOcorrencia/<?php echo $turma->ID_TURMA; ?>" method="post">
        <div style="display: flex; flex-direction: row; align-items: center; justify-content: center; margin-bottom: 20px; flex-direction: row">
            <input name="data_filtro" type="date" style="width: 130px!important; margin-right: 10px; height: 37px" id="data_filtro" value="<?php if(isset($_POST["data_filtro"]))echo $_POST["data_filtro"]; ?>" class="form-control pull-right" >
            <button type="submit" style="width: 130px!important; margin-right: 10px; background-color: #415e4a" type="button" class="btn mb-5">Pesquisar</button>       
            <input type="hidden" name="pesquisar" value="S">
            <a href="/Aplicativo/ListaOcorrencia/<?php echo $turma->ID_TURMA; ?>" style="width: 130px!important;" type="button" class="btn btn-warning mb-5">Ver todos</a>
        </div>
      </form>

      <ul class="nav nav-tabs nav-fill" role="tablist">
					<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home11" role="tab"> <h4 style=" margin-top: 15px; font-weight: 500 ">Datas</h4></a> </li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content tabcontent-border">
					<div class="tab-pane active" id="home11" role="tabpanel">
            <?php


            if($resultados_ocorrencia != ""){
              foreach ($resultados_ocorrencia as $ocorrencia) {
                echo 
                '
                  <a href="/Aplicativo/OcorrenciaNovo/'.$ocorrencia->FK_ID_TURMA.'/'.$ocorrencia->ID_OCORRENCIA.'">
                    <div style="display: flex; flex-direction: row; align-items: center;border-bottom: 1px solid #000;">
                      <img src="/template/img/edit.png" style="max-width: 10%; margin-left: 10px" alt="">
                      <h3 style="color: #000; margin-top: 15px; margin-left: 15px;">'.$ocorrencia->OCORRENCIA.'</h3>
                    </div>
                  </a>
                ';
              }
            }

            ?>
					</div>
				
      
	  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="/template/js/escola.js"></script>