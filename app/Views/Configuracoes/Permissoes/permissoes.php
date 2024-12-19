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
                                            <h5>Fazenda</h5>
                                            <div class="controls">
                                                <select name="profissional_escola" id="profissional_escola" class="form-control select2">
                                                    <option value="">Selecione uma fazenda</option>
                                                    <?php 
                                                        foreach ($escolas as $escola) {
                                                            echo "<option value=".$escola->ID_ESCOLA.">".$escola->NOME."</option>";
                                                        }
                                                    ?>
                                                </select>
                                                <div class="help-block">Selecione uma fazenda</div>
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
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4">
                                            <!-- Default box -->
                                                <div class="box">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">Fazenda</h4>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="myadmin-dd">
                                                            <ol class="dd-list">
                                                                <li class="dd-item">
                                                                    <div class="dd-handle collapsed" data-toggle="collapse" data-target="#escola" aria-expanded="false" aria-controls="escola"><i class="fa fa-plus"></i> Fazenda</div>
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
                                                        <h4 class="box-title">Lotes</h4>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="myadmin-dd">
                                                            <ol class="dd-list">
                                                                <li class="dd-item">
                                                                    <div class="dd-handle collapsed" data-toggle="collapse" data-target="#ano" aria-expanded="false" aria-controls="ano"><i class="fa fa-plus"></i> Lotes</div>
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
                                                        <h4 class="box-title">Animais</h4>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="myadmin-dd">
                                                            <ol class="dd-list">
                                                                <li class="dd-item">
                                                                    <div class="dd-handle collapsed" data-toggle="collapse" data-target="#Profissionais" aria-expanded="false" aria-controls="Profissionais"><i class="fa fa-plus"></i> Animais</div>
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
                                                        <h4 class="box-title">Procedimentos</h4>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="myadmin-dd">
                                                            <ol class="dd-list">
                                                                <li class="dd-item">
                                                                    <div class="dd-handle collapsed" data-toggle="collapse" data-target="#procedimentos" aria-expanded="false" aria-controls="procedimentos"><i class="fa fa-plus"></i> Procedimentos</div>
                                                                    <ol class="dd-list controls collapse" id="procedimentos" aria-expanded="false" class="collapse">
                                                                        <li class="dd-item">
                                                                            <div class="dd-handle collapsed">
                                                                                <fieldset>
                                                                                    <input type="checkbox" id="procedimentos_chk_cons" value="58" class="checkboxes" name="checkperm[]">
                                                                                    <label for="procedimentos_chk_cons">Consultar</label>
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