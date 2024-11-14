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
    <?php helper('mensagem');?>
     
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
                            <input type="hidden" name="usuario_id" value="<?php echo isset($usuario->ID_USUARIO) ? $usuario->ID_USUARIO : '';?>" id="usuario_id">
                            <input type="hidden" name="alterar_senha" value="S">
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
