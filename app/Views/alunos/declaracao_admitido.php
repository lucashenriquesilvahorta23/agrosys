<style>
    @media print {
        @page {
            size: portrait; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>
<p style="text-align: center;"><strong>DECLARAÇÃO DE PROFISSIONAL</strong></p>

<p align="justify">
Declaramos para os devidos fins e a parte interessada que o(a) Sr. (a) <strong><?= $aluno->NOME_PROFISSIONAL; ?></strong>, inscrito(a) no CPF sob o nº <strong><?= $aluno->CPF; ?></strong>, exerce o cargo
<?php 
    switch($aluno->CARGO) {
        case '1':
            $cargo = 'PROFESSOR(A)';
            break;
        case '2':
            $cargo = 'ORIENTADOR';
            break;
        case '3':
            $cargo = 'GESTOR(A) ESCOLAR';
            break;
    }
?>
de <strong><?= $cargo; ?></strong>, desde o dia <strong><?= date("d/m/Y", strtotime($aluno->DATA_ADMISSAO)); ?></strong>, até a presente data, na <strong><?= mb_strtoupper($escola->ESCOLA, 'UTF-8') ?></strong>, INEP nº <strong><?= $escola->INEP ?></strong>, localizada à <strong><?= $escola->LOGRADOURO ?></strong>, <strong><?= $escola->BAIRRO ?></strong>, CEP: <strong><?= $escola->CEP ?></strong>
<strong><?= $escola->MUNICIPIO ?></strong> – <strong><?= $escola->FUNCIONAMENTO ?></strong>, instituição mantida através do(a) <strong><?= mb_strtoupper($escola->MANTEDORA, 'UTF-8') ?></strong>, inscrito(a) no CNPJ nº <strong><?= $escola->CNPJ ?></strong>.
</p>

<p align="justify">
Caso seja necessário verificar a autenticidade deste documento entre em
contato com a secretaria da Instituição de Ensino pelo telefone <strong><?= $escola->TELEFONE ?></strong>,
estando de posse desta via, informar o Código do documento localizado à direita da
parte superior.</p>

<p align="justify">
    <?= $escola->MUNICIPIO ?> – <?= $aluno->ESTADO_NATURALIDADE ?>, <?= date("d/m/Y") ?>
</p>

<div class="signature">
    <div>
        ____________________________ <br>
        <?= $escola->GESTOR ?> <br>
        CPF: <?= $escola->CPF_GESTOR ?> <br>
        Gestor(a) Escolar
    </div>
</div>
