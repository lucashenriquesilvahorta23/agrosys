<style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px!important
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
        <span style="text-align: center; font-size: 15px; display: flex; justify-content: center"><strong>FICHA DO ALUNO</strong></span>
        <span id="titulo" style="background-color: #CCCCCC; text-align: center; font-size: 15px; display: flex; justify-content: center"><strong>DADOS DO(A) ALUNO(A)</strong></span>
        <div class="row" style="margin-bottom: 3px">
        <div class="col-md-8" style="display: flex">
            <label style="font-size: 15px; font-weight: bold;" for="exampleInputtext1">NIS do Aluno:</label>
            <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 430px; height: 23px; display: flex;align-items: center; font-size: 15px;">
                <?= $aluno->ID_ALUNO ?: ''; ?>
            </div>
        </div>
        <div class="col-md-4" style="display: flex">
            <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Cartão do SUS:</label>
            <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 133px; height: 23px; display: flex;align-items: center; font-size: 14px;">
                <?= $aluno->CARTAO_SUS ?: ''; ?>
            </div>
        </div>
</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-9" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Nome do(a) Aluno(a):</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 375px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->NOME_ALUNO; ?>
        </div>
    </div>
    <div class="col-md-3" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Nascimento:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 81px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= date("d/m/Y", strtotime($aluno->DATA_NASCIMENTO)); ?>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-2" style="display: flex" >
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Sexo:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 70px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->SEXO == 'M' ? 'Masc.' : 'Fem.'; ?>
        </div>
    </div>
    <div class="col-md-3" style="display: flex" >
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">CPF:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 150px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->CPF; ?>
        </div>
    </div>
    <div class="col-md-3" style="display: flex" >
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Emissão:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 112px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= date("d/m/Y", strtotime($aluno->DATA_EMISSAO)); ?>
        </div>
    </div>
    <div class="col-md-4" style="display: flex" >
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Órgão:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 192px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->ORGAO_EXPEDITOR; ?>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-6" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Natural de (Cidade):</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 200px; height: 23px; display: flex;align-items: center; font-size: 14px;">
        <?= getCityNameById($aluno->NATURALIDADE); ?>
        </div>
    </div>
    <div class="col-md-2" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Estado:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 54px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->ESTADO_NATURALIDADE; ?>
        </div>
    </div>
    <div class="col-md-4" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Nacionalidade:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 134px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->NACIONALIDADE == 'BR' ? 'Brasileiro(a)' : ''; ?>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-8" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Certidão de Nascimento:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 278px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->NUMERO_MATRICULA ?: ''; ?>
        </div>
    </div>
    <div class="col-md-4" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Cor ou Raça:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 147px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?php 
                switch($aluno->COR_RACA) {
                    case 'BR':
                        echo 'Branco(a)';
                        break;
                    case 'AM':
                        echo 'Amarelo(a)';
                        break;
                    case 'IN':
                        echo 'Indígena';
                        break;
                    case 'NG':
                        echo 'Negro(a)';
                        break;
                    case 'PD':
                        echo 'Pardo(a)';
                        break;
                    case 'ND':
                        echo 'Não declarado';
                        break;
                    default:
                        echo 'Outra';
                        break;
                }
            ?>
        </div>
    </div>

</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-7" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Filiação 1:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 380px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->FILIACAO_1; ?>
        </div>
    </div>
    <div class="col-md-2" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Situação:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 100px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->FILIACAO_1_VIVO == 'V' ? 'Vivo' : 'Falecido'; ?>
        </div>
    </div>
    <div class="col-md-3" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Tel:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 145px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->FILIACAO_1_TELEFONE ?: ''; ?>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-7" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Filiação 2:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 380px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->FILIACAO_2 ?: ''; ?>
        </div>
    </div>
    <div class="col-md-2" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Situação:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 100px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->FILIACAO_2_VIVO == 'V' ? 'Vivo' : 'Falecido'; ?>
        </div>
    </div>
    <div class="col-md-3" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Tel:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 145px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->FILIACAO_2_TELEFONE ?: ''; ?>
        </div>
    </div>
</div>

<?php
    if($aluno->RESPONSAVEL_LEGAL == "A"){
        $tipo_resp = "Filiação 1 e 2";
    }else if($aluno->RESPONSAVEL_LEGAL == "M"){
        $tipo_resp = "Filiação 1";
    }else if($aluno->RESPONSAVEL_LEGAL == "P"){
        $tipo_resp = "Filiação 2";
    }else{
        $tipo_resp = "Outro - ";
    }

?>
<div class="row" style="margin-bottom: 3px">
    <div class="col-md-6" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Responsável:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 250px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $tipo_resp.$aluno->RESPONSAVEL_LEGAL_NOME ?: ''; ?>
        </div>
    </div>
    <div class="col-md-6" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Grau de Parentesco:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 232px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->GRAU_PARENTESCO ?: ''; ?>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-3" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Telefone:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 150px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->RESPONSAVEL_LEGAL_TELEFONE ?: ''; ?>
        </div>
    </div>
