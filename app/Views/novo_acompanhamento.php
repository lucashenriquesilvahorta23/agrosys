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
        </div>
        <div class="box-body">
          <!-- <form novalidate method="POST" action="/Aplicativo/AcompanhamentoInserir" id="frm" class="validate" enctype='multipart/form-data'> -->
            <!-- Date -->
            <h3 style="color: #000; text-align: center;" class="box-title"><?php echo $dados_aluno->NOME_ALUNO; ?></h3>
            <br>

            <div class="form-group">
              <h5 style="color: #000;" class="box-title">Data do acompanhamento</h5>

              <div class="input-group date">
                <input type="date" name="data_acompanhamento" id="data_acompanhamento" value="<?php echo isset($dados_semestre->DATA) ? $dados_semestre->DATA : '';?>" class="form-control pull-right" >
                <input type="hidden" name="turma" id="turma" value="<?php echo $turma->ID_TURMA; ?>">
                <input type="hidden" name="semestre" id="semestre" value="<?php echo $semestre; ?>">
                <input type="hidden" name="aluno" id="aluno" value="<?php echo $aluno; ?>">
                <input type="hidden" name="tipo" id="tipo" value="A" >
                <input type="hidden" class="form-control" name="acompanhamento_id" id="acompanhamento_id" value="<?php echo isset($dados_semestre->ID_ACOMPANHAMENTO_ALUNO) ? $dados_semestre->ID_ACOMPANHAMENTO_ALUNO : '';?>" >
              </div>
              <!-- /.input group -->
            </div>

            <br>


            <div class="form-group" >
              <h5 style="color: #000;" class="box-title">Descrição detalhada</h5>

              <div class="input-group">
              <textarea name="eu_outros" id="eu_outros" class="form-control"  style="width: 100%; height: 150px;"> <?php echo isset($dados_semestre->EU_OUTROS_NOS) ? $dados_semestre->EU_OUTROS_NOS : '';?> </textarea>
              </div>

              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <br>

            <div class="form-group" >
              <h5 style="color: #000;" class="box-title">Estratégias De Apoio E Intervenções</h5>

              <div class="input-group">
              <textarea name="estrategias" id="estrategias" class="form-control"  style="width: 100%; height: 150px;"> <?php echo isset($dados_semestre->ESTRATEGIAS_APOIO_INTERVENCOES) ? $dados_semestre->ESTRATEGIAS_APOIO_INTERVENCOES : '';?> </textarea>
              </div>

              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <br>

            <div class="form-group" >
              <h5 style="color: #000;" class="box-title">Recomendações</h5>

              <div class="input-group">
              <textarea name="recomendacoes" id="recomendacoes" class="form-control"  style="width: 100%; height: 150px;"> <?php echo isset($dados_semestre->RECOMENDACOES) ? $dados_semestre->RECOMENDACOES : '';?> </textarea>
              </div>

              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <br>

            <button type="button" id="gravar_acompanhamento" class="btn btn-danger">Salvar</button>         
          <!-- </form>  -->

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