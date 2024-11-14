<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> Vinculo
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Vinculo</a></li>
        <li class="breadcrumb-item active">Listagem</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">		
            <div class="col-12">         
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Vinculo - <?= $aluno->NOME_ALUNO; ?></h3>
                    <div class="box-controls pull-right">
                        <!-- <button id="row-remove" class="btn btn-xs btn-danger">Delete selected row</button> -->
                        <a <?php echo 'href="/Aluno/InserirVinculo/'.$id_aluno.'"'; ?>><button class="btn btn-md btn-info"><i class="fa fa-plus"></i> Novo</button></a>
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        <table id="tabela_padrao_datatable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                            <thead>
                                <tr>
                                    <th>Ações</th>
                                    <th>Ano letivo</th>
                                    <th>Etapa</th>
                                    <th>Turma</th>
                                    <th>Turno</th>
                                    <th>Data Matric. / Rematric.</th>
                                    <th>Situação</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if($resultados != ""){
                                        foreach ($resultados as $resultado) {
                                            echo '<tr>';
                                                echo '	<td align="center">';				
                                                echo '    <a href="/Aluno/ConcluirAluno/'.base64_encode($resultado->ID_ALUNO_TURMA).'" onclick="return confirm(\'Você tem certeza que deseja concluir?\');">';
                                                echo '        <button class="btn btn-success btn-sm" title="Concluir"><i class="fa fa-check "></i></button>';
                                                echo '    </a>';
                                                echo '    <a href="/Aluno/TransferenciaVinculo/'.base64_encode($resultado->ID_ALUNO_TURMA).'/TR" onclick="return confirm(\'Você tem certeza que deseja transferir o aluno?\');">';
                                                echo '        <button class="btn btn-warning btn-sm" title="Transferir aluno"><i class="fa fa-repeat "></i></button>';
                                                echo '    </a>';
                                                echo '    <a href="/Aluno/TransferenciaVinculo/'.base64_encode($resultado->ID_ALUNO_TURMA).'/EV" onclick="return confirm(\'Você tem certeza que deseja evadir o aluno?\');">';
                                                echo '        <button class="btn btn-secondary btn-sm" title="Evadir aluno"><i class="fa fa-minus "></i></button>';
                                                echo '    </a>';
                                                echo '    <a href="/Aluno/TransferenciaVinculo/'.base64_encode($resultado->ID_ALUNO_TURMA).'/FL" onclick="return confirm(\'Você tem certeza que deseja marcar como falecido?\');">';
                                                echo '        <button class="btn btn-dark btn-sm" title="Marcar como falecido"><i class="fa fa-close "></i></button>';
                                                echo '    </a>';
                                                echo '    <a href="/Aluno/ExcluirVinculo/'.base64_encode($resultado->ID_ALUNO_TURMA).'" onclick="return confirm(\'Você tem certeza que deseja excluir as informações?\');">';
                                                echo '        <button class="btn btn-danger btn-sm" title="EXcluir informações"><i class="fa fa-trash "></i></button>';
                                                echo '    </a>';
                                                echo '	</td>';
                                                echo '	<td>'.$resultado->ANO_LETIVO.'</td>';
                                                $etapa = $resultado->ETAPA;

                                                if ($etapa == 'I1') {
                                                    echo '<td>Ed. Infantil I – 4 Anos</td>';
                                                } elseif ($etapa == 'I2') {
                                                    echo '<td>Ed. Infantil II – 5 Anos</td>';
                                                } elseif ($etapa == 'C1') {
                                                    echo '<td>Creche I – 1 Ano</td>';
                                                } elseif ($etapa == 'C2') {
                                                    echo '<td>Creche II – 2 Anos</td>';
                                                } elseif ($etapa == 'C3') {
                                                    echo '<td>Creche III – 3 Anos</td>';
                                                } elseif ($etapa == 'F1') {
                                                    echo '<td>Fundamental I</td>';
                                                } elseif ($etapa == 'F2') {
                                                    echo '<td>Fundamental II</td>';
                                                } elseif ($etapa == 'M1') {
                                                    echo '<td>Médio I</td>';
                                                } elseif ($etapa == 'M2') {
                                                    echo '<td>Médio II</td>';
                                                } else {
                                                    echo '<td>Não informado</td>';
                                                }
                                                echo '	<td>'.$resultado->NOME_TURMA.'</td>';
                                                
                                                $tipo_atendimento = $resultado->TIPO_ATENDIMENTO;

                                                if ($tipo_atendimento == 'IN') {
                                                    echo '<td>Integral</td>';
                                                } elseif ($tipo_atendimento == 'PM') {
                                                    echo '<td>Parcial Matutino</td>';
                                                } elseif ($tipo_atendimento == 'PV') {
                                                    echo '<td>Parcial Vespertino</td>';
                                                } elseif ($tipo_atendimento == 'PA') {
                                                    echo '<td>Parcial</td>';
                                                } elseif ($tipo_atendimento == 'ND') {
                                                    echo '<td>Noturno</td>';
                                                } elseif ($tipo_atendimento == 'DU') {
                                                    echo '<td>Dupla Jornada</td>';
                                                } elseif ($tipo_atendimento == 'SE') {
                                                    echo '<td>Semi-integral</td>';
                                                } else {
                                                    echo '<td>Não informado</td>';
                                                }


                                                echo '	<td>'.inverterData($resultado->DATA_MATRICULA).'</td>';   

                                                $situacao = $resultado->SITUACAO;

                                                if ($situacao == 'CU') {
                                                    echo '<td>Cursando</td>';
                                                } elseif ($situacao == 'CO') {
                                                    echo '<td>Concluido</td>';
                                                } elseif ($situacao == 'TR') {
                                                    echo '<td>Transferido</td>';
                                                }  elseif ($situacao == 'EV') {
                                                    echo '<td>Evadido</td>';
                                                }  elseif ($situacao == 'FL') {
                                                    echo '<td>Falecido</td>';
                                                } 
                                             
                                                echo '	<td>'.inverterData($resultado->DATA_ALTERACAO_SITUACAO).'</td>';  
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