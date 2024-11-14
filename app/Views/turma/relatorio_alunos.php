
<style>
    @media print {
        @page {
            size: landscape; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>
<p style="text-align: center;"><strong>RELATÓRIO DE ALUNOS</strong></p>

<table>
        <thead>
            <tr>
                <th>Ano Letivo: <?= isset($ano->ANO_LETIVO) ? $ano->ANO_LETIVO : "-"; ?></th>
                
            </tr>
        </thead>
    </table>


    <table>
        <thead>
            <tr>
                <th>Nº</th>
                <th>NOME DO ALUNO</th>
                <th>SEXO</th>
                <th>DATA DE NASCIMENTO</th>
                <th>CPF</th>
                <th>TELEFONE</th>
                <th>ETAPA</th>
                <th>TURMA</th>
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

                    switch ($resultado->ETAPA) {
                        case 'I1':
                            echo '<td class="">Etapa: Infantil I – 4 Anos</td>';
                            break;
                        case 'I2':
                            echo '<td class="">Etapa: Infantil II – 5 Anos</td>';
                            break;
                        case 'C1':
                            echo '<td class="">Etapa: Creche I – 1 Ano</td>';
                            break;
                        case 'C2':
                            echo '<td class="">Etapa: Creche II – 2 Anos</td>';
                            break;
                        case 'C3':
                            echo '<td class="">Etapa: Creche III – 3 Anos</td>';
                            break;
                        case 'F1':
                            echo '<td class="">Etapa: Fundamental I</td>';
                            break;
                        case 'F2':
                            echo '<td class="">Etapa: Fundamental II</td>';
                            break;
                        case 'M1':
                            echo '<td class="">Etapa: Médio I</td>';
                            break;
                        case 'M2':
                            echo '<td class="">Etapa: Médio II</td>';
                            break;
                        default:
                            echo '<td class="">Etapa: -</td>';
                            break;
                    }

                    echo '<td class="">'.trim($turma->NOME_TURMA).'</td>';

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
