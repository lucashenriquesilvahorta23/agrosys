<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> Aluno
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Aluno</a></li>
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
                    <h3 class="box-title">Alunos</h3>
                    <div class="box-controls pull-right">
                        <!-- <button id="row-remove" class="btn btn-xs btn-danger">Delete selected row</button> -->
                        <a href="/Aluno/Inserir"><button class="btn btn-md btn-info"><i class="fa fa-plus"></i> Novo</button></a>
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        <table id="tabela_padrao_datatable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                            <thead>
                                <tr>
                                    <th>Ações</th>
                                    <th>Aluno</th>
                                    <th>Registro Geral - CPF</th>
                                    <th>Nascimento</th>
                                    <th>Sexo</th>
                                    <th>Telefone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if($resultados != ""){
                                        foreach ($resultados as $resultado) {
                                            echo '<tr>';
                                                echo '	<td align="center">';				
                                                echo '		<a href="/Aluno/Editar/'.base64_encode($resultado->ID_ALUNO).'" >';
                                                echo '<button class="btn btn-success btn-sm" title="Editar informações"><i class="fa fa-edit "></i></button>';
                                                echo '		</a>';
                                                echo '		</a>';
                                                // echo '		<a target="_blank" href="/Aluno/DeclaracaoConclusao/'.base64_encode($resultado->ID_ALUNO).'" >';
                                                // echo '<button class="btn btn-primary btn-sm" title="DECLARAÇÃO DE CONCLUSÃO"><i class="fa fa-file "></i></button>';
                                                // echo '		</a>';
                                                // echo '		<a target="_blank" href="/Aluno/DeclaracaoFrequencia/'.base64_encode($resultado->ID_ALUNO).'" >';
                                                // echo '<button class="btn btn-primary btn-sm" title="DECLARAÇÃO DE FREQUÊNCIA DO ALUNO"><i class="fa fa-file "></i></button>';
                                                // echo '		</a>';
                                                // echo '		<a target="_blank" href="/Aluno/DeclaracaoTransferencia/'.base64_encode($resultado->ID_ALUNO).'" >';
                                                // echo '<button class="btn btn-primary btn-sm" title="DECLARAÇÃO DE TRANSFERÊNCIA DE ALUNO"><i class="fa fa-file "></i></button>';
                                                // echo '		</a>';
                                                // echo '		<a target="_blank" href="/Aluno/Encaminhamento/'.base64_encode($resultado->ID_ALUNO).'" >';
                                                // echo '<button class="btn btn-primary btn-sm" title="ENCAMINHAMENTO"><i class="fa fa-file "></i></button>';
                                                // echo '		</a>';
                                                echo '		<a href="/Aluno/Excluir/'.base64_encode($resultado->ID_ALUNO).'" onclick="return confirm(\'Deseja continuar?\')">';
                                                echo '<button class="btn btn-warning btn-sm" title="EXcluir informações"><i class="fa fa-trash "></i></button>';
                                                echo '		</a>';
                                                echo '		<a href="/Aluno/Vinculo/'.base64_encode($resultado->ID_ALUNO).'"">';
                                                echo '<button class="btn btn-secondary btn-sm" title="Visualizar vinculos"><i class="fa fa-eye "></i></button>';
                                                echo '		</a>';
                                                echo '		<a href="/Aluno/Foto/'.base64_encode($resultado->ID_ALUNO).'"">';
                                                echo '<button class="btn btn-primary btn-sm" title="Anexos"><i class="fa fa-file "></i></button>';
                                                echo '		</a>';
                                                echo '	</td>';
                                                echo '	<td>'.$resultado->NOME_ALUNO.'</td>';
                                                echo '	<td>'.$resultado->CPF.'</td>';
                                                echo '	<td>'.inverterData($resultado->DATA_NASCIMENTO).'</td>';
                                                echo '	<td>'.$resultado->SEXO.'</td>';
                                                if($resultado->RESPONSAVEL_LEGAL_TELEFONE != "" && $resultado->RESPONSAVEL_LEGAL_TELEFONE !=null){
                                                    echo '	<td>'.$resultado->RESPONSAVEL_LEGAL_TELEFONE.'</td>';
                                                }else if($resultado->FILIACAO_1_TELEFONE != "" && $resultado->FILIACAO_1_TELEFONE !=null){
                                                    echo '	<td>'.$resultado->FILIACAO_1_TELEFONE.'</td>';
                                                }else{
                                                    echo '	<td>'.$resultado->FILIACAO_2_TELEFONE.'</td>';
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