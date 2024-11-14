<style>
        body {
            font-family: Arial, sans-serif;
            font-size: 18px!important
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
        <span style="text-align: center; font-size: 15px; display: flex; justify-content: center"><strong>FICHA DO PROFISSIONAL</strong></span>
        <span id="titulo" style="background-color: #CCCCCC; text-align: center; font-size: 15px; display: flex; justify-content: center"><strong>DADOS DO PROFISISONAL</strong></span>
        <div class="row" style="margin-bottom: 3px">
</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-8" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Nome:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 490px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->NOME_PROFISSIONAL; ?>
        </div>
    </div>
    <div class="col-md-4" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Nascimento:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 135px; height: 23px; display: flex;align-items: center; font-size: 14px;">
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
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 120px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= date("d/m/Y", strtotime($aluno->DATA_EMISSAO)); ?>
        </div>
    </div>
    <div class="col-md-4" style="display: flex" >
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Órgão:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 176px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->ORGAO_EXPEDITOR; ?>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-6" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Natural de (Cidade):</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 232px; height: 23px; display: flex;align-items: center; font-size: 14px;">
        <?= getCityNameById($aluno->NATURALIDADE); ?>
        </div>
    </div>
    <div class="col-md-2" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Estado:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 100px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->ESTADO_NATURALIDADE; ?>
        </div>
    </div>
    <div class="col-md-4" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Nacionalidade:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 118px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->NACIONALIDADE == 'BR' ? 'Brasileiro(a)' : ''; ?>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-4" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Cor ou Raça:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 127px; height: 23px; display: flex;align-items: center; font-size: 14px;">
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
    <div class="col-md-2" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Idade:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 52px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->IDADE; ?>
        </div>
    </div>
    <div class="col-md-6" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Estado Civil:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 272px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?php 
                switch($aluno->ESTADO_CIVIL) {
                    case 'SO':
                        echo 'Solteiro(a)';
                        break;
                    case 'CA':
                        echo 'Casado(a)';
                        break;
                    case 'DI':
                        echo 'Divorciado(a)';
                        break;
                    case 'VI':
                        echo 'Viúvo(a)';
                        break;
                    case 'UN':
                        echo 'União Estável';
                        break;
                }
            ?>
        </div>
    </div>

</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-6" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Filiação 1:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 300px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->FILIACAO_1; ?>
        </div>
    </div>
    <div class="col-md-6" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Filiação 2:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 290px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->FILIACAO_2 ?: ''; ?>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-6" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Titulo de eleitor:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 257px; height: 23px; display: flex;align-items: center; font-size: 14px;">
        <?= $aluno->TITULO_ELEITOR; ?>
        </div>
    </div>
    <div class="col-md-3" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Zona:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 120px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->ZONA; ?>
        </div>
    </div>
    <div class="col-md-3" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Seção:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 105px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->SECAO; ?>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-6" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Email:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 328px; height: 23px; display: flex;align-items: center; font-size: 14px;">
        <?= $aluno->EMAIL; ?>
        </div>
    </div>
    <div class="col-md-3" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Tel 1.:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 120px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->TELEFONE_1; ?>
        </div>
    </div>
    <div class="col-md-3" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Tel. 2:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 112px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->TELEFONE_2; ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Deficiência</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno->DEFICIENCIA) && $aluno->DEFICIENCIA == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label" style="margin-right: 20px">Sim</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno->DEFICIENCIA) && $aluno->DEFICIENCIA == 'N' ? 'checked' : ''; ?>>
        <label class="form-check-label" style="margin-right: 20px">Não</label>
    </div>
    <div class="col-md-8" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Qual:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 465px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->QUAL_DEFICIENCIA; ?>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-5">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Doenças Crônicas:</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno->DOENCA) && $aluno->DOENCA == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label" style="margin-right: 20px">Sim</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno->DOENCA) && $aluno->DOENCA == 'N' ? 'checked' : ''; ?>>
        <label class="form-check-label" style="margin-right: 20px">Não</label>
    </div>
    <div class="col-md-7" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Qual:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 395px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->QUAL_DOENCA; ?>
        </div>
    </div>

</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-6" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Cônjuge:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 303px; height: 23px; display: flex;align-items: center; font-size: 14px;">
        <?= $aluno->CONJUGE; ?>
        </div>
    </div>
    <div class="col-md-3" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Tel 1.:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 120px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->TELEFONE_CONJUGE; ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Filhos:</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno->FILHO) && $aluno->FILHO == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label" style="margin-right: 20px">Sim</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno->FILHO) && $aluno->FILHO == 'N' ? 'checked' : ''; ?>>
        <label class="form-check-label" style="margin-right: 20px">Não</label>
    </div>
    <div class="col-md-7" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Quantos:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 236px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->QTD_FILHO; ?>
        </div>
    </div>

</div>

<br>
<span id="titulo" style="background-color: #CCCCCC; text-align: center; font-size: 15px; display: flex; justify-content: center"><strong>DADOS DO ENDEREÇO</strong></span>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-8" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Endereço:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 387px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->ENDERECO; ?>
        </div>
    </div>
    <div class="col-md-4" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Bairro:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 172px; height: 23px; display: flex;align-items: center; font-size: 14px;">
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
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 100px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->ESTADO; ?>
        </div>
    </div>
    <div class="col-md-5" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Compl.:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 235px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->NUMERO; ?>
        </div>
    </div>
