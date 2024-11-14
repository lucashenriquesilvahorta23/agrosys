<p style="text-align: center;"><strong>RELATÓRIO DE OCORRÊNCIAS</strong></p>
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
foreach ($resultados as $ocorrencia) {
    // Mapeamento das etapas
    $etapas = [
        "C1" => "CRECHE I – 1 ANO",
        "C2" => "CRECHE II – 2 ANOS",
        "C3" => "CRECHE III – 3 ANOS",
        "I1" => "INFANTIL I – 4 ANOS",
        "I2" => "INFANTIL II – 5 ANOS"
    ];
    
    $turma = $ocorrencia['NOME_TURMA'];
    $descricao = $ocorrencia['DESCRICAO'];
    $anoLetivo = $ocorrencia['ANO_LETIVO'];
    if($anoLetivo == ""){
        $anoLetivo = $ano_letivo_filtrado;
    }
    $codigo = $ocorrencia['ID_OCORRENCIA'];
    $tipo_atendimento = $ocorrencia['TIPO_ATENDIMENTO'];
    $etapa = isset($ocorrencia['ETAPA']) ? $etapas[$ocorrencia['ETAPA']] : "";
    $dataOcorrencia = $ocorrencia['DATA_OCORRENCIA'];
    $professor = $ocorrencia['NOME_PROFISISONAL'];

    // Definindo Turno
    $turno = match($tipo_atendimento) {
        'IN' => 'Integral',
        'PM' => 'Parcial Matutino',
        'PV' => 'Parcial Vespertino',
        'PA' => 'Parcial',
        'ND' => 'Noturno',
        'DU' => 'Dupla Jornada',
        'SE' => 'Semi-integral',
        default => '',
    };

    echo "<div class='date-header'>Data da Ocorrência: <span style='font-weight: lighter' > $dataOcorrencia </span></div>"; // Data acima da ocorrência

    echo "<table class=''>";
    
    echo "<tr>";
    echo "<th>Código: <span style='font-weight: lighter' > $anoLetivo/00$codigo </span></th>";
    echo "<th>Ano Letivo: <span  style='font-weight: lighter' > $anoLetivo </span></th>";
    echo "<th>Turno: <span  style='font-weight: lighter' > $turno </span></th>";
    echo "<th>Etapa: <span  style='font-weight: lighter' > $etapa </span></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<th colspan='2' >Turma: <span  style='font-weight: lighter' > $turma </span></th>";
    echo "<th colspan='2' >Responsável: <span  style='font-weight: lighter' > $professor </span></th>";
    echo "</tr>";

    echo "<tr>";
    echo "<td colspan='4' style='text-align: left;' >";
    echo " <span style='font-weight: bold;' > Alunos Envolvidos: <span style='font-weight: lighter' >";
    
    // Armazena os nomes dos alunos em um array
    $nomes = [];
    if(isset($ocorrencia['ALUNOS_OCORRENCIA'])){

        foreach ($ocorrencia['ALUNOS_OCORRENCIA'] as $aluno) {
            $nomes[] = $aluno->NOME_ALUNO;
        }
        
        // Usa implode para juntar os nomes separados por vírgula
        echo implode(", ", $nomes);
    }
    
    echo " </span> </span> </td>";
    echo "</tr>";
    
    

    echo "<tr>";
    echo "<th colspan='4'>Descrição da ocorrência: <br>  <span style='font-weight: lighter' >  ".$descricao."  </span></th>";
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
        <?= $escola->GESTOR ?> <br>
        CPF: <?= $escola->CPF_GESTOR ?> <br>
        Gestor (a) Escolar
    </div>
</div>

</body>
</html>