<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
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
            text-align: center;
        }
        .signature div {
            display: inline-block;
            width: 40%; 
            text-align: center;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>


<div style="border: 1px solid #949494; padding: 20px; text-align: center; width: 500px; height: 240px" class="container">
    <div class="row" style="margin-left: 15px" >
        <div class="col-md-2">
            <?php
                if(isset($escola->NOME_ALEATORIO) && !empty($escola->NOME_ALEATORIO)){
                    echo '<img style="margin-right: 30px;" src="'.LINK_UPLOAD.$escola->NOME_ALEATORIO.'" width=25 class="img-bordered img-fluid">';
                } else {
                    echo '<img style="margin-right: 30px;" src="'.LINK_UPLOAD.'padrao.png'.'" width=25 class="img-bordered img-fluid">';
                }
            ?>
        </div>
        <div class="col-md-8">
            <div class="header-info" style="text-align: justify; font-size: 11px">
                <span><strong><?= $escola->ESCOLA ?></strong></span><br>
                <?= $escola->LOGRADOURO ?>, <?= $escola->BAIRRO ?><br>
                <span><strong>INEP Nº: </strong><?= $escola->ESCOLA ?></span><br>
                <span><strong>TELEFONE: </strong><?= $escola->TELEFONE ?></span><br>
            </div>
        </div>
    </div>

    <div class="row" style="margin-left: 15px">
        <div class="col-md-2">
            <?php
                if(isset($aluno->NOME_ALEATORIO) && !empty($aluno->NOME_ALEATORIO)){
                    echo '<img style="margin-right: 30px;" src="'.LINK_UPLOAD.$aluno->NOME_ALEATORIO.'" width=75 class="img-bordered img-fluid">';
                } else {
                    echo '<img style="margin-right: 30px;" src="'.LINK_UPLOAD.'padrao.png'.'" width=75 class="img-bordered img-fluid">';
                }
            ?>
            <p style="font-size: 10px; text-align: center" >Foto</p>
        </div>
        <div class="col-md-8" style="margin-top: -10px" >
            <div class="header-info" style="text-align: justify; font-size: 12px;">
                <span><strong>Nome</strong></span><br>
                <div style="border-radius: 2px;border: 2px solid #CCCCCC;padding: 5px;width: 322px; height: 20px; display: flex;align-items: center; font-size: 10px;">
                    <strong><?= $aluno->NOME_ALUNO ?></strong>
                </div>

                <div style="display: flex;  margin-top: 5px" >
                    <span style="display: flex; margin-right: 5px" ><strong>Etapa:</strong> 
                    <div style="border-radius: 2px;border: 2px solid #CCCCCC;padding: 5px;width: 50px; height: 20px; display: flex;align-items: center; font-size: 10px;">
                        <?= $aluno->ETAPA ?>
                    </div></span>
    
                    <span style="display: flex; margin-right: 5px" ><strong>Turma:</strong> 
                    <div style="border-radius: 2px;border: 2px solid #CCCCCC;padding: 5px;width: 75px; height: 20px; display: flex;align-items: center; font-size: 10px;">
                        <?= $aluno->NOME_TURMA ?>
                    </div></span>
    
                    <span style="display: flex; margin-right: 5px" ><strong>Turno:</strong> 
                    <div style="border-radius: 2px;border: 2px solid #CCCCCC;padding: 5px;width: 72px; height: 20px; display: flex;align-items: center; font-size: 10px;">
                        <?= $aluno->TIPO_ATENDIMENTO ?>
                    </div></span>
                </div>

                <?php
                    $telefone = !empty($aluno->RESPONSAVEL_LEGAL_TELEFONE) ? $aluno->RESPONSAVEL_LEGAL_TELEFONE : 
                               (!empty($aluno->FILIACAO_1_TELEFONE) ? $aluno->FILIACAO_1_TELEFONE : $aluno->FILIACAO_2_TELEFONE);

                    $tipo_resp = match($aluno->RESPONSAVEL_LEGAL) {
                        'A' => "Ambos",
                        'M' => "Filiação 1",
                        'P' => "Filiação 2",
                        default => "Outro - ",
                    };
                ?>

                <span><strong>Nome do Responsável</strong></span><br>
                <div style="border-radius: 2px;border: 2px solid #CCCCCC;padding: 5px;width: 322px; height: 20px; display: flex;align-items: center; font-size: 10px;">
                    <?= $tipo_resp . $aluno->RESPONSAVEL_LEGAL_NOME ?>
                </div>


                <div style="display: flex;  margin-top: 5px; " >
                    <span style="display: flex; margin-right: -30px; text-align: left" ><strong>Parentesco:</strong> 
                        <div style="border-radius: 2px;border: 2px solid #CCCCCC;padding: 5px;width: 110px; height: 20px; display: flex;align-items: center; font-size: 10px;">
                            <?= $aluno->GRAU_PARENTESCO ?>
                        </div>
                    </span>
    
                    <span style="display: flex; margin-left: 40px" ><strong>Tel:</strong> 
                    <div style="border-radius: 2px;border: 2px solid #CCCCCC;padding: 5px;width: 112px; height: 20px; display: flex;align-items: center; font-size: 10px;">
                        <?= $telefone ?>
                    </div></span>

                </div>

            </div>
        </div>
    </div>
</div>
    <div style="border: 1px solid #949494; padding: 20px; text-align: center; width: 500px; height: 240px" class="container">
                    

    <div class="row" style="margin-top: -20px">
        <div class="col-md-8 mx-auto d-flex justify-content-center">
            <div class="header-info" style="text-align: justify; font-size: 12px">
                <p>É indispensável a apresentação da carteira de identificação da criança na portaria da escola para liberação desta.</p>
                <p><strong>OBS: </strong> A Instituição <strong>NÃO AUTORIZA</strong> a saída do aluno com outra criança ou adolescente.</p>
                <p style="text-align: center; height: 50px">__________________________________________ <br>Assinatura do responsável</p>
            </div>
        </div>
    </div>
</div>



    
</body>
</html>

<style>
        body {
            font-family: Arial, sans-serif;
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
            transform: rotate(180deg);
        }
        h1, h2 {
            text-align: center;
        }
        .header-info {
            text-align: center;
            margin-bottom: 20px;
        }
        .signature {
            text-align: center;
        }
        .signature div {
            display: inline-block;
            width: 40%;
            text-align: center;
        }
        /* Estilo para impressão */
        @media print {
            @page {
                size: portrait; /* Para paisagem */
                /* size: portrait;  Para retrato (padrão) */
            }
            /* Forçar as colunas a ficarem lado a lado para todas as larguras de colunas */
            .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6,
            .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
                float: left; /* Força os elementos a ficarem lado a lado */
            }

            #titulo {
                background-color: #CCCCCC !important;
                text-align: center !important;
                font-size: 15px !important;
                width: 99%;
            }

            /* Definir as larguras proporcionais com base no sistema de 12 colunas */
            .col-md-1 { width: 8.33%; }
            .col-md-2 { width: 16.66%; }
            .col-md-3 { width: 25%; }
            .col-md-4 { width: 33.33%; }
            .col-md-5 { width: 41.66%; }
            .col-md-6 { width: 50%; }
            .col-md-7 { width: 58.33%; }
            .col-md-8 { width: 66.66%; }
            .col-md-9 { width: 75%; }
            .col-md-10 { width: 83.33%; }
            .col-md-11 { width: 91.66%; }
            .col-md-12 { width: 100%; }
        }
    </style>
        

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bumdle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55mdzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>