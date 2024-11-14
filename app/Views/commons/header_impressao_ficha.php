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
        @media print {
            #incioDados {
                zoom: 90%;
            }
        }
    </style>
        <script>
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>


    <div class="row">
        <div class="col-md-2"  >
            <?php
                if(isset($escola->NOME_ALEATORIO) && ($escola->NOME_ALEATORIO != null || $escola->NOME_ALEATORIO != "")){
                    echo '	<img style="margin-left: 30px;" src="'.LINK_UPLOAD.$escola->NOME_ALEATORIO.'"  width=80 class="img-bordered">';
                }else{
                    echo '	<img style="margin-left: 30px;" src="'.LINK_UPLOAD.'padrao.png'.'" width=80 class="img-bordered">';
                }
            ?>
        </div>
        <div class="col-md-8" >
            <div class="header-info" style="text-align: justify; font-size: 14px">
                <span><strong><?= mb_strtoupper($escola->ESCOLA, 'UTF-8') ?></strong><br>
                Autorização Educação Infantil CME Nº <?= $escola->CME ?> - INEP Nº <?= $escola->INEP ?><br>
                <?= $escola->LOGRADOURO ?>, <?= $escola->BAIRRO ?>, CEP: <?= $escola->CEP ?><br>
                <?= $escola->MUNICIPIO ?> – <?= $escola->FUNCIONAMENTO ?></span>
            </div>
        </div>
        <div class="col-md-2 "   >
            <?php
                if(isset($aluno->NOME_ALEATORIO) && ($aluno->NOME_ALEATORIO != null || $aluno->NOME_ALEATORIO != "")){
                    echo '	<img style="border: 1px solid #000; border-radius: 8px;" src="'.LINK_UPLOAD.$aluno->NOME_ALEATORIO.'"  width=75 class="img-bordered">';
                }else{
                    echo '	<img src="'.LINK_UPLOAD.'padrao.png'.'" width=75 class="img-bordered">';
                }
            ?>
            <p style="font-size: 9px" >Foto do(a) aluno(a)</p>
        </div>
    </div>
<div id="incioDados" >