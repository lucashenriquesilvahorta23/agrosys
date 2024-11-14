
<style>
    @media print {
        @page {
            size: portrait; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>
<p style="text-align: center;"><strong>FICHA DE OBSERVAÇÃO DO ALUNO</strong></p>
<p style="text-align: center;"><strong><?= $bimestre."º"; ?> BIMESTRE</strong></p>


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
    <p style="text-align: justify"> <strong> Professor:</strong> <?= $profissional->NOME_PROFISSIONAL; ?></p>
    <p style="text-align: justify"> <strong> Aluno(a):</strong> <?= $aluno->NOME_ALUNO; ?></p>



    <?php
        $habilidades_fisicas = [
            ["label" => "Lateralidade (diferencia esquerda e direita)", "key" => "LATERALIDADE"],
            ["label" => "Noção de espaço", "key" => "NOCAO_ESPACO"],
            ["label" => "Equilíbrio e agilidade ao se locomover", "key" => "EQUILIBRIO_AGILIDADE"],
            ["label" => "Pula com um pé só", "key" => "PULA_UM_PE"],
            ["label" => "Pula com os dois pés", "key" => "PULA_DOIS_PES"],
            ["label" => "Corre em linha reta", "key" => "CORRE_LINHA_RETA"],
            ["label" => "Perpassa obstáculos", "key" => "PERPASSA_OBSTACULOS"],
            ["label" => "Anda na ponta dos pés", "key" => "ANDA_PONTA_PES"]
        ];

        // Habilidades motoras finas e suas chaves correspondentes
        $habilidades_motora_fina = [
            ["label" => "Pega corretamente o lápis", "key" => "PEGA_CORRETAMENTE_LAPIS"],
            ["label" => "Utiliza o lápis com facilidade", "key" => "UTILIZA_LAPIS_FACILIDADE"],
            ["label" => "Escreve de forma espelhada", "key" => "ESCREVE_FORMA_ESPELHADA"],
            ["label" => "Recorta com as mãos", "key" => "RECORTA_COM_MAOS"],
            ["label" => "Recorta com tesoura", "key" => "RECORTA_COM_TESOURA"],
            ["label" => "Pinta dentro dos espaços", "key" => "PINTA_DENTRO_ESPACOS"],
            ["label" => "Amassa", "key" => "AMASSA"],
            ["label" => "Desenha", "key" => "DESENHA"],
            ["label" => "Alinhava", "key" => "ALINHAVA"],
            ["label" => "Abre embalagens de objetos", "key" => "ABRE_EMBALAGENS"],
            ["label" => "Enrosca", "key" => "ENROSCA"],
            ["label" => "Monta e desmonta", "key" => "MONTA_DESMONTA"]
        ];

        // Habilidades sociais e emocionais e suas chaves correspondentes
        $habilidades_sociais_emocionais = [
            ["label" => "Busca atenção para si", "key" => "BUSCA_ATENCAO_PARA_SI"],
            ["label" => "Busca interagir com os colegas", "key" => "BUSCA_INTERAGIR_COLEGAS"],
            ["label" => "Compreende e atende regras e comandos", "key" => "COMPREENDE_ATENDE_REGRAS"],
            ["label" => "Aceita e solicita ajuda", "key" => "ACEITA_SOLICITA_AJUDA"],
            ["label" => "Divide e compartilha brinquedos e materiais", "key" => "DIVIDE_COMPARTILHA_BRINQUEDOS"],
            ["label" => "Participa de momentos em grupo", "key" => "PARTICIPA_MOMENTOS_GRUPO"],
            ["label" => "Expõe acontecimentos do seu cotidiano", "key" => "EXPOE_ACONTECIMENTOS_COTIDIANO"],
            ["label" => "Brinca de forma isolada", "key" => "BRINCA_FORMA_ISOLADA"],
            ["label" => "Brinca com os colegas", "key" => "BRINCA_COM_COLEGAS"],
            ["label" => "Aceita contato físico", "key" => "ACEITA_CONTATO_FISICO"],
            ["label" => "Se isola", "key" => "SE_ISOLA"],
            ["label" => "Se zanga com facilidade", "key" => "SE_ZANGA_COM_FACILIDADE"],
            ["label" => "Alterações de humor com frequência", "key" => "ALTERACOES_HUMOR_FREQUENCIA"],
            ["label" => "Faz contato visual", "key" => "FAZ_CONTATO_VISUAL"],
            ["label" => "Se reconhece em fotos", "key" => "SE_RECONHECE_FOTOS"],
            ["label" => "Reconhece pessoas em fotos", "key" => "RECONHECE_PESSOAS_FOTOS"],
            ["label" => "Reconhece componentes familiares", "key" => "RECONHECE_COMPONENTES_FAMILIARES"]
        ];

        // Habilidades de autonomia e suas chaves correspondentes
        $habilidades_autonomia = [
            ["label" => "Utiliza fralda", "key" => "UTILIZA_FRALDA"],
            ["label" => "Se limpa sozinho(a)", "key" => "SE_LIMPA_SOZINHO"],
            ["label" => "Escova os dentes sozinho(a)", "key" => "ESCOVA_DENTES_SOZINHO"],
            ["label" => "Guarda seus pertences sozinho(a)", "key" => "GUARDA_PERTENCES_SOZINHO"],
            ["label" => "Amarra cadarços", "key" => "AMARRA_CADARCOS"],
            ["label" => "Abre mochila/estojo/lancheira sem auxílio", "key" => "ABRE_MOCHILA_SEM_AUXILIO"],
            ["label" => "É independente na realização das atividades", "key" => "INDEPENDENTE_REALIZACAO_ATIVIDADES"],
        ];

        $habilidades_cognitivas = [
            ["label" => "Reconhece e identifica as cores estudadas.", "key" => "RECONHECE_IDENTIFICA_CORES"],
            ["label" => "Reconhece e identifica os números estudados.", "key" => "RECONHECE_IDENTIFICA_NUMEROS"],
            ["label" => "Reconhece e identifica as letras estudadas.", "key" => "RECONHECE_IDENTIFICA_LETRAS"],
            ["label" => "Diferencia letras de números.", "key" => "DIFERENCIA_LETRAS_NUMEROS"],
            ["label" => "Identifica as letras do nome.", "key" => "IDENTIFICA_LETRAS_NOME"],
            ["label" => "Escreve o próprio nome sem auxílio.", "key" => "ESCREVE_NOME_SEM_AUXILIO"],
            ["label" => "Realiza pareamento.", "key" => "REALIZA_PAREAMENTO"],
            ["label" => "Mantém atenção concentrada.", "key" => "MANTEM_ATENCAO_CONCENTRADA"],
            ["label" => "Reconhece as sílabas estudadas.", "key" => "RECONHECE_SILABAS_ESTUDADAS"],
            ["label" => "Identifica as partes do corpo.", "key" => "IDENTIFICA_PARTES_CORPO"],
            ["label" => "Nomeia pessoas ao seu redor e familiares.", "key" => "NOMEIA_PESSOAS_FAMILIARES"],
            ["label" => "Apresenta sequência lógica dos fatos.", "key" => "SEQUENCIA_LOGICA_FATOS"],
            ["label" => "Relaciona números às suas respectivas quantidades.", "key" => "RELACIONA_NUMEROS_QUANTIDADES"],
            ["label" => "Comunica-se com clareza.", "key" => "COMUNICA_CLAREZA"],
            ["label" => "Observa semelhanças e diferenças entre os objetos.", "key" => "OBSERVA_SEMELHANCA_DIFERENCA_OBJETOS"],
            ["label" => "Compreende e responde sua idade quando questionado(a).", "key" => "COMPREENDER_RESPONDE_IDADE"],
        ];

        // Habilidades de relação família-escola e suas chaves correspondentes
        $habilidades_relacao = [
            ["label" => "Participa das reuniões quando solicitado.", "key" => "PARTICIPA_REUNIOES_SOLICITADO"],
            ["label" => "Deixa o aluno(a) na escola com o uniforme limpo.", "key" => "UNIFORME_LIMPO"],
            ["label" => "Realiza banho diário.", "key" => "REALIZA_BANHO_DIARIO"],
            ["label" => "Higieniza os pertences pessoais do aluno(a) (mochila, toalhas etc.).", "key" => "HIGIENIZA_PERTENCES_ALUNO"],
            ["label" => "Cuidado com os materiais escolares do aluno(a).", "key" => "CUIDADO_MATERIAIS_ESCOLARES"],
            ["label" => "É um aluno assíduo.", "key" => "ALUNO_ASSIDUO"],
            ["label" => "Pontualidade nos horários de entrada e saída do aluno(a).", "key" => "PONTUALIDADE_HORARIOS_ENTRADA_SAIDA"],
        ];
    ?>

    <table>
        <!-- Linha com a célula mesclada -->
        <tr>
            <th colspan="5">ASPECTOS FÍSICOS</th>
        </tr>
        <!-- Cabeçalhos das colunas -->
        <tr>
            <th style="width: 50%" >HABILIDADES</th>
            <th style="width: 10%" >SIM</th>
            <th style="width: 10%" >NÃO</th>
            <th style="width: 10%" >PARCIALMENTE</th>
            <th style="width: 20%" >NÃO SE APLICA</th>
        </tr>
        <!-- Dados das habilidades e marcadores de teste -->
        
        <?php
        // Preenchendo a tabela com os dados
        foreach ($habilidades_fisicas as $habilidade) {
            echo '<tr>';
            echo '<td style="text-align: left;">' . $habilidade['label'] . '</td>';
            
            // Verifica se a habilidade foi respondida com "sim", "não", "parcial" ou "não se aplica"
            echo '<td>' . ($dados_fisicos->{$habilidade['key']} == 'sim' ? 'X' : '') . '</td>';
            echo '<td>' . ($dados_fisicos->{$habilidade['key']} == 'nao' ? 'X' : '') . '</td>';
            echo '<td>' . ($dados_fisicos->{$habilidade['key']} == 'parcialmente' ? 'X' : '') . '</td>';
            echo '<td>' . ($dados_fisicos->{$habilidade['key']} == 'naoaplica' ? 'X' : '') . '</td>';
            echo '</tr>';
        }
        ?>
    </table>

    <table>
        <!-- Linha com a célula mesclada -->
        <tr>
            <th colspan="5">ASPECTOS DA COORDENAÇÃO MOTORA FINA</th>
        </tr>
        <!-- Cabeçalhos das colunas -->
        <tr>
            <th style="width: 50%" >HABILIDADES</th>
            <th style="width: 10%" >SIM</th>
            <th style="width: 10%" >NÃO</th>
            <th style="width: 10%" >PARCIALMENTE</th>
            <th style="width: 20%" >NÃO SE APLICA</th>
        </tr>
        <!-- Dados das habilidades e marcadores de teste -->
        <?php
            // Preenchendo a tabela com os dados
            foreach ($habilidades_motora_fina as $habilidade) {
                echo '<tr>';
                echo '<td style="text-align: left;">' . $habilidade['label'] . '</td>';
                
                // Verifica se a habilidade foi respondida com "sim", "não", "parcial" ou "não se aplica"
                echo '<td>' . ($dados_motora_fina->{$habilidade['key']} == 'sim' ? 'X' : '') . '</td>';
                echo '<td>' . ($dados_motora_fina->{$habilidade['key']} == 'nao' ? 'X' : '') . '</td>';
                echo '<td>' . ($dados_motora_fina->{$habilidade['key']} == 'parcialmente' ? 'X' : '') . '</td>';
                echo '<td>' . ($dados_motora_fina->{$habilidade['key']} == 'naoaplica' ? 'X' : '') . '</td>';
                echo '</tr>';
            }
        ?>
    </table>

    <table>
        <!-- Linha com a célula mesclada -->
        <tr>
            <th colspan="5">ASPECTOS SOCIAIS E EMOCIONAIS</th>
        </tr>
        <tr>
            <th style="width: 50%" >HABILIDADES</th>
            <th style="width: 10%" >SIM</th>
            <th style="width: 10%" >NÃO</th>
            <th style="width: 10%" >PARCIALMENTE</th>
            <th style="width: 20%" >NÃO SE APLICA</th>
        </tr>
        <!-- Cabeçalhos das colunas -->
        <?php
            // Preenchendo a tabela com os dados
            foreach ($habilidades_sociais_emocionais as $habilidade) {
                echo '<tr>';
                echo '<td style="text-align: left;">' . $habilidade['label'] . '</td>';
                
                // Verifica se a habilidade foi respondida com "sim", "não", "parcial" ou "não se aplica"
                echo '<td>' . ($dados_sociais_emocionais->{$habilidade['key']} == 'sim' ? 'X' : '') . '</td>';
                echo '<td>' . ($dados_sociais_emocionais->{$habilidade['key']} == 'nao' ? 'X' : '') . '</td>';
                echo '<td>' . ($dados_sociais_emocionais->{$habilidade['key']} == 'parcialmente' ? 'X' : '') . '</td>';
                echo '<td>' . ($dados_sociais_emocionais->{$habilidade['key']} == 'naoaplica' ? 'X' : '') . '</td>';
                echo '</tr>';
            }
        ?>
    </table>

    <table>
        <!-- Linha com a célula mesclada -->
        <tr>
            <th colspan="5">ASPECTOS DE AUTONOMIA</th>
        </tr>
        <!-- Cabeçalhos das colunas -->
        <tr>
            <th style="width: 50%">HABILIDADES</th>
            <th style="width: 10%" >SIM</th>
            <th style="width: 10%" >NÃO</th>
            <th style="width: 10%" >PARCIALMENTE</th>
            <th style="width: 20%" >NÃO SE APLICA</th>
        </tr>
        <!-- Dados das habilidades e marcadores de teste -->
        <?php
            // Preenchendo a tabela com os dados
            foreach ($habilidades_autonomia as $habilidade) {
                echo '<tr>';
                echo '<td style="text-align: left;">' . $habilidade['label'] . '</td>';
                
                // Verifica se a habilidade foi respondida com "sim", "não", "parcial" ou "não se aplica"
                echo '<td>' . ($dados_autonomia->{$habilidade['key']} == 'sim' ? 'X' : '') . '</td>';
                echo '<td>' . ($dados_autonomia->{$habilidade['key']} == 'nao' ? 'X' : '') . '</td>';
                echo '<td>' . ($dados_autonomia->{$habilidade['key']} == 'parcialmente' ? 'X' : '') . '</td>';
                echo '<td>' . ($dados_autonomia->{$habilidade['key']} == 'naoaplica' ? 'X' : '') . '</td>';
                echo '</tr>';
            }
        ?>
    </table>

    <table>
        <!-- Linha com a célula mesclada -->
        <tr>
            <th colspan="5">ASPECTOS COGNITIVOS</th>
        </tr>
        <!-- Cabeçalhos das colunas -->
        <tr>
            <th style="width: 50%">HABILIDADES</th>
            <th style="width: 10%" >SIM</th>
            <th style="width: 10%" >NÃO</th>
            <th style="width: 10%" >PARCIALMENTE</th>
            <th style="width: 20%" >NÃO SE APLICA</th>
        </tr>
        <?php
            // Preenchendo a tabela com os dados
            foreach ($habilidades_cognitivas as $habilidade) {
                echo '<tr>';
                echo '<td style="text-align: left;">' . $habilidade['label'] . '</td>';
                
                // Verifica se a habilidade foi respondida com "sim", "não", "parcial" ou "não se aplica"
                echo '<td>' . ($dados_cognitivos->{$habilidade['key']} == 'sim' ? 'X' : '') . '</td>';
                echo '<td>' . ($dados_cognitivos->{$habilidade['key']} == 'nao' ? 'X' : '') . '</td>';
                echo '<td>' . ($dados_cognitivos->{$habilidade['key']} == 'parcialmente' ? 'X' : '') . '</td>';
                echo '<td>' . ($dados_cognitivos->{$habilidade['key']} == 'naoaplica' ? 'X' : '') . '</td>';
                echo '</tr>';
            }
        ?>
    </table>

    <table>
        <!-- Linha com a célula mesclada -->
        <tr>
            <th colspan="5">PARTICIPAÇÃO DOS RESPONSÁVEIS NA VIDA ESCOLAR</th>
        </tr>
        <!-- Cabeçalhos das colunas -->
        <tr>
            <th style="width: 50%">HABILIDADES</th>
            <th style="width: 10%" >SIM</th>
            <th style="width: 10%" >NÃO</th>
            <th style="width: 10%" >PARCIALMENTE</th>
            <th style="width: 20%" >NÃO SE APLICA</th>
        </tr>
        <?php
            // Preenchendo a tabela com os dados
            foreach ($habilidades_relacao as $habilidade) {
                echo '<tr>';
                echo '<td style="text-align: left;">' . $habilidade['label'] . '</td>';
                
                // Verifica se a habilidade foi respondida com "sim", "não", "parcial" ou "não se aplica"
                echo '<td>' . ($dados_relacao_familia_escola->{$habilidade['key']} == 'sim' ? 'X' : '') . '</td>';
                echo '<td>' . ($dados_relacao_familia_escola->{$habilidade['key']} == 'nao' ? 'X' : '') . '</td>';
                echo '<td>' . ($dados_relacao_familia_escola->{$habilidade['key']} == 'parcialmente' ? 'X' : '') . '</td>';
                echo '<td>' . ($dados_relacao_familia_escola->{$habilidade['key']} == 'naoaplica' ? 'X' : '') . '</td>';
                echo '</tr>';
            }
        ?>
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