</div>


<br>
<span id="titulo" style="background-color: #CCCCCC; text-align: center; font-size: 15px; display: flex; justify-content: center"><strong>INFORMAÇÕES DE ESCOLARIDADE</strong></span>
<!-- Deficiências -->
<div class="row">
    <div class="col-md-12">
        <input class="form-check-input" type="checkbox" <?= isset($aluno->ESCOLARIDADE) && $aluno->ESCOLARIDADE == 'F' ? 'checked' : ''; ?>>
        <label class="form-check-label" style="margin-right: 20px">Fundamental</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno->ESCOLARIDADE) && $aluno->ESCOLARIDADE == 'M' ? 'checked' : ''; ?>>
        <label class="form-check-label" style="margin-right: 20px">Médio</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno->ESCOLARIDADE) && $aluno->ESCOLARIDADE == 'MA' ? 'checked' : ''; ?>>
        <label class="form-check-label">Magistério</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno->ESCOLARIDADE) && $aluno->ESCOLARIDADE == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label">Superior</label>
    </div>
</div>
<div class="row">
    <div class="col-md-6" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Curso superior:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 228px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->CURSO_SUPERIOR; ?>
        </div>
    </div>
    <div class="col-md-6">
        <input class="form-check-input" type="checkbox" <?= isset($aluno->NIVEL_GRAU_ACADEMICO) && $aluno->NIVEL_GRAU_ACADEMICO == 'B' ? 'checked' : ''; ?>>
        <label class="form-check-label" style="margin-right: 20px">Bacharelado</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno->NIVEL_GRAU_ACADEMICO) && $aluno->NIVEL_GRAU_ACADEMICO == 'L' ? 'checked' : ''; ?>>
        <label class="form-check-label" style="margin-right: 20px">Licenciatura</label>
    </div>
</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-12" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Especialização 1:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 655px; height: 23px; display: flex;align-items: center; font-size: 14px;">
        <?= $aluno->ESPECIALIZACAO_1; ?>
        </div>
    </div>
</div>
<div class="row" style="margin-bottom: 3px">
    <div class="col-md-12" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Especialização 2:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 655px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->ESPECIALIZACAO_2; ?>
        </div>
    </div>
</div>
<div class="row" style="margin-bottom: 3px">
    <div class="col-md-12" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Especialização 3:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 655px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->ESPECIALIZACAO_3; ?>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom: 3px">
    <div class="col-md-3" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Cargo:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 127px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?php 
                switch($aluno->CARGO) {
                    case '1':
                        echo 'PROFESSOR(A)';
                        break;
                    case '2':
                        echo 'ORIENTADOR';
                        break;
                    case '3':
                        echo 'GESTOR(A) ESCOLAR';
                        break;
                }
            ?>
        </div>
    </div>
    <div class="col-md-6" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Vinculo:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 260px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?php 
                switch($aluno->TIPO_VINCULO) {
                    case 'CT':
                        echo 'CTPS';
                        break;
                    case 'AT':
                        echo 'Autônomo';
                        break;
                    case 'PJ':
                        echo 'PJ';
                        break;
                    case 'ET':
                        echo 'Estagiário';
                        break;
                    case 'FR':
                        echo 'Freelancer';
                        break;
                }
            ?>
        </div>
    </div>
    <div class="col-md-3" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Carga-horário:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 49px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->CARGA_HORARIA; ?>
        </div>
    </div>
    

</div>

<div class="row">
    <div class="col-md-4">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Intervalo</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno->INTERVALO) && $aluno->INTERVALO == 'S' ? 'checked' : ''; ?>>
        <label class="form-check-label" style="margin-right: 20px">Sim</label>
        <input class="form-check-input" type="checkbox" <?= isset($aluno->INTERVALO) && $aluno->INTERVALO == 'N' ? 'checked' : ''; ?>>
        <label class="form-check-label" style="margin-right: 20px">Não</label>
    </div>
    <div class="col-md-4" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Entrada:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 228px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->HORARIO_ENTRADA; ?>
        </div>
    </div>
    <div class="col-md-4" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Saída:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 177px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->HORARIO_SAIDA; ?>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Data de admissão:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 175px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= date("d/m/Y", strtotime($aluno->DATA_ADMISSAO)); ?>

        </div>
    </div>
    <div class="col-md-6" style="display: flex">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Data de desligamento:</label>
        <div style="border-radius: 2px;border: 2px solid #000;padding: 5px;width: 202px; height: 23px; display: flex;align-items: center; font-size: 14px;">
            <?= $aluno->DATA_DESLIGAMENTO != "0000-00-00" ? date("d/m/Y", strtotime($aluno->DATA_DESLIGAMENTO)) : "" ; ?>
        </div>
    </div>

</div>


    <br><br><br>
    <div class="row">
        <div class="col-md-12 mx-auto d-flex justify-content-center">
            <p style="text-align: justify" >Declaro, que todos os documentos entregues a instituição são verdadeiros e autênticos, não contendo informações falsas, distorcidas ou omitidas.</p>
        </div>
    </div>
    <br><br><br>


    <div class="row" >
        <div class="col-md-8 mx-auto d-flex justify-content-center">
            <div class="header-info" style="text-align: justify;">
                
                <p style="text-align: center; height: 50px">__________________________________________ <br>Assinatura do profissional</p>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bumdle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55mdzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>