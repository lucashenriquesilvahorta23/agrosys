<style>
    @media print {
        @page {
            size: portrait; /* Para paisagem */
            /* size: portrait;  Para retrato (padrão) */
        }
    }
</style>
<p style="text-align: center;"><strong>TERMO DE AUTORIZAÇÃO PARA O USO DE IMAGEM</strong></p>

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
Eu, responsável pelo(a) aluno(a) <strong><?= $aluno->NOME_ALUNO ?></strong>, AUTORIZO que a imagem do(a) mesmo(a) em atividades escolares, seja utilizada em fotos, vídeos, documentos e campanhas promocionais e institucionais da escola. 
<br>
A presente autorização é concedida a título gratuito, abrangendo o uso da imagem acima mencionada em todo território nacional, sob qualquer forma e meios, ou sejam: 
<br><br>

• Out-door;
<br><br>
• Bus-door; 
<br><br>
• Folder de apresentação;
<br><br>
• Anúncios em revistas e jornais em geral; 
<br><br>
• Redes sociais; 
<br><br>
• Cartazes;
<br><br>
• Mídia eletrônica;
<br><br>
• Painéis, vídeo-tapes, televisão, cinema, programa para rádio, entre outros;
<br><br>
• Folhetos em geral (encartes, mala direta, catálogo, etc).
<br><br>

Por esta ser a expressão da minha vontade, declaro que autorizo o uso acima descrito da imagem do(a) referido(a) aluno(a), sem que nada haja a ser reclamado a título de direitos conexos à sua imagem.

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
