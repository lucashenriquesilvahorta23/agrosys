<style>
    @media print {
        @page {
            size: portrait; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>
<p style="text-align: center;"><strong>DECLARAÇÃO DE HISTÓRICO ESCOLAR</strong></p>

<p align="justify">

    Declaramos para os devidos fins e a parte interessada o registro da trajetória escolar do aluno
    (a)  <strong><?= $aluno->NOME_ALUNO ?></strong>, nascido (a) em <strong><?= date("d/m/Y", strtotime($aluno->DATA_NASCIMENTO)) ?></strong>, 
    natural de <strong><?= $aluno->CIDADE ?></strong> – <?= $aluno->ESTADO_NATURALIDADE ?>,  filho de <strong><?= $aluno->FILIACAO_1 ?></strong><strong><?= $aluno->FILIACAO_2 != "" ? " <span style='font-weight: normal;' >e</span> ".$aluno->FILIACAO_2."," : "," ?></strong>
    nesta instituição de ensino até a presente data.

</p>

<table>
    <thead>
        <tr>
            <th rowspan="2">Nº</th>
            <th rowspan="2">ANO LETIVO</th>
            <th rowspan="2">ETAPA</th>
            <th rowspan="2">TURMA</th>
            <th rowspan="2">TURNO</th>
            <th rowspan="2">DATA MATRICULA</th>
            <th colspan="2">RESULTADO FINAL</th> <!-- Colspan para mesclar "SITUAÇÃO" <span style='font-weight: normal;' >e</span> "DATA" -->
        </tr>
        <tr>
            <th>SITUAÇÃO</th>
            <th>DATA</th>
        </tr>
    </thead>

    <tbody>

        <?php 
            if($resultados){
                $cont = 1;
                foreach ($resultados as $resultado) {                    
                    echo'<tr>';

                    echo'    <td>'.$cont.'</td>';
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

                    echo'    <td class="">'.$resultado->NOME_TURMA.'</td>';


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

                    echo'    <td class="">'.inverterData($resultado->DATA_MATRICULA).'</td>';
    
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

                    echo'    <td class="">'.inverterData($resultado->DATA_ALTERACAO_SITUACAO).'</td>';
                    
    
    
                    echo'</tr>';
                    $cont++;
                }
            }

        ?>
    </tbody>


    </table>

<p align="justify">
    <?= $escola->MUNICIPIO ?> – <?= $aluno->ESTADO_NATURALIDADE ?>, <?= date("d/m/Y") ?>
</p>

<div class="signature">
    <div>
        ____________________________ <br>
        <?= $escola->GESTOR ?> <br>
        CPF: <?= $escola->CPF_GESTOR ?> <br>
        Gestor(a) Escolar
    </div>
</div>
