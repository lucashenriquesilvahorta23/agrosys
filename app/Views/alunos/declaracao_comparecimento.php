<style>
    @media print {
        @page {
            size: portrait; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>
<p style="text-align: center;"><strong>DECLARAÇÃO DE COMPARECIMENTO</strong></p>

<p align="justify">
Declaramos para os devidos fins e a parte interessada que o(a) Sr. (a)
<strong><?= $nome_pessoa ?></strong>, inscrito no CPF sob o nº <strong><?= $profissional_cpf ?></strong>, compareceu a esta instituição de ensino, data <strong><?= inverterData($data) ?></strong>, a fim de participar do(a) <strong><?= $motivo_reuniao ?></strong>.
</p>

<p align="justify">
Caso seja necessário verificar a autenticidade deste documento entre em
contato com a secretaria da Instituição de Ensino pelo telefone <strong><?= $escola->TELEFONE ?></strong>,
estando de posse desta via, informar o Código do documento localizado à direita da
parte superior.</p>

<p align="justify">
    <?= $escola->MUNICIPIO ?> – MA, <?= date("d/m/Y") ?>
</p>

<div class="signature">
    <div>
        ____________________________ <br>
        <?= $escola->GESTOR ?> <br>
        CPF: <?= $escola->CPF_GESTOR ?> <br>
        Gestor(a) Escolar
    </div>
</div>
