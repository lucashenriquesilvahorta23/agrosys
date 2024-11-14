 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuario
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Usuario</a></li>
        <li class="breadcrumb-item active"><?php echo isset($usuario->ID_FORNECEDOR) ? 'Edição' : 'Cadastro';?> de usuario</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
        <div class="row">	
            <div class="col-lg-12 col-12">
                <div class="box box-solid bg-success">
                    <div class="box-header with-border">
                        <h4 class="box-title"><?php echo isset($usuario->ID_FORNECEDOR) ? 'Edição' : 'Cadastro';?> de usuario</h4>			
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>	
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <!-- /.box-header -->
                    <form class="form" action="/Configuracoes/Usuario/Store" method="POST" id="frmUsuario">
                    <?= csrf_field() ?>
                        <div class="box-body">
                            <div class="row">
					            <div class="col-md-5">						
						            <div class="form-group">
                                        <label>Nome</label> <span class="text-danger">*</span>
                                        <div class="controls">
                                            <input type="hidden" name="usuario_id" value="<?php echo isset($usuario->ID_USUARIO) ? $usuario->ID_USUARIO : '';?>" id="usuario_id">
                                            <input type="text" name="usuario_nome" id="usuario_nome" class="form-control" required data-validation-required-message="Campo obrigatório" minlength="6" data-validation-minlength-message="Informe um nome válido (min 6 caracteres)" value="<?php echo isset($usuario->NOME) ? $usuario->NOME : '';?>"> 
                                        </div>
						            </div>
                                </div>    
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Login<span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="usuario_login" id="usuario_login" class="form-control" required data-validation-required-message="Campo obrigatório" minlength="2" data-validation-minlength-message="Informe um login válido (min 2 caracteres)" value="<?php echo isset($usuario->USUARIO) ? $usuario->USUARIO : '';?>" style="text-transform: uppercase;" autocomplete="off"> 
                                        </div>
						            </div>
                                </div>
                                <div class="col-md-2">						
						            <div class="form-group">
                                        <label>Status<span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <select name="usuario_status" id="usuario_status" required class="form-control">
                                                <option value="A" <?php if(isset($usuario->ATIVO) && $usuario->ATIVO == 'A'){echo 'selected';}?>>Ativo</option>
                                                <option value="I" <?php if(isset($usuario->ATIVO) && $usuario->ATIVO == 'I'){echo 'selected';}?>>Inativo</option>
                                            </select> 
                                        </div>
						            </div>
                                </div>
                                <div class="col-md-2">						
						            <div class="form-group">
                                        <label>Tipo<span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <select name="usuario_tipo" id="usuario_tipo" required class="form-control">
                                                <option value="AD" <?php if(isset($usuario->TIPO) && $usuario->TIPO == 'AD'){echo 'selected';}?>>Administrador</option>
                                                <option value="PR" <?php if(isset($usuario->TIPO) && $usuario->TIPO == 'PR'){echo 'selected';}?>>Comum</option>
                                                <option value="GT" <?php if(isset($usuario->TIPO) && $usuario->TIPO == 'GT'){echo 'selected';}?>>Gestão</option>
                                                <option value="AM" <?php if(isset($usuario->TIPO) && $usuario->TIPO == 'AM'){echo 'selected';}?>>Administrativo</option>
                                                <option value="PF" <?php if(isset($usuario->TIPO) && $usuario->TIPO == 'PF'){echo 'selected';}?>>Professor</option>
                                            </select> 
                                        </div>
						            </div>
                                </div>
                            </div>
                            <div class="row">
					            <div class="col-md-4">						
						            <div class="form-group">
                                        <label>Email<span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="email" name="usuario_email" id="usuario_email" class="form-control" required data-validation-required-message="Campo obrigatório" data-validation-regex-regex="([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})" data-validation-regex-message="Informe um email válido" value="<?php echo isset($usuario->EMAIL) ? $usuario->EMAIL : '';?>"> 
                                        </div>
						            </div>
                                </div>
                                <div class="col-md-3">						
						            <div class="form-group">
                                        <label>Telefone<span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="usuario_telefone" id="usuario_telefone" class="form-control telefone" required minlength="11" value="<?php echo isset($usuario->TELEFONE) ? $usuario->TELEFONE : '';?>"> 
                                        </div>
						            </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Profisisonal </label>
                                        <select id="profissional_cargo" name="profissional_cargo" class="form-control">
                                            <option value="">Escolha um profisisonal</option>
                                            <?php

                                                foreach($professores as $professor) {
                                                    $selected = (isset($usuario->FK_ID_PROFISSIONAL) && $usuario->FK_ID_PROFISSIONAL == $professor->ID_PROFISSIONAL) ? 'selected' : '';
                                                    echo "<option value='$professor->ID_PROFISSIONAL' $selected>$professor->NOME_PROFISSIONAL</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <?php
                                if (1) { // Se não for edição, possibilita a inclusão do campo senha
                                    echo '
                                    <div class="row">
                                        <div class="col-md-6">						
                                            <div class="form-group">
                                                <h5>Senha<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="password" name="usuario_senha" id="usuario_senha" class="form-control" minlength="6" autocomplete="off"> 
                                                </div>
                                                <p class="help-block">Informe a senha para login</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">						
                                            <div class="form-group">
                                                <h5>Confirme a senha<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="password" name="usuario_confirmacao_senha" id="usuarioo_confirmacao_senha" equalTo="#usuario_senha" class="form-control" autocomplete="off">
                                                </div>
                                                <p class="help-block">Confirme a senha</p>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            ?>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-right">
                            <button type="button" id="gravar" class="btn btn-primary btn-outline">
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

  <script src="/template/js/usuario.js"></script>
