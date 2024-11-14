 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Escolas
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Escolas</a></li>
        <li class="breadcrumb-item active"><?php echo isset($escolas->ID_ESCOLA) ? 'Edição' : 'Cadastro';?> de escola</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
        <div class="row">	
            <div class="col-lg-12 col-12">
                    <div class="box box-solid bg-login">
                    <div class="box-header with-border">
                        <h4 class="box-title"><?php echo isset($escolas->ID_ESCOLA) ? 'Edição' : 'Cadastro';?> de escola</h4>			
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>	
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <!-- /.box-header -->
                    <form class="form" method="POST" action="/Escola/Store" id="frm" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Escola</label> <span class="text-danger">*</span>
                                        <input type="hidden" class="form-control" value="<?php echo isset($escola->ID_ESCOLA) ? $escola->ID_ESCOLA : '';?>" name="escola_id">
                                        <input type="text" class="form-control" placeholder="Nome da escola" name="nome" required id="nome" value="<?php echo isset($escola->ESCOLA) ? $escola->ESCOLA : '';?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>CNPJ Mantenedora</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control cnpj" placeholder="xx.xxx.xxx/xxxx-xx" name="cnpj" required id="cnpj" value="<?php echo isset($escola->CNPJ) ? $escola->CNPJ : '';?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mantedora</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="Nome da mantedora" name="mantedora" required id="mantedora" value="<?php echo isset($escola->MANTEDORA) ? $escola->MANTEDORA : '';?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Funcionamento</label> <span class="text-danger">*</span>
                                        <select name="funcionamento" required id="funcionamento" class="form-control">
                                            <option <?php if(isset($escola->FUNCIONAMENTO) && $escola->FUNCIONAMENTO == 'MA'){echo 'selected';}?> value="MA">Matutino</option>
                                            <option <?php if(isset($escola->FUNCIONAMENTO) && $escola->FUNCIONAMENTO == 'TA'){echo 'selected';}?> value="TA">Vespertino</option>
                                            <option <?php if(isset($escola->FUNCIONAMENTO) && $escola->FUNCIONAMENTO == 'MT'){echo 'selected';}?> value="MT">Matutino e Vespertino</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>INEP</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="Nº INEP" name="inep" required id="inep" value="<?php echo isset($escola->INEP) ? $escola->INEP : '';?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>CME - Resolução</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="CME - Resolução" name="cme" required id="cme" value="<?php echo isset($escola->CME) ? $escola->CME : '';?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Telefone</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control tel" placeholder="(xx) xxxx-xxxx" name="tel" required id="tel" value="<?php echo isset($escola->TELEFONE) ? $escola->TELEFONE : '';?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>E-mail</label> <span class="text-danger">*</span>
                                        <input type="email" class="form-control" placeholder="contato@sigeo.com.br" name="email" required id="email" value="<?php echo isset($escola->EMAIL) ? $escola->EMAIL : '';?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>CEP</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control cep" placeholder="0000-000" name="cep" required id="cep" value="<?php echo isset($escola->CEP) ? $escola->CEP : '';?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cidade</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="Nome da cidade" name="cidade" required id="cidade" value="<?php echo isset($escola->MUNICIPIO) ? $escola->MUNICIPIO : '';?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Logradouro</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="Rua X, S/N" name="endereco" required id="endereco" value="<?php echo isset($escola->LOGRADOURO) ? $escola->LOGRADOURO : '';?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Bairro</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="Nome do bairro" name="bairro" required id="bairro" value="<?php echo isset($escola->BAIRRO) ? $escola->BAIRRO : '';?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Coordenador</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="" name="coordenador" required id="coordenador" value="<?php echo isset($escola->COORDENADOR) ? $escola->COORDENADOR : '';?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Telefone coordenador</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control tel" placeholder="(xx) xxxx-xxxx" name="tel_c" required id="tel_c" value="<?php echo isset($escola->CELULAR_COORDENADOR) ? $escola->CELULAR_COORDENADOR : '';?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>CPF Coordenador *</label>
                                        <input type="text" class="form-control cpf"  value="<?php echo isset($escola->CPF_COORDENADOR) ? $escola->CPF_COORDENADOR : '';?>" name="coordenador_cpf" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gestor</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="" name="gestor" required id="gestor" value="<?php echo isset($escola->GESTOR) ? $escola->GESTOR : '';?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Telefone gestor</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control tel" placeholder="(xx) xxxx-xxxx" name="tel_g" required id="tel_g" value="<?php echo isset($escola->CELULAR_GESTOR) ? $escola->CELULAR_GESTOR : '';?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>CPF Gestor *</label>
                                        <input type="text" class="form-control cpf"  value="<?php echo isset($escola->CPF_GESTOR) ? $escola->CPF_GESTOR : '';?>" name="escola_cpf" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Horário entrada (Matutino) *</label>
                                        <input type="text" class="form-control horario" value="<?php echo isset($escola->ENTRADA) ? $escola->ENTRADA : '';?>" name="horario_entrada">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Horário saída (Matutino) *</label>
                                        <input type="text" class="form-control horario" value="<?php echo isset($escola->SAIDA) ? $escola->SAIDA : '';?>" name="horario_saida">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Horário entrada (Vespertino) *</label>
                                        <input type="text" class="form-control horario" value="<?php echo isset($escola->ENTRADA_TARDE) ? $escola->ENTRADA_TARDE : '';?>" name="horario_entrada_tarde">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Horário saída (Vespertino) *</label>
                                        <input type="text" class="form-control horario" value="<?php echo isset($escola->SAIDA_TARDE) ? $escola->SAIDA_TARDE : '';?>" name="horario_saida_tarde">
                                    </div>
                                </div>
                                <div class="col-md-4">                      
                                    <div class="form-group">
                                        <label>Foto escola</label>
                                        <div class="controls">
                                            <input type="file" name="foto_escola" id="foto_escola" class="form-control">
                                        </div>
                                        <p >Foto do escola<br> <?php if(isset($escola->NOME_ALEATORIO)){echo '<a style="color: #000;" target="_blank" href="'.LINK_UPLOAD.$escola->NOME_ALEATORIO.'">Clique para ver a imagem</a>';}?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-right">
                            <button type="button" class="btn btn-warning btn-outline mr-1">
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