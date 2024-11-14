<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Profissional
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Profissional</a></li>
        <li class="breadcrumb-item active">Listagem</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php helper('mensagem');?>
        <div class="row">		
            <div class="col-12">         
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Profissional</h3>
                    <div class="box-controls pull-right">
                        <!-- <button id="row-remove" class="btn btn-xs btn-danger">Delete selected row</button> -->
                        <a href="/Profissional/Inserir"><button class="btn btn-md btn-info"><i class="fa fa-plus"></i> Novo</button></a>
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        <table id="tabela_padrao_datatable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                            <thead>
                                <tr>
                                    <th>Ações</th>
                                    <th>Nome</th>
                                    <th>Registro Geral - CPF</th>
                                    <th>Função</th>
                                    <th>Admissão</th>
                                    <th>Situação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if($resultados != ""){
                                        foreach ($resultados as $resultado) {
                                            echo '<tr>';
                                                echo '	<td align="center">';				
                                                echo '		<a href="/Profissional/Editar/'.base64_encode($resultado->ID_PROFISSIONAL).'" >';
                                                echo '<button class="btn btn-success btn-sm" title="Editar informações"><i class="fa fa-edit "></i></button>';
                                                echo '		</a>';
                                                echo '		<a href="/Profissional/Excluir/'.base64_encode($resultado->ID_PROFISSIONAL).'" onclick="return confirm(\'Deseja continuar?\')">';
                                                echo '<button class="btn btn-warning btn-sm" title="Editar informações"><i class="fa fa-trash "></i></button>';
                                                echo '		</a>';
                                                echo '		<a href="/Profissional/Foto/'.base64_encode($resultado->ID_PROFISSIONAL).'"">';
                                                echo '<button class="btn btn-primary btn-sm" title="Anexos"><i class="fa fa-file "></i></button>';
                                                echo '		</a>';
                                                echo '	</td>';
                                                echo '	<td>'.$resultado->NOME_PROFISSIONAL.'</td>';
                                                echo '	<td>'.$resultado->CPF.'</td>';
                                                echo '	<td>'.$resultado->PROFISSAO.'</td>';
                                                echo '	<td>'.inverterData($resultado->DATA_ADMISSAO).'</td>';
                                                if($resultado->DATA_DESLIGAMENTO != null && $resultado->DATA_DESLIGAMENTO != "0000-00-00"){
                                                    echo '	<td>Desligado</td>';
                                                }else{
                                                    echo '	<td>Admitido</td>';
                                                }
                                            echo '</tr>';
                                        }
                                    }
                                ?>
                            </tbody>				  
                        </table>
                        </div>              
                    </div>
                    <!-- /.box-body -->
                </div>
            <!-- /.box -->          
            </div>
            <!-- /.col -->
        </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="/template/js/escola.js"></script>