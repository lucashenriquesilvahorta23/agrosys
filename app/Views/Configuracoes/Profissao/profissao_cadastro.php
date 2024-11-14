 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profissao
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Profissao</a></li>
        <li class="breadcrumb-item active"><?php echo isset($profissao->ID_PROFISSAO) ? 'Edição' : 'Cadastro';?> de profissao</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
        <div class="row">	
            <div class="col-lg-12 col-12">
                <div class="box box-solid bg-success">
                    <div class="box-header with-border">
                        <h4 class="box-title"><?php echo isset($profissao->ID_PROFISSAO) ? 'Edição' : 'Cadastro';?> de profissao</h4>			
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>	
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <!-- /.box-header -->
                    <form class="form" action="/Configuracoes/Profissao/Store" method="POST" id="frmUsuario">
                    <?= csrf_field() ?>
                        <div class="box-body">
                            <div class="row">
					            <div class="col-md-5">						
						            <div class="form-group">
                                        <label>Nome</label> <span class="text-danger">*</span>
                                        <div class="controls">
                                            <input type="hidden" name="profissao_id" value="<?php echo isset($profissao->ID_PROFISSAO) ? $profissao->ID_PROFISSAO : '';?>" id="profissao_id">
                                            <input type="text" name="profissao_nome" id="profissao_nome" class="form-control" required data-validation-required-message="Campo obrigatório" minlength="3" data-validation-minlength-message="Informe um nome válido (min 3 caracteres)" value="<?php echo isset($profissao->NOME) ? $profissao->NOME : '';?>"> 
                                        </div>
						            </div>
                                </div>    
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
