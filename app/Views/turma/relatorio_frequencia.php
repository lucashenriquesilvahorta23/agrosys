<style>
    @media print {
        @page {
            size: landscape; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>
<p style="text-align: center;"><strong>REGISTRO DE FRÊQUENCIA</strong></p>

    <table>
        <thead>
            <tr>
                <th>Ano Letivo: <span  style='font-weight: lighter' ><?= $turma->ANO_LETIVO; ?></span></th>
                <?php
                    switch ($turma->TIPO_ATENDIMENTO) {
                        case 'IN':
                            echo '<th>Turno: <span  style="font-weight: lighter" >Integral </span></th>';
                            break;
                        case 'PM':
                            echo '<th>Turno: <span  style="font-weight: lighter" >Parcial Matutino </span></th>';
                            break;
                        case 'PV':
                            echo '<th>Turno: <span  style="font-weight: lighter" >Parcial Vespertino </span></th>';
                            break;
                        case 'PA':
                            echo '<th>Turno: <span  style="font-weight: lighter" >Parcial </span></th>';
                            break;
                        case 'ND':
                            echo '<th>Turno: <span  style="font-weight: lighter" >Noturno </span></th>';
                            break;
                        case 'DU':
                            echo '<th>Turno: <span  style="font-weight: lighter" >Dupla Jornada </span></th>';
                            break;
                        case 'SE':
                            echo '<th>Turno: <span  style="font-weight: lighter" >Semi-integral </span></th>';
                            break;
                        default:
                            echo '<th>Turno: <span  style="font-weight: lighter" >Não informado </span></th>';
                            break;
                    }
                ?>
                <?php
                    switch ($turma->ETAPA) {
                        case 'I1':
                            echo '<th class="">Etapa: <span  style="font-weight: lighter" >Ed. Infantil I – 4 Anos </span> </th>';
                            break;
                        case 'I2':
                            echo '<th class="">Etapa: <span  style="font-weight: lighter" >Ed. Infantil II – 5 Anos </span> </th>';
                            break;
                        case 'C1':
                            echo '<th class="">Etapa: <span  style="font-weight: lighter" >Creche I – 1 Ano </span> </th>';
                            break;
                        case 'C2':
                            echo '<th class="">Etapa: <span  style="font-weight: lighter" >Creche II – 2 Anos </span> </th>';
                            break;
                        case 'C3':
                            echo '<th class="">Etapa: <span  style="font-weight: lighter" >Creche III – 3 Anos </span> </th>';
                            break;
                        case 'F1':
                            echo '<th class="">Etapa: <span  style="font-weight: lighter" >Fundamental I </span> </th>';
                            break;
                        case 'F2':
                            echo '<th class="">Etapa: <span  style="font-weight: lighter" >Fundamental II </span> </th>';
                            break;
                        case 'M1':
                            echo '<th class="">Etapa: <span  style="font-weight: lighter" >Médio I </span> </th>';
                            break;
                        case 'M2':
                            echo '<th class="">Etapa: <span  style="font-weight: lighter" >Médio II </span> </th>';
                            break;
                        default:
                            echo '<th class="">Etapa: <span  style="font-weight: lighter" >Não informado </span> </th>';
                            break;
                    }
                ?>
                <th class="">Turma: <span  style="font-weight: lighter" ><?= trim($turma->NOME_TURMA); ?></span></th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th colspan="2">Professor: <span  style="font-weight: lighter" ><?= $profissional->NOME_PROFISSIONAL; ?></span></th>
                <th colspan="2">Periodo: <span  style="font-weight: lighter" ><?= InverterData($data_inicial) .' - '. InverterData($data_final); ?></span></th>
            </tr>
        </thead>
    </table>


    <table>
        <thead>
            <tr>
                <th>Nº</th>
                <th>Nome do Aluno</th>
                <th>Situação</th>
                <?php 
                    foreach ($chamadas as $chamada) {
                        echo '<th class="vertical">'.InverterData($chamada->DATA).'</th>';
                    }
                ?>
                <th class="vertical">Presença</th>
                <th class="vertical">Falta</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $cont = 1;
                $total_presencas = 0;
                $total_faltas = 0;
                $qtd_dias_trabalhados = 0;

                foreach ($alunos as $resultado) {                    
                    echo '<tr>';
                    echo '    <td>'.$cont.'</td>';
                    echo '    <td>'.$resultado->NOME_ALUNO.'</td>';

                    $situacao = $resultado->SITUACAO;
    
                    if ($situacao == 'CO') {
                        echo'    <td class="">Progressão Direta</td>';
                    } elseif ($situacao == 'TR') {
                        echo'    <td class="">Transferido</td>';
                    }  elseif ($situacao == 'EV') {
                        echo'    <td class="">Evadido</td>';
                    }  elseif ($situacao == 'FL') {
                        echo'    <td class="">Falecido</td>';
                    }   else {
                        echo'    <td class="">Cursando</td>';
                    } 

                    $presenca_total = 0;
                    $falta_total = 0;

                    foreach ($chamadas as $chamada) {
                        if($resultado->SITUACAO != "CU" && $chamada->DATA > $resultado->DATA_ALTERACAO_SITUACAO){
                            echo '<th class=""> - </th>';    
                        }else{
                            $frequencia_aluno = getFrequenciaAluno($chamada->ID_CHAMADA, $resultado->ID_ALUNO);
                            if ($frequencia_aluno == "P") {
                                $presenca_total++;
                                $total_presencas++;
                            } else if ($frequencia_aluno != "-"){
                                $falta_total++;
                                $total_faltas++;
                            }
                            echo '<th class="">'.$frequencia_aluno.'</th>';
                        }
                        $qtd_dias_trabalhados++;
                    }

                    echo '    <td>'.$presenca_total.'</td>';
                    echo '    <td>'.$falta_total.'</td>';
                    echo '</tr>';
                    $cont++;
                }
            ?>
        </tbody>
    </table>


    <p > <strong> Dias trabalhados no Período:</strong> <?= count($chamadas); ?></p>

    <p>
        <span style="font-weight: bold;">Dias não letivo: </span> <?= count($dia_nao_letivo); ?> <br>
        <strong>Observações:</strong> 
        <?php 
            $totalDias = count($dia_nao_letivo);
            foreach ($dia_nao_letivo as $index => $dia) {
                echo inverterData($dia->DATA) . ' - ' . $dia->OBSERVACOES;
                if ($index < $totalDias - 1) {
                    echo ', ';
                }
            }
        ?>
    </p>

    <table>
    <thead>
        <tr>
            <th colspan="5">MOVIMENTO DE ALUNOS</th>
        </tr>
        <tr>
            <th>ESPECIFICAÇÃO</th>
            <th>F</th>
            <th>M</th>
            <th>TOTAL GERAL</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $data = [
            'MATRÍCULA INICIAL' => [$resultados_matricula_inicial_feminino, $resultados_matricula_inicial_masculino],
            'ALUNOS EVADIDOS' => [$resultados_aluno_evadidos_feminino, $resultados_aluno_evadidos_masculino],
            'ALUNOS NOVOS' => [$resultados_aluno_novos_feminino, $resultados_aluno_novos_masculino],
            'ALUNOS TRANSFERIDOS' => [$resultados_aluno_transferidos_feminino, $resultados_aluno_transferidos_masculino],
            'ALUNOS FALECIDOS' => [$resultados_aluno_falecidos_feminino, $resultados_aluno_falecidos_masculino],
        ];

        foreach ($data as $label => $results) {
            echo '<tr>';
            echo "<td>{$label}</td>";
            echo '<td>' . $results[0]->QTD_ALUNO . '</td>';
            echo '<td>' . $results[1]->QTD_ALUNO . '</td>';
            echo '<td>' . ($results[0]->QTD_ALUNO + $results[1]->QTD_ALUNO) . '</td>';
            echo '</tr>';
        }

        // Atualiza os cálculos para matrícula atual
        $matriculaAtualFeminino = $resultados_matricula_inicial_feminino->QTD_ALUNO 
            - $resultados_aluno_evadidos_feminino->QTD_ALUNO 
            - $resultados_aluno_falecidos_feminino->QTD_ALUNO 
            - $resultados_aluno_transferidos_feminino->QTD_ALUNO 
            + $resultados_aluno_novos_feminino->QTD_ALUNO;

        $matriculaAtualMasculino = $resultados_matricula_inicial_masculino->QTD_ALUNO 
            - $resultados_aluno_evadidos_masculino->QTD_ALUNO 
            - $resultados_aluno_falecidos_masculino->QTD_ALUNO 
            - $resultados_aluno_transferidos_masculino->QTD_ALUNO 
            + $resultados_aluno_novos_masculino->QTD_ALUNO;

        echo '<tr>';
        echo '<td>MATRÍCULA ATUAL</td>';
        echo '<td>' . $matriculaAtualFeminino . '</td>';
        echo '<td>' . $matriculaAtualMasculino . '</td>';
        echo '<td>' . ($matriculaAtualFeminino + $matriculaAtualMasculino) . '</td>';
        echo '</tr>';
        ?>
    </tbody>
</table>

    <h3 style="text-align: center" >Justificativas de falta</h3>

    <?php 
        foreach ($chamadas as $chamada): 
            $dados_chamada = getJustificativas($chamada->ID_CHAMADA);
            if (!empty($dados_chamada)): // Verifica se há dados para exibir
        ?>
                <h5>Data da chamada <?= inverterData($chamada->DATA); ?></h5>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 40%">NOME DO ALUNO</th>
                            <th style="width: 60%">JUSTIFICATIVA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados_chamada as $dados): ?>
                            <tr>
                                <td><?= htmlspecialchars($dados->NOME_ALUNO); ?></td>
                                <td><?= htmlspecialchars($dados->OBSERVACOES); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        <?php 
            endif; // Fecha o if para verificação de dados
        endforeach; 
        ?>





    <p>
        <?= $escola->MUNICIPIO ?> – MA, <?= date("d/m/Y") ?>
    </p>

    <div class="signature">

        <div>
        ____________________________ <br>
            <?= $profissional->NOME_PROFISSIONAL ?> <br>
            CPF: <?= $profissional->CPF ?> <br>
            Professor(a) Escolar
        </div>

        <div>
        ____________________________ <br>
            <?= $escola->COORDENADOR ?> <br>
            CPF: <?= $escola->CPF_COORDENADOR ?> <br>
            Coordenador (a) Escolar
        </div>
    </div>

</body>
</html>
