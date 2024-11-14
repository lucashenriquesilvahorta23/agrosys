<style>
    @media print {
        @page {
            size: portrait; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>
<p style="text-align: center;"><strong> FICHA DE MATRÍCULA  </strong></p>

<p>Na data de <strong><?= inverterData($resultados[0]->DATA_MATRICULA) ?></strong> foi efetuada a presente matrícula para ingresso no ano letivo de <strong><?= $resultados[0]->ANO_LETIVO ?></strong> desta instituição de ensino, com as seguintes informações: </p>

<br>
<div class="row" style="display: flex; justify-content: center">
    <div class="col-md-2 "   >
        <?php
            if(isset($aluno->NOME_ALEATORIO) && ($aluno->NOME_ALEATORIO != null || $aluno->NOME_ALEATORIO != "")){
                echo '	<img style="border: 1px solid #000; border-radius: 8px" src="'.LINK_UPLOAD.$aluno->NOME_ALEATORIO.'"  width=75 class="img-bordered">';
                echo '<p style="font-size: 9px; text-align: center;" >Foto do(a) aluno(a)</p>';
            }else{
                echo '	<img src="'.LINK_UPLOAD.'padrao.png'.'" width=75 class="img-bordered">';
                echo '<p style="font-size: 9px; text-align: center;" >Foto do(a) aluno(a)</p>';
            }

            $etapa = $resultados[0]->ETAPA;

            if ($etapa == 'I1') {
                $etapa = 'Infantil I – 4 Anos';
            } elseif ($etapa == 'I2') {
                $etapa = 'Infantil II – 5 Anos';
            } elseif ($etapa == 'C1') {
                $etapa = 'Creche I – 1 Ano';
            } elseif ($etapa == 'C2') {
                $etapa = 'Creche II – 2 Anos';
            } elseif ($etapa == 'C3') {
                $etapa = 'Creche III – 3 Anos';
            } elseif ($etapa == 'F1') {
                $etapa = 'Fundamental I';
            } elseif ($etapa == 'F2') {
                $etapa = 'Fundamental II';
            } elseif ($etapa == 'M1') {
                $etapa = 'Médio I';
            } elseif ($etapa == 'M2') {
                $etapa = 'Médio II';
            } else {
                $etapa = 'Não informado';
            }

            $tipo_atendimento = $resultados[0]->TIPO_ATENDIMENTO;

            if ($tipo_atendimento == 'IN') {
                $tipo_atendimento = 'Integral';
            } elseif ($tipo_atendimento == 'PM') {
                $tipo_atendimento = 'Parcial Matutino';
            } elseif ($tipo_atendimento == 'PV') {
                $tipo_atendimento = 'Parcial Vespertino';
            } elseif ($tipo_atendimento == 'PA') {
                $tipo_atendimento = 'Parcial';
            } elseif ($tipo_atendimento == 'ND') {
                $tipo_atendimento = 'Noturno';
            } elseif ($tipo_atendimento == 'DU') {
                $tipo_atendimento = 'Dupla Jornada';
            } elseif ($tipo_atendimento == 'SE') {
                $tipo_atendimento = 'Semi-integral';
            } else {
                $tipo_atendimento = 'Não informado';
            }

            $situacao = $resultados[0]->SITUACAO;

            if ($situacao == 'CO') {
                $situacao = 'Progressão Direta';
            } elseif ($situacao == 'TR') {
                $situacao = 'Transferido';
            }  elseif ($situacao == 'EV') {
                $situacao = 'Evadido';
            }  elseif ($situacao == 'FL') {
                $situacao = 'Falecido';
            }   else {
                $situacao = 'Cursando';
            } 

            $tipo_atendimento = $resultados[0]->TIPO_ATENDIMENTO;

            if ($tipo_atendimento == 'IN') {
                $tipo_atendimento = 'Integral';
            } elseif ($tipo_atendimento == 'PM') {
                $tipo_atendimento = 'Parcial Matutino';
            } elseif ($tipo_atendimento == 'PV') {
                $tipo_atendimento = 'Parcial Vespertino';
            } elseif ($tipo_atendimento == 'PA') {
                $tipo_atendimento = 'Parcial';
            } elseif ($tipo_atendimento == 'ND') {
                $tipo_atendimento = 'Noturno';
            } elseif ($tipo_atendimento == 'DU') {
                $tipo_atendimento = 'Dupla Jornada';
            } elseif ($tipo_atendimento == 'SE') {
                $tipo_atendimento = 'Semi-integral';
            } else {
                $tipo_atendimento = 'Não informado';
            }
        ?>
    </div>
    <div class="col-md-2" style="margin-left: 10px; margin-right: 10px" ></div>
    <div class="col-md-8" style="
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-12">
            <strong>Código do(a) Aluno(a): </strong><span  style='font-weight: lighter' > <?= $resultados[0]->ID_ALUNO; ?> </span>
            </div>
        </div>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-12">
            <strong>Nome do(a) Aluno(a):  </strong><span  style='font-weight: lighter' >  <?= $resultados[0]->NOME_ALUNO; ?> </span>
            </div>
        </div>
        <div class="row"  style="display: flex; margin-bottom: 10px;">
            <div class="col-md-4" style="margin-right: 20px" >
            <strong>Data de Nascimento: </strong><span  style='font-weight: lighter' > <?= inverterData($resultados[0]->DATA_NASCIMENTO); ?> </span>
            </div>
            <div class="col-md-4" style="margin-right: 20px" >
            <strong>Idade: </strong><span  style='font-weight: lighter' > <?= $resultados[0]->IDADE; ?> </span>
            </div>
            <div class="col-md-4" style="margin-right: 20px" >
            <strong>CPF: </strong><span  style='font-weight: lighter' > <?= $resultados[0]->CPF; ?> </span>
            </div>
        </div>
        <div class="row" style="display: flex; margin-bottom: 10px">
            <div class="col-md-4" style="margin-right: 20px" >
            <strong>Etapa: </strong><span  style='font-weight: lighter' > <?= $etapa; ?> </span>
            </div>
            <div class="col-md-4" style="margin-right: 20px" >
            <strong>Turma: </strong><span  style='font-weight: lighter' > <?= $resultados[0]->NOME_TURMA; ?> </span>
            </div>
            <div class="col-md-4" style="margin-right: 20px" >
            <strong>TURNO: </strong><span  style='font-weight: lighter' > <?= $tipo_atendimento; ?> </span>
            </div>
        </div>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-12">
            <strong>Status:  </strong><span  style='font-weight: lighter' > Matriculado </span>
            </div>
        </div>
    </div>
</div>

<br><br>

<p>Este documento serve como comprovante de matrícula e tem validade a partir de sua expedição.
Caso seja necessário segunda via, compareça à secretaria desta Instituição de Ensino para
solicitação do mesmo.</p>

<br>
<p style="border: 1px solid #000; height: 100px; padding: 5px" >     <strong> OBSERVAÇÕES:</strong> </p>

<br><br>

<div class="row"  style="display: flex; justify-content: space-around">
    <div  class="col-md-6" style="text-align: cemter!important;" >__________________________________ <br>
    Assinatura do Responsável pela matrícula
    </div>
    <div  class="col-md-6" style="text-align: cemter!important;" >________________________________ <br>
    Assinatura do Responsável do(a) aluno(a)
    </div>
</div>


