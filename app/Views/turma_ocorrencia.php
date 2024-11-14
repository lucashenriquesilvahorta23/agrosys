
  <!-- Content Wrapper. Contains page content -->
<div style="background-color: #FFFFFF;" class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section  class="">
      <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
        <h4 style="color: #000; margin-top: 15px; margin-left: 15px;"><img onclick="window.location.href='/Aplicativo'" src="/template/img/seta_esquerda.png" style="max-width: 5%;" alt=""> Turmas</h4>
      </div>
      <?php

        foreach ($resultados as $resultado) {
          echo 
          '
            <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;border-bottom: 1px solid #000;">
              <h3 style="color: #000; margin-top: 15px; margin-left: 15px;">'.$resultado->NOME_TURMA." (".$resultado->ANO_LETIVO.")".'</h3>
              <a style="display: contents;" href="/Aplicativo/ListaOcorrencia/'.$resultado->ID_TURMA.'" ><button style="margin-right: 10px" type="button" class="btn btn-sm btn-danger">Abrir</button></a>
            </div>
          ';
        }

      ?>
      
      
	  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="/template/js/escola.js"></script>
  