<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEAD -->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h3>Log</h3>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <?php helper('mensagem');?>
        <div class="portlet-body">
			<div class="panel-group accordion" id="accordion3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1" aria-expanded="false"><i class="fa fa-search"></i>
                            Pesquisa avançada</a>
						</h4>
					</div>
					<div id="collapse_3_1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
						<div class="panel-body">
							<form action="<?php echo $_SERVER['REQUEST_URI']?>" method="POST" id="frm_pesquisa">
                            <?= csrf_field() ?>
								<div class="row">										
                                    <div class="col-md-5">						
                                        <div class="form-group">
                                            <h5>Parceiros</h5>
                                            <div class="controls">
                                                <select name="filtro_parceiro" id="filtro_parceiro" required class="form-control">
                                                <option value="">Selecione um parceiro</option>
                                                <?php 
                                                    foreach ($usuarios->getResult() as $usuario) {
                                                        $checkedend='';
                                                        if(isset($_POST["filtro_parceiro"])&&$_POST["filtro_parceiro"]==$usuario->ID_USUARIO){$checkedend='selected';}

                                                        echo "<option ".$checkedend." value=".$usuario->ID_USUARIO.">".$usuario->USUARIO."</option>";
                                                    }
                                                ?>
                                                </select> 
                                            </div>
                                            <p class="help-block">Informe o parceiro</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Data inicial</h5>
                                            <div class="controls">
                                                <input type="text" class="form-control datafmtbr" id="log_dt_inicial" name="log_dt_inicial" value="<?php if(isset($_POST["log_dt_inicial"]))echo $_POST["log_dt_inicial"]; ?>"> 
                                            </div>
                                            <p class="help-block">Data agendada</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Data final</h5>
                                            <div class="controls">
                                                <input type="text" class="form-control datafmtbr" id="log_dt_final" name="log_dt_final" value="<?php if(isset($_POST["log_dt_final"]))echo $_POST["log_dt_final"]; ?>"> 
                                            </div>
                                            <p class="help-block">Data agendada</p>
                                        </div>
                                    </div>
                                </div>
								<div class="btn-set pull-right">
                                    <button id="limpafrmpesquisa" type="button" class="btn btn-secondary"><i class="fa fa-eraser"></i>&nbsp;&nbsp;&nbsp;&nbsp;Limpar&nbsp;&nbsp;&nbsp;</button>             
                                    <button type="button" id="enviafrmpesquisa" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;Pesquisar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="row">		
            <div class="col-md-12">         
                <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption">Lista de log's</div>
                    </div>
                    <div class="portlet-body">
                        <div class="table">
                            <table id="log" class="table nowrap table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="display: none;">ID</th>
                                        <th>Nome</th>
                                        <th>Acesso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
										foreach ($resultados->getResult() as $resultado) {
                                            echo '<tr>';
                                                echo '	<td style="display:none">'.$resultado->ID_LOG.'</td>';
                                                echo '	</td>';
                                                echo '	<td>'.mb_strtoupper($resultado->NOME,'UTF-8').'</td>';
                                                echo '	<td>'.inverterDataHora($resultado->DATA,'UTF-8').'</td>';
                                            echo '</tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>   <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>     <!-- /.box -->
<script src="/template/assets/global/scripts/log.min.js"></script>