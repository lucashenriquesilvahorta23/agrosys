
<style>
    @media print {
        @page {
            size: landscape; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>

<?php
    if($periodo == 1){
        $descricao_titulo = "INICIO";
        $descricao_tabela = "INICIAL";
    }else{
        $descricao_titulo = "FINAL";
        $descricao_tabela = "FINAL";
    }

?>

<p style="text-align: center;"><strong>DIAGNÓSTICO DE SALA <br> <?= $descricao_titulo; ?> DO ANO LETIVO</strong></p>

    
<table>
        <thead>
            <tr>
                <th>Ano Letivo: <span style="font-weight: lighter" ><?= $turma->ANO_LETIVO; ?></span></th>
                <?php
                    switch ($turma->TIPO_ATENDIMENTO) {
                        case 'IN':
                            echo '<th>Turno: <span style="font-weight: lighter" >Integral  </span> </th>';
                            break;
                        case 'PM':
                            echo '<th>Turno: <span style="font-weight: lighter" >Parcial Matutino  </span> </th>';
                            break;
                        case 'PV':
                            echo '<th>Turno: <span style="font-weight: lighter" >Parcial Vespertino  </span> </th>';
                            break;
                        case 'PA':
                            echo '<th>Turno: <span style="font-weight: lighter" >Parcial  </span> </th>';
                            break;
                        case 'ND':
                            echo '<th>Turno: <span style="font-weight: lighter" >Noturno  </span> </th>';
                            break;
                        case 'DU':
                            echo '<th>Turno: <span style="font-weight: lighter" >Dupla Jornada  </span> </th>';
                            break;
                        case 'SE':
                            echo '<th>Turno: <span style="font-weight: lighter" >Semi-integral  </span> </th>';
                            break;
                        default:
                            echo '<th>Turno: <span style="font-weight: lighter" >Não informado  </span> </th>';
                            break;
                    }
                ?>
                <?php
                    switch ($turma->ETAPA) {
                        case 'I1':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" >Ed. Infantil I – 4 Anos </span> </th>';
                            break;
                        case 'I2':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" >Ed. Infantil II – 5 Anos </span> </th>';
                            break;
                        case 'C1':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" >Creche I – 1 Ano </span> </th>';
                            break;
                        case 'C2':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" >Creche II – 2 Anos </span> </th>';
                            break;
                        case 'C3':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" >Creche III – 3 Anos </span> </th>';
                            break;
                        case 'F1':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" >Fundamental I </span> </th>';
                            break;
                        case 'F2':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" >Fundamental II </span> </th>';
                            break;
                        case 'M1':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" >Médio I </span> </th>';
                            break;
                        case 'M2':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" >Médio II </span> </th>';
                            break;
                        default:
                            echo '<th class="">Etapa: <span style="font-weight: lighter" >Não informado </span> </th>';
                            break;
                    }
                ?>
                <th class="">Turma: <span style="font-weight: lighter" ><?= trim($turma->NOME_TURMA); ?></span></th>
            </tr>
        </thead>
    </table>


    <table>
        <thead>
            <tr>
                <th style="width: 5%" >Nº</th>
                <th style="width: 25%" >NOME DO ALUNO</th>
                <th style="width: 70%" >REGISTRO <?= $descricao_tabela; ?> DA CRIANÇA</th>
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
                    echo'    <td style="text-align: justify" class="">'.$resultado->DESCRICAO.'</td>';
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
            <?= $profissional->NOME_PROFISSIONAL ?> <br>
            CPF: <?= $profissional->CPF ?> <br>
            <strong>PROFESSOR(A)</strong>
        </div>
    </div>

</body>
</html>
