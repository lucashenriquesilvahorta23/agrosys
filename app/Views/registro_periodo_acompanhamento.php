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
          <img onclick="window.location.href='/Aplicativo/RegistroNovo/<?php echo $turma->ID_TURMA; ?>'" src="/template/img/seta_esquerda.png" style="max-width: 5%; margin-right: 10px" alt="">
          <h4 class="box-title"><?php echo $turma->NOME_TURMA." (".$turma->ANO_LETIVO.")"; ?> </h4>
          <input type="hidden" name="turma" id="turma" value="<?php echo $turma->ID_TURMA; ?>">
        </div>
        <div class="box-body">
        <input type="hidden" name="situacao" id="situacao" value="<?= $situacao; ?>">
          <div class="row">
            <div  class="col-xl-3 col-md-6 col-12">
                <div class="box">
                  <div class="box-body">

                    <a href="/Aplicativo/RegistrarRegistro/1/<?php echo $turma->ID_TURMA."/".$aluno; ?>">
                    <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;" class="text-left my-2">
                      <img src="/template/img/registro2.png" style="max-width: 40%; " alt="">
                      <?php 
                        if($aluno_primeiro_semestre != null){
                          echo '<h2 style="color: #415e4a; font-weight: 500; text-align:center;">Inicio do Ano Letivo <img src="/template/img/feito.png" style="max-width: 10%; " alt=""></h2>';
                        }else{
                          echo '<h2 style="color: #415e4a; font-weight: 500; text-align:center;">Inicio do Ano Letivo <img src="/template/img/pendente.png" style="max-width: 10%; " alt=""></h2>';
                        }
                      ?>
                    </div>
                    </a>
                  </div>
                </div>
            </div>
            <div  class="col-xl-3 col-md-6 col-12">
                <div class="box">
                  <div class="box-body">

                  <a href="/Aplicativo/RegistrarRegistro/2/<?php echo $turma->ID_TURMA."/".$aluno; ?>">
                    <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;" class="text-left my-2">
                      <img src="/template/img/registro2.png" style="max-width: 40%; " alt="">
                      <?php                       
                        
                        if($aluno_segundo_semestre != null){
                          echo '<h2 style="color: #415e4a; font-weight: 500; text-align:center;">Final do Ano Letivo <img src="/template/img/feito.png" style="max-width: 10%; " alt=""></h2>';
                        }else{
                          echo '<h2 style="color: #415e4a; font-weight: 500; text-align:center;">Final do Ano Letivo <img src="/template/img/pendente.png" style="max-width: 10%; " alt=""></h2>';
                        }
                      ?>
                    </div>
                    </a>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>  



      
	  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



<script src="/template/js/escola.js"></script>