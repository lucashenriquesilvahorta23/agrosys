<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ata de Resultados Finais</title>
    <style>
        body {
            font-family: Arial!important;
            margin: 20px;
            font-size: 15px!important
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th.vertical, td.vertical {
            writing-mode: vertical-rl;
            transform: rotate(180deg); /* Isso ajusta a orientação do texto */
        }
        h1, h2 {
            text-align: center;
        }
        .header-info {
            text-align: center;
            margin-bottom: 20px;
        }
        .signature {
            margin-top: 50px;
            text-align: center;
        }
        .signature div {
            display: inline-block;
            width: 40%;
            text-align: center;
        }
    </style>
</head>
<body>

    <div style=" border: 5px double #FFFFFF; padding: 60px" >  
        <?php
            if(isset($codigo)){
                echo '<span style="display: flex; justify-content: end" > <strong> Código: </strong> '.$codigo.'</span>';
            }

        ?>
        

        <div class="header-info">
            <?php
                if(isset($escola->NOME_ALEATORIO) && ($escola->NOME_ALEATORIO != null || $escola->NOME_ALEATORIO != "")){
                    echo '	<img src="'.LINK_UPLOAD.$escola->NOME_ALEATORIO.'"  width=75 class="img-bordered">';
                }else{
                    echo '	<img src="'.LINK_UPLOAD.'padrao.png'.'" width=75 class="img-bordered">';
                }
            ?>
            <p><strong><?= mb_strtoupper($escola->ESCOLA, 'UTF-8') ?></strong><br>
            Autorização Educação Infantil CME Nº <?= $escola->CME ?> - INEP Nº <?= $escola->INEP ?><br>
            <?= $escola->LOGRADOURO ?>, <?= $escola->BAIRRO ?>, CEP: <?= $escola->CEP ?><br>
            <?= $escola->MUNICIPIO ?> – <?= $escola->FUNCIONAMENTO ?></p>
        </div>

        <h1 style="text-align: center; margin-top: 250px; margin-bottom: 300px"><strong>RELATÓRIO INDIVIDUAL <br>
        EDUCAÇÃO INFANTIL</strong></h1>


        <div class="row" style="display: flex; justify-content: center;">
            <div class="col-md-12" style="text-align: center">
            <?= $aluno->NOME_ALUNO; ?> <br>
            <strong> ALUNO</strong>
            </div>
        </div>
        <br><br>

        <?php
            switch ($turma->ETAPA) {
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


            switch ($turma->TIPO_ATENDIMENTO) {
                case 'IN':
                    $turno = 'Integral';
                    break;
                case 'PM':
                    $turno = 'Parcial Matutino';
                    break;
                case 'PV':
                    $turno = 'Parcial Vespertino';
                    break;
                case 'PA':
                    $turno = 'Parcial';
                    break;
                case 'ND':
                    $turno = 'Noturno';
                    break;
                case 'DU':
                    $turno = 'Dupla Jornada';
                    break;
                case 'SE':
                    $turno = 'Semi-integral';
                    break;
                default:
                    $turno = 'Não informado';
                    break;
            }

        ?>

        <div class="row" style="display: flex; justify-content: center; align-items: center">
            <div class="col-md-5" style="margin-right: 20px" >
                <strong>TURMA: </strong><?= $etapa; ?>
                <br><br>
                <strong>PERÍODO: </strong><?= $periodo."º"; ?> Semestre
            </div>

            <div class="col-md-5" style="margin-left: 20px" >
                <strong>TURNO: </strong><?= $turno; ?>
                <br><br>
                <strong>ANO LETIVO: </strong><?= $aluno->ANO_LETIVO; ?>
            </div>
        </div>


        <br><br><br><br><br><br><br><br>
        


    </div>


        <p align="justify">
        O relatório individual atua como uma ferramenta fundamental de avaliação na
        Educação Infantil, revelando o desenvolvimento dos aspectos físico, motor, cognitivo,
        social e emocional observados no percurso educativo da criança. Através desse
        documento, as famílias conseguem obter mais informações acerca do desenvolvimento
        educacional de seus filhos e como é fundamental o processo de ensino-aprendizagem
        na vida da criança
        </p>

        <p align="justify">
        A seguir, temos o relatório de desenvolvimento, construído a partir das
        observações e dos resultados das avaliações de aprendizagem realizadas ao longo do
        semestre da sua criança, com base nas habilidades da BNCC.
        </p>

        <p style="font-weight: bold; text-align: center" > DESCRIÇÃO DETALHADA </p>

        <p align="justify">
            <?= isset($aluno_acompanhamento) ? $aluno_acompanhamento->EU_OUTROS_NOS : ""; ?>
        </p>
        <br>
        <br>
        


        <p style="font-weight: bold; text-align: center" > ESTRATÉGIAS DE APOIO E INTERVENÇÕES </p>

        <p align="justify">
            <?= isset($aluno_acompanhamento) ? $aluno_acompanhamento->ESTRATEGIAS_APOIO_INTERVENCOES : ""; ?>
        </p>

        <br>
        <br>



        <p style="font-weight: bold; text-align: center" > RECOMENDAÇÕES  </p>

        <p align="justify">
            <?= isset($aluno_acompanhamento) ? $aluno_acompanhamento->RECOMENDACOES : ""; ?>
        </p>

        <br>
        <br>



        <div class="row" style="display: flex; justify-content: center;">
            <div class="col-md-12" style="text-align: center">
            <strong>DATA:</strong> <?= inverterData(date('Y-m-d')) ?>  <br>
            <strong> </strong>
            </div>
        </div>
        <br><br>

        <div class="row" style="display: flex; justify-content: center;">
            <div class="col-md-5" style="text-align: center">
            ________________________________ <br>
            <?= $escola->GESTOR ?> <br>
            CPF: <?= $escola->CPF_GESTOR ?> <br>
            <strong> Gestor (a) Escolar</strong>
            </div>
            <div class="col-md-2" style="margin-left: 20px; margin-right: 20px"></div>
            <div class="col-md-5" style="text-align: center">
            ________________________________ <br>
            <?= $escola->COORDENADOR ?> <br>
            CPF: <?= $escola->CPF_COORDENADOR ?> <br>
            <strong>Coordenador (a) Escolar</strong>
            </div>
        </div>
        <br>

        <div class="row" style="display: flex; justify-content: center;">
            <div class="col-md-5" style="text-align: center">
            ________________________________ <br>
            <?= $profissional->NOME_PROFISSIONAL ?> <br>
            CPF: <?= $profissional->CPF ?> <br>
            <strong>PROFESSOR(A)</strong>
            </div>
            <div class="col-md-2" style="margin-left: 20px; margin-right: 20px"></div>
            <div class="col-md-5" style="text-align: center">
            ________________________________ <br>
            <strong> RESPONSÁVEL</strong>
            </div>
        </div>

    
</body>
</html>
