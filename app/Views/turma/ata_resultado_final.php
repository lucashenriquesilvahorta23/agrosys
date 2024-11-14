<style>
    @media print {
        @page {
            size: portrait; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>
<p style="text-align: center;"><strong>ATA DE RESULTADOS FINAIS</strong></p>
<p align="justify">Na data de <strong><?= inverterData($turma->DATA_FINAL) ?></strong>, concluiu-se o processo de observação, acompanhamento e avaliação dos alunos da Etapa: 
<?php
switch ($turma->ETAPA) {
    case 'I1':
        echo '<strong> Infantil I – 4 Anos</strong>';
        break;
    case 'I2':
        echo '<strong> Infantil II – 5 Anos</strong>';
        break;
    case 'C1':
        echo '<strong> Creche I – 1 Ano</strong>';
        break;
    case 'C2':
        echo '<strong> Creche II – 2 Anos</strong>';
        break;
    case 'C3':
        echo '<strong> Creche III – 3 Anos</strong>';
        break;
    case 'F1':
        echo '<strong> Fundamental I</strong>';
        break;
    case 'F2':
        echo '<strong> Fundamental II</strong>';
        break;
    case 'M1':
        echo '<strong> Médio I</strong>';
        break;
    case 'M2':
        echo '<strong> Médio II</strong>';
        break;
    default:
        echo '<strong> Não informado</strong>';
        break;
}
?>, Turma: <strong><?= trim($turma->NOME_TURMA) ?></strong>, Turno: 
<?php
switch ($turma->TIPO_ATENDIMENTO) {
    case 'IN':
        echo '<strong>Integral</strong>';
        break;
    case 'PM':
        echo '<strong>Parcial Matutino</strong>';
        break;
    case 'PV':
        echo '<strong>Parcial Vespertino</strong>';
        break;
    case 'PA':
        echo '<strong>Parcial</strong>';
        break;
    case 'ND':
        echo '<strong>Noturno</strong>';
        break;
    case 'DU':
        echo '<strong>Dupla Jornada</strong>';
        break;
    case 'SE':
        echo '<strong>Semi-integral</strong>';
        break;
    default:
        echo '<strong>Não informado</strong>';
        break;
}
?>, desta instituição de ensino, com os seguintes resultados:</p>
Professor: <strong><?= $profissional->NOME_PROFISSIONAL; ?></strong>
    <table>
        <thead>
            <tr>
                <th>Nº</th>
                <th>Nome do Aluno</th>
                <th class="vertical">Sexo</th>
                <th class="vertical">Idade</th>
                <th class="vertical">Transferido</th>
                <th class="vertical">Evadido</th>
                <th class="vertical">Falecido</th>
                <th class="vertical">Progressão Direta</th>
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
                    echo'    <td class="">'.$resultado->IDADE.'</td>';

                    $situacao = $resultado->SITUACAO;

                    if ($situacao == 'CO') {
                        echo'    <td class=""></td>';
                        echo'    <td class=""></td>';
                        echo'    <td class=""></td>';
                        echo'    <td class="">X</td>';
                    } elseif ($situacao == 'TR') {
                        echo'    <td class="">X</td>';
                        echo'    <td class=""></td>';
                        echo'    <td class=""></td>';
                        echo'    <td class=""></td>';
                    }  elseif ($situacao == 'EV') {
                        echo'    <td class=""></td>';
                        echo'    <td class="">X</td>';
                        echo'    <td class=""></td>';
                        echo'    <td class=""></td>';
                    }  elseif ($situacao == 'FL') {
                        echo'    <td class=""></td>';
                        echo'    <td class=""></td>';
                        echo'    <td class="">X</td>';
                        echo'    <td class=""></td>';
                    }   else {
                        echo'    <td class=""></td>';
                        echo'    <td class=""></td>';
                        echo'    <td class=""></td>';
                        echo'    <td class=""></td>';
                    } 


                    echo'</tr>';
                    $cont++;
                }

            ?>
            <!-- Repeat for more students -->
        </tbody>
    </table>

    <div class="signature">
        <div>
        ____________________________ <br>
            <?= $escola->COORDENADOR ?> <br>
            CPF: <?= $escola->CPF_COORDENADOR ?> <br>
            Coordenador (a) Escolar
        </div>
        <div>
        ____________________________ <br>
            <?= $escola->GESTOR ?> <br>
            CPF: <?= $escola->CPF_GESTOR ?> <br>
            Gestor (a) Escolar
        </div>
    </div>

</body>
</html>
