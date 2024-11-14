<p style="text-align: center;"><strong>RELATÓRIO DE TURMAS</strong></p>

    <table>
        <thead>
            <tr>
                <th>ANO LETIVO</th>
                <th>ETAPA</th>
                <th>TURMA</th>
                <th>NÚMERO DE ALUNOS</th>
                <th>TURNO</th>
            </tr>
        </thead>
        <tbody>
            <!-- Alunos data here -->
            <?php 
                foreach ($resultados as $resultado) {                    
                    echo'<tr>';
                    echo'    <td>'.$resultado->ANO_LETIVO.'</td>';
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
                    echo'    <td>'.$resultado->NOME_TURMA.'</td>';
                    echo'    <td>'.$resultado->QTD_ALUNO.'</td>';

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

                    echo'</tr>';
                }

            ?>
            <!-- Repeat for more students -->
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
            Gestor(a) Escolar
        </div>
    </div>


</body>
</html>
