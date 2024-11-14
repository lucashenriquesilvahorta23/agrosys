<style>
#map {
    height: 300px;
    width: 100%;
    overflow: hidden;
    float: left;
    }
</style>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEAD -->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h3>Usuários</h3>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <?php helper('mensagem');?>
        <!-- Basic Forms -->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <?php echo isset($usuario->ID_USUARIO) ? 'Edição' : 'Cadastro';?> de usuário
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
            	        <form novalidate method="POST" action="/Configuracoes/Usuario/usuarioStore" id="frmUsuario_cadastro" class="validate" enctype="multipart/form-data">
                        <?= csrf_field()?>
				            <div class="row">
					            <div class="col-md-6">						
						            <div class="form-group">
                                        <h5>Nome completo<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="hidden" name="usuario_id" value="<?php echo isset($usuario->ID_USUARIO) ? $usuario->ID_USUARIO : '';?>" id="usuario_id">
                                            <input type="text" name="usuario_nome" id="usuario_nome" class="form-control" required data-validation-required-message="Campo obrigatório" minlength="6" data-validation-minlength-message="Informe um nome válido (min 6 caracteres)" value="<?php echo isset($usuario->NOME) ? $usuario->NOME : '';?>"> 
                                        </div>
							            <p class="help-block">Informe o nome completo do usuário</p>
						            </div>
                                </div>    
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5>Login<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="usuario_login" id="usuario_login" class="form-control" required data-validation-required-message="Campo obrigatório" minlength="2" data-validation-minlength-message="Informe um login válido (min 2 caracteres)" value="<?php echo isset($usuario->USUARIO) ? $usuario->USUARIO : '';?>" style="text-transform: uppercase;" autocomplete="off"> 
                                        </div>
							            <p class="help-block">Informe o login</p>
						            </div>
                                </div>
                            </div>
                            <div class="row">
					            <div class="col-md-4">						
						            <div class="form-group">
                                        <h5>Email<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="email" name="usuario_email" id="usuario_email" class="form-control" required data-validation-required-message="Campo obrigatório" data-validation-regex-regex="([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})" data-validation-regex-message="Informe um email válido" value="<?php echo isset($usuario->EMAIL) ? $usuario->EMAIL : '';?>"> 
                                        </div>
							            <p class="help-block">Informe o email do usuário</p>
						            </div>
                                </div>
                                <div class="col-md-3">						
						            <div class="form-group">
                                        <h5>Telefone<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="usuario_telefone" id="usuario_telefone" class="form-control telefone" required minlength="11" value="<?php echo isset($usuario->TELEFONE) ? $usuario->TELEFONE : '';?>"> 
                                        </div>
							            <p class="help-block">Informe o telefone do usuário</p>
						            </div>
                                </div>
                                <div class="col-md-3">						
						            <div class="form-group">
                                        <h5>Foto</h5>
                                        <div class="controls">
                                            <input type="file" name="usuario_foto" id="usuario_foto" class="form-control"> 
                                        </div>
							            <p class="help-block">.jpg ou .png | Max: 2mb</p>
						            </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">						
                                    <div class="form-group">
                                        <h5>Nova Senha<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="usuario_senha" id="usuario_senha" class="form-control" required minlength="6" autocomplete="off"> 
                                        </div>
                                        <p class="help-block">Informe a senha para login</p>
                                    </div>
                                </div>
                                <div class="col-md-6">						
                                    <div class="form-group">
                                        <h5>Confirme a senha<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="usuario_confirmacao_senha" id="usuarioo_confirmacao_senha" equalTo="#usuario_senha" class="form-control" required autocomplete="off">
                                        </div>
                                        <p class="help-block">Confirme a senha</p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xs-right bt-1 pt-10">
                                <div class="pull-right">
                                <input type="hidden" name="perfil" value="true">
						            <button type="button" id="gravar_usuario" class="btn blue btn-sm"><span class="fa fa-save"> Salvar</span></button>
                                </div>
					        </div> 
                        </form>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/template/assets/global/scripts/usuario.js"></script>