</div>

<span id="titulo" style="background-color: #CCCCCC; text-align: center; font-size: 15px; display: flex; justify-content: center; margin-bottom: 5px"><strong>DADOS DO ENDEREÇO</strong></span>
<div class="row" style="margin-bottom: 3px">
    <div class="col-md-7" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Endereço:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 380px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->ENDERECO; ?>
        </div>
    </div>
    <div class="col-md-5" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Bairro:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 261px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->BAIRRO; ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-5" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Cidade:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 300px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->CIDADE; ?>
        </div>
    </div>
    <div class="col-md-2" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">UF:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 80px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->ESTADO; ?>
        </div>
    </div>
    <div class="col-md-5" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Compl.:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 255px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->NUMERO; ?>
        </div>
    </div>
</div>
<br>
<span id="titulo" style="background-color: #CCCCCC; text-align: center; font-size: 15px; display: flex; justify-content: center"><strong>INFORMAÇÕES COMPLEMENTARES</strong></span>
<!-- Deficiências -->
<div class="row">
    <div class="col-md-12">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Deficiência: <?= isset($aluno_deficiencia->DEFICIENCIA_FISICA) && $aluno_deficiencia->DEFICIENCIA_FISICA == 'S' ? 'Sim' : 'Não'; ?></label>
        <br>
        <input class="form-check-input" type="checkbox" <?= isset($aluno_deficiencia->BAIXA_VISAO) && $aluno_deficiencia->BAIXA_VISAO == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label" style="margin-right: 20px">Baixa Visão</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno_deficiencia->AUDITIVA) && $aluno_deficiencia->AUDITIVA == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label">Deficiência Auditiva</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno_deficiencia->SURDOCEGUEIRA) && $aluno_deficiencia->SURDOCEGUEIRA == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label">Surdocegueira</label>
        <input class="form-check-input" style="margin-left: 20px" type="checkbox" <?= isset($aluno_deficiencia->INTELECTUAL) && $aluno_deficiencia->INTELECTUAL == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label">Deficiência Intelectual</label>
        <br>
        <input class="form-check-input" type="checkbox" <?= isset($aluno_deficiencia->CEGUEIRA) && $aluno_deficiencia->CEGUEIRA == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label" style="margin-right: 40px">Cegueira</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno_deficiencia->SURDEZ) && $aluno_deficiencia->SURDEZ == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label">Surdez</label>
        <input class="form-check-input" style="margin-left: 87px" type="checkbox" <?= isset($aluno_deficiencia->DEFICIENCIA_FISICA) && $aluno_deficiencia->DEFICIENCIA_FISICA == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label">Deficiência Física</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno_deficiencia->MULTIPLA) && $aluno_deficiencia->MULTIPLA == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label">Deficiência Múltipla</label>
    </div>
</div>

<!-- Transtornos -->
<div class="row">
    <div class="col-md-12">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Transtornos: <?= isset($aluno_transtorno->AUSTISMO) && $aluno_transtorno->AUSTISMO == 'S' ? 'Sim' : 'Não'; ?></label>
        <br>
        <input class="form-check-input" type="checkbox" <?= isset($aluno_transtorno->AUSTISMO) && $aluno_transtorno->AUSTISMO == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label" style="margin-right: 20px">Transtorno Espectro Autista</label>
        <br>
        <label class="form-check-label" style="display: flex"> 
            <input class="form-check-input" type="checkbox" <?= isset($aluno_transtorno->OUTROS) && $aluno_transtorno->OUTROS ? 'checked' : ''; ?>> 
            <span style="margin-left: 10px; margin-right: 10px">Outro</span>
            <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 720px; height: 23px; display: flex;align-items: center; font-size: 14px;"><?= isset($aluno_transtorno->OUTROS) ? $aluno_transtorno->OUTROS : ''; ?></div>
        </label>
    </div>
</div>

<!-- Superdotação -->
<div class="row">
    <div class="col-md-12">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Altas Habilidades/Superdotação: <?= isset($aluno->POSSUI_SUPERDOTACAO) && $aluno->POSSUI_SUPERDOTACAO == 'S' ? 'Sim' : 'Não'; ?></label>
    </div>
</div>

