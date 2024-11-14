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
          <img onclick="history.back()" src="/template/img/seta_esquerda.png" style="max-width: 5%; margin-right: 10px" alt="">
          <h4 class="box-title"><?php echo $turma->NOME_TURMA." (".$turma->ANO_LETIVO.")"; ?> </h4>
          <input type="hidden" name="turma" id="turma" value="<?php echo $turma->ID_TURMA; ?>">
          <input type="hidden" name="tipo" id="tipo" value="O" >
          <input type="hidden" class="form-control" name="id_ocorrencia" id="id_ocorrencia" value="<?php echo isset($dados_ocorrencia->ID_OCORRENCIA) ? $dados_ocorrencia->ID_OCORRENCIA : '';?>" >
        </div>
        <div class="box-body">
          <!-- Date -->
          <div class="form-group">
            <h5 style="color: #000;" class="box-title">Data da ocorrência</h5>

            <div class="input-group date">
              <input type="date" value="<?php echo isset($dados_ocorrencia->DATA) ? $dados_ocorrencia->DATA : '';?>" class="form-control pull-right" >
            </div>
            <!-- /.input group -->
          </div>

          <div class="form-group">
            <h5 style="color: #000;" class="box-title">Hora da ocorrência</h5>

            <div class="input-group">
              <input type="text" class="form-control horario"  name="profissional_horario_saida" value="<?php echo isset($dados_ocorrencia->HORA) ? $dados_ocorrencia->HORA : '';?>" >
            </div>

            <!-- /.input group -->
          </div>
          <!-- /.form group -->



          <div class="form-group">
            <h5 style="color: #000;" class="box-title">Descrição da ocorrência</h5>

            <div class="input-group">
              <textarea name="textarea" id="textarea" class="form-control" ><?php echo isset($dados_ocorrencia->DESCRICAO) ? $dados_ocorrencia->DESCRICAO : '';?></textarea>
            </div>

            <!-- /.input group -->
          </div>
          <!-- /.form group -->


          <button type="button" class="btn btn-danger mb-5">Salvar</button>          

        </div>
        <!-- /.box-body -->
      </div>  

      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Alunos envolvidos </h4>
        </div>
        <div class="box-body">

          <?php

            $envolvidos_ids = array();
            if($dados_envolvidos_ocorrencia != null){
              foreach ($dados_envolvidos_ocorrencia as $envolvido) {
                  $envolvidos_ids[] = $envolvido->FK_ID_ALUNO;
              }
            }

            
            foreach ($resultados as $resultado) {
                $checked = in_array($resultado->ID_ALUNO, $envolvidos_ids) ? 'checked' : '';
                $disabled = "";
                if($resultado->SITUACAO != "CU"){
                  $disabled = "disabled";
                }
                echo '
                <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="controls">
                        <input '.$disabled.' type="checkbox" id="checkbox_1-'.$resultado->ID_ALUNO.'" required value="single" '.$checked.'>
                        <label style="color: #000!important; font-size: 14px" for="checkbox_1-'.$resultado->ID_ALUNO.'">'.$resultado->NOME_ALUNO.'</label>
                    </div>
                </div>';
            }

          ?>

           

        </div>
        <!-- /.box-body -->
      </div>  


      
	  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal -->
<div class="modal center-modal fade" id="modal-center" tabindex="-1">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Modal title</h5>
    <button type="button" class="close" data-dismiss="modal">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <h5 style="color: #000;" class="box-title">Justificativa da falta</h5>

        <div class="input-group">
          <textarea name="textarea" row="10" id="textarea" class="form-control" ></textarea>
        </div>

        <!-- /.input group -->
      </div>
      <!-- /.form group -->
    </div>
    <div class="modal-footer modal-footer-uniform">
    <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Fechar</button>
    <button type="button" class="btn btn-bold btn-pure btn-primary float-right">Salvar</button>
    </div>
  </div>
  </div>
</div>
<!-- /.modal -->

<div class="modal modal-danger fade" id="modal-danger">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title">Erro ao salvar</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
    <p>One fine body&hellip;</p>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-outline btn-light" style="color: #FFF" data-dismiss="modal">ok</button>
    </div>
  </div>
  <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<div class="modal modal-success fade" id="modal-success">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title">Ação realizada</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
    <p>One fine body&hellip;</p>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-outline btn-light" style="color: #FFF" data-dismiss="modal">ok</button>
    </div>
  </div>
  <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script src="/template/js/escola.js"></script>