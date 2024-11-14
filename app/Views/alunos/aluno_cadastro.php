 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Aluno
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Aluno</a></li>
        <li class="breadcrumb-item active"><?php echo isset($aluno->ID_ALUNO) ? 'Edição' : 'Cadastro';?> de aluno</li>
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
                        <h4 class="box-title"><?php echo isset($aluno->ID_ALUNO) ? 'Edição' : 'Cadastro';?> de aluno</h4>			
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>	
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <!-- /.box-header -->
                    <form novalidate method="POST" action="/Aluno/Store" id="frm" class="validate" enctype='multipart/form-data'>
                        <div class="box-body">
                            <!-- Linha 1 -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Código</label>
                                        <input disabled="disabled" type="text" class="form-control" value="<?php echo isset($aluno->ID_ALUNO) ? $aluno->ID_ALUNO : '';?>" >
                                        <input type="hidden" class="form-control" value="<?php echo isset($aluno->ID_ALUNO) ? $aluno->ID_ALUNO : '';?>" name="aluno_id">
                                    </div>
                                </div>
                                <div class="col-md-5">                      
                                    <div class="form-group">
                                        <label>Foto Aluno</label>
                                        <div class="controls">
                                            <input type="file" name="aluno_imagem" id="aluno_imagem" class="form-control">
                                        </div>
                                        <p>Foto do(a) aluno(a)</p>
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
                                        <label>Foto Aluno</label>
                                        <div class="controls">
                                            <?php
                                                if(isset($aluno->NOME_ALEATORIO) && ($aluno->NOME_ALEATORIO != null || $aluno->NOME_ALEATORIO != "")){
                                                    echo '  <img id="fotoPreview" src="'.LINK_UPLOAD.$aluno->NOME_ALEATORIO.'" width="100" class="img-bordered">';
                                                } else {
                                                    echo '  <img id="fotoPreview" src="'.LINK_UPLOAD.'padrao.png'.'" width="100" class="img-bordered">';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NIS aluno </label>
                                        <input type="text" class="form-control" value="<?php echo isset($aluno->NIS_ALUNO) ? $aluno->NIS_ALUNO : '';?>" name="aluno_nis" >
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Nome do aluno *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($aluno->NOME_ALUNO) ? $aluno->NOME_ALUNO : '';?>" name="aluno_nome" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data de nascimento *</label>
                                        <input type="date" class="form-control" value="<?php echo isset($aluno->DATA_NASCIMENTO) ? $aluno->DATA_NASCIMENTO : '';?>" id="aluno_data_nascimento" name="aluno_data_nascimento" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Linha 2 -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Idade *</label>
                                        <input type="number" class="form-control" value="<?php echo isset($aluno->IDADE) ? $aluno->IDADE : '';?>" id="aluno_idade" name="aluno_idade" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Sexo *</label>
                                        <select class="form-control" name="aluno_sexo" required>
                                            <option <?php if(isset($aluno->SEXO) && $aluno->SEXO == 'M'){echo 'selected';}?> value="M">Masculino</option>
                                            <option <?php if(isset($aluno->SEXO) && $aluno->SEXO == 'F'){echo 'selected';}?> value="F">Feminino</option>
                                            <option <?php if(isset($aluno->SEXO) && $aluno->SEXO == 'O'){echo 'selected';}?> value="O">Outro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>UF de nascimento *</label>
                                        <select class="form-control" name="aluno_estado_naturalidade" id="aluno_estado_naturalidade" >
                                            <option value="AC" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'AC'){echo 'selected';}?> >Acre (AC)</option>
                                            <option value="AL" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'AL'){echo 'selected';}?> >Alagoas (AL)</option>
                                            <option value="AP" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'AP'){echo 'selected';}?> >Amapá (AP)</option>
                                            <option value="AM" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'AM'){echo 'selected';}?> >Amazonas (AM)</option>
                                            <option value="BA" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'BA'){echo 'selected';}?> >Bahia (BA)</option>
                                            <option value="CE" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'CE'){echo 'selected';}?> >Ceará (CE)</option>
                                            <option value="DF" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'DF'){echo 'selected';}?> >Distrito Federal (DF)</option>
                                            <option value="ES" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'ES'){echo 'selected';}?> >Espírito Santo (ES)</option>
                                            <option value="GO" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'GO'){echo 'selected';}?> >Goiás (GO)</option>
                                            <option value="MA" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'MA'){echo 'selected';}?> >Maranhão (MA)</option>
                                            <option value="MT" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'MT'){echo 'selected';}?> >Mato Grosso (MT)</option>
                                            <option value="MS" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'MS'){echo 'selected';}?> >Mato Grosso do Sul (MS)</option>
                                            <option value="MG" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'MG'){echo 'selected';}?> >Minas Gerais (MG)</option>
                                            <option value="PA" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'PA'){echo 'selected';}?> >Pará (PA)</option>
                                            <option value="PB" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'PB'){echo 'selected';}?> >Paraíba (PB)</option>
                                            <option value="PR" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'PR'){echo 'selected';}?> >Paraná (PR)</option>
                                            <option value="PE" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'PE'){echo 'selected';}?> >Pernambuco (PE)</option>
                                            <option value="PI" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'PI'){echo 'selected';}?> >Piauí (PI)</option>
                                            <option value="RJ" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'RJ'){echo 'selected';}?> >Rio de Janeiro (RJ)</option>
                                            <option value="RN" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'RN'){echo 'selected';}?> >Rio Grande do Norte (RN)</option>
                                            <option value="RS" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'RS'){echo 'selected';}?> >Rio Grande do Sul (RS)</option>
                                            <option value="RO" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'RO'){echo 'selected';}?> >Rondônia (RO)</option>
                                            <option value="RR" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'RR'){echo 'selected';}?> >Roraima (RR)</option>
                                            <option value="SC" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'SC'){echo 'selected';}?> >Santa Catarina (SC)</option>
                                            <option value="SP" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'SP'){echo 'selected';}?> >São Paulo (SP)</option>
                                            <option value="SE" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'SE'){echo 'selected';}?> >Sergipe (SE)</option>
                                            <option value="TO" <?php if(isset($aluno->ESTADO_NATURALIDADE) && $aluno->ESTADO_NATURALIDADE == 'TO'){echo 'selected';}?> >Tocantins (TO)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Município de Nascimento *</label>
                                        <select  name="aluno_naturalidade" id="aluno_naturalidade" class="form-control">
                                            <option value="">Selecione uma cidade</option>
                                        </select>
                                        <input type="hidden" class="form-control" value="<?php echo isset($aluno->NATURALIDADE) ? $aluno->NATURALIDADE : '';?>" name="aluno_naturalidade_hidden" id="aluno_naturalidade_hidden" >
                                    </div>
                                </div>
                            </div>

                            <!-- Linha 3 -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nacionalidade *</label>
                                        <select name="aluno_nacionalidade" required id="aluno_nacionalidade" class="form-control">
                                            <option <?php if(isset($aluno->NACIONALIDADE) && $aluno->NACIONALIDADE == 'BR'){echo 'selected';}?> value="BR">Brasileiro</option>
                                            <option <?php if(isset($aluno->NACIONALIDADE) && $aluno->NACIONALIDADE == 'OT'){echo 'selected';}?> value="OT">Outro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Registro Geral/CPF</label>
                                        <input type="text" class="form-control cpf"  value="<?php echo isset($aluno->CPF) ? $aluno->CPF : '';?>" name="aluno_cpf" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Data de emissão</label>
                                        <input type="date" class="form-control"  value="<?php echo isset($aluno->DATA_EMISSAO) ? $aluno->DATA_EMISSAO : '';?>" name="aluno_data_emissao">
                                    </div>
                                </div>
                            </div>

                            <!-- Linha 4 -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Orgão expeditor *</label>
                                        <input type="text" class="form-control"  value="<?php echo isset($aluno->ORGAO_EXPEDITOR) ? $aluno->ORGAO_EXPEDITOR : '';?>" name="aluno_orgao_expeditor" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Cartão do SUS</label>
                                        <input type="text" class="form-control"  value="<?php echo isset($aluno->CARTAO_SUS) ? $aluno->CARTAO_SUS : '';?>" name="aluno_sus">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Número da matrícula (certidão de nascimento)</label>
                                        <input type="text" class="form-control"  value="<?php echo isset($aluno->NUMERO_MATRICULA) ? $aluno->NUMERO_MATRICULA : '';?>" name="aluno_numero_matricula" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Cor ou Raça *</label>
                                        <select class="form-control" name="aluno_cor_raca" required>
                                            <option <?php if(isset($aluno->COR_RACA) && $aluno->COR_RACA == 'BR'){echo 'selected';}?> value="BR">Branco</option>
                                            <option <?php if(isset($aluno->COR_RACA) && $aluno->COR_RACA == 'AM'){echo 'selected';}?> value="AM">Amarelo</option>
                                            <option <?php if(isset($aluno->COR_RACA) && $aluno->COR_RACA == 'IN'){echo 'selected';}?> value="IN">Indigena</option>
                                            <option <?php if(isset($aluno->COR_RACA) && $aluno->COR_RACA == 'NG'){echo 'selected';}?> value="NG">Negro</option>
                                            <option <?php if(isset($aluno->COR_RACA) && $aluno->COR_RACA == 'PD'){echo 'selected';}?> value="PD">Pardo</option>
                                            <option <?php if(isset($aluno->COR_RACA) && $aluno->COR_RACA == 'PD'){echo 'selected';}?> value="ND">Não declarado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Linha 5 - Filiação 1 -->
                            <h5>Filiação 1</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nome *</label>
                                        <input type="text" class="form-control"  value="<?php echo isset($aluno->FILIACAO_1) ? $aluno->FILIACAO_1 : '';?>" id="aluno_filiacao_1" name="aluno_filiacao_1" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Situação </label>
                                        <select class="form-control" name="aluno_filiacao_1_vivo">
                                            <option <?php if(isset($aluno->FILIACAO_1_VIVO) && $aluno->FILIACAO_1_VIVO == 'V'){echo 'selected';}?> value="V">Vivo</option>
                                            <option <?php if(isset($aluno->FILIACAO_1_VIVO) && $aluno->FILIACAO_1_VIVO == 'F'){echo 'selected';}?> value="F">Falecido</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Telefone </label>
                                        <input type="text" class="form-control telefone"  value="<?php echo isset($aluno->FILIACAO_1_TELEFONE) ? $aluno->FILIACAO_1_TELEFONE : '';?>" name="aluno_filiacao_1_telefone">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Profissão </label>
                                        <input type="text" class="form-control"  value="<?php echo isset($aluno->FILIACAO_1_PROFISSAO) ? $aluno->FILIACAO_1_PROFISSAO : '';?>" name="aluno_filiacao_1_profissao">
                                    </div>
                                </div>
                            </div>

                            <!-- Linha 6 - Filiação 2 -->
                            <h5>Filiação 2</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nome </label>
                                        <input type="text" class="form-control" value="<?php echo isset($aluno->FILIACAO_2) ? $aluno->FILIACAO_2 : '';?>" id="aluno_filiacao_2" name="aluno_filiacao_2">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Situação </label>
                                        <select class="form-control" name="aluno_filiacao_2_vivo">
                                            <option <?php if(isset($aluno->FILIACAO_2_VIVO) && $aluno->FILIACAO_2_VIVO == 'V'){echo 'selected';}?> value="V">Vivo</option>
                                            <option <?php if(isset($aluno->FILIACAO_2_VIVO) && $aluno->FILIACAO_2_VIVO == 'F'){echo 'selected';}?> value="F">Falecido</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Telefone </label>
                                        <input type="text" class="form-control telefone" value="<?php echo isset($aluno->FILIACAO_2_TELEFONE) ? $aluno->FILIACAO_2_TELEFONE : '';?>" name="aluno_filiacao_2_telefone" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Profissão</label>
                                        <input type="text" class="form-control" value="<?php echo isset($aluno->FILIACAO_2_PROFISSAO) ? $aluno->FILIACAO_2_PROFISSAO : '';?>" name="aluno_filiacao_2_profissao">
                                    </div>
                                </div>
                            </div>

                            <!-- Linha 7 - Responsável legal -->
                            <h5>Responsável legal</h5>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select class="form-control" name="aluno_responsavel_legal" id="aluno_responsavel_legal">
                                            <option value="A" <?php if(isset($aluno->RESPONSAVEL_LEGAL) && $aluno->RESPONSAVEL_LEGAL == 'A'){echo 'selected';}?>>Filiação 1 e Filiação 2</option>
                                            <option value="M" <?php if(isset($aluno->RESPONSAVEL_LEGAL) && $aluno->RESPONSAVEL_LEGAL == 'M'){echo 'selected';}?>>Filiação 1</option>
                                            <option value="P" <?php if(isset($aluno->RESPONSAVEL_LEGAL) && $aluno->RESPONSAVEL_LEGAL == 'P'){echo 'selected';}?>>Filiação 2</option>
                                            <option value="O" <?php if(isset($aluno->RESPONSAVEL_LEGAL) && $aluno->RESPONSAVEL_LEGAL == 'O'){echo 'selected';}?>>Outro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row divResponsaveis">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nome *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($aluno->RESPONSAVEL_LEGAL_NOME) ? $aluno->RESPONSAVEL_LEGAL_NOME : '';?>" name="aluno_responsavel_legal_nome">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Grau de parentesco *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($aluno->GRAU_PARENTESCO) ? $aluno->GRAU_PARENTESCO : '';?>" name="aluno_grau_parentesco">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Telefone *</label>
                                        <input type="text" class="form-control telefone" value="<?php echo isset($aluno->RESPONSAVEL_LEGAL_TELEFONE) ? $aluno->RESPONSAVEL_LEGAL_TELEFONE : '';?>" name="aluno_responsavel_legal_telefone">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Profissão</label>
                                        <input type="text" class="form-control" value="<?php echo isset($aluno->RESPONSAVEL_LEGAL_PROFISSAO) ? $aluno->RESPONSAVEL_LEGAL_PROFISSAO : '';?>" name="aluno_responsavel_legal_profissao">
                                    </div>
                                </div>
                            </div>

                            <!-- Linha 8 - Endereço -->
                            <h5>Endereço</h5>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>CEP *</label>
                                        <input type="text" class="form-control cep" value="<?php echo isset($aluno->CEP) ? $aluno->CEP : '';?>" name="aluno_cep" id="aluno_cep" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Endereço *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($aluno->ENDERECO) ? $aluno->ENDERECO : '';?>" name="aluno_endereco" id="aluno_endereco" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Número *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($aluno->NUMERO) ? $aluno->NUMERO : '';?>" name="aluno_numero" id="aluno_numero" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Bairro *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($aluno->BAIRRO) ? $aluno->BAIRRO : '';?>" name="aluno_bairro" id="aluno_bairro" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cidade *</label>
                                        <input type="text" class="form-control" value="<?php echo isset($aluno->CIDADE) ? $aluno->CIDADE : '';?>" name="aluno_cidade" id="aluno_cidade" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Estado *</label>
                                        <select class="form-control" name="aluno_estado" id="aluno_estado" required>
                                            <option value="AC" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'AC'){echo 'selected';}?> >Acre (AC)</option>
                                            <option value="AL" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'AL'){echo 'selected';}?> >Alagoas (AL)</option>
                                            <option value="AP" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'AP'){echo 'selected';}?> >Amapá (AP)</option>
                                            <option value="AM" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'AM'){echo 'selected';}?> >Amazonas (AM)</option>
                                            <option value="BA" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'BA'){echo 'selected';}?> >Bahia (BA)</option>
                                            <option value="CE" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'CE'){echo 'selected';}?> >Ceará (CE)</option>
                                            <option value="DF" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'DF'){echo 'selected';}?> >Distrito Federal (DF)</option>
                                            <option value="ES" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'ES'){echo 'selected';}?> >Espírito Santo (ES)</option>
                                            <option value="GO" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'GO'){echo 'selected';}?> >Goiás (GO)</option>
                                            <option value="MA" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'MA'){echo 'selected';}?> >Maranhão (MA)</option>
                                            <option value="MT" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'MT'){echo 'selected';}?> >Mato Grosso (MT)</option>
                                            <option value="MS" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'MS'){echo 'selected';}?> >Mato Grosso do Sul (MS)</option>
                                            <option value="MG" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'MG'){echo 'selected';}?> >Minas Gerais (MG)</option>
                                            <option value="PA" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'PA'){echo 'selected';}?> >Pará (PA)</option>
                                            <option value="PB" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'PB'){echo 'selected';}?> >Paraíba (PB)</option>
                                            <option value="PR" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'PR'){echo 'selected';}?> >Paraná (PR)</option>
                                            <option value="PE" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'PE'){echo 'selected';}?> >Pernambuco (PE)</option>
                                            <option value="PI" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'PI'){echo 'selected';}?> >Piauí (PI)</option>
                                            <option value="RJ" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'RJ'){echo 'selected';}?> >Rio de Janeiro (RJ)</option>
                                            <option value="RN" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'RN'){echo 'selected';}?> >Rio Grande do Norte (RN)</option>
                                            <option value="RS" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'RS'){echo 'selected';}?> >Rio Grande do Sul (RS)</option>
                                            <option value="RO" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'RO'){echo 'selected';}?> >Rondônia (RO)</option>
                                            <option value="RR" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'RR'){echo 'selected';}?> >Roraima (RR)</option>
                                            <option value="SC" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'SC'){echo 'selected';}?> >Santa Catarina (SC)</option>
                                            <option value="SP" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'SP'){echo 'selected';}?> >São Paulo (SP)</option>
                                            <option value="SE" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'SE'){echo 'selected';}?> >Sergipe (SE)</option>
                                            <option value="TO" <?php if(isset($aluno->ESTADO) && $aluno->ESTADO == 'TO'){echo 'selected';}?> >Tocantins (TO)</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <br>


                            <!-- Linha de deficiência -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Com deficiência *</label>
                                        <select class="form-control" name="aluno_possui_deficiencia" id="aluno_possui_deficiencia" required>
                                            <option <?php if(isset($aluno->POSSUI_DEFICIENCIA) && $aluno->POSSUI_DEFICIENCIA == 'N'){echo 'selected';}?>  value="N">Não</option>
                                            <option <?php if(isset($aluno->POSSUI_DEFICIENCIA) && $aluno->POSSUI_DEFICIENCIA == 'S'){echo 'selected';}?>  value="S">Sim</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row divDeficiencia">
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" id="aluno_baixa_visao" value="S" aria-invalid="false" name="aluno_baixa_visao" <?php if(isset($aluno_deficiencia->BAIXA_VISAO) && $aluno_deficiencia->BAIXA_VISAO == "S"){echo "checked";}?>>
                                        <label for="aluno_baixa_visao">Baixa visão</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" id="aluno_deficiencia_fisica" value="S" aria-invalid="false" name="aluno_deficiencia_fisica" <?php if(isset($aluno_deficiencia->DEFICIENCIA_FISICA) && $aluno_deficiencia->DEFICIENCIA_FISICA == "S"){echo "checked";}?>>
                                        <label for="aluno_deficiencia_fisica">Deficiência física</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" id="aluno_surdocegueira" value="S" aria-invalid="false" name="aluno_surdocegueira" <?php if(isset($aluno_deficiencia->SURDOCEGUEIRA) && $aluno_deficiencia->SURDOCEGUEIRA == "S"){echo "checked";}?>>
                                        <label for="aluno_surdocegueira">Surdocegueira</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" id="aluno_cegueira" value="S" aria-invalid="false" name="aluno_cegueira" <?php if(isset($aluno_deficiencia->CEGUEIRA) && $aluno_deficiencia->CEGUEIRA == "S"){echo "checked";}?>>
                                        <label for="aluno_cegueira">Cegueira</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" id="aluno_intelectual" value="S" aria-invalid="false" name="aluno_intelectual" <?php if(isset($aluno_deficiencia->INTELECTUAL) && $aluno_deficiencia->INTELECTUAL == "S"){echo "checked";}?>>
                                        <label for="aluno_intelectual">Deficiência intelectual</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" id="aluno_multipla" value="S" aria-invalid="false" name="aluno_multipla" <?php if(isset($aluno_deficiencia->MULTIPLA) && $aluno_deficiencia->MULTIPLA == "S"){echo "checked";}?>>
                                        <label for="aluno_multipla">Deficiência múltipla</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row divDeficiencia">
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" id="aluno_auditiva" value="S" aria-invalid="false" name="aluno_auditiva" <?php if(isset($aluno_deficiencia->AUDITIVA) && $aluno_deficiencia->AUDITIVA == "S"){echo "checked";}?>>
                                        <label for="aluno_auditiva">Deficiência auditiva</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" id="surdez" value="S" aria-invalid="false" name="aluno_surdez" <?php if(isset($aluno_deficiencia->SURDEZ) && $aluno_deficiencia->SURDEZ == "S"){echo "checked";}?>>
                                        <label for="surdez">Surdez</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-check">
                                        <label class="form-check-label">Outros </label>
                                        <input type="text" class="form-control"  value="<?php echo isset($aluno_deficiencia->OUTROS) ? $aluno_deficiencia->OUTROS : '';?>" name="aluno_outros" required>
                                    </div>
                                </div>
                            </div>


                            <!-- Linha de transtorno -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Com transtorno *</label>
                                        <select class="form-control" name="aluno_possui_transtorno" id="aluno_possui_transtorno" required>
                                            <option <?php if(isset($aluno->POSSUI_TRANSTORNO) && $aluno->POSSUI_TRANSTORNO == 'N'){echo 'selected';}?>  value="N">Não</option>
                                            <option <?php if(isset($aluno->POSSUI_TRANSTORNO) && $aluno->POSSUI_TRANSTORNO == 'S'){echo 'selected';}?>  value="S">Sim</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row divTranstorno">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" id="aluno_autismo" value="S" aria-invalid="false" name="aluno_autismo" <?php if(isset($aluno_transtorno->AUSTISMO) && $aluno_transtorno->AUSTISMO == "S"){echo "checked";}?>>
                                        <label for="aluno_autismo">Transtorno espectro autista</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row divTranstorno">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <label for="aluno_outros_transtornos">Outros</label>
                                        <input type="text" class="form-control"  value="<?php echo isset($aluno_transtorno->OUTROS) ? $aluno_transtorno->OUTROS : '';?>" name="aluno_outros_transtornos" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Altas habilidades/superdotação *</label>
                                        <select class="form-control" name="aluno_possui_superdotacao" required>
                                            <option <?php if(isset($aluno->POSSUI_SUPERDOTACAO) && $aluno->POSSUI_SUPERDOTACAO == 'N'){echo 'selected';}?>  value="N">Não</option>
                                            <option <?php if(isset($aluno->POSSUI_SUPERDOTACAO) && $aluno->POSSUI_SUPERDOTACAO == 'S'){echo 'selected';}?>  value="S">Sim</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Com doenças crônicas *</label>
                                        <select class="form-control" name="aluno_possui_doencas_cronicas" id="aluno_possui_doencas_cronicas" required>
                                            <option <?php if(isset($aluno->POSSUI_DOENCAS_CRONICAS) && $aluno->POSSUI_DOENCAS_CRONICAS == 'N'){echo 'selected';}?>  value="N">Não</option>
                                            <option <?php if(isset($aluno->POSSUI_DOENCAS_CRONICAS) && $aluno->POSSUI_DOENCAS_CRONICAS == 'S'){echo 'selected';}?>  value="S">Sim</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row divDoencas">
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" id="aluno_diabete" value="S" aria-invalid="false" name="aluno_diabete" <?php if(isset($aluno_doencas_cronicas->DIEABETE) && $aluno_doencas_cronicas->DIEABETE == "S"){echo "checked";}?>>
                                        <label for="aluno_diabete">Diabetes Mellitus</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" id="aluno_respiratoria" value="S" aria-invalid="false" name="aluno_respiratoria" <?php if(isset($aluno_doencas_cronicas->RESPIRATORIA) && $aluno_doencas_cronicas->RESPIRATORIA == "S"){echo "checked";}?>>
                                        <label for="aluno_respiratoria">Respiratória</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" id="aluno_neurologia" value="S" aria-invalid="false" name="aluno_neurologia" <?php if(isset($aluno_doencas_cronicas->NEUROLOGIA) && $aluno_doencas_cronicas->NEUROLOGIA == "S"){echo "checked";}?>>
                                        <label for="aluno_neurologia">Neurológica</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" id="aluno_obesidade" value="S" aria-invalid="false" name="aluno_obesidade" <?php if(isset($aluno_doencas_cronicas->OBESIDADE) && $aluno_doencas_cronicas->OBESIDADE == "S"){echo "checked";}?>>
                                        <label for="aluno_obesidade">Obesidade</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <label class="form-check-label">Outros </label>
                                        <input type="text" class="form-control"  value="<?php echo isset($aluno_doencas_cronicas->OUTROS) ? $aluno_doencas_cronicas->OUTROS : '';?>" name="aluno_outros_cronicas" required>
                                    </div>
                                </div>
                            </div>

                            

                            <!-- Linha de transtorno -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Intolerância Alimentar *</label>
                                        <select class="form-control" name="aluno_possui_intolerancia" id="aluno_possui_intolerancia" required>
                                            <option <?php if(isset($aluno->POSSUI_INTOLERANCIA) && $aluno->POSSUI_INTOLERANCIA == 'N'){echo 'selected';}?>  value="N">Não</option>
                                            <option <?php if(isset($aluno->POSSUI_INTOLERANCIA) && $aluno->POSSUI_INTOLERANCIA == 'S'){echo 'selected';}?>  value="S">Sim</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row divIntolerancia">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <label for="aluno_intolerancia">Qual</label>
                                        <input type="text" class="form-control"  value="<?php echo isset($aluno_intolerancia->OUTROS) ? $aluno_intolerancia->OUTROS : '';?>" name="aluno_intolerancia" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Alergia *</label>
                                        <select class="form-control" name="aluno_possui_alergia" id="aluno_possui_alergia" required>
                                            <option <?php if(isset($aluno->POSSUI_ALERGIA) && $aluno->POSSUI_ALERGIA == 'N'){echo 'selected';}?>  value="N">Não</option>
                                            <option <?php if(isset($aluno->POSSUI_ALERGIA) && $aluno->POSSUI_ALERGIA == 'S'){echo 'selected';}?>  value="S">Sim</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row divAlergia">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <label for="aluno_alergia">Qual</label>
                                        <input type="text" class="form-control"  value="<?php echo isset($aluno_alergia->OUTROS) ? $aluno_alergia->OUTROS : '';?>" name="aluno_alergia" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Faz algum tratamento especializado *</label>
                                        <select class="form-control" name="aluno_possui_tratamento" id="aluno_possui_tratamento" required>
                                            <option <?php if(isset($aluno->POSSUI_TRATAMENTO) && $aluno->POSSUI_TRATAMENTO == 'N'){echo 'selected';}?>  value="N">Não</option>
                                            <option <?php if(isset($aluno->POSSUI_TRATAMENTO) && $aluno->POSSUI_TRATAMENTO == 'S'){echo 'selected';}?>  value="S">Sim</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row divTratamento">
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" id="aluno_psicologo" value="S" aria-invalid="false" name="aluno_psicologo" <?php if(isset($aluno_tratamento->PSICOLOGO) && $aluno_tratamento->PSICOLOGO == "S"){echo "checked";}?>>
                                        <label for="aluno_psicologo">Psicólogo</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" id="aluno_fonoaudiologo" value="S" aria-invalid="false" name="aluno_fonoaudiologo" <?php if(isset($aluno_tratamento->FONOAUDIOLOGO) && $aluno_tratamento->FONOAUDIOLOGO == "S"){echo "checked";}?>>
                                        <label for="aluno_fonoaudiologo">Fonoaudiólogo</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" id="aluno_terapia" value="S" aria-invalid="false" name="aluno_terapia" <?php if(isset($aluno_tratamento->TERAPIA) && $aluno_tratamento->TERAPIA == "S"){echo "checked";}?>>
                                        <label for="aluno_terapia">Terapia Ocupacional</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <label class="form-check-label">Outros </label>
                                        <input type="text" class="form-control"  value="<?php echo isset($aluno_tratamento->OUTROS) ? $aluno_tratamento->OUTROS : '';?>" name="aluno_outros_tratamento" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Medicamento Contínuo *</label>
                                        <select class="form-control" name="aluno_possui_medicamento" id="aluno_possui_medicamento" required>
                                            <option <?php if(isset($aluno->POSSUI_MEDICAMENTO) && $aluno->POSSUI_MEDICAMENTO == 'N'){echo 'selected';}?>  value="N">Não</option>
                                            <option <?php if(isset($aluno->POSSUI_MEDICAMENTO) && $aluno->POSSUI_MEDICAMENTO == 'S'){echo 'selected';}?>  value="S">Sim</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row divMedicamento">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <label for="aluno_medicamento">Qual</label>
                                        <input type="text" class="form-control"  value="<?php echo isset($aluno_medicamento->OUTROS) ? $aluno_medicamento->OUTROS : '';?>" name="aluno_medicamento" required>
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