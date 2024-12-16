<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-paw"></i> Animais
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Animais</a></li>
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
                        <h3 class="box-title">Animais</h3>
                        <div class="box-controls pull-right">
                            <a href="/Animais/Inserir"><button class="btn btn-md btn-info"><i class="fa fa-plus"></i> Novo</button></a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="tabela_padrao_datatable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead>
                                    <tr>
                                        <th>Ações</th>
                                        <th>Identificação</th>
                                        <th>Nome</th>
                                        <th>Raça</th>
                                        <th>Sexo</th>
                                        <th>Peso Inicial</th>
                                        <th>Peso Atual</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if($resultados != ""){
                                        foreach ($resultados as $resultado) {
                                            echo '<tr>';
                                                echo '  <td align="center">';				
                                                echo '      <a href="/Animais/Editar/'.base64_encode($resultado->ID_PROFISSIONAL).'" >';
                                                echo '<button class="btn btn-success btn-sm" title="Editar informações"><i class="fa fa-edit"></i></button>';
                                                echo '      </a>';
                                                echo '      <a href="/Animais/Excluir/'.base64_encode($resultado->ID_PROFISSIONAL).'" onclick="return confirm(\'Deseja continuar?\')">';
                                                echo '<button class="btn btn-warning btn-sm" title="Excluir"><i class="fa fa-trash"></i></button>';
                                                echo '      </a>';
                                                echo '  </td>';
                                                echo '  <td>'.$resultado->IDENTIFICACAO.'</td>';
                                                echo '  <td>'.$resultado->NOME.'</td>';
                                                echo '  <td>'.$resultado->RACA.'</td>';
                                                echo '  <td>'.$resultado->SEXO.'</td>';
                                                echo '  <td>'.$resultado->PESO_INICIAL.' kg</td>';
                                                echo '  <td>'.$resultado->PESO_ATUAL.' kg</td>';
                                                echo '  <td>'.$resultado->STATUS.'</td>';
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
