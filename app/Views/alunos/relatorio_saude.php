
<style>
    @media print {
        @page {
            size: landscape; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>
<p style="text-align: center;"><strong>RELATÓRIO DE SAÚDE</strong></p>

<table>
        <thead>
            <tr>
                <th>Ano Letivo: <?= $ano->ANO_LETIVO; ?></th>
                <th>Categoria: <?= categoria($categoria); ?></th>
                
            </tr>
        </thead>
    </table>


    <table >
        <thead>
            <tr>
                <th >Nº</th>
                <th >NOME DO ALUNO</th>
                <th >SEXO</th>
                <th >ETAPA</th>
                <th >TURMA</th>
                <th >TURNO</th>
                <th >SITUAÇÃO</th>
                <th >TIPO</th>
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

                    switch ($resultado->ETAPA) {
                        case 'C1':
                            $etapa = 'Creche I – 1 Ano';
                            break;
                        case 'C2':
                            $etapa = 'Creche II – 2 Anos';
                            break;
                        case 'C3':
                            $etapa = 'Creche III – 3 Anos';
                            break;
                        case 'I1':
                            $etapa = 'Infantil I – 4 Anos';
                            break;
                        case 'I2':
                            $etapa = 'Infantil II – 5 Anos';
                            break;
                        default:
                            $etapa = 'Não informado';
                            break;
                    }


                    echo'    <td class="">'.$etapa.'</td>';
                    echo'    <td class="">'.$resultado->NOME_TURMA.'</td>';
                    echo'    <td class="">'.turno($resultado->TIPO_ATENDIMENTO).'</td>';
                    echo'    <td class="">'.situacao($resultado->SITUACAO).'</td>';

                    if($categoria == "DE"){
                        $doencas = [];

                        // Verifica cada condição no objeto e adiciona à lista de doenças se estiver marcada como 'S'
                        if ($resultado->BAIXA_VISAO === 'S') {
                            $doencas[] = 'Baixa Visão';
                        }
                        if ($resultado->DEFICIENCIA_FISICA === 'S') {
                            $doencas[] = 'Deficiência Física';
                        }
                        if ($resultado->SURDOCEGUEIRA === 'S') {
                            $doencas[] = 'Surdocegueira';
                        }
                        if ($resultado->CEGUEIRA === 'S') {
                            $doencas[] = 'Cegueira';
                        }
                        if ($resultado->INTELECTUAL === 'S') {
                            $doencas[] = 'Deficiência Intelectual';
                        }
                        if ($resultado->MULTIPLA === 'S') {
                            $doencas[] = 'Deficiência Múltipla';
                        }
                        if ($resultado->AUDITIVA === 'S') {
                            $doencas[] = 'Deficiência Auditiva';
                        }
                        if ($resultado->SURDEZ === 'S') {
                            $doencas[] = 'Surdez';
                        }

                        // Verifica a coluna "OUTROS" e adiciona à lista se houver algo nela
                        if (!empty($resultado->OUTROS)) {
                            $doencas[] = $resultado->OUTROS;
                        }

                        // Concatena as doenças em uma única string separada por vírgulas
                        echo'    <td class="">'.implode(', ', $doencas).'</td>';
                    }

                    if($categoria == "TR"){
                        if ($resultado->AUSTISMO === 'S') {
                            $doencas[] = 'Autismo';
                        }
                        if ($resultado->TDAH === 'S') {
                            $doencas[] = 'TDAH';
                        }
                    
                        // Verifica a coluna "OUTROS" e adiciona à lista se houver algo nela
                        if (!empty($resultado->OUTROS)) {
                            $doencas[] = $resultado->OUTROS;
                        }
                    
                        // Concatena as doenças em uma única string separada por vírgulas
                        echo'    <td class="">'.implode(', ', $doencas).'</td>';
                    }

                    if($categoria == "IA"){                   
                        // Verifica a coluna "OUTROS" e adiciona à lista se houver algo nela
                        if (!empty($resultado->OUTROS)) {
                            $doencas[] = $resultado->OUTROS;
                        }
                    
                        // Concatena as doenças em uma única string separada por vírgulas
                        echo'    <td class="">'.implode(', ', $doencas).'</td>';
                    }

                    if($categoria == "AL"){                   
                        // Verifica a coluna "OUTROS" e adiciona à lista se houver algo nela
                        if (!empty($resultado->OUTROS)) {
                            $doencas[] = $resultado->OUTROS;
                        }
                    
                        // Concatena as doenças em uma única string separada por vírgulas
                        echo'    <td class="">'.implode(', ', $doencas).'</td>';
                    }

                    if($categoria == "MC"){                   
                        // Verifica a coluna "OUTROS" e adiciona à lista se houver algo nela
                        if (!empty($resultado->OUTROS)) {
                            $doencas[] = $resultado->OUTROS;
                        }
                    
                        // Concatena as doenças em uma única string separada por vírgulas
                        echo'    <td class="">'.implode(', ', $doencas).'</td>';
                    }

                    if($categoria == "TE"){
                        if ($resultado->PSICOLOGO === 'S') {
                            $doencas[] = 'Psicológico';
                        }
                        if ($resultado->FONOAUDIOLOGO === 'S') {
                            $doencas[] = 'Fonoaudiológico';
                        }
                        if ($resultado->TERAPIA === 'S') {
                            $doencas[] = 'Terapeutico';
                        }
                    
                        // Verifica a coluna "OUTROS" e adiciona à lista se houver algo nela
                        if (!empty($resultado->OUTROS)) {
                            $doencas[] = $resultado->OUTROS;
                        }
                    
                        // Concatena as doenças em uma única string separada por vírgulas
                        echo'    <td class="">'.implode(', ', $doencas).'</td>';
                    }

                    if($categoria == "DC"){
                        if ($resultado->DIEABETE === 'S') {
                            $doencas[] = 'Diabetes';
                        }
                        if ($resultado->RESPIRATORIA === 'S') {
                            $doencas[] = 'Respiratoria';
                        }
                        if ($resultado->NEUROLOGIA === 'S') {
                            $doencas[] = 'Neurologica';
                        }
                        if ($resultado->OBESIDADE === 'S') {
                            $doencas[] = 'Obesidade';
                        }
                    
                        // Verifica a coluna "OUTROS" e adiciona à lista se houver algo nela
                        if (!empty($resultado->OUTROS)) {
                            $doencas[] = $resultado->OUTROS;
                        }
                    
                        // Concatena as doenças em uma única string separada por vírgulas
                        echo'    <td class="">'.implode(', ', $doencas).'</td>';
                    }

                    if($categoria == "AH"){

                    
                        // Concatena as doenças em uma única string separada por vírgulas
                        echo'    <td class="">Altas habilidades</td>';
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
