
<style>
    @media print {
        @page {
            size: portrait; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>
<p style="text-align: center;"><strong>FICHA DE DIAGNÓSTICO DE ALUNOS COM PATOLOGIAS ESPECÍFICAS</strong></p>

<p align="justify">
    O(a) aluno(a) <strong><?= $aluno->NOME_ALUNO ?></strong>, 
    nascido(a) em <strong><?= date("d/m/Y", strtotime($aluno->DATA_NASCIMENTO)) ?></strong>, 
    natural de <strong><?= $aluno->CIDADE ?></strong> – <strong><?= $aluno->ESTADO_NATURALIDADE ?></strong>, 
    filho(a) de <strong><?= $aluno->FILIACAO_1 ?></strong><strong><?= $aluno->FILIACAO_2 != "" ? " <span style='font-weight: normal;' >e</span> ".$aluno->FILIACAO_2."," : "," ?></strong> cursando a etapa 
    <?php
    switch ($turma->ETAPA) {
        case 'I1':
            echo '<strong>Ed. Infantil I – 4 Anos</strong>';
            break;
        case 'I2':
            echo '<strong>Ed. Infantil II – 5 Anos</strong>';
            break;
        case 'C1':
            echo '<strong>Creche I – 1 Ano</strong>';
            break;
        case 'C2':
            echo '<strong>Creche II – 2 Anos</strong>';
            break;
        case 'C3':
            echo '<strong>Creche III – 3 Anos</strong>';
            break;
        case 'F1':
            echo '<strong>Fundamental I</strong>';
            break;
        case 'F2':
            echo '<strong>Fundamental II</strong>';
            break;
        case 'M1':
            echo '<strong>Médio I</strong>';
            break;
        case 'M2':
            echo '<strong>Médio II</strong>';
            break;
        default:
            echo '<strong>Não informado</strong>';
            break;
    }
    ?>, 
    Turma: <strong><?= trim($turma->NOME_TURMA) ?></strong>, Turno: 
    <?php
    switch ($turma->TIPO_ATENDIMENTO) {
        case 'IN':
            echo '<strong>Integral</strong>';
            break;
        case 'PM':
            echo '<strong>Parcial Matutino</strong>';
            break;
        case 'PV':
            echo '<strong>Parcial Vespertino</strong>';
            break;
        case 'PA':
            echo '<strong>Parcial</strong>';
            break;
        case 'ND':
            echo '<strong>Noturno</strong>';
            break;
        case 'DU':
            echo '<strong>Dupla Jornada</strong>';
            break;
        case 'SE':
            echo '<strong>Semi-Integral</strong>';
            break;
        default:
            echo '<strong>Não informado</strong>';
            break;
    }
    ?>.
</p>


<div class="row">
    <div class="col-md-12">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Cartão do SUS: <?= $aluno->CARTAO_SUS ?></label>
    </div>
</div>
<!-- Deficiências -->
<br/>
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
<br/>
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
<br/>
<div class="row">
    <div class="col-md-12">
        <label style="font-size: 15px; margin-right: 1px; font-weight: bold;" for="exampleInputtext1">Altas Habilidades/Superdotação: <?= isset($aluno->POSSUI_SUPERDOTACAO) && $aluno->POSSUI_SUPERDOTACAO == 'S' ? 'Sim' : 'Não'; ?></label>
    </div>
</div>

<!-- Doenças Crônicas -->
<br/>
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
<br/>
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
<br/>
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
<br/>
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
<br/>
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
        ____________________________ <br>
        <?= $escola->GESTOR ?> <br>
        CPF: <?= $escola->CPF_GESTOR ?> <br>
        Gestor(a) Escolar
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bumdle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55mdzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>