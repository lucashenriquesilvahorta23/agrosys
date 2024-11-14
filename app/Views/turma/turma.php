<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-th"></i> Turma
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Turma</a></li>
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
                    <h3 class="box-title">Turma</h3>
                    <div class="box-controls pull-right">
                        <!-- <button id="row-remove" class="btn btn-xs btn-danger">Delete selected row</button> -->
                        <a href="/Turma/Inserir"><button class="btn btn-md btn-info"><i class="fa fa-plus"></i> Novo</button></a>
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        <table id="tabela_padrao_datatable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Ações</th>
                                    <th>Ano letivo</th>
                                    <th>Etapa</th>
                                    <th>Turma</th>
                                    <th>Turno</th>
                                    <th>Professor</th>
                                    <th>Alunos Vinculados</th>
                                    <th>Vagas Disponíveis</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if($resultados != ""){
                                        foreach ($resultados as $resultado) {
                                            echo '<tr>';
                                                echo '  <td align="center" style="white-space: nowrap;">';  // No-wrap aplicado aqui
                                                echo '      <a href="/aluno/getAlunoturma/'.base64_encode($resultado['ID_TURMA']).'">';
                                                echo '<button class="btn btn-secondary btn-sm" title="Visualizar alunos"><i class="fa fa-eye"></i></button>';
                                                echo '		</a>';
                                                echo '      <a href="/Turma/Editar/'.base64_encode($resultado['ID_TURMA']).'">';
                                                echo '<button class="btn btn-success btn-sm" title="Editar informações"><i class="fa fa-edit"></i></button>';
                                                echo '      </a>';
                                                echo '      <a href="/Turma/Excluir/'.base64_encode($resultado['ID_TURMA']).'" onclick="return confirm(\'Deseja continuar?\')">';
                                                echo '<button class="btn btn-warning btn-sm" title="Excluir informações"><i class="fa fa-trash"></i></button>';
                                                echo '      </a>';
                                                echo '  </td>';
                                                echo '  <td>'.$resultado['ANO_LETIVO'].'</td>';
                                                
                                                // Tratamento da Etapa
                                                $etapa = $resultado['ETAPA'];
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

                                                echo '  <td>'.$resultado['NOME_TURMA'].'</td>';
                                                
                                                // Tratamento do Turno
                                                $tipo_atendimento = $resultado['TIPO_ATENDIMENTO'];
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

                                                echo '  <td>'.$resultado['PROFESSOR'].'</td>';                                                
                                                echo '  <td>'.$resultado['QTD_ALUNO'].'</td>';  
                                                echo '  <td>'.$resultado['QTD_VAGAS'] - $resultado['QTD_ALUNO'].'</td>';                                              
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