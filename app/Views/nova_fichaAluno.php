<!-- Content Wrapper. Contains page content -->
<div style="background-color: #FFFFFF;" class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section  class="">
      <div class="box">
        <div class="box-header with-border" style="
            display: flex;
            justify-content: flex-start;
            align-items: center;
        " >
          <img onclick="window.location.href='/Aplicativo/FichaAluno'" src="/template/img/seta_esquerda.png" style="max-width: 5%; margin-right: 10px" alt="">
          <h4 class="box-title"><?php echo $turma->NOME_TURMA." (".$turma->ANO_LETIVO.")"; ?> </h4>
          <input type="hidden" name="turma" id="turma" value="<?php echo $turma->ID_TURMA; ?>">
        </div>
        <div class="box-body">
          <?php

          foreach ($resultados as $resultado) {
            echo 
            '
              <a href="/Aplicativo/FichaAlunoPeriodo/'.$resultado->ID_ALUNO.'/'.$turma->ID_TURMA.'/'.$resultado->SITUACAO.'">
                <div class="form-group" style="display: flex;    justify-content: space-between;    align-items: center;">
                  <div class="controls"  >
                    <label style="color: #000!important; font-size: 14px" for="checkbox_1-'.$resultado->ID_ALUNO.'">'.$resultado->NOME_ALUNO.'</label>
                  </div>
                  <img  data-toggle="modal" data-target="#modal-center" src="/template/img/novo_acompanhamento.png" style="max-width: 8%; margin-bottom: 10px; margin-right: 5px; " alt="">
                </div>   
              </a>
            ';
          }

          ?>
          
        </div>
        <!-- /.box-body -->
      </div>  



      
	  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



<script src="/template/js/escola.js"></script>