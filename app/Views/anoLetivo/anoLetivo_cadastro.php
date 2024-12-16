<style>
    .legenda {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
		color: #000
    }
    .legenda-coluna {
        flex: 1; /* Cada coluna ocupa a mesma largura */
        margin-right: 20px; /* Espaçamento entre as colunas */
    }
    .legenda-item {
        display: flex;
        align-items: center;
        font-size: 12px;
        margin-bottom: 8px; /* Espaçamento entre os itens */
        white-space: nowrap; /* Evita quebra de linha */
    }
    .cor {
        display: inline-block;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        margin-right: 8px;
        border: 1px solid #00000020;
    }

	/* Reduz o tamanho da fonte dos números dos dias */
	.fc-day-number {
		font-size: 15px; /* Ajuste o tamanho conforme necessário */
	}

	/* Caso deseje ajustar também os números dos eventos */
	.fc-event {
		font-size: 15px; /* Ajuste o tamanho conforme necessário */
	}

	/* Reduz o tamanho da fonte dos eventos */
	.fc-event {
		font-size: 12px; /* Ajuste o tamanho conforme necessário */
	}

	/* Reduz o tamanho da fonte dos cabeçalhos dos dias */
	.fc-day-header {
		font-size: 12px; /* Ajuste o tamanho conforme necessário */
	}

	/* Reduz o tamanho da fonte do título do calendário */
	.fc-title {
		font-size: 12px; /* Ajuste o tamanho conforme necessário */
	}

</style>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Lote
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Lote</a></li>
        <li class="breadcrumb-item active"><?php echo isset($anoLetivo->ID_ANO_LETIVO) ? 'Edição' : 'Cadastro';?> de Lote</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
        <div class="row">	
            <div class="col-lg-12 col-12">
                    <div class="box box-solid bg-login">
                    <div class="box-header with-border">
                        <h4 class="box-title"><?php echo isset($anoLetivo->ID_ANO_LETIVO) ? 'Edição' : 'Cadastro';?> de Lote</h4>			
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>	
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <!-- /.box-header -->
                    <form novalidate method="POST" action="/Lotes/Store" id="frm" class="validate" enctype='multipart/form-data'>
                        <div class="box-body">
                            <!-- Linha 1 -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nome do Lote *</label>
                                        <input type="hidden" class="form-control" value="<?php echo isset($anoLetivo->ID_ANO_LETIVO) ? $anoLetivo->ID_ANO_LETIVO : '';?>" name="anoLetivo_id">
                                        <input type="text" class="form-control" value="<?php echo isset($anoLetivo->NOME_LOTE) ? $anoLetivo->NOME_LOTE : '';?>" name="nome_lote" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipo de Lote</label>
                                        <input type="text" class="form-control" value="<?php echo isset($anoLetivo->TIPO_LOTE) ? $anoLetivo->TIPO_LOTE : '';?>" name="tipo_lote">
                                    </div>
                                </div>
                            </div>

                            <!-- Linha 2 -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Número de Animais *</label>
                                        <input type="number" class="form-control" value="<?php echo isset($anoLetivo->NUMERO_ANIMAIS) ? $anoLetivo->NUMERO_ANIMAIS : '';?>" name="numero_animais" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Status *</label>
                                        <select class="form-control" name="status" required>
                                            <option value="ATIVO" <?php echo (isset($anoLetivo->STATUS) && $anoLetivo->STATUS == 'ATIVO') ? 'selected' : '';?>>Ativo</option>
                                            <option value="INATIVO" <?php echo (isset($anoLetivo->STATUS) && $anoLetivo->STATUS == 'INATIVO') ? 'selected' : '';?>>Inativo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Localização</label>
                                        <input type="text" class="form-control" value="<?php echo isset($anoLetivo->LOCALIZACAO) ? $anoLetivo->LOCALIZACAO : '';?>" name="localizacao">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Data de Cadastro *</label>
                                        <input type="date" class="form-control" value="<?php echo isset($anoLetivo->DATA_CADASTRO) ? $anoLetivo->DATA_CADASTRO : '';?>" name="data_cadastro" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Linha 3 -->
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Observações</label>
                                        <textarea class="form-control" rows="3" name="observacoes"><?php echo isset($anoLetivo->OBSERVACOES) ? $anoLetivo->OBSERVACOES : '';?></textarea>
                                    </div>
                                </div>
                            </div>

                            <br>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-right">
                            <button type="submit" class="btn btn-warning btn-outline mr-1">
                                <i class="fa fa-times"></i> Cancelar
                            </button>
                            <button id="gravar" type="button" class="btn btn-primary btn-outline">
                                <i class="fa fa-save"></i> Salvar
                            </button>
                        </div>  
                    </form>
                    </div>
                    <!-- /.box -->			
            </div>  
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="/assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>
  <script src="/template/js/escola.js"></script>
  