<!-- Doenças Crônicas -->
<div class="row">
    <div class="col-md-12">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Doenças Crônicas: <?= isset($aluno_doencas_cronicas->DIEABETE) && $aluno_doencas_cronicas->DIEABETE == 'S' ? 'Sim' : 'Não'; ?></label>
        <br>
        <input class="form-check-input" type="checkbox" <?= isset($aluno_doencas_cronicas->DIEABETE) && $aluno_doencas_cronicas->DIEABETE == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="defaultCheck1">Diabetes Mellitus</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno_doencas_cronicas->RESPIRATORIA) && $aluno_doencas_cronicas->RESPIRATORIA == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="defaultCheck1">Respiratória</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno_doencas_cronicas->NEUROLOGIA) && $aluno_doencas_cronicas->NEUROLOGIA == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="defaultCheck1">Neurológica</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno_doencas_cronicas->OBESIDADE) && $aluno_doencas_cronicas->OBESIDADE == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="defaultCheck1">Obesidade</label>
        <br>
        <label class="form-check-label" style="display: flex"> 
            <input class="form-check-input" type="checkbox" <?= isset($aluno_doencas_cronicas->OUTROS) && $aluno_doencas_cronicas->OUTROS ? 'checked' : ''; ?>> 
            <span style="margin-left: 10px; margin-right: 10px">Outro</span>
            <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 721px; height: 23px; display: flex;align-items: center; font-size: 14px;"><?= isset($aluno_doencas_cronicas->OUTROS) ? $aluno_doencas_cronicas->OUTROS : ''; ?></div>
        </label>
    </div>
</div>

<!-- Intolerância Alimentar -->
<div class="row">
    <div class="col-md-12">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Intolerância Alimentar: <?= isset($aluno_intolerancia->OUTROS) && $aluno_intolerancia->OUTROS ? 'Sim' : 'Não'; ?></label>
        <br>
        <label class="form-check-label" style="display: flex"> 
            <span style=" margin-right: 10px">Qual</span>
            <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 751px; height: 23px; display: flex;align-items: center; font-size: 14px;"><?= isset($aluno_intolerancia->OUTROS) ? $aluno_intolerancia->OUTROS : ''; ?></div>
        </label>
    </div>
</div>

<!-- Alergia -->
<div class="row">
    <div class="col-md-12">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Alergia: <?= isset($aluno_alergia->OUTROS) && $aluno_alergia->OUTROS ? 'Sim' : 'Não'; ?></label>
        <br>
        <label class="form-check-label" style="display: flex"> 
            <span style=" margin-right: 10px">Qual</span>
            <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 751px; height: 23px; display: flex;align-items: center; font-size: 14px;"><?= isset($aluno_alergia->OUTROS) ? $aluno_alergia->OUTROS : ''; ?></div>
        </label>
    </div>
</div>

<!-- Tratamento Especializado -->
<div class="row">
    <div class="col-md-12">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Faz algum tratamento especializado: <?= isset($aluno_tratamento->OUTROS) && $aluno_tratamento->OUTROS ? 'Sim' : 'Não'; ?></label>
        <br>
        <input class="form-check-input" type="checkbox" <?= isset($aluno_tratamento->PSICOLOGO) && $aluno_tratamento->PSICOLOGO == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="defaultCheck1">Psicólogo</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno_tratamento->FONOAUDIOLOGO) && $aluno_tratamento->FONOAUDIOLOGO == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="defaultCheck1">Fonoaudiólogo</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno_tratamento->TERAPIA) && $aluno_tratamento->TERAPIA == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="defaultCheck1">Terapia Ocupacional</label>
        <br>
        <label class="form-check-label" style="display: flex"> 
            <input class="form-check-input" type="checkbox" <?= isset($aluno_tratamento->OUTROS) && $aluno_tratamento->OUTROS ? 'checked' : ''; ?>> 
            <span style="margin-left: 10px; margin-right: 10px">Outro</span>
            <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 720px; height: 23px; display: flex;align-items: center; font-size: 14px;"><?= isset($aluno_tratamento->OUTROS) ? $aluno_tratamento->OUTROS : ''; ?></div>
        </label>
    </div>
</div>

<!-- Medicamento Contínuo -->
<div class="row">
    <div class="col-md-12">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Medicamento Contínuo: <?= isset($aluno_medicamento->OUTROS) && $aluno_medicamento->OUTROS ? 'Sim' : 'Não'; ?></label>
        <br>
        <label class="form-check-label" style="display: flex"> 
            <span style=" margin-right: 10px">Qual</span>
            <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 750px; height: 23px; display: flex;align-items: center; font-size: 14px;"><?= isset($aluno_medicamento->OUTROS) ? $aluno_medicamento->OUTROS : ''; ?></div>
        </label>
    </div>
</div>


<br>

    
<span stle="display: flex" >
    <?= $escola->MUNICIPIO ?> – <?= $aluno->ESTADO_NATURALIDADE ?>, <?= date("d/m/Y") ?>
    <br><br>
<div class="signature">
<div>
    __________________________________________ <br>
    Assinatura do responsável
    </div>
    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bumdle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55mdzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>