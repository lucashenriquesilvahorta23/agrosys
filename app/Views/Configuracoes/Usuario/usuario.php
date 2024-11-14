<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-globe"></i> Usuarios
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
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
                    <h3 class="box-title">Usuarios</h3>
                    <div class="box-controls pull-right">
                        <!-- <button id="row-remove" class="btn btn-xs btn-danger">Delete selected row</button> -->
                        <a href="/Configuracoes/Usuario/Inserir"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Novo</button></a>
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        <table id="usuario" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                            <thead>
                                <tr>
                                    <th>Ações</th>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Usuario</th>
                                    <th>Tipo</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if($resultados != ""){
                                        foreach ($resultados as $resultado) {
                                            echo '<tr>';
                                                echo '	<td align="center">';				
                                                echo '		<a href="/Configuracoes/Usuario/Editar/'.base64_encode($resultado->ID_USUARIO).'" >';
                                                echo '<button class="btn btn-success btn-xs" title="Editar informações"><i class="fa fa-edit"></i></button>';
                                                echo '		</a>';
                                                echo '	</td>';
                                                echo '	<td>'.$resultado->ID_USUARIO.'</td>';
                                                echo '	<td>'.mb_strtoupper($resultado->NOME,'UTF-8').'</td>';
                                                echo '	<td>'.$resultado->USUARIO.'</td>';
                                                echo '	<td>'.cargo($resultado->TIPO).'</td>';
                                                echo '	<td>'.status($resultado->ATIVO).'</td>';
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
  <script src="/template/js/usuario.js"></script>