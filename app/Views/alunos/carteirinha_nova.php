<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            height: 100vh;
            background-color: #f4f4f4;
        }

        .carteirinhas {
            display: flex;
            justify-content: center;
        }

        .carteirinha {
            width: 13.5cm; /* Aproximadamente 90% de 15cm */
            height: 7.5cm; /* Aproximadamente 90% de 7.5cm */
            border: 1px solid #000;
            background-color: #ffffff;
        }

        .carteirinha img {
            width: 90px; /* Redução proporcional */
        }

        .carteirinha .col-md-12 span, 
        .carteirinha div span {
            font-size: 10.8px; /* Redução de 12px para 90% */
        }


        .carteirinha p {
            font-size: 9px; /* Redução de fontes */
        }

        /* Ajustes para os campos de texto */
        .input-field {
            font-size: 9px; /* Ajuste proporcional da fonte */
            padding: 4px;
            height: 18px; /* Ajuste de altura */
        }

        @media print {
            /* Remove margens da impressão */
            @page {
                margin: 25px;
            }

            /* Ajuste os estilos da carteirinha para expandir no papel */
            body {
                margin: 0;
                padding: 0;
            }
            .carteirinha {
                margin: 0;
                width: 100%;
                height: 275px;
            }

            /* Caso queira ajustar as bordas da carteirinha ou espaçamentos internos */
            .carteirinha {
                padding: 0;
            }
        }
    </style>
    <style>
    @media print {
        @page {
            size: portrait; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>
</style>
        <script>
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="carteirinhas">
        <div style="margin-right: 9px" class="carteirinha">
            <div class="row">
                <div style="text-align: center" class="col-md-12">
                    <?php
                        if(isset($escola->NOME_ALEATORIO) && !empty($escola->NOME_ALEATORIO)){
                            echo '<img style="margin-top: 5px" src="'.LINK_UPLOAD.$escola->NOME_ALEATORIO.'" class="img-bordered img-fluid">';
                        } else {
                            echo '<img style="margin-top: 5px" src="'.LINK_UPLOAD.'padrao.png'.'" class="img-bordered img-fluid">';
                        }
                    ?>
                </div>
                <div style="text-align: center" class="col-md-12">
                    <div style="line-height: 0.8;">
                        <span style="font-weight: bold; font-size: 12px;"><?= $escola->ESCOLA ?></span>
                        <br>
                        <span style="font-size: 11px;"><?= $escola->LOGRADOURO ?>, <?= $escola->BAIRRO ?><br></span>
                        <span style="font-size: 11px;">INEP Nº: <?= $escola->INEP ?></span><br>
                    </div>

                    <div style="text-align: justify; padding: 10px" >
                        <span style="font-size: 11px" >É indispensável a apresentação da carteira de identificação da criança na portaria da escola para liberação desta.</span><br>
                        <span style="font-size: 11px" ><strong>OBS: </strong> A Instituição <strong>NÃO AUTORIZA</strong> a saída do aluno com outra criança ou adolescente.</span>
                    </div>
                    <span style="font-size: 13px; text-align: center; height: 50px">____________________________________________ <br>Assinatura do responsável</span>
                </div>
            </div>
        </div>
        <div style="margin-left: 10px" class="carteirinha">
            <div style="display: flex" >
                <div style="padding: 10px; display: flex; flex-direction: column" >  
                    <?php
                        if(isset($escola->NOME_ALEATORIO) && !empty($escola->NOME_ALEATORIO)){
                            echo '<img style="margin-top: 5px" src="'.LINK_UPLOAD.$escola->NOME_ALEATORIO.'" width=100 class="img-bordered img-fluid">';
                        } else {
                            echo '<img style="margin-top: 5px" src="'.LINK_UPLOAD.'padrao.png'.'" width=100 class="img-bordered img-fluid">';
                        }
                    ?>
                    <br>
                    <?php
                        if(isset($aluno->NOME_ALEATORIO) && !empty($aluno->NOME_ALEATORIO)){
                            echo '<img style="margin-top: 5px; border: 1px solid #000; border-radius: 8px" src="'.LINK_UPLOAD.$aluno->NOME_ALEATORIO.'" width=100 class="img-bordered img-fluid">';
                        } else {
                            echo '<img style="margin-top: 5px" src="'.LINK_UPLOAD.'padrao.png'.'" width=100 class="img-bordered img-fluid">';
                        }

                        $etapa = $aluno->ETAPA;

                        if ($etapa == 'I1') {
                            $etapa = 'Ed. Infantil I – 4 Anos</td>';
                        } elseif ($etapa == 'I2') {
                            $etapa = 'Ed. Infantil II – 5 Anos</td>';
                        } elseif ($etapa == 'C1') {
                            $etapa = 'Creche I – 1 Ano</td>';
                        } elseif ($etapa == 'C2') {
                            $etapa = 'Creche II – 2 Anos</td>';
                        } elseif ($etapa == 'C3') {
                            $etapa = 'Creche III – 3 Anos</td>';
                        } elseif ($etapa == 'F1') {
                            $etapa = 'Fundamental I</td>';
                        } elseif ($etapa == 'F2') {
                            $etapa = 'Fundamental II</td>';
                        } elseif ($etapa == 'M1') {
                            $etapa = 'Médio I</td>';
                        } elseif ($etapa == 'M2') {
                            $etapa = 'Médio II</td>';
                        } else {
                            $etapa = 'Não informado</td>';
                        }
                    ?>
                    <p style="font-size: 10px; text-align: center" >Foto do(a) aluno(a)</p>
                </div>
                <div style="padding: 10px" >  
                    <div style="line-height: 0.8; text-align: center">
                        <span style="font-weight: bold; font-size: 12px;"><?= $escola->ESCOLA ?></span>
                        <br>
                        <span style="font-size: 11px;"><?= $escola->LOGRADOURO ?>, <?= $escola->BAIRRO ?><br></span>
                        <span style="font-size: 11px;">INEP Nº: <?= $escola->INEP ?></span><br>
                        <span style="font-weight: bold; font-size: 12px;" >CARTEIRA DE IDENTIFICAÇÃO DO ALUNO</span>
                    </div>
                    <span style="font-size: 10px" ><strong>Nome do(a) Aluno(a):</strong></span><br>
                    <div style="border-radius: 2px;border: 2px solid #949494;padding: 5px;width: 250px; height: 20px; display: flex;align-items: center; font-size: 10px;">
                        <strong><?= $aluno->NOME_ALUNO ?></strong>
                    </div>
                    <div style="display: flex; justify-content:space-between;" >
                        <div style="display: flex; flex-direction: column" >
                            <span style="font-size: 10px" ><strong>Etapa:</strong></span>
                            <div style="border-radius: 2px;border: 2px solid #949494;padding: 5px;width: 130px; height: 20px; display: flex;align-items: center; font-size: 10px;">
                                <strong><?= $etapa ?></strong>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column" >
                            <span style="font-size: 10px" ><strong>Turma:</strong></span>
                            <div style="border-radius: 2px;border: 2px solid #949494;padding: 5px;width: 110px; height: 20px; display: flex;align-items: center; font-size: 10px;">
                                <strong><?= $aluno->NOME_TURMA ?></strong>
                            </div>
                        </div>
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

                        switch ($aluno->TIPO_ATENDIMENTO) {
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
                    <div style="display: flex; justify-content:space-between;" >
                        <div style="display: flex; flex-direction: column" >
                            <span style="font-size: 10px" ><strong>Turno:</strong></span>
                            <div style="border-radius: 2px;border: 2px solid #949494;padding: 5px;width: 130px; height: 20px; display: flex;align-items: center; font-size: 10px;">
                                <strong><?= $turno ?></strong>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column" >
                            <span style="font-size: 10px" ><strong>Tel:</strong></span>
                            <div style="border-radius: 2px;border: 2px solid #949494;padding: 5px;width: 110px; height: 20px; display: flex;align-items: center; font-size: 10px;">
                                <strong><?= $telefone ?></strong>
                            </div>
                        </div>
                    </div>
                    <span style="font-size: 10px" ><strong>Filiação 1:</strong></span><br>
                    <div style="border-radius: 2px;border: 2px solid #949494;padding: 5px;width: 250px; height: 20px; display: flex;align-items: center; font-size: 10px;">
                        <strong><?= $aluno->FILIACAO_1 ?></strong>
                    </div>
                    <span style="font-size: 10px" ><strong>Filiação 2:</strong></span><br>
                    <div style="border-radius: 2px;border: 2px solid #949494;padding: 5px;width: 250px; height: 20px; display: flex;align-items: center; font-size: 10px;">
                        <strong><?= $aluno->FILIACAO_2 ?></strong>
                    </div>
                </div>
            </div>
            <div style="display: flex" >
                <div style="padding: 10px" >  
                    
                </div>
                
            </div>
            
        </div>
    </div>
    



    
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bumdle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55mdzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>