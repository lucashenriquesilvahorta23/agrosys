<style>
    @media print {
        @page {
            size: portrait; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>
<p style="text-align: center;"><strong>REGISTRO DAS VIVÊNCIAS DESENVOLVIDAS</strong></p>

    <table>
        <thead>
            <tr>
                <th>Ano Letivo:  <span style='font-weight: lighter' ><?= $turma->ANO_LETIVO; ?> </span> </th>
                <?php
                    switch ($turma->TIPO_ATENDIMENTO) {
                        case 'IN':
                            echo '<th>Turno: <span style="font-weight: lighter" > Integral  </span> </th>';
                            break;
                        case 'PM':
                            echo '<th>Turno: <span style="font-weight: lighter" > Parcial Matutino  </span> </th>';
                            break;
                        case 'PV':
                            echo '<th>Turno: <span style="font-weight: lighter" > Parcial Vespertino  </span> </th>';
                            break;
                        case 'PA':
                            echo '<th>Turno: <span style="font-weight: lighter" > Parcial  </span> </th>';
                            break;
                        case 'ND':
                            echo '<th>Turno: <span style="font-weight: lighter" > Noturno  </span> </th>';
                            break;
                        case 'DU':
                            echo '<th>Turno: <span style="font-weight: lighter" > Dupla Jornada  </span> </th>';
                            break;
                        case 'SE':
                            echo '<th>Turno: <span style="font-weight: lighter" > Semi-integral  </span> </th>';
                            break;
                        default:
                            echo '<th>Turno: <span style="font-weight: lighter" > Não informado  </span> </th>';
                            break;
                    }
                ?>
                <?php
                    switch ($turma->ETAPA) {
                        case 'I1':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" > Infantil I – 4 Anos </span> </th>';
                            break;
                        case 'I2':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" > Infantil II – 5 Anos </span> </th>';
                            break;
                        case 'C1':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" > Creche I – 1 Ano </span> </th>';
                            break;
                        case 'C2':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" > Creche II – 2 Anos </span> </th>';
                            break;
                        case 'C3':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" > Creche III – 3 Anos </span> </th>';
                            break;
                        case 'F1':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" > Fundamental I </span> </th>';
                            break;
                        case 'F2':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" > Fundamental II </span> </th>';
                            break;
                        case 'M1':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" > Médio I </span> </th>';
                            break;
                        case 'M2':
                            echo '<th class="">Etapa: <span style="font-weight: lighter" > Médio II </span> </th>';
                            break;
                        default:
                            echo '<th class="">Etapa: <span style="font-weight: lighter" > Não informado </span> </th>';
                            break;
                    }
                ?>
                <th class="">Turma: <span style="font-weight: lighter" > <?= trim($turma->NOME_TURMA); ?> </span></th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th colspan="2">Professor: <span style="font-weight: lighter" ><?= $profissional->NOME_PROFISSIONAL; ?> </span></th>
                <th colspan="2">Periodo: <span style="font-weight: lighter" ><?= InverterData($data_inicial) .' - '. InverterData($data_final); ?> </span></th>
            </tr>
        </thead>
    </table>


    <style>
        body {
            text-align: center;
        }
        .table {
            margin: 15px auto;
            width: 80%;
            border: 1px solid #ccc;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }
        th {
            text-align: left;
        }
        .relato {
            text-align: left;
        }
        .signature {
            margin-top: 50px;
            text-align: center;
        }
        .spacer {
            margin-bottom: 40px; /* Espaço entre as ocorrências */
        }
        .date-header {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
        }
    </style>

<?php
foreach ($chamadas as $chamada) {

    
    $data = inverterData($chamada->DATA);
    $codigo = $chamada->CODIGO;
    $descricao = $chamada->DESCRICAO;


    echo "<div class='date-header'>Data do registro: <span style='font-weight: lighter' >$data </span> </div>"; // Data acima da ocorrência

    echo "<table class=''>";
    
    echo "<tr>";
    echo "<th>Códigos dos Objetivos: <span style='font-weight: lighter' > $codigo </span></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th colspan='4'>Registro das vivencias Desenvolvidas: <br>  <span style='font-weight: lighter' > $descricao </span></th>";
    echo "</tr>";

    echo "</table>";
    echo "<div class='spacer'></div>"; // Espaço entre as ocorrências
}
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
