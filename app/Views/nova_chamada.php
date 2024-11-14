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
          <input type="hidden" class="form-control" name="id_chamada" id="id_chamada" value="<?php echo isset($dados_chamada->ID_CHAMADA) ? $dados_chamada->ID_CHAMADA : '';?>" >
        </div>
        <div class="box-body">
          <!-- Date -->
          <div class="form-group">
            <h5 style="color: #000;" class="box-title">Data da chamada</h5>

            <div class="input-group date">
              <input type="date" value="<?php echo isset($dados_chamada->DATA) ? $dados_chamada->DATA : '';?>" id="data_chamada" name="data_chamada" class="form-control pull-right" >
            </div>
            <!-- /.input group -->
          </div>

          <div class="form-group">
            <h5 style="color: #000;" class="box-title">Hora da chamada</h5>

            <div class="input-group">
              <input type="text" class="form-control horario" value="<?php echo isset($dados_chamada->HORA) ? $dados_chamada->HORA : '';?>"  name="profissional_horario_saida" >
            </div>

            <!-- /.input group -->
          </div>
          <!-- /.form group -->



          <div class="form-group">
            <h5 style="color: #000;" class="box-title">Registro das vivências desenvolvidas</h5>

            <div class="input-group">
              <textarea name="textarea" id="textarea" style="width: 100%; height: 100px;" class="form-control" ><?php echo isset($dados_chamada->DESCRICAO) ? $dados_chamada->DESCRICAO : '';?></textarea>
            </div>

            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <div class="form-group">
            <h5 style="color: #000;" class="box-title">Códigos dos objetivos de aprendizagem e desenvolvimento</h5>

            <div class="input-group">
              <input type="text" class="form-control" value="<?php echo isset($dados_chamada->CODIGO) ? $dados_chamada->CODIGO : '';?>"  name="profissional_codigo" >
            </div>

            <!-- /.input group -->
          </div>
          <!-- /.form group -->


                    
          <div class="form-group">
            <div class="controls">
                <input <?php if($dados_chamada != ""){ if($dados_chamada->DIA_NAO_LETIVO == "S"){ echo 'checked="checked" disabled="disabled"';}}?>  type="checkbox" id="dia_nao_letivo">
                <label style="color: #000!important; font-size: 14px" for="dia_nao_letivo">Dia não letivo</label>
            </div>
          </div>

          <div class="form-group">
            <h5 style="color: #000;" class="box-title">Observações</h5>

            <div class="input-group">
              <textarea name="observacoes" id="observacoes" style="width: 100%; height: 100px;" class="form-control" ><?php echo isset($dados_chamada->OBSERVACOES) ? $dados_chamada->OBSERVACOES : '';?></textarea>
            </div>

            <!-- /.input group -->
          </div>


          <button type="button" class="btn btn-danger mb-5">Salvar</button>          

        </div>
        <!-- /.box-body -->
      </div>  

      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Alunos </h4>
        </div>
        <div class="box-body">

          <?php

            $alunos_justificativas = []; // Array para armazenar dados dos alunos e justificativas


            foreach ($resultados as $resultado) {
              // Procurar justificativa para o aluno
              $justificativa = '';
              $presente = 'N';

              // Inicialização das variáveis
              $presente = "";
              $justificativa = "";

              // Verifica se há dados e atribui as variáveis
              if ($dados_envolvidos_chamada != null) {
                foreach ($dados_envolvidos_chamada as $chamada) {
                    if ($chamada->FK_ID_ALUNO == $resultado->ID_ALUNO) {
                        $presente = $chamada->PRESENTE;
                        $justificativa = $chamada->OBSERVACOES;
                        break;
                    }
                }
              }

              // Marcar checkbox com base na presença
              $checked = ($presente === 'S') ? 'checked' : '';

              // Adicionar dados ao array
                $alunos_justificativas[] = [
                  'id_aluno' => $resultado->ID_ALUNO,
                  'nome_aluno' => $resultado->NOME_ALUNO,
                  'presente' => $presente,
                  'justificativa' => $justificativa
              ];

              $disabled = "";
              if(isset($dados_chamada->ID_CHAMADA)){
                $disabled = "disabled";
              }

              $disabled = "";
              if(isset($dados_chamada->ID_CHAMADA) || $resultado->SITUACAO != "CU"){
                $disabled = "disabled";
              }
              
              echo '
                  <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
                      <div class="controls">
                          <input '.$disabled.' type="checkbox" id="checkbox_1-' . $resultado->ID_ALUNO . '" ' . $checked . '>
                          <label style="color: #000!important; font-size: 14px" for="checkbox_1-' . $resultado->ID_ALUNO . '">' . $resultado->NOME_ALUNO . '</label>
                      </div>
                      <img data-toggle="modal" data-target="#modal-center" src="/template/img/comentarios.png" style="max-width: 8%; margin-bottom: 10px; margin-right: 5px;" alt="">
                  </div>
              ';
              // Associar a justificativa ao elemento
              //echo "<script>$('#checkbox_1-" . $resultado->ID_ALUNO . "').closest('.form-group').data('justificativa', '$justificativa');</script>";
            }

          ?>

          <input type="hidden" id="alunos_justificativas" value='<?php echo htmlspecialchars(json_encode($alunos_justificativas), ENT_QUOTES, 'UTF-8'); ?>'>




           

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