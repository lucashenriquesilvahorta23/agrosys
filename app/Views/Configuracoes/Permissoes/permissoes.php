<?php
    if(isset($_GET['idusuario'])){
        $idusuario = $_GET['idusuario'];
    }else{
        $idusuario = 0;
    }
?>
<style>
    ol{
        list-style: none;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Permissões
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Configurações</a></li>
        <li class="breadcrumb-item active">Permissões</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php helper('mensagem');?>
        <div class="row">	
            <div class="col-lg-12 col-12">
                <div class="box box-solid bg-login">
                    <div class="box-header with-border">
                        <h4 class="box-title">Permissões de usuários</h4>			
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>	
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                        <form novalidate action="/Configuracoes/Permissoes/permissoesInserir" method="POST" id="frmPermissoes"> 
                        <?= csrf_field() ?>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Usuário</h5>
                                            <div class="controls">
                                                <select name="permissoes_usuarios" id="permissoes_usuarios" required class="form-control select2" data-validation-required-message="Campo obrigatório">
                                                    <option value="">Selecione um usuário</option>
                                                    <?php 
                                                        foreach ($usuarios as $usuario) {
                                                            if($idusuario==$usuario->ID_USUARIO){$selected='selected';}else{$selected='';}
                                                            echo "<option ".$selected." value=".$usuario->ID_USUARIO.">".$usuario->NOME."</option>";
                                                        }
                                                    ?>
                                                </select>
                                                <div class="help-block">Selecione um usuário para definir as permissões</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Escola</h5>
                                            <div class="controls">
                                                <select name="profissional_escola" id="profissional_escola" class="form-control select2">
                                                    <option value="">Selecione uma escola</option>
                                                    <?php 
                                                        foreach ($escolas as $escola) {
                                                            echo "<option value=".$escola->ID_ESCOLA.">".$escola->ESCOLA."</option>";
                                                        }
                                                    ?>
                                                </select>
                                                <div class="help-block">Selecione uma escola</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Perfil</h5>
                                            <div class="controls">
                                                <select name="permissoes_perfil" id="permissoes_perfil" class="form-control select2">
                                                    <option value="">Selecione um perfil</option>
                                                    <?php 
                                                        foreach ($perfis as $perfil) {
                                                            echo "<option value=".$perfil->ID_PERFIL.">".$perfil->DESCRICAO."</option>";
                                                        }
                                                    ?>
                                                </select>
                                                <div class="help-block">Selecione um perfil para permissões pré-selecionados</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <fieldset>
                                            <input type="checkbox" id="permissoes_chk_all">
                                            <label for="permissoes_chk_all">Marcar todas as opções</label>
                                        </fieldset>
                                        <div class="row">
                                            <div class="col-md-4">
                                            <!-- Default box -->
                                                <div class="box">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">Configurações</h4>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="myadmin-dd">
                                                            <ol class="dd-list">
                                                                <li class="dd-item">
                                                                    <div class="dd-handle collapsed" data-toggle="collapse" data-target="#profissao" aria-expanded="false" aria-controls="profissao"><i class="fa fa-plus"></i> Profisssão</div>
                                                                    <ol class="dd-list controls collapse" id="profissao" aria-expanded="false" class="collapse">
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="profissaos_chk_cons" value="31" class="checkboxes" name="checkperm[]">
                                                                                    <label for="profissaos_chk_cons">Consultar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="profissao_chk_ins" value="32" class="checkboxes" name="checkperm[]">
                                                                                    <label for="profissao_chk_ins">Inserir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="profissao_chk_edt" value="33" class="checkboxes" name="checkperm[]">
                                                                                    <label for="profissao_chk_edt">Editar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="profissao_chk_exc" value="34" class="checkboxes" name="checkperm[]">
                                                                                    <label for="profissao_chk_exc">Excluir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                    </ol>
                                                                </li>
                                                            </ol>
                                                            <ol class="dd-list">
                                                                <li class="dd-item">
                                                                    <div class="dd-handle collapsed" data-toggle="collapse" data-target="#usuario" aria-expanded="false" aria-controls="usuario"><i class="fa fa-plus"></i> Usuários</div>
                                                                    <ol class="dd-list controls collapse" id="usuario" aria-expanded="false" class="collapse">
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="usuarios_chk_cons" value="2" class="checkboxes" name="checkperm[]">
                                                                                    <label for="usuarios_chk_cons">Consultar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="usuario_chk_ins" value="3" class="checkboxes" name="checkperm[]">
                                                                                    <label for="usuario_chk_ins">Inserir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="usuario_chk_edt" value="4" class="checkboxes" name="checkperm[]">
                                                                                    <label for="usuario_chk_edt">Editar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                    </ol>
                                                                </li>
                                                            </ol>
                                                            <ol class="dd-list">
                                                                <li class="dd-item">
                                                                    <div class="dd-handle collapsed" data-toggle="collapse" data-target="#permissoes" aria-expanded="false" aria-controls="permissoes"><i class="fa fa-plus"></i> Permissões</div>
                                                                    <ol class="dd-list controls collapse" id="permissoes" aria-expanded="false" class="collapse">
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="permissoes_chk_cons" value="5" class="checkboxes" name="checkperm[]">
                                                                                    <label for="permissoes_chk_cons">Consultar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="permissoes_chk_mod" value="6" class="checkboxes" name="checkperm[]">
                                                                                    <label for="permissoes_chk_mod">Modificar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                    </ol>
                                                                </li>
                                                            </ol>
                                                            <ol class="dd-list">
                                                                <li class="dd-item">
                                                                    <div class="dd-handle collapsed" data-toggle="collapse" data-target="#perfil" aria-expanded="false" aria-controls="perfil"><i class="fa fa-plus"></i> Perfil</div>
                                                                    <ol class="dd-list controls collapse" id="perfil" aria-expanded="false" class="collapse">
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="perfil_chk_cons" value="7" class="checkboxes" name="checkperm[]">
                                                                                    <label for="perfil_chk_cons">Consultar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                    </ol>
                                                                </li>
                                                            </ol>
                                                            <ol class="dd-list">
                                                                <li class="dd-item">
                                                                    <div class="dd-handle collapsed" data-toggle="collapse" data-target="#senha" aria-expanded="false" aria-controls="senha"><i class="fa fa-plus"></i> Alterar Senha</div>
                                                                    <ol class="dd-list controls collapse" id="senha" aria-expanded="false" class="collapse">
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="senha_chk_cons" value="52" class="checkboxes" name="checkperm[]">
                                                                                    <label for="senha_chk_cons">Consultar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                    </ol>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4">
                                            <!-- Default box -->
                                                <div class="box">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">Escola</h4>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="myadmin-dd">
                                                            <ol class="dd-list">
                                                                <li class="dd-item">
                                                                    <div class="dd-handle collapsed" data-toggle="collapse" data-target="#escola" aria-expanded="false" aria-controls="escola"><i class="fa fa-plus"></i> Escola</div>
                                                                    <ol class="dd-list controls collapse" id="escola" aria-expanded="false" class="collapse">
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="escola_chk_cons" value="21" class="checkboxes" name="checkperm[]">
                                                                                    <label for="escola_chk_cons">Consultar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="escola_chk_ins" value="22" class="checkboxes" name="checkperm[]">
                                                                                    <label for="escola_chk_ins">Inserir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="escola_chk_edt" value="23" class="checkboxes" name="checkperm[]">
                                                                                    <label for="escola_chk_edt">Editar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="escola_chk_exc" value="24" class="checkboxes" name="checkperm[]">
                                                                                    <label for="escola_chk_exc">Excluir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                    </ol>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4">
                                            <!-- Default box -->
                                                <div class="box">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">Ano</h4>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="myadmin-dd">
                                                            <ol class="dd-list">
                                                                <li class="dd-item">
                                                                    <div class="dd-handle collapsed" data-toggle="collapse" data-target="#ano" aria-expanded="false" aria-controls="ano"><i class="fa fa-plus"></i> Ano</div>
                                                                    <ol class="dd-list controls collapse" id="ano" aria-expanded="false" class="collapse">
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="ano_chk_cons" value="9" class="checkboxes" name="checkperm[]">
                                                                                    <label for="ano_chk_cons">Consultar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="ano_chk_ins" value="10" class="checkboxes" name="checkperm[]">
                                                                                    <label for="ano_chk_ins">Inserir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="ano_chk_edt" value="11" class="checkboxes" name="checkperm[]">
                                                                                    <label for="ano_chk_edt">Editar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="ano_chk_exc" value="12" class="checkboxes" name="checkperm[]">
                                                                                    <label for="ano_chk_exc">Excluir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                    </ol>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                            <!-- Default box -->
                                                <div class="box">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">Turmas</h4>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="myadmin-dd">
                                                            <ol class="dd-list">
                                                                <li class="dd-item">
                                                                    <div class="dd-handle collapsed" data-toggle="collapse" data-target="#Turmas" aria-expanded="false" aria-controls="Turmas"><i class="fa fa-plus"></i> Turmas</div>
                                                                    <ol class="dd-list controls collapse" id="Turmas" aria-expanded="false" class="collapse">
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="Turmas_chk_cons" value="13" class="checkboxes" name="checkperm[]">
                                                                                    <label for="Turmas_chk_cons">Consultar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="Turmas_chk_ins" value="14" class="checkboxes" name="checkperm[]">
                                                                                    <label for="Turmas_chk_ins">Inserir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="Turmas_chk_edt" value="15" class="checkboxes" name="checkperm[]">
                                                                                    <label for="Turmas_chk_edt">Editar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="Turmas_chk_exc" value="16" class="checkboxes" name="checkperm[]">
                                                                                    <label for="Turmas_chk_exc">Excluir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                    </ol>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4">
                                            <!-- Default box -->
                                                <div class="box">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">Profissionais</h4>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="myadmin-dd">
                                                            <ol class="dd-list">
                                                                <li class="dd-item">
                                                                    <div class="dd-handle collapsed" data-toggle="collapse" data-target="#Profissionais" aria-expanded="false" aria-controls="Profissionais"><i class="fa fa-plus"></i> Profissionais</div>
                                                                    <ol class="dd-list controls collapse" id="Profissionais" aria-expanded="false" class="collapse">
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="Profissionais_chk_cons" value="17" class="checkboxes" name="checkperm[]">
                                                                                    <label for="Profissionais_chk_cons">Consultar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="Profissionais_chk_ins" value="18" class="checkboxes" name="checkperm[]">
                                                                                    <label for="Profissionais_chk_ins">Inserir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="Profissionais_chk_edt" value="19" class="checkboxes" name="checkperm[]">
                                                                                    <label for="Profissionais_chk_edt">Editar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="Profissionais_chk_exc" value="20" class="checkboxes" name="checkperm[]">
                                                                                    <label for="Profissionais_chk_exc">Excluir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                    </ol>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4">
                                            <!-- Default box -->
                                                <div class="box">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">Alunos</h4>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="myadmin-dd">
                                                            <ol class="dd-list">
                                                                <li class="dd-item">
                                                                    <div class="dd-handle collapsed" data-toggle="collapse" data-target="#Alunos" aria-expanded="false" aria-controls="Alunos"><i class="fa fa-plus"></i> Alunos</div>
                                                                    <ol class="dd-list controls collapse" id="Alunos" aria-expanded="false" class="collapse">
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="Alunos_chk_cons" value="25" class="checkboxes" name="checkperm[]">
                                                                                    <label for="Alunos_chk_cons">Consultar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="Alunos_chk_ins" value="26" class="checkboxes" name="checkperm[]">
                                                                                    <label for="Alunos_chk_ins">Inserir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="Alunos_chk_edt" value="27" class="checkboxes" name="checkperm[]">
                                                                                    <label for="Alunos_chk_edt">Editar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="Alunos_chk_exc" value="28" class="checkboxes" name="checkperm[]">
                                                                                    <label for="Alunos_chk_exc">Excluir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="Alunos_chk_vinc" value="29" class="checkboxes" name="checkperm[]">
                                                                                    <label for="Alunos_chk_vinc">Vinculo</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="Alunos_chk_conc" value="30" class="checkboxes" name="checkperm[]">
                                                                                    <label for="Alunos_chk_conc">Concluir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                    </ol>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4">
                                            <!-- Default box -->
                                                <div class="box">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">Ocorrências</h4>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="myadmin-dd">
                                                            <ol class="dd-list">
                                                                <li class="dd-item">
                                                                    <div class="dd-handle collapsed" data-toggle="collapse" data-target="#ocorrencia" aria-expanded="false" aria-controls="ocorrencia"><i class="fa fa-plus"></i> Ocorrências</div>
                                                                    <ol class="dd-list controls collapse" id="ocorrencia" aria-expanded="false" class="collapse">
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="ocorrencia_chk_cons" value="57" class="checkboxes" name="checkperm[]">
                                                                                    <label for="ocorrencia_chk_cons">Consultar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="ocorrencia_chk_ins" value="56" class="checkboxes" name="checkperm[]">
                                                                                    <label for="ocorrencia_chk_ins">Inserir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="ocorrencia_chk_edt" value="54" class="checkboxes" name="checkperm[]">
                                                                                    <label for="ocorrencia_chk_edt">Editar</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="ocorrencia_chk_exc" value="53" class="checkboxes" name="checkperm[]">
                                                                                    <label for="ocorrencia_chk_exc">Excluir</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </li>
                                                                    </ol>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4">
                                            <!-- Default box -->
                                                <div class="box">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">Relatórios</h4>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="myadmin-dd">
                                                        <ol class="dd-list">
                                                            <!-- Documento: Ata de Resultados Finais -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#ataresultados" aria-expanded="false" aria-controls="ataresultados">
                                                                    <i class="fa fa-plus"></i> Ata de Resultados Finais
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="ataresultados" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="ataresultados_chk_cons" value="35" class="checkboxes" name="checkperm[]">
                                                                                <label for="ataresultados_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>
                                                            
                                                            <!-- Documento: Declaração de Conclusão -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#declaracaoConclusao" aria-expanded="false" aria-controls="declaracaoConclusao">
                                                                    <i class="fa fa-plus"></i> Declaração de Conclusão
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="declaracaoConclusao" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="declaracaoConclusao_chk_cons" value="36" class="checkboxes" name="checkperm[]">
                                                                                <label for="declaracaoConclusao_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>

                                                            <!-- Documento: Declaração de Frequência -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#declaracaoFrequencia" aria-expanded="false" aria-controls="declaracaoFrequencia">
                                                                    <i class="fa fa-plus"></i> Declaração de Frequência
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="declaracaoFrequencia" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="declaracaoFrequencia_chk_cons" value="37" class="checkboxes" name="checkperm[]">
                                                                                <label for="declaracaoFrequencia_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>

                                                            <!-- Documento: Declaração para Transferência em Curso -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#declaracaoTransferencia" aria-expanded="false" aria-controls="declaracaoTransferencia">
                                                                    <i class="fa fa-plus"></i> Declaração para Transferência em Curso
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="declaracaoTransferencia" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="declaracaoTransferencia_chk_cons" value="38" class="checkboxes" name="checkperm[]">
                                                                                <label for="declaracaoTransferencia_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>

                                                            <!-- Documento: Encaminhamento NIS -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#encaminhamentoNIS" aria-expanded="false" aria-controls="encaminhamentoNIS">
                                                                    <i class="fa fa-plus"></i> Encaminhamento NIS
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="encaminhamentoNIS" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="encaminhamentoNIS_chk_cons" value="39" class="checkboxes" name="checkperm[]">
                                                                                <label for="encaminhamentoNIS_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>

                                                            <!-- Documento: Ficha de Diagnóstico de Alunos com Patologias Específicas -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#fichaDiagnostico" aria-expanded="false" aria-controls="fichaDiagnostico">
                                                                    <i class="fa fa-plus"></i> Ficha de Diagnóstico de Alunos com Patologias Específicas
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="fichaDiagnostico" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="fichaDiagnostico_chk_cons" value="40" class="checkboxes" name="checkperm[]">
                                                                                <label for="fichaDiagnostico_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>

                                                            <!-- Documento: Ficha de Matrícula -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#fichaMatricula" aria-expanded="false" aria-controls="fichaMatricula">
                                                                    <i class="fa fa-plus"></i> Ficha do Aluno
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="fichaMatricula" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="fichaMatricula_chk_cons" value="41" class="checkboxes" name="checkperm[]">
                                                                                <label for="fichaMatricula_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>

                                                            <!-- Documento: Registro das Vivências Desenvolvidas -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#registroVivencias" aria-expanded="false" aria-controls="registroVivencias">
                                                                    <i class="fa fa-plus"></i> Registro das Vivências Desenvolvidas
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="registroVivencias" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="registroVivencias_chk_cons" value="42" class="checkboxes" name="checkperm[]">
                                                                                <label for="registroVivencias_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>

                                                            <!-- Documento: Relatório de Aluno por Turma -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#relatorioAlunoTurma" aria-expanded="false" aria-controls="relatorioAlunoTurma">
                                                                    <i class="fa fa-plus"></i> Relatório de Aluno por Turma
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="relatorioAlunoTurma" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="relatorioAlunoTurma_chk_cons" value="43" class="checkboxes" name="checkperm[]">
                                                                                <label for="relatorioAlunoTurma_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>

                                                            <!-- Documento: Relatório de Alunos com Patologias Específicas -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#relatorioAlunosPatologias" aria-expanded="false" aria-controls="relatorioAlunosPatologias">
                                                                    <i class="fa fa-plus"></i> Relatório de Alunos com Patologias Específicas
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="relatorioAlunosPatologias" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="relatorioAlunosPatologias_chk_cons" value="44" class="checkboxes" name="checkperm[]">
                                                                                <label for="relatorioAlunosPatologias_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>

                                                            <!-- Documento: Relatório de Alunos -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#relatorioAlunos" aria-expanded="false" aria-controls="relatorioAlunos">
                                                                    <i class="fa fa-plus"></i> Relatório de Alunos
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="relatorioAlunos" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="relatorioAlunos_chk_cons" value="45" class="checkboxes" name="checkperm[]">
                                                                                <label for="relatorioAlunos_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>

                                                            <!-- Documento: Relatório de Frequência -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#relatorioFrequencia" aria-expanded="false" aria-controls="relatorioFrequencia">
                                                                    <i class="fa fa-plus"></i> Relatório de Frequência
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="relatorioFrequencia" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="relatorioFrequencia_chk_cons" value="46" class="checkboxes" name="checkperm[]">
                                                                                <label for="relatorioFrequencia_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>

                                                            <!-- Documento: Relatório de Ocorrências -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#relatorioOcorrencias" aria-expanded="false" aria-controls="relatorioOcorrencias">
                                                                    <i class="fa fa-plus"></i> Relatório de Ocorrências
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="relatorioOcorrencias" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="relatorioOcorrencias_chk_cons" value="47" class="checkboxes" name="checkperm[]">
                                                                                <label for="relatorioOcorrencias_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>

                                                            <!-- Documento: Relatório de Profissionais -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#relatorioProfissionais" aria-expanded="false" aria-controls="relatorioProfissionais">
                                                                    <i class="fa fa-plus"></i> Relatório de Profissionais
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="relatorioProfissionais" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="relatorioProfissionais_chk_cons" value="48" class="checkboxes" name="checkperm[]">
                                                                                <label for="relatorioProfissionais_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>

                                                            <!-- Documento: Relatório de Turmas -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#relatorioTurmas" aria-expanded="false" aria-controls="relatorioTurmas">
                                                                    <i class="fa fa-plus"></i> Relatório de Turmas
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="relatorioTurmas" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="relatorioTurmas_chk_cons" value="49" class="checkboxes" name="checkperm[]">
                                                                                <label for="relatorioTurmas_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>

                                                            <!-- Documento: Termo de Autorização para Uso de Imagem -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#termoAutorizacaoImagem" aria-expanded="false" aria-controls="termoAutorizacaoImagem">
                                                                    <i class="fa fa-plus"></i> Termo de Autorização para Uso de Imagem
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="termoAutorizacaoImagem" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="termoAutorizacaoImagem_chk_cons" value="50" class="checkboxes" name="checkperm[]">
                                                                                <label for="termoAutorizacaoImagem_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>

                                                            <!-- Documento: Termo de Compromisso -->
                                                            <li class="dd-item">
                                                                <div class="dd-handle collapsed" data-toggle="collapse" data-target="#termoCompromisso" aria-expanded="false" aria-controls="termoCompromisso">
                                                                    <i class="fa fa-plus"></i> Termo de Compromisso
                                                                </div>
                                                                <ol class="dd-list controls collapse" id="termoCompromisso" aria-expanded="false" class="collapse">
                                                                    <li class="dd-item">
                                                                        <div class="dd-handle collapsed">
                                                                            <fieldset>
                                                                                <input type="checkbox" id="termoCompromisso_chk_cons" value="51" class="checkboxes" name="checkperm[]">
                                                                                <label for="termoCompromisso_chk_cons">Consultar</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            </li>
                                                        </ol>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer text-right">
                            <button type="button" id="gravar_permissoes" class="btn btn-primary btn-outline">
                                <i class="fa fa-save"></i> Salvar
                            </button>
                        </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>     <!-- /.box -->
<script src="/template/js/permissao.js"></script>