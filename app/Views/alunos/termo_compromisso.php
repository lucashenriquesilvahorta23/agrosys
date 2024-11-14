<style>
    @media print {
        @page {
            size: portrait; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>
<p style="text-align: center;"><strong>TERMO DE COMPROMISSO ESCOLAR</strong></p>

<p align="justify">
<strong>Objetivos:</strong>
<br>
Promover o desenvolvimento integral da criança até cinco anos de idade, em seus aspectos físico, psicológico, intelectual e social complementando a ação da família e da comunidade;
</p>
<p align="justify">
Proporcionar condições adequadas para promover o bem-estar da criança, seu desenvolvimento físico, motor, emocional, intelectual e social, bem como a ampliação de suas experiências.
</p>

<p align="justify">
<strong>Atendimento:</strong>


<br>
<?php
    $periodo_manha = "";
    if($escola->ENTRADA != "" && $escola->SAIDA){
       $periodo_manha = $escola->ENTRADA . ' às ' . $escola->SAIDA ;
    }

    $periodo_tarde = "";
    if($escola->ENTRADA_TARDE != "" && $escola->SAIDA_TARDE){
       $periodo_tarde = $escola->ENTRADA_TARDE . ' às ' . $escola->SAIDA_TARDE ;
    }
    switch ($escola->FUNCIONAMENTO) {
        case 'MA':
            echo 'Matutino <br/> ' .$periodo_manha.' <br/> ' . $periodo_tarde;
            break;
        case 'TA':
            echo 'Vespertino <br/> ' . $periodo_manha.' <br/> ' . $periodo_tarde;
            break;
        case 'MT':
            echo 'Matutino e Vespertino <br/> ' . $periodo_manha.' <br/> ' . $periodo_tarde;
            break;
        default:
            echo 'Não informado <br/> ' . $periodo_manha.' <br/> ' . $periodo_tarde;
            break;
    }
?>
</p>

<p align="justify">
Em caso de atrasos, o responsável deverá apresentar justificativa;
</p>

<p align="justify">
A <?= $escola->ESCOLA ?> atenderá de segunda-feira a sexta-feira e excepcionalmente nos sábados letivos previstos no calendário escolar. Não haverá atividades nos feriados nacionais e municipais. (Nos feriados tidos como ponto facultativo, decretado pela administração municipal de <?= $escola->MUNICIPIO ?>, a escola seguirá as mesmas decisões.)
</p>

<p align="justify">
Não será permitida a entrada de pessoas trajando roupas inadequadas como: bermudas, shorts, vestidos ou saias acima do joelho e blusas com decotes profundos no ambiente escolar.
</p>

<p align="justify">
No caso de desacato às autoridades escolares, agressões ou insultos entre alunos, pais e/ou funcionários do Estabelecimento de Ensino, tais atitudes serão penalizadas de acordo com a legislação.
</p>

<p align="justify">
<strong>Medicamentos:</strong>
</p>

<p align="justify">
A escola não autoriza que a criança seja medicada pelas professoras ou por qualquer funcionário da instituição, pois medicamentos podem causar reações adversas como alergias, efeitos colaterais e outras complicações nocivas. Em caso de tratamento, a criança deverá permanecer em casa até o término do mesmo ou ausência dos sintomas. A escola deve orientar os pais para que, sempre que possível, organizem a medicação do aluno para que ocorra em casa e fora do horário escolar.
</p>

<p align="justify">
Nos casos de ordem expressa para administração de medicamentos, a escola precisa receber o documento que comprove a ordem, junto com a autorização por escrito dos pais e/ou responsáveis, anexada com a cópia da receita médica contendo: nome do aluno, do medicamento, do médico com seu respectivo carimbo, a dosagem e o horário para administração do medicamento. É importante também orientar os pais para que organizem os medicamentos em horários predeterminados (ex. 10h, 14h e 16h) para facilitar a organização da escola. A medicação não pode ser enviada para escola na mochila da criança; o responsável deve entregar a medicação em mãos a um profissional da escola, de preferência ao gestor ou coordenador pedagógico.
</p>

<p align="justify">
<strong>Higiene:</strong>
</p>

<p align="justify">
É de extrema responsabilidade dos pais e/ou responsáveis:
<ul>
    <li>Deixar as crianças na escola com o uniforme limpo;</li>
    <li>Realizar o corte de cabelo e banho diário;</li>
    <li>Cortar semanalmente as unhas das crianças, evitando assim arranhões e outros ferimentos;</li>
    <li>Manter as orelhas limpas;</li>
    <li>Observar e limpar diariamente a cabeça das crianças para evitar a proliferação de piolho;</li>
    <li>Mandar sempre roupas na mochila para trocar caso seja necessário;</li>
    <li>Higienizar os pertences pessoais das crianças (mochila, toalhas etc.).</li>
</ul>
</p>

<p align="justify">
<strong>Acidentes ou Mal-estar das Crianças:</strong>
</p>

<p align="justify">
Em caso de acidentes, serão feitos os primeiros socorros e os pais e/ou responsáveis serão comunicados e deverão buscar as crianças imediatamente. Caso os pais e/ou responsáveis não forem encontrados, conforme contatos por telefone deixados na matrícula, será acionado o Conselho Tutelar. Quando ocorrer da criança apresentar febre, suspeita de viroses ou apresentar outro problema, os pais e/ou responsáveis serão comunicados para virem buscá-la e encaminhá-la ao atendimento médico, trazendo o atestado médico até a instituição, justificando as faltas. Quando ocorrer da criança apresentar febre ou apresentar outro problema em casa, a criança deverá permanecer em casa.
</p>

<p align="justify">
<strong>Pertences das Crianças:</strong>
</p>

<p align="justify">
Deverá conter na sacola da criança os itens de material pessoal conforme a lista entregue no ato da matrícula, tendo a identificação da criança (nome) em todos os itens. Em caso de troca de roupas ou demais pertences, os pais e/ou responsáveis deverão procurar a direção e fazer a devolução dos pertences para que seja entregue ao dono. Quando sentir a falta de algum pertence, comunicar no dia seguinte, logo na entrada, ou via agenda, para que seja tomada providência.
</p>

<p align="justify">
<strong>Objetos de Valor e Risco:</strong>
</p>

<p align="justify">
Não mandar as crianças com objetos valiosos como: pulseiras, brincos e colares para evitar o risco de perdas e ferimentos. A escola não se responsabiliza pela perda ou danos dos objetos citados acima. Não deixar que as crianças tragam objetos de risco como: moeda, brinquedos com peças pequenas que soltam ou quebram com facilidade e objetos que possam ter o risco de serem engolidos por elas.
</p>

<p align="justify">
<strong>Comunicação entre Escola x Família:</strong>
</p>

<p align="justify">
Pretendemos manter as famílias sempre bem-informadas das atividades e normas da escola. Para isso, além do regimento interno, utilizaremos os meios de comunicação, circulares, comunicados, bilhetes e reuniões. A agenda será o principal elo de comunicação entre a escola x família e vice-versa. Os pais e/ou responsáveis devem consultá-la e assiná-la diariamente.
</p>

<p align="justify">
<strong>Comemorações, Eventos e Reuniões:</strong>
</p>

<p align="justify">
Nossa escola, a fim de promover eventos especiais e com intuito de confraternizar entre as crianças e, às vezes, com familiares e comunidade, promove todos os anos algumas festas em alusão a datas comemorativas como, por exemplo: Páscoa, festa Junina, Dia da Criança, Formatura e Natal. Sua participação e colaboração é de extrema importância para nossa instituição quando solicitada. É fundamental a participação dos pais e/ou responsáveis nas reuniões da escola.
</p>

<p align="justify">
<strong>Processo de Visita de Pais na Escola:</strong>
</p>

<p align="justify">
Não será permitida a visita e permanência de pais e/ou responsáveis nas dependências das turmas durante o período de aula, porque além de dificultar a compreensão de separação, tumultua o trabalho dos educadores que se encontram envolvidos com as crianças na rotina. Em caso de necessidade de atividades coletivas Escola x Família, os pais e/ou responsáveis poderão participar da rotina de seus filhos mediante convite.
</p>

<p align="justify">
<strong>Avaliação:</strong>
</p>

<p align="justify">
A avaliação acontecerá de forma contínua, através da observação e acompanhamento do desenvolvimento das crianças, bem como o registro do desenvolvimento delas, que serão assinados pelos pais e/ou responsáveis em reuniões semestrais.
</p>

<p align="justify">
<strong>Reclamações, Dúvidas e Sugestões:</strong>
</p>

<p align="justify">
Qualquer assunto de ordem pedagógica ou administrativa deverá ser tratado primeiramente com a direção deste estabelecimento de ensino.
</p>





<p align="justify">
    <?php 
        if($aluno->FILIACAO_1 != ""){
            $responsavel = $aluno->FILIACAO_1;
        }else if($aluno->FILIACAO_2 != ""){
            $responsavel = $aluno->FILIACAO_2;
        }else{
            $responsavel = $aluno->RESPONSAVEL_LEGAL_NOME;
        }

    ?>
Eu, responsável pelo aluno(a) <strong><?= $aluno->NOME_ALUNO ?></strong>, declaro estar ciente das normas contidas neste termo de compromisso escolar:

</p>


<p align="justify">
    <?= $escola->MUNICIPIO ?> – <?= $aluno->ESTADO_NATURALIDADE ?>, <?= date("d/m/Y") ?>
</p>

<div class="signature">
    <div>
    __________________________________________ <br>
    Assinatura do responsável
    </div>
</div>
