<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-file"></i> Anexos
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Anexos</a></li>
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
                    <h3 class="box-title">Anexos - <?= $escola->ESCOLA; ?></h3>
                    <div class="box-controls pull-right">
                        <!-- <button id="row-remove" class="btn btn-xs btn-danger">Delete selected row</button> -->
                        <a href="/Escola/FotoInserir/<?php echo $id_escola; ?>"><button class="btn btn-md btn-info"><i class="fa fa-plus"></i> Novo</button></a>
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        <table id="tabela_padrao_datatable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                            <thead>
                                <tr>
                                    <th>Ações</th>
                                    <th>Anexos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if($resultados != ""){
                                        foreach ($resultados as $resultado) {
                                            echo '<tr>';
                                                echo '	<td align="center">';				
                                                echo '		<a target="_blank" href="'.LINK_UPLOAD.$resultado->NOME_ALEATORIO.'" >';
                                                echo '<button class="btn btn-secondary btn-list-icon" title="Visualizar"><i class="fa fa-eye "></i></button>';
                                                echo '		</a>';
                                                echo '		<a href="/Escola/FotoEditar/'.base64_encode($resultado->ID_DOCUMENTO_ESCOLA).'" >';
                                                echo '<button class="btn btn-success btn-list-icon" title="Editar informações"><i class="fa fa-edit "></i></button>';
                                                echo '		</a>';
                                                echo '<a href="'.base_url().'/Escola/FotoExcluir/'.base64_encode($resultado->ID_DOCUMENTO_ESCOLA).'/'.base64_encode($id_escola).'" class="btn btn-danger btn-list-icon" title="Excluir informação" onclick="return confirm(\'Tem certeza que deseja apagar?\');"><i class="fa fa-trash"></i></a>';
                                                echo '	</td>';
                                                echo '	<td>'.$resultado->DESCRICAO.'</td>';
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