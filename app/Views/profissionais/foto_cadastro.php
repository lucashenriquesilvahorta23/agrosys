 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Anexos
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Anexo</a></li>
        <li class="breadcrumb-item active"><?php echo isset($foto->ID_DOCUMENTO_ALUNO) ? 'Edição' : 'Cadastro';?> de anexos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
        <div class="row">	
            <div class="col-lg-12 col-12">
                    <div class="box box-solid bg-login">
                    <div class="box-header with-border">
                        <h4 class="box-title"><?php echo isset($foto->ID_DOCUMENTO_ALUNO) ? 'Edição' : 'Cadastro';?> de anexos</h4>			
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>	
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <!-- /.box-header -->
                    <form novalidate method="POST" action="/Profissional/FotoStore" id="frm" class="validate" enctype='multipart/form-data'>
                        <div class="box-body">
                            <!-- Linha 1 -->
                            <div class="row">
                                <?= csrf_field() ?>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>Descrição</label>
                                        <input type="text" name="descricao" class="form-control" value="<?php echo isset($foto->DESCRICAO) ? $foto->DESCRICAO : '';?>" >
                                    </div>
                                </div>
                                <div class="col-md-5">                      
                                    <div class="form-group">
                                        <h5>Documento</h5>
                                        <div class="controls">
                                            <input type="hidden" name="id_foto" value="<?php echo isset($foto->ID_DOCUMENTO_ALUNO) ? $foto->ID_DOCUMENTO_ALUNO : '';?>" id="id_foto">
                                            <input type="hidden" name="id_profissional" value="<?= $id_profissional;?>" id="id_profissional">
                                            <input type="file" name="aluno_imagem" id="aluno_imagem" class="form-control">
                                        </div>
                                        <p class="help-block">Informe o documento. <?php if(isset($foto->NOME_ALEATORIO)){echo '<a style="color: #000000" target="_blank" href="'.LINK_UPLOAD.$foto->NOME_ALEATORIO.'">Clique para ver a imagem</a>';}?></p>
                                    </div>
                                </div>
                            </div>
                            

                            <!-- Linha de doenças crônicas -->


                            <!-- Linha de doenças crônicas -->


                            
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

  <script src="/template/js/escola.js"></script>