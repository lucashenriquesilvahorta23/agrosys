<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            font-size: 13px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            font-size: 11px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            text-align: center;
        }
        th.vertical, td.vertical {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
        }
        h1, h2 {
            text-align: center;
            font-size: 20px;
        }
        .header-info {
            text-align: center;
            margin-bottom: 10px;
            margin-top: -5px;
            font-size: 16px;
        }
        .signature {
            margin-top: 25px;
            text-align: center;
        }
        .signature div {
            display: inline-block;
            width: 40%;
            text-align: center;
        }

        /* Ajustes de impressão */
        @media print {
            body {
                margin: 10px;
            }
            @page {
                margin: 10px;
            }
            .header-info, table {
                page-break-inside: avoid;
            }
        }
    </style>
    <script>
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
</head>
<body>

<?php 
    foreach ($profisisonais as $profissional) {
        // Informações do funcionário
        $nome = $profissional->NOME_PROFISSIONAL;
        $turno = $profissional->NOME_PROFISSIONAL;
        $local = $profissional->NOME_PROFISSIONAL;
        $municipio = $profissional->NATURALIDADE;
        $estado = $profissional->ESTADO_NATURALIDADE;
        $escolaNome = isset($escola->NOME_ALEATORIO) ? $escola->NOME_ALEATORIO : 'padrao.png';

        foreach($profissoes as $prof){
            $select = '';
            if(isset($profissional->CARGO)&&$profissional->CARGO==$prof->ID_PROFISSAO){
                $funcao = $prof->NOME;
            }
        }

        // Definir ano e mês

        $meses = [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro',
        ];

        $valorSemZero = ltrim($mes, '0');
        $nomeDoMes = $meses[$valorSemZero];

        // Definir os dias da semana abreviados
        $diasSemana = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'];
?>

<table>
    <thead>
        <tr>
            <th rowspan="2" style="width: 50%;">
                <img src="<?php echo LINK_UPLOAD . $escolaNome; ?>" width="60" class="img-bordered">
            </th>
            <th colspan="2" style="text-align: center; font-size: 13px;">MÊS: <span style="font-weight: bold"><?= $nomeDoMes; ?></span> ANO: <span style="font-weight: bold"><?= $ano; ?></span></th>
        </tr>
        <tr>
            <th colspan="2" style="text-align: left; font-size: 13px;">PERÍODO DE FREQUÊNCIA: <span style="font-weight: lighter"></span></th>
        </tr>
        <tr>
            <th rowspan="2" style="text-align: left; font-size: 13px;">NOME DO FUNCIONÁRIO: <span style="font-weight: lighter"><?php echo $nome; ?></span></th>
            <th style="width: 30%; text-align: left; font-size: 13px;">FUNÇÃO: <span style="font-weight: lighter"><?php echo $funcao; ?></span></th>
            <th  style="text-align: left; font-size: 13px;">TURNO: <span style="font-weight: lighter"></span></th>
        </tr>
    </thead>
</table>

<p style="text-align: center; font-size: 15px;"><strong>FOLHA DE PONTO INDIVIDUAL DE TRABALHO</strong></p>

<?php

        
    // Obter o número de dias no mês
    $numeroDias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
    
    echo "<table border='1' cellspacing='0' cellpadding='6' style='width:100%; text-align: center; font-size: 11px;'>";

    // Linha de cabeçalho
    echo "<tr>";
    echo "<th rowspan='2' style='width: 5%;'>DIA</th>";
    echo "<th rowspan='2' style='width: 5%;'>DIA DA SEMANA</th>";
    echo "<th rowspan='2' style='width: 10%;'>ENTRADA</th>";
    echo "<th colspan='2' style='width: 20%;'>INTERVALO</th>";
    echo "<th rowspan='2' style='width: 10%;'>SAÍDA</th>";
    echo "<th rowspan='2' style='width: 20%;'>OBSERVAÇÃO</th>";
    echo "<th rowspan='2' style='width: 30%;'>ASSINATURA</th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th style='width:10%;'>SAÍDA</th>";
    echo "<th style='width:10%;'>RETORNO</th>";
    echo "</tr>";
    
    // Gerar as linhas para cada dia do mês
    for ($dia = 1; $dia <= $numeroDias; $dia++) {
        $dataAtual = strtotime("$ano-$mes-$dia");
        $indiceDiaSemana = date('w', $dataAtual);
        $diaSemanaAbreviado = $diasSemana[$indiceDiaSemana];
        $backgroundColor = ($indiceDiaSemana == 0 || $indiceDiaSemana == 6) ? "background-color: #f8cbad;" : "";
        $textColor = ($indiceDiaSemana == 0 || $indiceDiaSemana == 6) ? "color: red;" : "";
        
        echo "<tr style='$backgroundColor'>";
        echo "<td style='$textColor'>$dia</td>";
        echo "<td style='$textColor'>$diaSemanaAbreviado</td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "</tr>";
    }
    echo "</table>";
?>

<table>
    <thead>
        <tr>
            <th colspan="2" style="text-align: center; background-color: #CCCCCC; font-size: 13px;">RESUMO GERAL</th>
        </tr>
        <tr>
            <th style="text-align: left; font-size: 13px;">DIAS NORMAIS:</th>
            <th style="text-align: left; font-size: 13px;">FALTAS NO MÊS:</th>
        </tr>
        <tr>
            <th style="text-align: left; font-size: 13px;">FERIADOS:</th>
            <th style="text-align: left; font-size: 13px;">VISTO:</th>
        </tr>
    </thead>
</table>
    <div  class="header-info">
        <p><strong><?= mb_strtoupper($escola->ESCOLA, 'UTF-8') ?></strong><br>
        Autorização Educação Infantil CME Nº <?= $escola->CME ?> - INEP Nº <?= $escola->INEP ?><br>
        <?= $escola->LOGRADOURO ?>, <?= $escola->BAIRRO ?>, CEP: <?= $escola->CEP ?><br>
        <?= $escola->MUNICIPIO ?> – <?= $escola->FUNCIONAMENTO ?></p>
    </div>

<?php 
    } // Fim do foreach
?>

</body>
</html>