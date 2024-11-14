 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Profissional
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Profissional</a></li>
        <li class="breadcrumb-item active"><?php echo isset($profissional->ID_PROFISSIONAL) ? 'Edição' : 'Cadastro';?> de profissional</li>
      </ol>
    </section>
    <style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
        text-align: center;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>


    <!-- Main content -->
    <section class="content">
     
        <div class="row">	
            <div class="col-lg-12 col-12">
                    <div class="box box-solid bg-login">
                    <div class="box-header with-border">
                        <h4 class="box-title"><?php echo isset($profissional->ID_PROFISSIONAL) ? 'Edição' : 'Cadastro';?> de profissional</h4>			
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>	
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <!-- /.box-header -->
                    <form novalidate method="POST" action="/Profissional/Store" name="profissional" id="frm" class="validate" enctype='multipart/form-data'>
                        <div class="box-body">
                            <!-- Linha 1 -->

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Código</label>
                                        <input type="hidden" id="username" name="username" value="<?php echo isset($username) ? $username : '';?>" class="form-control" >
                                        <input disabled="disabled" type="text" class="form-control" value="<?php echo isset($profissional->ID_PROFISSIONAL) ? $profissional->ID_PROFISSIONAL : '';?>" >
                                        <input type="hidden" class="form-control" value="<?php echo isset($profissional->ID_PROFISSIONAL) ? $profissional->ID_PROFISSIONAL : '';?>" name="profissional_id">
                                        <input type="hidden" class="form-control" value="<?php echo isset($profissional->FK_ID_ESCOLA) ? $profissional->FK_ID_ESCOLA : '';?>" name="profisisonal_escola_id" id="profisisonal_escola_id">
                                    </div>
                                </div>
                                <div class="col-md-5">                      
                                    <div class="form-group">
                                        <label>Foto profissional</label>
                                        <div class="controls">
                                            <input type="file" name="profissional_imagem" id="profissional_imagem" class="form-control">
                                        </div>
                                        <p >Foto do profissional<br> <?php if(isset($profissional->NOME_ALEATORIO)){echo '<a style="color: #000;" target="_blank" href="'.LINK_UPLOAD.$profissional->NOME_ALEATORIO.'">Clique para ver a imagem</a>';}?></p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Foto Aluno</label>
                                        <div class="controls">
                                            <button type="button" class="btn btn-primary" onclick="abrirModal()">Capturar Foto</button>
                                            <input type="hidden" name="aluno_imagem_base64" id="aluno_imagem_base64">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 text-center">
                                    <div class="form-group">
                                        <label>Foto Profissional</label>
                                        <div class="controls">
                                            <?php
                                                if(isset($profissional->NOME_ALEATORIO) && ($profissional->NOME_ALEATORIO != null || $profissional->NOME_ALEATORIO != "")){
                                                    echo '	<img id="fotoPreview" src="'.LINK_UPLOAD.$profissional->NOME_ALEATORIO.'"  width=100 class="img-bordered">';
                                                }else{
                                                    echo '	<img id="fotoPreview" src="'.LINK_UPLOAD.'padrao.png'.'" width=100 class="img-bordered">';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Nome do profissional *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($profissional->NOME_PROFISSIONAL) ? $profissional->NOME_PROFISSIONAL : '';?>" name="profissional_nome" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data de nascimento *</label>
                                        <input type="date" class="form-control" value="<?php echo isset($profissional->DATA_NASCIMENTO) ? $profissional->DATA_NASCIMENTO : '';?>" name="profissional_data_nascimento" id="profissional_data_nascimento" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Idade *</label>
                                        <input type="number" class="form-control" value="<?php echo isset($profissional->IDADE) ? $profissional->IDADE : '';?>" name="profissional_idade" id="profissional_idade" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Sexo *</label>
                                        <select class="form-control" name="profissional_sexo" required>
                                            <option <?php if(isset($profissional->SEXO) && $profissional->SEXO == 'M'){echo 'selected';}?> value="M">Masculino</option>
                                            <option <?php if(isset($profissional->SEXO) && $profissional->SEXO == 'F'){echo 'selected';}?> value="F">Feminino</option>
                                            <option <?php if(isset($profissional->SEXO) && $profissional->SEXO == 'O'){echo 'selected';}?> value="O">Outro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Linha 5 - Filiação 1 -->
                            <h5>Filiação</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Filiação 1 *</label>
                                        <input type="text" class="form-control"  value="<?php echo isset($profissional->FILIACAO_1) ? $profissional->FILIACAO_1 : '';?>" name="profissional_filiacao_1" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Filiação 2</label>
                                        <input type="text" class="form-control" value="<?php echo isset($profissional->FILIACAO_2) ? $profissional->FILIACAO_2 : '';?>" name="profissional_filiacao_2">
                                    </div>
                                </div>
                            </div>


                            <!-- Linha 2 -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>UF de nascimento *</label>
                                        <select class="form-control" id="profissional_estado_naturalidade" name="profissional_estado_naturalidade" required>
                                            <option value="AC" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'AC'){echo 'selected';}?> >Acre (AC)</option>
                                            <option value="AL" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'AL'){echo 'selected';}?> >Alagoas (AL)</option>
                                            <option value="AP" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'AP'){echo 'selected';}?> >Amapá (AP)</option>
                                            <option value="AM" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'AM'){echo 'selected';}?> >Amazonas (AM)</option>
                                            <option value="BA" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'BA'){echo 'selected';}?> >Bahia (BA)</option>
                                            <option value="CE" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'CE'){echo 'selected';}?> >Ceará (CE)</option>
                                            <option value="DF" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'DF'){echo 'selected';}?> >Distrito Federal (DF)</option>
                                            <option value="ES" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'ES'){echo 'selected';}?> >Espírito Santo (ES)</option>
                                            <option value="GO" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'GO'){echo 'selected';}?> >Goiás (GO)</option>
                                            <option value="MA" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'MA'){echo 'selected';}?> >Maranhão (MA)</option>
                                            <option value="MT" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'MT'){echo 'selected';}?> >Mato Grosso (MT)</option>
                                            <option value="MS" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'MS'){echo 'selected';}?> >Mato Grosso do Sul (MS)</option>
                                            <option value="MG" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'MG'){echo 'selected';}?> >Minas Gerais (MG)</option>
                                            <option value="PA" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'PA'){echo 'selected';}?> >Pará (PA)</option>
                                            <option value="PB" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'PB'){echo 'selected';}?> >Paraíba (PB)</option>
                                            <option value="PR" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'PR'){echo 'selected';}?> >Paraná (PR)</option>
                                            <option value="PE" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'PE'){echo 'selected';}?> >Pernambuco (PE)</option>
                                            <option value="PI" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'PI'){echo 'selected';}?> >Piauí (PI)</option>
                                            <option value="RJ" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'RJ'){echo 'selected';}?> >Rio de Janeiro (RJ)</option>
                                            <option value="RN" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'RN'){echo 'selected';}?> >Rio Grande do Norte (RN)</option>
                                            <option value="RS" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'RS'){echo 'selected';}?> >Rio Grande do Sul (RS)</option>
                                            <option value="RO" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'RO'){echo 'selected';}?> >Rondônia (RO)</option>
                                            <option value="RR" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'RR'){echo 'selected';}?> >Roraima (RR)</option>
                                            <option value="SC" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'SC'){echo 'selected';}?> >Santa Catarina (SC)</option>
                                            <option value="SP" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'SP'){echo 'selected';}?> >São Paulo (SP)</option>
                                            <option value="SE" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'SE'){echo 'selected';}?> >Sergipe (SE)</option>
                                            <option value="TO" <?php if(isset($profissional->ESTADO_NATURALIDADE) && $profissional->ESTADO_NATURALIDADE == 'TO'){echo 'selected';}?> >Tocantins (TO)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Município de Nascimento *</label>
                                        <select  name="profissional_naturalidade" id="profissional_naturalidade" class="form-control">
                                            <option value="">Selecione uma cidade</option>
                                        </select>
                                        <input type="hidden" class="form-control" value="<?php echo isset($profissional->NATURALIDADE) ? $profissional->NATURALIDADE : '';?>" name="profissional_naturalidade_hidden" id="profissional_naturalidade_hidden" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Nacionalidade *</label>
                                        <select name="profissional_nacionalidade" required id="profissional_nacionalidade" class="form-control">
                                            <option <?php if(isset($profissional->NACIONALIDADE) && $profissional->NACIONALIDADE == 'BR'){echo 'selected';}?> value="BR">Brasileiro</option>
                                            <option <?php if(isset($profissional->NACIONALIDADE) && $profissional->NACIONALIDADE == 'OT'){echo 'selected';}?> value="OT">Outro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Cor ou Raça *</label>
                                        <select class="form-control" name="profissional_cor_raca" required>
                                            <option <?php if(isset($profissional->COR_RACA) && $profissional->COR_RACA == 'BR'){echo 'selected';}?> value="BR">Branco</option>
                                            <option <?php if(isset($profissional->COR_RACA) && $profissional->COR_RACA == 'AM'){echo 'selected';}?> value="AM">Amarelo</option>
                                            <option <?php if(isset($profissional->COR_RACA) && $profissional->COR_RACA == 'IN'){echo 'selected';}?> value="IN">Indigena</option>
                                            <option <?php if(isset($profissional->COR_RACA) && $profissional->COR_RACA == 'NG'){echo 'selected';}?> value="NG">Negro</option>
                                            <option <?php if(isset($profissional->COR_RACA) && $profissional->COR_RACA == 'PD'){echo 'selected';}?> value="PD">Pardo</option>
                                            <option <?php if(isset($profissional->COR_RACA) && $profissional->COR_RACA == 'ND'){echo 'selected';}?> value="ND">Não declarado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Linha 3 -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Registro geral/CPF *</label>
                                        <input type="text" class="form-control cpf"  value="<?php echo isset($profissional->CPF) ? $profissional->CPF : '';?>" name="profissional_cpf" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Data de emissão *</label>
                                        <input type="date" class="form-control"  value="<?php echo isset($profissional->DATA_EMISSAO) ? $profissional->DATA_EMISSAO : '';?>" name="profissional_data_emissao" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Orgão expeditor *</label>
                                        <input type="text" class="form-control"  value="<?php echo isset($profissional->ORGAO_EXPEDITOR) ? $profissional->ORGAO_EXPEDITOR : '';?>" name="profissional_orgao_expeditor" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Titulo de eleitor *</label>
                                        <input type="text" class="form-control"  value="<?php echo isset($profissional->TITULO_ELEITOR) ? $profissional->TITULO_ELEITOR : '';?>" name="profissional_titulo_eleitor" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Zona *</label>
                                        <input type="text" class="form-control"  value="<?php echo isset($profissional->ZONA) ? $profissional->ZONA : '';?>" name="profissional_zona" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Seção *</label>
                                        <input type="text" class="form-control"  value="<?php echo isset($profissional->SECAO) ? $profissional->SECAO : '';?>" name="profissional_secao" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Linha 8 - Endereço -->
                            <h5>Endereço</h5>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>CEP *</label>
                                        <input type="text" class="form-control cep" value="<?php echo isset($profissional->CEP) ? $profissional->CEP : '';?>" id="profissional_cep" name="profissional_cep" required>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Endereço *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($profissional->ENDERECO) ? $profissional->ENDERECO : '';?>" id="profissional_endereco" name="profissional_endereco" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Número *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($profissional->NUMERO) ? $profissional->NUMERO : '';?>" id="profissional_numero" name="profissional_numero" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Bairro *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($profissional->BAIRRO) ? $profissional->BAIRRO : '';?>" id="profissional_bairro" name="profissional_bairro" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cidade *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($profissional->CIDADE) ? $profissional->CIDADE : '';?>" id="profissional_cidade" name="profissional_cidade" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>UF *</label>
                                        <select class="form-control" name="profissional_estado" id="profissional_estado" required>
                                            <option value="AC" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'AC'){echo 'selected';}?> >Acre (AC)</option>
                                            <option value="AL" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'AL'){echo 'selected';}?> >Alagoas (AL)</option>
                                            <option value="AP" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'AP'){echo 'selected';}?> >Amapá (AP)</option>
                                            <option value="AM" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'AM'){echo 'selected';}?> >Amazonas (AM)</option>
                                            <option value="BA" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'BA'){echo 'selected';}?> >Bahia (BA)</option>
                                            <option value="CE" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'CE'){echo 'selected';}?> >Ceará (CE)</option>
                                            <option value="DF" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'DF'){echo 'selected';}?> >Distrito Federal (DF)</option>
                                            <option value="ES" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'ES'){echo 'selected';}?> >Espírito Santo (ES)</option>
                                            <option value="GO" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'GO'){echo 'selected';}?> >Goiás (GO)</option>
                                            <option value="MA" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'MA'){echo 'selected';}?> >Maranhão (MA)</option>
                                            <option value="MT" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'MT'){echo 'selected';}?> >Mato Grosso (MT)</option>
                                            <option value="MS" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'MS'){echo 'selected';}?> >Mato Grosso do Sul (MS)</option>
                                            <option value="MG" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'MG'){echo 'selected';}?> >Minas Gerais (MG)</option>
                                            <option value="PA" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'PA'){echo 'selected';}?> >Pará (PA)</option>
                                            <option value="PB" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'PB'){echo 'selected';}?> >Paraíba (PB)</option>
                                            <option value="PR" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'PR'){echo 'selected';}?> >Paraná (PR)</option>
                                            <option value="PE" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'PE'){echo 'selected';}?> >Pernambuco (PE)</option>
                                            <option value="PI" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'PI'){echo 'selected';}?> >Piauí (PI)</option>
                                            <option value="RJ" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'RJ'){echo 'selected';}?> >Rio de Janeiro (RJ)</option>
                                            <option value="RN" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'RN'){echo 'selected';}?> >Rio Grande do Norte (RN)</option>
                                            <option value="RS" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'RS'){echo 'selected';}?> >Rio Grande do Sul (RS)</option>
                                            <option value="RO" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'RO'){echo 'selected';}?> >Rondônia (RO)</option>
                                            <option value="RR" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'RR'){echo 'selected';}?> >Roraima (RR)</option>
                                            <option value="SC" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'SC'){echo 'selected';}?> >Santa Catarina (SC)</option>
                                            <option value="SP" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'SP'){echo 'selected';}?> >São Paulo (SP)</option>
                                            <option value="SE" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'SE'){echo 'selected';}?> >Sergipe (SE)</option>
                                            <option value="TO" <?php if(isset($profissional->ESTADO) && $profissional->ESTADO == 'TO'){echo 'selected';}?> >Tocantins (TO)</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Telefone 1 *</label>
                                        <input type="text" class="form-control telefone" value="<?php echo isset($profissional->TELEFONE_1) ? $profissional->TELEFONE_1 : '';?>" name="profissional_telefone_1" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Telefone 2</label>
                                        <input type="text" class="form-control telefone" value="<?php echo isset($profissional->TELEFONE_2) ? $profissional->TELEFONE_2 : '';?>" name="profissional_telefone_2">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" value="<?php echo isset($profissional->EMAIL) ? $profissional->EMAIL : '';?>" name="profissional_email">
                                    </div>
                                </div>
                            </div>
                            <br>

                            <!-- Linha 3 -->
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Nível de escolaridade concluído</label>
                                        <div class="d-flex">
                                            <div class="form-check me-2">
                                                <input class="form-check-input" type="radio" name="profissional_escolaridade" <?php if(isset($profissional->ESCOLARIDADE) && $profissional->ESCOLARIDADE == "F"){echo "checked";}?> id="fundamental" value="F">
                                                <label class="form-check-label" for="fundamental">Fundamental</label>
                                            </div>
                                            <div class="form-check me-2">
                                                <input class="form-check-input" type="radio" name="profissional_escolaridade" <?php if(isset($profissional->ESCOLARIDADE) && $profissional->ESCOLARIDADE == "M"){echo "checked";}?> id="media" value="M">
                                                <label class="form-check-label" for="media">Médio</label>
                                            </div>
                                            <div class="form-check me-2">
                                                <input class="form-check-input" type="radio" name="profissional_escolaridade" <?php if(isset($profissional->ESCOLARIDADE) && $profissional->ESCOLARIDADE == "MA"){echo "checked";}?> id="magisterio" value="MA">
                                                <label class="form-check-label" for="magisterio">Magistério</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="profissional_escolaridade" <?php if(isset($profissional->ESCOLARIDADE) && $profissional->ESCOLARIDADE == "S"){echo "checked";}?> id="superior" value="S">
                                                <label class="form-check-label" for="superior">Superior</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 divCursoSuperior">
                                    <div class="form-group">
                                        <label>Nome do curso superior *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($profissional->CURSO_SUPERIOR) ? $profissional->CURSO_SUPERIOR : '';?>" name="profissional_curso_superior">
                                    </div>
                                </div>
                                <div class="col-md-2 divCursoSuperior">
                                    <div class="form-group">
                                        <label>Nível / Grau Acadêmico *</label>
                                        <div class="d-flex">
                                            <div class="form-check me-2">
                                                <input class="form-check-input" type="radio" name="profissional_nivel_grau_academico" <?php if(isset($profissional->NIVEL_GRAU_ACADEMICO) && $profissional->NIVEL_GRAU_ACADEMICO == "B"){echo "checked";}?> id="bacharelado" value="B">
                                                <label class="form-check-label" for="bacharelado">Bacharelado</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="profissional_nivel_grau_academico" <?php if(isset($profissional->NIVEL_GRAU_ACADEMICO) && $profissional->NIVEL_GRAU_ACADEMICO == "L"){echo "checked";}?> id="licenciatura" value="L">
                                                <label class="form-check-label" for="licenciatura">Licenciatura</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h5 class="divCursoSuperior">Especializações concluidas</h5>

                            <div class="row divCursoSuperior">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Especialização 1</label>
                                        <input type="text" class="form-control" value="<?php echo isset($profissional->ESPECIALIZACAO_1) ? $profissional->ESPECIALIZACAO_1 : '';?>" name="profissional_especializacao_1">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Especialização 2</label>
                                        <input type="text" class="form-control" value="<?php echo isset($profissional->ESPECIALIZACAO_2) ? $profissional->ESPECIALIZACAO_2 : '';?>" name="profissional_especializacao_2">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Especialização 3</label>
                                        <input type="text" class="form-control" value="<?php echo isset($profissional->ESPECIALIZACAO_3) ? $profissional->ESPECIALIZACAO_3 : '';?>" name="profissional_especializacao_3">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Cargo *</label>
                                        <select name="profissional_cargo" required class="form-control">
                                            <option value="">Escolha um cargo</option>
                                            <?php 
                                                foreach($profissoes as $prof){
                                                    $select = '';
                                                    if(isset($profissional->CARGO)&&$profissional->CARGO==$prof->ID_PROFISSAO){$select = 'selected';}
                                                    echo '<option value="'.$prof->ID_PROFISSAO.'" '.$select.'>'.$prof->NOME.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Carga-horário *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($profissional->CARGA_HORARIA) ? $profissional->CARGA_HORARIA : '';?>" name="profissional_carga_horaria" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Horário entrada *</label>
                                        <input type="text" class="form-control horario" value="<?php echo isset($profissional->HORARIO_ENTRADA) ? $profissional->HORARIO_ENTRADA : '';?>" name="profissional_horario_entrada" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Horário saída *</label>
                                        <input type="text" class="form-control horario" value="<?php echo isset($profissional->HORARIO_SAIDA) ? $profissional->HORARIO_SAIDA : '';?>" name="profissional_horario_saida" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Intervalo</label>
                                        <div class="d-flex">
                                            <div class="form-check me-2">
                                                <input class="form-check-input" type="radio" name="profissional_intervalo" <?php if(isset($profissional->INTERVALO) && $profissional->INTERVALO == "S"){echo "checked";}?> id="sim" value="S">
                                                <label class="form-check-label" for="sim">Sim</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="profissional_intervalo" <?php if(isset($profissional->INTERVALO) && $profissional->INTERVALO == "N"){echo "checked";}?> id="nao" value="N">
                                                <label class="form-check-label" for="nao">Não</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 divHora">
                                    <div class="form-group">
                                        <label>Quantas horas? </label>
                                        <input type="number" class="form-control" value="<?php echo isset($profissional->INTERVALO_HORA) ? $profissional->INTERVALO_HORA : '';?>" id="profissional_intervalo_hora" name="profissional_intervalo_hora">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipo de vinculo *</label>
                                        <select name="profissional_tipo_vinculo" id="profissional_tipo_vinculo" class="form-control" required>
                                            <option value="">Selecione o tipo de vínculo</option>
                                            <option <?php if(isset($profissional->TIPO_VINCULO) && $profissional->TIPO_VINCULO == 'CT'){echo 'selected';}?> value="CT">CTPS</option>
                                            <option <?php if(isset($profissional->TIPO_VINCULO) && $profissional->TIPO_VINCULO == 'AT'){echo 'selected';}?> value="AT">Autônomo</option>
                                            <option <?php if(isset($profissional->TIPO_VINCULO) && $profissional->TIPO_VINCULO == 'PJ'){echo 'selected';}?> value="PJ">PJ</option>
                                            <option <?php if(isset($profissional->TIPO_VINCULO) && $profissional->TIPO_VINCULO == 'ET'){echo 'selected';}?> value="ET">Estagiário</option>
                                            <option <?php if(isset($profissional->TIPO_VINCULO) && $profissional->TIPO_VINCULO == 'FR'){echo 'selected';}?> value="FR">Freelancer</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data de admissão *</label>
                                        <input type="date" class="form-control" value="<?php echo isset($profissional->DATA_ADMISSAO) ? $profissional->DATA_ADMISSAO : '';?>" name="profissional_data_admissao" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data de desligamento </label>
                                        <input type="date" class="form-control" value="<?php echo isset($profissional->DATA_DESLIGAMENTO) ? $profissional->DATA_DESLIGAMENTO : '';?>" name="profissional_data_desligamento">
                                    </div>
                                </div>
                                

                            </div>

                            
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Estado Civil *</label>
                                        <select name="profissional_estado_civil" required id="profissional_estado_civil" class="form-control">
                                        <option <?php if (isset($profissional->ESTADO_CIVIL) && $profissional->ESTADO_CIVIL == 'SO') echo 'selected'; ?> value="SO">Solteiro(a)</option>
                                        <option <?php if (isset($profissional->ESTADO_CIVIL) && $profissional->ESTADO_CIVIL == 'CA') echo 'selected'; ?> value="CA">Casado(a)</option>
                                        <option <?php if (isset($profissional->ESTADO_CIVIL) && $profissional->ESTADO_CIVIL == 'DI') echo 'selected'; ?> value="DI">Divorciado(a)</option>
                                        <option <?php if (isset($profissional->ESTADO_CIVIL) && $profissional->ESTADO_CIVIL == 'VI') echo 'selected'; ?> value="VI">Viúvo(a)</option>
                                        <option <?php if (isset($profissional->ESTADO_CIVIL) && $profissional->ESTADO_CIVIL == 'UN') echo 'selected'; ?> value="UN">União Estável</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 divConjuge">
                                    <div class="form-group">
                                        <label>Cônjuge: </label>
                                        <input type="text" class="form-control" value="<?php echo isset($profissional->CONJUGE) ? $profissional->CONJUGE : ''; ?>" id="profissional_conjuge" name="profissional_conjuge">
                                    </div>
                                </div>
                                
                                <div class="col-md-2 divConjuge">
                                    <div class="form-group">
                                        <label>Telefone: </label>
                                        <input type="text" class="form-control telefone" value="<?php echo isset($profissional->TELEFONE_CONJUGE) ? $profissional->TELEFONE_CONJUGE : '';?>" name="telefone_conjuge">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Filhos</label>
                                        <div class="d-flex">
                                            <div class="form-check me-2">
                                                <input class="form-check-input" type="radio" name="profissional_filhos" <?php if(isset($profissional->FILHO) && $profissional->FILHO == "S"){echo "checked";}?> id="sim_filho" value="S">
                                                <label class="form-check-label" for="sim_filho">Sim</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="profissional_filhos" <?php if(isset($profissional->FILHO) && $profissional->FILHO == "N"){echo "checked";}?> id="nao_filho" value="N">
                                                <label class="form-check-label" for="nao_filho">Não</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 divFilho">
                                    <div class="form-group">
                                        <label>Quantos: </label>
                                        <input type="number" class="form-control" value="<?php echo isset($profissional->QTD_FILHO) ? $profissional->QTD_FILHO : '';?>" id="profissional_qtd_filho" name="profissional_qtd_filho">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Deficiência</label>
                                        <div class="d-flex">
                                            <div class="form-check me-2">
                                                <input class="form-check-input" type="radio" name="profissional_deficiência" <?php if(isset($profissional->DEFICIENCIA) && $profissional->DEFICIENCIA == "S"){echo "checked";}?> id="sim_def" value="S">
                                                <label class="form-check-label" for="sim_def">Sim</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="profissional_deficiência" <?php if(isset($profissional->DEFICIENCIA) && $profissional->DEFICIENCIA == "N"){echo "checked";}?> id="nao_def" value="N">
                                                <label class="form-check-label" for="nao_def">Não</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 divDeficienciaProf">
                                    <div class="form-group">
                                        <label>Qual: </label>
                                        <input type="text" class="form-control" value="<?php echo isset($profissional->QUAL_DEFICIENCIA) ? $profissional->QUAL_DEFICIENCIA : '';?>" id="profissional_qual_deficiencia" name="profissional_qual_deficiencia">
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Doenças Crônicas</label>
                                        <div class="d-flex">
                                            <div class="form-check me-2">
                                                <input class="form-check-input" type="radio" name="profissional_doenca" <?php if(isset($profissional->DOENCA) && $profissional->DOENCA == "S"){echo "checked";}?> id="sim_doenca" value="S">
                                                <label class="form-check-label" for="sim_doenca">Sim</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="profissional_doenca" <?php if(isset($profissional->DOENCA) && $profissional->DOENCA == "N"){echo "checked";}?> id="nao_doenca" value="N">
                                                <label class="form-check-label" for="nao_doenca">Não</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 divDoenca">
                                    <div class="form-group">
                                        <label>Qual: </label>
                                        <input type="text" class="form-control" value="<?php echo isset($profissional->QUAL_DOENCA) ? $profissional->QUAL_DOENCA : '';?>" id="profissional_qual_doenca" name="profissional_qual_doenca">
                                    </div>
                                </div>
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

  <!-- Modal para a câmera -->
  <div id="cameraModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span style="color: #000" class="close" onclick="fecharModal()">&times;</span>
        <h2 style="color: #000" >Capturar Foto</h2>
        <video id="video" width="100%" autoplay></video>
        <br>
        <button class="btn btn-success" onclick="capturarFoto()">Tirar Foto</button>
        <canvas id="canvas" style="display:none;"></canvas>
    </div>
</div>

  <script src="/template/js/escola.js"></script>
  <script>
    let stream;

// Função para abrir o modal e a câmera
function abrirModal() {
    document.getElementById('cameraModal').style.display = 'block';
    abrirWebcam();
}

// Função para fechar o modal e a câmera
function fecharModal() {
    fecharWebcam();
    document.getElementById('cameraModal').style.display = 'none';
}

// Função para abrir a câmera
function abrirWebcam() {
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then((mediaStream) => {
                stream = mediaStream;
                document.getElementById('video').srcObject = stream;
            })
            .catch((error) => {
                console.error('Erro ao acessar a webcam:', error);
                alert('Erro ao acessar a webcam. Verifique as permissões.');
            });
    } else {
        alert('Seu navegador não suporta getUserMedia. Verifique se está usando HTTPS ou tente em um navegador moderno.');
    }
}
function capturarFoto() {
    const video = document.getElementById('video');
    const canvas = document.createElement('canvas');
    
    // Define a largura e altura desejadas para a imagem capturada
    canvas.width = 141;
    canvas.height = 165;
    
    // Obtenha o contexto do canvas e desenhe o vídeo redimensionado
    const context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    
    // Converte a imagem para Base64
    const dataURL = canvas.toDataURL('image/png');
    
    // Armazena o Base64 no campo oculto para envio ao servidor
    document.getElementById('aluno_imagem_base64').value = dataURL;
    
    // Exibe a imagem capturada no elemento img
    const imgPreview = document.getElementById('fotoPreview');  // Corrigido para "fotoPreview"
    imgPreview.src = dataURL;

    // Fecha a modal (se necessário)
    fecharModal()
}


// Função para fechar a câmera
function fecharWebcam() {
    if (stream) {
        const tracks = stream.getTracks();
        tracks.forEach((track) => track.stop());
    }
}




  </script>