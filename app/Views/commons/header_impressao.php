<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial!important;
            margin: 20px;
            font-size: 17px!important
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px
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
            margin-top: -20px
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
        @media print {
            body {
                zoom: 90%;
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
        if(isset($codigo)){
            echo '<span style="display: flex; justify-content: end" > <strong> Código: </strong> '.$codigo.'</span>';
        }

    ?>
    

    <div class="header-info">
        <?php
            if(isset($escola->NOME_ALEATORIO) && ($escola->NOME_ALEATORIO != null || $escola->NOME_ALEATORIO != "")){
                echo '	<img src="'.LINK_UPLOAD.$escola->NOME_ALEATORIO.'"  width=100 class="img-bordered">';
            }else{
                echo '	<img src="'.LINK_UPLOAD.'padrao.png'.'" width=100 class="img-bordered">';
            }
        ?>
        <p><strong><?= mb_strtoupper($escola->ESCOLA, 'UTF-8') ?></strong><br>
        Autorização Educação Infantil CME Nº <?= $escola->CME ?> - INEP Nº <?= $escola->INEP ?><br>
        <?= $escola->LOGRADOURO ?>, <?= $escola->BAIRRO ?>, CEP: <?= $escola->CEP ?><br>
        <?= $escola->MUNICIPIO ?> – <?= $escola->FUNCIONAMENTO ?></p>
    </div>
    
    
