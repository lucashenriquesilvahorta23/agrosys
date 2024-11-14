
<style>
    @media print {
        @page {
            size: landscape; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>
<p style="text-align: center;"><strong>RELATÓRIO DE ALUNOS POR TURMA</strong></p>

<table>
        <thead>
            <tr>
                <th>Ano Letivo: <?= $turma->ANO_LETIVO; ?></th>
                <?php
                    switch ($turma->TIPO_ATENDIMENTO) {
                        case 'IN':
                            echo '<th>Turno: Integral </th>';
                            break;
                        case 'PM':
                            echo '<th>Turno: Parcial Matutino </th>';
                            break;
                        case 'PV':
                            echo '<th>Turno: Parcial Vespertino </th>';
                            break;
                        case 'PA':
                            echo '<th>Turno: Parcial </th>';
                            break;
                        case 'ND':
                            echo '<th>Turno: Noturno </th>';
                            break;
                        case 'DU':
                            echo '<th>Turno: Dupla Jornada </th>';
                            break;
                        case 'SE':
                            echo '<th>Turno: Semi-integral </th>';
                            break;
                        default:
                            echo '<th>Turno: Não informado </th>';
                            break;
                    }
                ?>
                <?php
                    switch ($turma->ETAPA) {
                        case 'I1':
                            echo '<th class="">Etapa: Infantil I – 4 Anos</th>';
                            break;
                        case 'I2':
                            echo '<th class="">Etapa: Infantil II – 5 Anos</th>';
                            break;
                        case 'C1':
                            echo '<th class="">Etapa: Creche I – 1 Ano</th>';
                            break;
                        case 'C2':
                            echo '<th class="">Etapa: Creche II – 2 Anos</th>';
                            break;
                        case 'C3':
                            echo '<th class="">Etapa: Creche III – 3 Anos</th>';
                            break;
                        case 'F1':
                            echo '<th class="">Etapa: Fundamental I</th>';
                            break;
                        case 'F2':
                            echo '<th class="">Etapa: Fundamental II</th>';
                            break;
                        case 'M1':
                            echo '<th class="">Etapa: Médio I</th>';
                            break;
                        case 'M2':
                            echo '<th class="">Etapa: Médio II</th>';
                            break;
                        default:
                            echo '<th class="">Etapa: Não informado</th>';
                            break;
                    }
                ?>
                <th class="">Turma: <?= trim($turma->NOME_TURMA); ?></th>
            </tr>
        </thead>
    </table>
    <p style="text-align: justify">Professor: <?= $resultados[0]->NOME_PROFISSIONAL; ?></p>


    <table>
        <thead>
            <tr>
                <th>Nº</th>
                <th>NOME DO ALUNO</th>
                <th>SEXO</th>
                <th>DATA DE NASCIMENTO</th>
                <th>CPF</th>
                <th>TELEFONE</th>
                <th>SITUAÇÃO</th>
            </tr>
        </thead>
        <tbody>
            <!-- Alunos data here -->
            <?php 
                $cont = 1;
                foreach ($resultados as $resultado) {                    
                    echo'<tr>';
                    echo'    <td>'.$cont.'</td>';
                    echo'    <td>'.$resultado->NOME_ALUNO.'</td>';
                    echo'    <td class="">'.$resultado->SEXO.'</td>';
                    echo'    <td class="">'.inverterData($resultado->DATA_MATRICULA).'</td>';
                    echo'    <td class="">'.$resultado->CPF.'</td>';

                    if($resultado->RESPONSAVEL_LEGAL_TELEFONE != "" && $resultado->RESPONSAVEL_LEGAL_TELEFONE !=null){
                        echo '	<td>'.$resultado->RESPONSAVEL_LEGAL_TELEFONE.'</td>';
                    }else if($resultado->FILIACAO_1_TELEFONE != "" && $resultado->FILIACAO_1_TELEFONE !=null){
                        echo '	<td>'.$resultado->FILIACAO_1_TELEFONE.'</td>';
                    }else{
                        echo '	<td>'.$resultado->FILIACAO_2_TELEFONE.'</td>';
                    }

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


                    echo'</tr>';
                    $cont++;
                }

            ?>
            <!-- Repeat for more students -->
        </tbody>
    </table>


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


    <p>
        <?= $escola->MUNICIPIO ?> – MA, <?= date("d/m/Y") ?>
    </p>

    <div class="signature">
        <div>
        ____________________________ <br>
            <?= $escola->GESTOR ?> <br>
            CPF: <?= $escola->CPF_GESTOR ?> <br>
            Gestor (a) Escolar
        </div>
    </div>

</body>
</html>
