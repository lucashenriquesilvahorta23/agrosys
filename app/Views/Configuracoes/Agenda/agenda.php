<div class="page-content-wrapper">
    <div class="page-content">
    <?php helper('mensagem');?>
        <!-- BEGIN PAGE HEAD -->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h3>Calendário</h3>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- BEGIN PAGE CONTENT-->
		<div class="portlet box blue-hoki calendar">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i>Calendário
				</div>
			</div>
			<div class="portlet-body">
				<div class="row">
                <?= csrf_field() ?>
					<div class="col-md-3 col-sm-12">
					</div>
					<div class="col-md-12 col-sm-12">
						<div id="calendar" class="has-toolbar">
						</div>
					</div>
				</div>
				<!-- END CALENDAR PORTLET-->
			</div>
		</div>
    </div>
</div>

<script src="/template/assets/global/scripts/agenda.js"></script>



<!-- INICIO MODAL DE LEMBRETE -->
<div id="modal-lembrete" class="modal fade bs-modal-lg in" tabindex="-1" aria-hidden="true">
	<form method="post" id="formulario_lembrete">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header modal-header-sucess">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechamodaldayclick"></button>
					<h4 class="modal-title">
						Lembrete							
					</h4>
				</div>
				<!-- BEGIN MENSAGENS-->
				<div class="caixa_mensagens_modal"></div>	
				<!-- END MENSAGENS-->
				<div class="modal-body">
					<div class="scroller" style="height:400px;width:600px;" data-always-visible="1" data-rail-visible="1">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Título</label>
									<input type="hidden" name="id_agenda" id="id_agenda">
									<input type="text" name="titulo" id="titulo" class="form-control" placeholder="Informe o Título do lembrete">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label class="control-label">Descrição</label>
									<textarea rows="3" name="descricao" id="descricao" class="form-control" placeholder="Digite a descrição do lembrete"></textarea>
								</div>
							</div>
						</div>	
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Data e hora para inicio</label>
									<input type="text" name="data_inicio" id="data_inicio" class="form-control datahora">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Data e hora para finalizar</label>
									<input type="text" name="data_final" id="data_final" class="form-control datahora">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Cor do Cartão</label>
									<input type="color" id="cor" name="cor" list="cores" value="#d9534f">
										<datalist id="cores">
											<option value="#d9534f">Vermelho</option>
											<option value="#ffbb33">Laranja</option>
											<option value="#ffeb3b">Amarelo</option>
											<option value="#5cb85c">Verde</option>
											<option value="#5bc0de">Azul</option>
											<option value="#428bca">Indigo</option>
											<option value="#9933CC">Violeta</option>
										</datalist>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn blue" id="grava_lembrete">
						<i class="fa fa-floppy-o"></i>
						&nbsp;Salvar
					</button>
					<button type="button" class="btn red" id="Excluir_Lembrete">
						<i class="fa fa-trash-o"></i>
						&nbsp;Excluir
					</button>
				</div>	
			</div>
		</div>		
	</form>	
</div>	
<!-- FIM MODAL DE LEMBRETE -->