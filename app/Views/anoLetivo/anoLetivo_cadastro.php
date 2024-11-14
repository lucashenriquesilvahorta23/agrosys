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
      Ano letivo
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Ano letivo</a></li>
        <li class="breadcrumb-item active"><?php echo isset($anoLetivo->ID_ANO_LETIVO) ? 'Edição' : 'Cadastro';?> de ano letivo</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
        <div class="row">	
            <div class="col-lg-12 col-12">
                    <div class="box box-solid bg-login">
                    <div class="box-header with-border">
                        <h4 class="box-title"><?php echo isset($anoLetivo->ID_ANO_LETIVO) ? 'Edição' : 'Cadastro';?> de ano letivo</h4>			
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>	
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <!-- /.box-header -->
                    <form novalidate method="POST" action="/AnoLetivo/Store" id="frm" class="validate" enctype='multipart/form-data'>
                        <div class="box-body">
                            <!-- Linha 1 -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Código</label>
                                        <input disabled="disabled" type="text" class="form-control" value="<?php echo isset($anoLetivo->ID_ANO_LETIVO) ? $anoLetivo->ID_ANO_LETIVO : '';?>" >
                                        <input type="hidden" class="form-control" value="<?php echo isset($anoLetivo->ID_ANO_LETIVO) ? $anoLetivo->ID_ANO_LETIVO : '';?>" name="anoLetivo_id">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Ano letivo *</label>
                                        <select id="ano_letivo" name="ano_letivo" class="form-control">
                                            <?php
                                                $currentYear = date("Y");
                                                $startYear = $currentYear - 5;
                                                $endYear = $currentYear + 20;

                                                for ($year = $startYear; $year <= $endYear; $year++) {
                                                    $selected = (isset($anoLetivo->ANO_LETIVO) && $anoLetivo->ANO_LETIVO == $year) ? 'selected' : '';
                                                    echo "<option value='$year' $selected>$year</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data inicial *</label>
                                        <input type="date" class="form-control" value="<?php echo isset($anoLetivo->DATA_INICIAL) ? $anoLetivo->DATA_INICIAL : '';?>" name="data_inicial" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data de termino(Previsão) *</label>
                                        <input type="date" class="form-control" value="<?php echo isset($anoLetivo->DATA_FINAL) ? $anoLetivo->DATA_FINAL : '';?>" name="data_final" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data inicial matricula *</label>
                                        <input type="date" class="form-control" value="<?php echo isset($anoLetivo->DATA_INICIAL_MATRICULA) ? $anoLetivo->DATA_INICIAL_MATRICULA : '';?>" name="data_inicial_matricula" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data de termino matricula *</label>
                                        <input type="date" class="form-control" value="<?php echo isset($anoLetivo->DATA_FINAL_MATRICULA) ? $anoLetivo->DATA_FINAL_MATRICULA : '';?>" name="data_final_matricula" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button id="add_data" type="button">Adicionar data específica</button>
                                </div>
                            </div>

                            <br>

                            <div class="datas">

                                <?php 
                                    $x=1;
                                    if(isset($datas_especificas)){
                                        foreach($datas_especificas as $datas){
                                            echo '<div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Descrição da data *</label>
                                                            <input type="text" class="form-control" value="'.$datas->DESCRICAO_DATA.'" name="descricao_data[]" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Data inicial *</label>
                                                            <input type="date" class="form-control" value="'.$datas->DATA.'" name="data_especifica[]" required>
                                                        </div>
                                                    </div>      
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Categoria calendário*</label>
                                                            <select class="form-control" name="cor[]" required>
                                                                <option value="#fff2cc" '.($datas->COR_CALENDARIO == "#fff2cc" ? "selected" : "").'>Período de Rematrículas e Matrículas</option>
                                                                <option value="#ffd966" '.($datas->COR_CALENDARIO == "#ffd966" ? "selected" : "").'>Início do Bimestre</option>
                                                                <option value="#bf8f00" '.($datas->COR_CALENDARIO == "#bf8f00" ? "selected" : "").'>Término de Bimestre</option>
                                                                <option value="#a8d08d" '.($datas->COR_CALENDARIO == "#a8d08d" ? "selected" : "").'>Férias Escolares</option>
                                                                <option value="#00b050" '.($datas->COR_CALENDARIO == "#00b050" ? "selected" : "").'>Data comemorativa</option>
                                                                <option value="#ed7d31" '.($datas->COR_CALENDARIO == "#ed7d31" ? "selected" : "").'>Ponto Facultativo</option>
                                                                <option value="#ff0000" '.($datas->COR_CALENDARIO == "#ff0000" ? "selected" : "").'>Feriado</option>
                                                                <option value="#ffff00" '.($datas->COR_CALENDARIO == "#ffff00" ? "selected" : "").'>Planejamento</option>
                                                                <option value="#5b9bd5" '.($datas->COR_CALENDARIO == "#5b9bd5" ? "selected" : "").'>Sábado Letivo</option>
                                                                <option value="#acb4f0" '.($datas->COR_CALENDARIO == "#acb4f0" ? "selected" : "").'>Reajustes de Diários e Relatórios</option>
                                                            </select>
                                                        </div>
                                                    </div>   
                                                    <div class="col-1">
                                                        <button style="margin-top: 30px" type="button" class="btn btn-danger btn-sm remove_data float-left mb-2">&times;</button>
                                                    </div>
                                                    <hr>
                                                </div>';
                                            $x++;
                                        }
                                        
                                        
                                        
                                    }
                                    echo '<input type="hidden" value="'.$x.'" id="cont_datas">';

                                ?>
                            

                            </div>
                            
                            

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
  <script>
function selectCor(cor, index) {
    document.getElementById('cor-input-' + index).value = cor;
    // Aqui você pode adicionar lógica para atualizar a seleção visualmente se necessário
}
</script>
  <script>

        $( document ).ready(function() {
        // Handler for .ready() called.
            var cont_datas = $('#cont_datas').val();
            $('#add_data').on('click', function(){
                var dependentBlock = `
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Descrição da data *</label>
                                <input type="text" class="form-control" name="descricao_data[]" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Data inicial *</label>
                                <input type="date" class="form-control" name="data_especifica[]" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Categoria calendário*</label>
                                <select class="form-control color-select" name="cor[]" required>
                                    <option value="#fff2cc" data-color="#fff2cc">Período de Rematrículas e Matrículas</option>
                                    <option value="#ffd966" data-color="#ffd966">Início do Bimestre</option>
                                    <option value="#bf8f00" data-color="#bf8f00">Término de Bimestre</option>
                                    <option value="#a8d08d" data-color="#a8d08d">Férias Escolares</option>
                                    <option value="#00b050" data-color="#00b050">Data comemorativa</option>
                                    <option value="#ed7d31" data-color="#ed7d31">Ponto Facultativo</option>
                                    <option value="#ff0000" data-color="#ff0000">Feriado</option>
                                    <option value="#ffff00" data-color="#ffff00">Planejamento</option>
                                    <option value="#5b9bd5" data-color="#5b9bd5">Sábado Letivo</option>
                                    <option value="#acb4f0" data-color="#acb4f0">Reajustes de Diários e Relatórios</option>
                                </select>
                            </div>
                        </div>   
                        <div class="col-1">
                            <button style="margin-top: 30px" type="button" class="btn btn-danger btn-sm remove_data float-left mb-2">&times;</button>
                        </div>
                        <hr>
                    </div>`;


                $('.datas').append(dependentBlock);
                cont_datas++;
                console.log(cont_datas);
            });


            $(document).on('click', '.remove_data', function() {
                $(this).closest('.row').remove();
                cont_datas--;
            });
        });
</script>