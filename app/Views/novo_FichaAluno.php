<!-- Content Wrapper. Contains page content -->
<div style="background-color: #FFFFFF;" class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section  class="">
      <div class="box">
        <div class="box-header with-border" style="
            display: flex;
            justify-content: flex-start;
            align-items: center;
        " >
          <img onclick="history.back()" src="/template/img/seta_esquerda.png" style="max-width: 5%; margin-right: 10px" alt="">
          <h4 class="box-title"><?php echo $turma->NOME_TURMA." (".$turma->ANO_LETIVO.")"; ?> </h4>
        </div>
        <div class="box-body">
          <!-- <form novalidate method="POST" action="/Aplicativo/AcompanhamentoInserir" id="frm" name="frm" class="validate" enctype='multipart/form-data'> -->
            <!-- Date -->
            <h3 style="color: #000; text-align: center;" class="box-title"><?php echo $dados_aluno->NOME_ALUNO; ?></h3>
            <br>

            <div class="form-group">
              <h5 style="color: #000;" class="box-title">Data do registro</h5>

              <div class="input-group date">
                <input type="date" id="data_acompanhamento" name="data_acompanhamento" value="<?php echo isset($dados_autonomia->DATA) ? $dados_autonomia->DATA : '';?>" class="form-control pull-right" >
                <input type="hidden" name="turma" id="turma" name="turma" value="<?php echo $turma->ID_TURMA; ?>">
                <input type="hidden" name="bimestre" id="bimestre" name="bimestre" value="<?php echo $bimestre; ?>">
                <input type="hidden" name="aluno" id="aluno" name="aluno" value="<?php echo $aluno; ?>">
                <input type="hidden" name="tipo" id="tipo" name="tipo" value="A" >
              </div>
              <!-- /.input group -->
            </div>

            <br>

            <div class="form-group" >
              <h4 style="color: #000;" class="box-title"><?php echo $bimestre."º"; ?>  Bimêstre</h4>
              <br>

              <?php
                // Exemplo de dados recebidos
                $dadosFisicos = $dados_fisicos; // Supondo que $dados seja a variável com os dados
                $dadosMotoraFina = $dados_motora_fina; // Supondo que $dados seja a variável com os dados
                $dadosSociaisEmocionais = $dados_sociais_emocionais;
                $dadosAutonomia = $dados_autonomia;
                $dadosCognitivos = $dados_cognitivos;
                $dadosRelacaoFamiliaEscola = $dados_relacao_familia_escola;

                // Função para verificar se o valor do input de rádio corresponde ao valor dos dados
                function isChecked($dataValue, $inputValue) {
                  return $dataValue === $inputValue ? 'checked' : '';
                }
              ?>

              <input type="hidden" name="aspectosautonomia_id" id="aspectosautonomia_id" value="<?= isset($dadosAutonomia->ID_ASPECTOS_AUTONOMIA) ? $dadosAutonomia->ID_ASPECTOS_AUTONOMIA : ""; ?>" >
              <input type="hidden" name="aspectoscognitivos_id" id="aspectoscognitivos_id" value="<?= isset($dadosCognitivos->ID_ASPECTOS_COGNITIVOS) ? $dadosCognitivos->ID_ASPECTOS_COGNITIVOS : ""; ?>" >
              <input type="hidden" name="aspectosfisicos_id" id="aspectosfisicos_id" value="<?= isset($dadosFisicos->ID_ASPECTOS_FISICOS) ? $dadosFisicos->ID_ASPECTOS_FISICOS : "";  ?>" >
              <input type="hidden" name="aspectosmotorafina_id" id="aspectosmotorafina_id" value="<?= isset($dadosMotoraFina->ID_ASPECTOS_MOTORA_FINA) ? $dadosMotoraFina->ID_ASPECTOS_MOTORA_FINA : ""; ?>" >
              <input type="hidden" name="aspectosrelacaofamiliaescola_id" id="aspectosrelacaofamiliaescola_id" value="<?= isset($dadosRelacaoFamiliaEscola->ID_ASPECTOS_RELACAO_FAMILIA_ESCOLA) ? $dadosRelacaoFamiliaEscola->ID_ASPECTOS_RELACAO_FAMILIA_ESCOLA : ""; ?>" >
              <input type="hidden" name="aspectossociaiseemocionais_id" id="aspectossociaiseemocionais_id" value="<?= isset($dadosSociaisEmocionais->ID_ASPECTOS_SOCIAIS_EMOCIONAIS) ? $dadosSociaisEmocionais->ID_ASPECTOS_SOCIAIS_EMOCIONAIS : ""; ?>" >

              <div class="row">
                <div class="col-md-12">
                  <h5 style="color: #000; font-weight: bold; text-align: center; cursor: pointer;" data-toggle="collapse" data-target="#aspectosFisicos">
                      ASPECTOS FÍSICOS <br><button style="margin-right: 10px" type="button" class="btn btn-sm btn-danger">Abrir</button>              
                  </h5>  
                  
                </div>
              </div>

              <div id="aspectosFisicos" name="aspectosFisicos" class="collapse">
                <!-- Lateralidade -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Lateralidade (diferencia esquerda e direita).</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="lateralidade" type="radio" id="radio_lateralidade_sim" value="sim" 
                            <?php if(isset($dadosFisicos->LATERALIDADE)){echo isChecked($dadosFisicos->LATERALIDADE, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_lateralidade_sim">Sim</label>

                        <input name="lateralidade" type="radio" id="radio_lateralidade_nao" value="nao" 
                            <?php if(isset($dadosFisicos->LATERALIDADE)){echo isChecked($dadosFisicos->LATERALIDADE, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_lateralidade_nao">Não</label>

                        <input name="lateralidade" type="radio" id="radio_lateralidade_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosFisicos->LATERALIDADE)){echo isChecked($dadosFisicos->LATERALIDADE, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_lateralidade_parcialmente">Parcialmente</label>

                        <input name="lateralidade" type="radio" id="radio_lateralidade_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosFisicos->LATERALIDADE)){echo isChecked($dadosFisicos->LATERALIDADE, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_lateralidade_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr>

                <!-- Noção de espaço -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Noção de espaço.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="nocao_espaco" type="radio" id="radio_nocao_espaco_sim" value="sim" 
                            <?php if(isset($dadosFisicos->NOCAO_ESPACO)){echo isChecked($dadosFisicos->NOCAO_ESPACO, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_nocao_espaco_sim">Sim</label>

                        <input name="nocao_espaco" type="radio" id="radio_nocao_espaco_nao" value="nao" 
                            <?php if(isset($dadosFisicos->NOCAO_ESPACO)){echo isChecked($dadosFisicos->NOCAO_ESPACO, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_nocao_espaco_nao">Não</label>

                        <input name="nocao_espaco" type="radio" id="radio_nocao_espaco_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosFisicos->NOCAO_ESPACO)){echo isChecked($dadosFisicos->NOCAO_ESPACO, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_nocao_espaco_parcialmente">Parcialmente</label>

                        <input name="nocao_espaco" type="radio" id="radio_nocao_espaco_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosFisicos->NOCAO_ESPACO)){echo isChecked($dadosFisicos->NOCAO_ESPACO, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_nocao_espaco_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr>

                <!-- Equilíbrio e agilidade ao se locomover -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Equilíbrio e agilidade ao se locomover.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="equilibrio_agilidade" type="radio" id="radio_equilibrio_agilidade_sim" value="sim" 
                            <?php if(isset($dadosFisicos->EQUILIBRIO_AGILIDADE)){echo isChecked($dadosFisicos->EQUILIBRIO_AGILIDADE, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_equilibrio_agilidade_sim">Sim</label>

                        <input name="equilibrio_agilidade" type="radio" id="radio_equilibrio_agilidade_nao" value="nao" 
                            <?php if(isset($dadosFisicos->EQUILIBRIO_AGILIDADE)){echo isChecked($dadosFisicos->EQUILIBRIO_AGILIDADE, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_equilibrio_agilidade_nao">Não</label>

                        <input name="equilibrio_agilidade" type="radio" id="radio_equilibrio_agilidade_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosFisicos->EQUILIBRIO_AGILIDADE)){echo isChecked($dadosFisicos->EQUILIBRIO_AGILIDADE, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_equilibrio_agilidade_parcialmente">Parcialmente</label>

                        <input name="equilibrio_agilidade" type="radio" id="radio_equilibrio_agilidade_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosFisicos->EQUILIBRIO_AGILIDADE)){echo isChecked($dadosFisicos->EQUILIBRIO_AGILIDADE, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_equilibrio_agilidade_nao_se_aplica">Não se Aplica</label>

                    </div>
                </div>

                <hr>

                <!-- Pula com um pé só -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Pula com um pé só.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="pula_um_pe" type="radio" id="radio_pula_um_pe_sim" value="sim"
                            <?php if(isset($dadosFisicos->PULA_UM_PE)){echo isChecked($dadosFisicos->PULA_UM_PE, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_pula_um_pe_sim">Sim</label>
                        
                        <input name="pula_um_pe" type="radio" id="radio_pula_um_pe_nao" value="nao"
                            <?php if(isset($dadosFisicos->PULA_UM_PE)){echo isChecked($dadosFisicos->PULA_UM_PE, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_pula_um_pe_nao">Não</label>
                        
                        <input name="pula_um_pe" type="radio" id="radio_pula_um_pe_parcialmente" value="parcialmente"
                            <?php if(isset($dadosFisicos->PULA_UM_PE)){echo isChecked($dadosFisicos->PULA_UM_PE, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_pula_um_pe_parcialmente">Parcialmente</label>
                        
                        <input name="pula_um_pe" type="radio" id="radio_pula_um_pe_nao_se_aplica" value="naoaplica"
                            <?php if(isset($dadosFisicos->PULA_UM_PE)){echo isChecked($dadosFisicos->PULA_UM_PE, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_pula_um_pe_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr>

                <!-- Pula com os dois pés -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Pula com os dois pés.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="pula_dois_pes" type="radio" id="radio_pula_dois_pes_sim" value="sim"
                            <?php if(isset($dadosFisicos->PULA_DOIS_PES)){echo isChecked($dadosFisicos->PULA_DOIS_PES, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_pula_dois_pes_sim">Sim</label>
                        
                        <input name="pula_dois_pes" type="radio" id="radio_pula_dois_pes_nao" value="nao"
                            <?php if(isset($dadosFisicos->PULA_DOIS_PES)){echo isChecked($dadosFisicos->PULA_DOIS_PES, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_pula_dois_pes_nao">Não</label>
                        
                        <input name="pula_dois_pes" type="radio" id="radio_pula_dois_pes_parcialmente" value="parcialmente"
                            <?php if(isset($dadosFisicos->PULA_DOIS_PES)){echo isChecked($dadosFisicos->PULA_DOIS_PES, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_pula_dois_pes_parcialmente">Parcialmente</label>
                        
                        <input name="pula_dois_pes" type="radio" id="radio_pula_dois_pes_nao_se_aplica" value="naoaplica"
                            <?php if(isset($dadosFisicos->PULA_DOIS_PES)){echo isChecked($dadosFisicos->PULA_DOIS_PES, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_pula_dois_pes_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr>

                <!-- Corre em linha reta -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Corre em linha reta.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="corre_linha_reta" type="radio" id="radio_corre_linha_reta_sim" value="sim"
                            <?php if(isset($dadosFisicos->CORRE_LINHA_RETA)){echo isChecked($dadosFisicos->CORRE_LINHA_RETA, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_corre_linha_reta_sim">Sim</label>
                        
                        <input name="corre_linha_reta" type="radio" id="radio_corre_linha_reta_nao" value="nao"
                            <?php if(isset($dadosFisicos->CORRE_LINHA_RETA)){echo isChecked($dadosFisicos->CORRE_LINHA_RETA, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_corre_linha_reta_nao">Não</label>
                        
                        <input name="corre_linha_reta" type="radio" id="radio_corre_linha_reta_parcialmente" value="parcialmente"
                            <?php if(isset($dadosFisicos->CORRE_LINHA_RETA)){echo isChecked($dadosFisicos->CORRE_LINHA_RETA, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_corre_linha_reta_parcialmente">Parcialmente</label>
                        
                        <input name="corre_linha_reta" type="radio" id="radio_corre_linha_reta_nao_se_aplica" value="naoaplica"
                            <?php if(isset($dadosFisicos->CORRE_LINHA_RETA)){echo isChecked($dadosFisicos->CORRE_LINHA_RETA, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_corre_linha_reta_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr>

                <!-- Perpassa obstáculos -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Perpassa obstáculos.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="perpassa_obstaculos" type="radio" id="radio_perpassa_obstaculos_sim" value="sim"
                            <?php if(isset($dadosFisicos->PERPASSA_OBSTACULOS)){echo isChecked($dadosFisicos->PERPASSA_OBSTACULOS, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_perpassa_obstaculos_sim">Sim</label>
                        
                        <input name="perpassa_obstaculos" type="radio" id="radio_perpassa_obstaculos_nao" value="nao"
                            <?php if(isset($dadosFisicos->PERPASSA_OBSTACULOS)){echo isChecked($dadosFisicos->PERPASSA_OBSTACULOS, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_perpassa_obstaculos_nao">Não</label>
                        
                        <input name="perpassa_obstaculos" type="radio" id="radio_perpassa_obstaculos_parcialmente" value="parcialmente"
                            <?php if(isset($dadosFisicos->PERPASSA_OBSTACULOS)){echo isChecked($dadosFisicos->PERPASSA_OBSTACULOS, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_perpassa_obstaculos_parcialmente">Parcialmente</label>
                        
                        <input name="perpassa_obstaculos" type="radio" id="radio_perpassa_obstaculos_nao_se_aplica" value="naoaplica"
                            <?php if(isset($dadosFisicos->PERPASSA_OBSTACULOS)){echo isChecked($dadosFisicos->PERPASSA_OBSTACULOS, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_perpassa_obstaculos_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr>

                <!-- Anda na ponta dos pés -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Anda na ponta dos pés.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="anda_ponta_pes" type="radio" id="radio_anda_ponta_pes_sim" value="sim"
                            <?php if(isset($dadosFisicos->ANDA_PONTA_PES)){echo isChecked($dadosFisicos->ANDA_PONTA_PES, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_anda_ponta_pes_sim">Sim</label>
                        
                        <input name="anda_ponta_pes" type="radio" id="radio_anda_ponta_pes_nao" value="nao"
                            <?php if(isset($dadosFisicos->ANDA_PONTA_PES)){echo isChecked($dadosFisicos->ANDA_PONTA_PES, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_anda_ponta_pes_nao">Não</label>
                        
                        <input name="anda_ponta_pes" type="radio" id="radio_anda_ponta_pes_parcialmente" value="parcialmente"
                            <?php if(isset($dadosFisicos->ANDA_PONTA_PES)){echo isChecked($dadosFisicos->ANDA_PONTA_PES, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_anda_ponta_pes_parcialmente">Parcialmente</label>
                        
                        <input name="anda_ponta_pes" type="radio" id="radio_anda_ponta_pes_nao_se_aplica" value="naoaplica"
                            <?php if(isset($dadosFisicos->ANDA_PONTA_PES)){echo isChecked($dadosFisicos->ANDA_PONTA_PES, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_anda_ponta_pes_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

              </div>


              <br><br>
              <div class="row">
                <div class="col-md-12">
                  <h5 style="color: #000; font-weight: bold; text-align: center; cursor: pointer;" data-toggle="collapse" data-target="#coordenacao">
                    ASPECTOS DA COORDENAÇÃO MOTORA FINA <br><button style="margin-right: 10px" type="button" class="btn btn-sm btn-danger">Abrir</button>              
                  </h5>
                </div>
              </div>

              <div id="coordenacao" name="coordenacao" class="collapse">
                <!-- Pega corretamente o lápis -->
                <!-- Pega corretamente o lápis -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Pega corretamente o lápis.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="pega_lapis" type="radio" id="radio_pega_lapis_sim" value="sim" 
                            <?php if(isset($dadosMotoraFina->PEGA_CORRETAMENTE_LAPIS)){echo isChecked($dadosMotoraFina->PEGA_CORRETAMENTE_LAPIS, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_pega_lapis_sim">Sim</label>

                        <input name="pega_lapis" type="radio" id="radio_pega_lapis_nao" value="nao" 
                            <?php if(isset($dadosMotoraFina->PEGA_CORRETAMENTE_LAPIS)){echo isChecked($dadosMotoraFina->PEGA_CORRETAMENTE_LAPIS, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_pega_lapis_nao">Não</label>

                        <input name="pega_lapis" type="radio" id="radio_pega_lapis_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosMotoraFina->PEGA_CORRETAMENTE_LAPIS)){echo isChecked($dadosMotoraFina->PEGA_CORRETAMENTE_LAPIS, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_pega_lapis_parcialmente">Parcialmente</label>

                        <input name="pega_lapis" type="radio" id="radio_pega_lapis_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosMotoraFina->PEGA_CORRETAMENTE_LAPIS)){echo isChecked($dadosMotoraFina->PEGA_CORRETAMENTE_LAPIS, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_pega_lapis_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Utiliza o lápis com facilidade -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Utiliza o lápis com facilidade.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="utiliza_lapis" type="radio" id="radio_utiliza_lapis_sim" value="sim" 
                            <?php if(isset($dadosMotoraFina->UTILIZA_LAPIS_FACILIDADE)){echo isChecked($dadosMotoraFina->UTILIZA_LAPIS_FACILIDADE, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_utiliza_lapis_sim">Sim</label>

                        <input name="utiliza_lapis" type="radio" id="radio_utiliza_lapis_nao" value="nao" 
                            <?php if(isset($dadosMotoraFina->UTILIZA_LAPIS_FACILIDADE)){echo isChecked($dadosMotoraFina->UTILIZA_LAPIS_FACILIDADE, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_utiliza_lapis_nao">Não</label>

                        <input name="utiliza_lapis" type="radio" id="radio_utiliza_lapis_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosMotoraFina->UTILIZA_LAPIS_FACILIDADE)){echo isChecked($dadosMotoraFina->UTILIZA_LAPIS_FACILIDADE, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_utiliza_lapis_parcialmente">Parcialmente</label>

                        <input name="utiliza_lapis" type="radio" id="radio_utiliza_lapis_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosMotoraFina->UTILIZA_LAPIS_FACILIDADE)){echo isChecked($dadosMotoraFina->UTILIZA_LAPIS_FACILIDADE, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_utiliza_lapis_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Escreve de forma espelhada -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Escreve de forma espelhada.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="escreve_espelhada" type="radio" id="radio_escreve_espelhada_sim" value="sim" 
                            <?php if(isset($dadosMotoraFina->ESCREVE_FORMA_ESPELHADA)){echo isChecked($dadosMotoraFina->ESCREVE_FORMA_ESPELHADA, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_escreve_espelhada_sim">Sim</label>

                        <input name="escreve_espelhada" type="radio" id="radio_escreve_espelhada_nao" value="nao" 
                            <?php if(isset($dadosMotoraFina->ESCREVE_FORMA_ESPELHADA)){echo isChecked($dadosMotoraFina->ESCREVE_FORMA_ESPELHADA, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_escreve_espelhada_nao">Não</label>

                        <input name="escreve_espelhada" type="radio" id="radio_escreve_espelhada_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosMotoraFina->ESCREVE_FORMA_ESPELHADA)){echo isChecked($dadosMotoraFina->ESCREVE_FORMA_ESPELHADA, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_escreve_espelhada_parcialmente">Parcialmente</label>

                        <input name="escreve_espelhada" type="radio" id="radio_escreve_espelhada_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosMotoraFina->ESCREVE_FORMA_ESPELHADA)){echo isChecked($dadosMotoraFina->ESCREVE_FORMA_ESPELHADA, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_escreve_espelhada_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Recorta com as mãos -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Recorta com as mãos.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="recorta_maos" type="radio" id="radio_recorta_maos_sim" value="sim" 
                            <?php if(isset($dadosMotoraFina->RECORTA_COM_MAOS)){echo isChecked($dadosMotoraFina->RECORTA_COM_MAOS, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_recorta_maos_sim">Sim</label>

                        <input name="recorta_maos" type="radio" id="radio_recorta_maos_nao" value="nao" 
                            <?php if(isset($dadosMotoraFina->RECORTA_COM_MAOS)){echo isChecked($dadosMotoraFina->RECORTA_COM_MAOS, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_recorta_maos_nao">Não</label>

                        <input name="recorta_maos" type="radio" id="radio_recorta_maos_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosMotoraFina->RECORTA_COM_MAOS)){echo isChecked($dadosMotoraFina->RECORTA_COM_MAOS, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_recorta_maos_parcialmente">Parcialmente</label>

                        <input name="recorta_maos" type="radio" id="radio_recorta_maos_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosMotoraFina->RECORTA_COM_MAOS)){echo isChecked($dadosMotoraFina->RECORTA_COM_MAOS, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_recorta_maos_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Recorta com tesoura -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Recorta com tesoura.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="recorta_tesoura" type="radio" id="radio_recorta_tesoura_sim" value="sim" 
                            <?php if(isset($dadosMotoraFina->RECORTA_COM_TESOURA)){echo isChecked($dadosMotoraFina->RECORTA_COM_TESOURA, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_recorta_tesoura_sim">Sim</label>

                        <input name="recorta_tesoura" type="radio" id="radio_recorta_tesoura_nao" value="nao" 
                            <?php if(isset($dadosMotoraFina->RECORTA_COM_TESOURA)){echo isChecked($dadosMotoraFina->RECORTA_COM_TESOURA, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_recorta_tesoura_nao">Não</label>

                        <input name="recorta_tesoura" type="radio" id="radio_recorta_tesoura_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosMotoraFina->RECORTA_COM_TESOURA)){echo isChecked($dadosMotoraFina->RECORTA_COM_TESOURA, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_recorta_tesoura_parcialmente">Parcialmente</label>

                        <input name="recorta_tesoura" type="radio" id="radio_recorta_tesoura_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosMotoraFina->RECORTA_COM_TESOURA)){echo isChecked($dadosMotoraFina->RECORTA_COM_TESOURA, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_recorta_tesoura_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Pinta dentro dos espaços -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Pinta dentro dos espaços.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="pinta_espacos" type="radio" id="radio_pinta_espacos_sim" value="sim" 
                            <?php if(isset($dadosMotoraFina->PINTA_DENTRO_ESPACOS)){echo isChecked($dadosMotoraFina->PINTA_DENTRO_ESPACOS, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_pinta_espacos_sim">Sim</label>

                        <input name="pinta_espacos" type="radio" id="radio_pinta_espacos_nao" value="nao" 
                            <?php if(isset($dadosMotoraFina->PINTA_DENTRO_ESPACOS)){echo isChecked($dadosMotoraFina->PINTA_DENTRO_ESPACOS, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_pinta_espacos_nao">Não</label>

                        <input name="pinta_espacos" type="radio" id="radio_pinta_espacos_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosMotoraFina->PINTA_DENTRO_ESPACOS)){echo isChecked($dadosMotoraFina->PINTA_DENTRO_ESPACOS, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_pinta_espacos_parcialmente">Parcialmente</label>

                        <input name="pinta_espacos" type="radio" id="radio_pinta_espacos_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosMotoraFina->PINTA_DENTRO_ESPACOS)){echo isChecked($dadosMotoraFina->PINTA_DENTRO_ESPACOS, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_pinta_espacos_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>


                <hr />

                <!-- Amassa -->
                <!-- Amassa -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Amassa.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="amassa" type="radio" id="radio_amassa_sim" value="sim" 
                            <?php if(isset($dadosMotoraFina->AMASSA)){echo isChecked($dadosMotoraFina->AMASSA, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_amassa_sim">Sim</label>

                        <input name="amassa" type="radio" id="radio_amassa_nao" value="nao" 
                            <?php if(isset($dadosMotoraFina->AMASSA)){echo isChecked($dadosMotoraFina->AMASSA, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_amassa_nao">Não</label>

                        <input name="amassa" type="radio" id="radio_amassa_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosMotoraFina->AMASSA)){echo isChecked($dadosMotoraFina->AMASSA, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_amassa_parcialmente">Parcialmente</label>

                        <input name="amassa" type="radio" id="radio_amassa_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosMotoraFina->AMASSA)){echo isChecked($dadosMotoraFina->AMASSA, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_amassa_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>


                <hr />

                <!-- Desenha -->
<!-- Desenha -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Desenha.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="desenha" type="radio" id="radio_desenha_sim" value="sim" 
                            <?php if(isset($dadosMotoraFina->DESENHA)){echo isChecked($dadosMotoraFina->DESENHA, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_desenha_sim">Sim</label>

                        <input name="desenha" type="radio" id="radio_desenha_nao" value="nao" 
                            <?php if(isset($dadosMotoraFina->DESENHA)){echo isChecked($dadosMotoraFina->DESENHA, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_desenha_nao">Não</label>

                        <input name="desenha" type="radio" id="radio_desenha_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosMotoraFina->DESENHA)){echo isChecked($dadosMotoraFina->DESENHA, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_desenha_parcialmente">Parcialmente</label>

                        <input name="desenha" type="radio" id="radio_desenha_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosMotoraFina->DESENHA)){echo isChecked($dadosMotoraFina->DESENHA, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_desenha_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>


                <hr />

                <!-- Alinhava -->
                <!-- Alinhava -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Alinhava.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="alinhava" type="radio" id="radio_alinhava_sim" value="sim" 
                            <?php if(isset($dadosMotoraFina->ALINHAVA)){echo isChecked($dadosMotoraFina->ALINHAVA, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_alinhava_sim">Sim</label>

                        <input name="alinhava" type="radio" id="radio_alinhava_nao" value="nao" 
                            <?php if(isset($dadosMotoraFina->ALINHAVA)){echo isChecked($dadosMotoraFina->ALINHAVA, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_alinhava_nao">Não</label>

                        <input name="alinhava" type="radio" id="radio_alinhava_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosMotoraFina->ALINHAVA)){echo isChecked($dadosMotoraFina->ALINHAVA, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_alinhava_parcialmente">Parcialmente</label>

                        <input name="alinhava" type="radio" id="radio_alinhava_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosMotoraFina->ALINHAVA)){echo isChecked($dadosMotoraFina->ALINHAVA, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_alinhava_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>


                <hr />

                <!-- Abre embalagens de objetos -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Abre embalagens de objetos.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="abre_embalagens" type="radio" id="radio_abre_embalagens_sim" value="sim" 
                            <?php if(isset($dadosMotoraFina->ABRE_EMBALAGENS)){echo isChecked($dadosMotoraFina->ABRE_EMBALAGENS, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_abre_embalagens_sim">Sim</label>

                        <input name="abre_embalagens" type="radio" id="radio_abre_embalagens_nao" value="nao" 
                            <?php if(isset($dadosMotoraFina->ABRE_EMBALAGENS)){echo isChecked($dadosMotoraFina->ABRE_EMBALAGENS, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_abre_embalagens_nao">Não</label>

                        <input name="abre_embalagens" type="radio" id="radio_abre_embalagens_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosMotoraFina->ABRE_EMBALAGENS)){echo isChecked($dadosMotoraFina->ABRE_EMBALAGENS, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_abre_embalagens_parcialmente">Parcialmente</label>

                        <input name="abre_embalagens" type="radio" id="radio_abre_embalagens_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosMotoraFina->ABRE_EMBALAGENS)){echo isChecked($dadosMotoraFina->ABRE_EMBALAGENS, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_abre_embalagens_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Enrosca -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Enrosca.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="enrosca" type="radio" id="radio_enrosca_sim" value="sim" 
                            <?php if(isset($dadosMotoraFina->ENROSCA)){echo isChecked($dadosMotoraFina->ENROSCA, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_enrosca_sim">Sim</label>

                        <input name="enrosca" type="radio" id="radio_enrosca_nao" value="nao" 
                            <?php if(isset($dadosMotoraFina->ENROSCA)){echo isChecked($dadosMotoraFina->ENROSCA, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_enrosca_nao">Não</label>

                        <input name="enrosca" type="radio" id="radio_enrosca_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosMotoraFina->ENROSCA)){echo isChecked($dadosMotoraFina->ENROSCA, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_enrosca_parcialmente">Parcialmente</label>

                        <input name="enrosca" type="radio" id="radio_enrosca_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosMotoraFina->ENROSCA)){echo isChecked($dadosMotoraFina->ENROSCA, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_enrosca_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Monta e desmonta -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Monta e desmonta.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="monta_desmonta" type="radio" id="radio_monta_desmonta_sim" value="sim" 
                            <?php if(isset($dadosMotoraFina->MONTA_DESMONTA)){echo isChecked($dadosMotoraFina->MONTA_DESMONTA, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_monta_desmonta_sim">Sim</label>

                        <input name="monta_desmonta" type="radio" id="radio_monta_desmonta_nao" value="nao" 
                            <?php if(isset($dadosMotoraFina->MONTA_DESMONTA)){echo isChecked($dadosMotoraFina->MONTA_DESMONTA, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_monta_desmonta_nao">Não</label>

                        <input name="monta_desmonta" type="radio" id="radio_monta_desmonta_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosMotoraFina->MONTA_DESMONTA)){echo isChecked($dadosMotoraFina->MONTA_DESMONTA, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_monta_desmonta_parcialmente">Parcialmente</label>

                        <input name="monta_desmonta" type="radio" id="radio_monta_desmonta_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosMotoraFina->MONTA_DESMONTA)){echo isChecked($dadosMotoraFina->MONTA_DESMONTA, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_monta_desmonta_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

              </div>

                <br><br>
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000; font-weight: bold; text-align: center; cursor: pointer;" data-toggle="collapse" data-target="#emocionais">
                      ASPECTOS SOCIAIS E EMOCIONAIS <br><button style="margin-right: 10px" type="button" class="btn btn-sm btn-danger">Abrir</button>              
                    </h5>
                  </div>
                </div>

              <div id="emocionais" name="emocionais" class="collapse">
                <!-- Busca atenção para si -->
                <!-- Busca atenção para si -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Busca atenção para si.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="atencao" type="radio" id="radio_atencao_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->BUSCA_ATENCAO_PARA_SI)){echo isChecked($dadosSociaisEmocionais->BUSCA_ATENCAO_PARA_SI, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_atencao_sim">Sim</label>

                        <input name="atencao" type="radio" id="radio_atencao_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->BUSCA_ATENCAO_PARA_SI)){echo isChecked($dadosSociaisEmocionais->BUSCA_ATENCAO_PARA_SI, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_atencao_nao">Não</label>

                        <input name="atencao" type="radio" id="radio_atencao_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->BUSCA_ATENCAO_PARA_SI)){echo isChecked($dadosSociaisEmocionais->BUSCA_ATENCAO_PARA_SI, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_atencao_parcialmente">Parcialmente</label>

                        <input name="atencao" type="radio" id="radio_atencao_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->BUSCA_ATENCAO_PARA_SI)){echo isChecked($dadosSociaisEmocionais->BUSCA_ATENCAO_PARA_SI, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_atencao_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Busca interagir com os colegas -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Busca interagir com os colegas.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="interage_colegas" type="radio" id="radio_interage_colegas_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->BUSCA_INTERAGIR_COLEGAS)){echo isChecked($dadosSociaisEmocionais->BUSCA_INTERAGIR_COLEGAS, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_interage_colegas_sim">Sim</label>

                        <input name="interage_colegas" type="radio" id="radio_interage_colegas_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->BUSCA_INTERAGIR_COLEGAS)){echo isChecked($dadosSociaisEmocionais->BUSCA_INTERAGIR_COLEGAS, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_interage_colegas_nao">Não</label>

                        <input name="interage_colegas" type="radio" id="radio_interage_colegas_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->BUSCA_INTERAGIR_COLEGAS)){echo isChecked($dadosSociaisEmocionais->BUSCA_INTERAGIR_COLEGAS, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_interage_colegas_parcialmente">Parcialmente</label>

                        <input name="interage_colegas" type="radio" id="radio_interage_colegas_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->BUSCA_INTERAGIR_COLEGAS)){echo isChecked($dadosSociaisEmocionais->BUSCA_INTERAGIR_COLEGAS, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_interage_colegas_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Compreende e atende regras e comandos -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Compreende e atende regras e comandos.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="compreende_regras" type="radio" id="radio_compreende_regras_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->COMPREENDE_ATENDE_REGRAS)){echo isChecked($dadosSociaisEmocionais->COMPREENDE_ATENDE_REGRAS, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_compreende_regras_sim">Sim</label>

                        <input name="compreende_regras" type="radio" id="radio_compreende_regras_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->COMPREENDE_ATENDE_REGRAS)){echo isChecked($dadosSociaisEmocionais->COMPREENDE_ATENDE_REGRAS, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_compreende_regras_nao">Não</label>

                        <input name="compreende_regras" type="radio" id="radio_compreende_regras_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->COMPREENDE_ATENDE_REGRAS)){echo isChecked($dadosSociaisEmocionais->COMPREENDE_ATENDE_REGRAS, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_compreende_regras_parcialmente">Parcialmente</label>

                        <input name="compreende_regras" type="radio" id="radio_compreende_regras_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->COMPREENDE_ATENDE_REGRAS)){echo isChecked($dadosSociaisEmocionais->COMPREENDE_ATENDE_REGRAS, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_compreende_regras_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Aceita e solicita ajuda -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Aceita e solicita ajuda.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="aceita_ajuda" type="radio" id="radio_aceita_ajuda_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->ACEITA_SOLICITA_AJUDA)){echo isChecked($dadosSociaisEmocionais->ACEITA_SOLICITA_AJUDA, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_aceita_ajuda_sim">Sim</label>

                        <input name="aceita_ajuda" type="radio" id="radio_aceita_ajuda_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->ACEITA_SOLICITA_AJUDA)){echo isChecked($dadosSociaisEmocionais->ACEITA_SOLICITA_AJUDA, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_aceita_ajuda_nao">Não</label>

                        <input name="aceita_ajuda" type="radio" id="radio_aceita_ajuda_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->ACEITA_SOLICITA_AJUDA)){echo isChecked($dadosSociaisEmocionais->ACEITA_SOLICITA_AJUDA, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_aceita_ajuda_parcialmente">Parcialmente</label>

                        <input name="aceita_ajuda" type="radio" id="radio_aceita_ajuda_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->ACEITA_SOLICITA_AJUDA)){echo isChecked($dadosSociaisEmocionais->ACEITA_SOLICITA_AJUDA, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_aceita_ajuda_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Divide e compartilha brinquedos e materiais -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Divide e compartilha brinquedos e materiais.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="divide_compartilha" type="radio" id="radio_divide_compartilha_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->DIVIDE_COMPARTILHA_BRINQUEDOS)){echo isChecked($dadosSociaisEmocionais->DIVIDE_COMPARTILHA_BRINQUEDOS, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_divide_compartilha_sim">Sim</label>

                        <input name="divide_compartilha" type="radio" id="radio_divide_compartilha_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->DIVIDE_COMPARTILHA_BRINQUEDOS)){echo isChecked($dadosSociaisEmocionais->DIVIDE_COMPARTILHA_BRINQUEDOS, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_divide_compartilha_nao">Não</label>

                        <input name="divide_compartilha" type="radio" id="radio_divide_compartilha_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->DIVIDE_COMPARTILHA_BRINQUEDOS)){echo isChecked($dadosSociaisEmocionais->DIVIDE_COMPARTILHA_BRINQUEDOS, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_divide_compartilha_parcialmente">Parcialmente</label>

                        <input name="divide_compartilha" type="radio" id="radio_divide_compartilha_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->DIVIDE_COMPARTILHA_BRINQUEDOS)){echo isChecked($dadosSociaisEmocionais->DIVIDE_COMPARTILHA_BRINQUEDOS, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_divide_compartilha_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Participa de momentos em grupo -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Participa de momentos em grupo.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="participa_grupo" type="radio" id="radio_participa_grupo_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->PARTICIPA_MOMENTOS_GRUPO)){echo isChecked($dadosSociaisEmocionais->PARTICIPA_MOMENTOS_GRUPO, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_participa_grupo_sim">Sim</label>

                        <input name="participa_grupo" type="radio" id="radio_participa_grupo_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->PARTICIPA_MOMENTOS_GRUPO)){echo isChecked($dadosSociaisEmocionais->PARTICIPA_MOMENTOS_GRUPO, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_participa_grupo_nao">Não</label>

                        <input name="participa_grupo" type="radio" id="radio_participa_grupo_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->PARTICIPA_MOMENTOS_GRUPO)){echo isChecked($dadosSociaisEmocionais->PARTICIPA_MOMENTOS_GRUPO, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_participa_grupo_parcialmente">Parcialmente</label>

                        <input name="participa_grupo" type="radio" id="radio_participa_grupo_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->PARTICIPA_MOMENTOS_GRUPO)){echo isChecked($dadosSociaisEmocionais->PARTICIPA_MOMENTOS_GRUPO, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_participa_grupo_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Expõe acontecimentos do seu cotidiano -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Expõe acontecimentos do seu cotidiano.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="expor_cotidiano" type="radio" id="radio_expor_cotidiano_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->EXPOE_ACONTECIMENTOS_COTIDIANO)){echo isChecked($dadosSociaisEmocionais->EXPOE_ACONTECIMENTOS_COTIDIANO, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_expor_cotidiano_sim">Sim</label>

                        <input name="expor_cotidiano" type="radio" id="radio_expor_cotidiano_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->EXPOE_ACONTECIMENTOS_COTIDIANO)){echo isChecked($dadosSociaisEmocionais->EXPOE_ACONTECIMENTOS_COTIDIANO, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_expor_cotidiano_nao">Não</label>

                        <input name="expor_cotidiano" type="radio" id="radio_expor_cotidiano_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->EXPOE_ACONTECIMENTOS_COTIDIANO)){echo isChecked($dadosSociaisEmocionais->EXPOE_ACONTECIMENTOS_COTIDIANO, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_expor_cotidiano_parcialmente">Parcialmente</label>

                        <input name="expor_cotidiano" type="radio" id="radio_expor_cotidiano_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->EXPOE_ACONTECIMENTOS_COTIDIANO)){echo isChecked($dadosSociaisEmocionais->EXPOE_ACONTECIMENTOS_COTIDIANO, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_expor_cotidiano_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Brinca de forma isolada -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Brinca de forma isolada.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="brinca_isolado" type="radio" id="radio_brinca_isolado_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->BRINCA_FORMA_ISOLADA)){echo isChecked($dadosSociaisEmocionais->BRINCA_FORMA_ISOLADA, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_brinca_isolado_sim">Sim</label>

                        <input name="brinca_isolado" type="radio" id="radio_brinca_isolado_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->BRINCA_FORMA_ISOLADA)){echo isChecked($dadosSociaisEmocionais->BRINCA_FORMA_ISOLADA, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_brinca_isolado_nao">Não</label>

                        <input name="brinca_isolado" type="radio" id="radio_brinca_isolado_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->BRINCA_FORMA_ISOLADA)){echo isChecked($dadosSociaisEmocionais->BRINCA_FORMA_ISOLADA, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_brinca_isolado_parcialmente">Parcialmente</label>

                        <input name="brinca_isolado" type="radio" id="radio_brinca_isolado_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->BRINCA_FORMA_ISOLADA)){echo isChecked($dadosSociaisEmocionais->BRINCA_FORMA_ISOLADA, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_brinca_isolado_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Brinca com os colegas -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Brinca com os colegas.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="brinca_colegas" type="radio" id="radio_brinca_colegas_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->BRINCA_COM_COLEGAS)){echo isChecked($dadosSociaisEmocionais->BRINCA_COM_COLEGAS, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_brinca_colegas_sim">Sim</label>

                        <input name="brinca_colegas" type="radio" id="radio_brinca_colegas_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->BRINCA_COM_COLEGAS)){echo isChecked($dadosSociaisEmocionais->BRINCA_COM_COLEGAS, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_brinca_colegas_nao">Não</label>

                        <input name="brinca_colegas" type="radio" id="radio_brinca_colegas_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->BRINCA_COM_COLEGAS)){echo isChecked($dadosSociaisEmocionais->BRINCA_COM_COLEGAS, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_brinca_colegas_parcialmente">Parcialmente</label>

                        <input name="brinca_colegas" type="radio" id="radio_brinca_colegas_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->BRINCA_COM_COLEGAS)){echo isChecked($dadosSociaisEmocionais->BRINCA_COM_COLEGAS, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_brinca_colegas_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Aceita contato físico -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Aceita contato físico.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="contato_fisico" type="radio" id="radio_contato_fisico_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->ACEITA_CONTATO_FISICO)){echo isChecked($dadosSociaisEmocionais->ACEITA_CONTATO_FISICO, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_contato_fisico_sim">Sim</label>

                        <input name="contato_fisico" type="radio" id="radio_contato_fisico_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->ACEITA_CONTATO_FISICO)){echo isChecked($dadosSociaisEmocionais->ACEITA_CONTATO_FISICO, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_contato_fisico_nao">Não</label>

                        <input name="contato_fisico" type="radio" id="radio_contato_fisico_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->ACEITA_CONTATO_FISICO)){echo isChecked($dadosSociaisEmocionais->ACEITA_CONTATO_FISICO, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_contato_fisico_parcialmente">Parcialmente</label>

                        <input name="contato_fisico" type="radio" id="radio_contato_fisico_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->ACEITA_CONTATO_FISICO)){echo isChecked($dadosSociaisEmocionais->ACEITA_CONTATO_FISICO, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_contato_fisico_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Se isola -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Se isola.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="se_isola" type="radio" id="radio_se_isola_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->SE_ISOLA)){echo isChecked($dadosSociaisEmocionais->SE_ISOLA, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_se_isola_sim">Sim</label>

                        <input name="se_isola" type="radio" id="radio_se_isola_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->SE_ISOLA)){echo isChecked($dadosSociaisEmocionais->SE_ISOLA, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_se_isola_nao">Não</label>

                        <input name="se_isola" type="radio" id="radio_se_isola_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->SE_ISOLA)){echo isChecked($dadosSociaisEmocionais->SE_ISOLA, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_se_isola_parcialmente">Parcialmente</label>

                        <input name="se_isola" type="radio" id="radio_se_isola_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->SE_ISOLA)){echo isChecked($dadosSociaisEmocionais->SE_ISOLA, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_se_isola_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Se zanga com facilidade -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Se zanga com facilidade.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="se_zanga" type="radio" id="radio_se_zanga_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->SE_ZANGA_COM_FACILIDADE)){echo isChecked($dadosSociaisEmocionais->SE_ZANGA_COM_FACILIDADE, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_se_zanga_sim">Sim</label>

                        <input name="se_zanga" type="radio" id="radio_se_zanga_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->SE_ZANGA_COM_FACILIDADE)){echo isChecked($dadosSociaisEmocionais->SE_ZANGA_COM_FACILIDADE, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_se_zanga_nao">Não</label>

                        <input name="se_zanga" type="radio" id="radio_se_zanga_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->SE_ZANGA_COM_FACILIDADE)){echo isChecked($dadosSociaisEmocionais->SE_ZANGA_COM_FACILIDADE, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_se_zanga_parcialmente">Parcialmente</label>

                        <input name="se_zanga" type="radio" id="radio_se_zanga_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->SE_ZANGA_COM_FACILIDADE)){echo isChecked($dadosSociaisEmocionais->SE_ZANGA_COM_FACILIDADE, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_se_zanga_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Alterações de humor com frequência -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Alterações de humor com frequência.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="alteracoes_humor" type="radio" id="radio_alteracoes_humor_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->ALTERACOES_HUMOR_FREQUENCIA)){echo isChecked($dadosSociaisEmocionais->ALTERACOES_HUMOR_FREQUENCIA, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_alteracoes_humor_sim">Sim</label>

                        <input name="alteracoes_humor" type="radio" id="radio_alteracoes_humor_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->ALTERACOES_HUMOR_FREQUENCIA)){echo isChecked($dadosSociaisEmocionais->ALTERACOES_HUMOR_FREQUENCIA, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_alteracoes_humor_nao">Não</label>

                        <input name="alteracoes_humor" type="radio" id="radio_alteracoes_humor_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->ALTERACOES_HUMOR_FREQUENCIA)){echo isChecked($dadosSociaisEmocionais->ALTERACOES_HUMOR_FREQUENCIA, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_alteracoes_humor_parcialmente">Parcialmente</label>

                        <input name="alteracoes_humor" type="radio" id="radio_alteracoes_humor_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->ALTERACOES_HUMOR_FREQUENCIA)){echo isChecked($dadosSociaisEmocionais->ALTERACOES_HUMOR_FREQUENCIA, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_alteracoes_humor_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Faz contato visual -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Faz contato visual.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="contato_visual" type="radio" id="radio_contato_visual_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->FAZ_CONTATO_VISUAL)){echo isChecked($dadosSociaisEmocionais->FAZ_CONTATO_VISUAL, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_contato_visual_sim">Sim</label>

                        <input name="contato_visual" type="radio" id="radio_contato_visual_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->FAZ_CONTATO_VISUAL)){echo isChecked($dadosSociaisEmocionais->FAZ_CONTATO_VISUAL, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_contato_visual_nao">Não</label>

                        <input name="contato_visual" type="radio" id="radio_contato_visual_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->FAZ_CONTATO_VISUAL)){echo isChecked($dadosSociaisEmocionais->FAZ_CONTATO_VISUAL, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_contato_visual_parcialmente">Parcialmente</label>

                        <input name="contato_visual" type="radio" id="radio_contato_visual_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->FAZ_CONTATO_VISUAL)){echo isChecked($dadosSociaisEmocionais->FAZ_CONTATO_VISUAL, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_contato_visual_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Se reconhece em fotos -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Se reconhece em fotos.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="se_reconhece_fotos" type="radio" id="radio_se_reconhece_fotos_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->SE_RECONHECE_FOTOS)){echo isChecked($dadosSociaisEmocionais->SE_RECONHECE_FOTOS, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_se_reconhece_fotos_sim">Sim</label>

                        <input name="se_reconhece_fotos" type="radio" id="radio_se_reconhece_fotos_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->SE_RECONHECE_FOTOS)){echo isChecked($dadosSociaisEmocionais->SE_RECONHECE_FOTOS, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_se_reconhece_fotos_nao">Não</label>

                        <input name="se_reconhece_fotos" type="radio" id="radio_se_reconhece_fotos_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->SE_RECONHECE_FOTOS)){echo isChecked($dadosSociaisEmocionais->SE_RECONHECE_FOTOS, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_se_reconhece_fotos_parcialmente">Parcialmente</label>

                        <input name="se_reconhece_fotos" type="radio" id="radio_se_reconhece_fotos_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->SE_RECONHECE_FOTOS)){echo isChecked($dadosSociaisEmocionais->SE_RECONHECE_FOTOS, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_se_reconhece_fotos_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Reconhece pessoas em fotos -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Reconhece pessoas em fotos.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="reconhece_pessoas_fotos" type="radio" id="radio_reconhece_pessoas_fotos_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->RECONHECE_PESSOAS_FOTOS)){echo isChecked($dadosSociaisEmocionais->RECONHECE_PESSOAS_FOTOS, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_reconhece_pessoas_fotos_sim">Sim</label>

                        <input name="reconhece_pessoas_fotos" type="radio" id="radio_reconhece_pessoas_fotos_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->RECONHECE_PESSOAS_FOTOS)){echo isChecked($dadosSociaisEmocionais->RECONHECE_PESSOAS_FOTOS, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_reconhece_pessoas_fotos_nao">Não</label>

                        <input name="reconhece_pessoas_fotos" type="radio" id="radio_reconhece_pessoas_fotos_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->RECONHECE_PESSOAS_FOTOS)){echo isChecked($dadosSociaisEmocionais->RECONHECE_PESSOAS_FOTOS, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_reconhece_pessoas_fotos_parcialmente">Parcialmente</label>

                        <input name="reconhece_pessoas_fotos" type="radio" id="radio_reconhece_pessoas_fotos_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->RECONHECE_PESSOAS_FOTOS)){echo isChecked($dadosSociaisEmocionais->RECONHECE_PESSOAS_FOTOS, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_reconhece_pessoas_fotos_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>

                <hr />

                <!-- Reconhece componentes familiares -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: #000;">Reconhece componentes familiares.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="reconhece_componentes_familiares" type="radio" id="radio_reconhece_componentes_familiares_sim" value="sim" 
                            <?php if(isset($dadosSociaisEmocionais->RECONHECE_COMPONENTES_FAMILIARES)){echo isChecked($dadosSociaisEmocionais->RECONHECE_COMPONENTES_FAMILIARES, 'sim'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_reconhece_componentes_familiares_sim">Sim</label>

                        <input name="reconhece_componentes_familiares" type="radio" id="radio_reconhece_componentes_familiares_nao" value="nao" 
                            <?php if(isset($dadosSociaisEmocionais->RECONHECE_COMPONENTES_FAMILIARES)){echo isChecked($dadosSociaisEmocionais->RECONHECE_COMPONENTES_FAMILIARES, 'nao'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_reconhece_componentes_familiares_nao">Não</label>

                        <input name="reconhece_componentes_familiares" type="radio" id="radio_reconhece_componentes_familiares_parcialmente" value="parcialmente" 
                            <?php if(isset($dadosSociaisEmocionais->RECONHECE_COMPONENTES_FAMILIARES)){echo isChecked($dadosSociaisEmocionais->RECONHECE_COMPONENTES_FAMILIARES, 'parcialmente'); }?> />
                        <label style="color: #000; margin-right: 5px" for="radio_reconhece_componentes_familiares_parcialmente">Parcialmente</label>

                        <input name="reconhece_componentes_familiares" type="radio" id="radio_reconhece_componentes_familiares_nao_se_aplica" value="naoaplica" 
                            <?php if(isset($dadosSociaisEmocionais->RECONHECE_COMPONENTES_FAMILIARES)){echo isChecked($dadosSociaisEmocionais->RECONHECE_COMPONENTES_FAMILIARES, 'naoaplica'); }?> />
                        <label style="color: #000" for="radio_reconhece_componentes_familiares_nao_se_aplica">Não se Aplica</label>
                    </div>
                </div>


              </div>


              <br><br>
              <div class="row">
                <div class="col-md-12">
                <h5 style="color: #000; font-weight: bold; text-align: center; cursor: pointer;" data-toggle="collapse" data-target="#autonomia">
                  ASPECTOS DE AUTONOMIA <br><button style="margin-right: 10px" type="button" class="btn btn-sm btn-danger">Abrir</button>              
                </h5>
                </div>
              </div>

              <div id="autonomia" name="autonomia" class="collapse">
                <!-- Utiliza fralda -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Utiliza fralda.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="utiliza_fralda" type="radio" id="radio_utiliza_fralda_sim" value="sim" 
                          <?php if(isset($dadosAutonomia->UTILIZA_FRALDA)){echo isChecked($dadosAutonomia->UTILIZA_FRALDA, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_utiliza_fralda_sim">Sim</label>

                    <input name="utiliza_fralda" type="radio" id="radio_utiliza_fralda_nao" value="nao" 
                          <?php if(isset($dadosAutonomia->UTILIZA_FRALDA)){echo isChecked($dadosAutonomia->UTILIZA_FRALDA, 'nao'); }?> />
                    <label style="color: #000" for="radio_utiliza_fralda_nao">Não</label>

                    <input name="utiliza_fralda" type="radio" id="radio_utiliza_fralda_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosAutonomia->UTILIZA_FRALDA)){echo isChecked($dadosAutonomia->UTILIZA_FRALDA, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_utiliza_fralda_parcialmente">Parcialmente</label>

                    <input name="utiliza_fralda" type="radio" id="radio_utiliza_fralda_nao_aplica" value="naoaplica" 
                          <?php if(isset($dadosAutonomia->UTILIZA_FRALDA)){echo isChecked($dadosAutonomia->UTILIZA_FRALDA, 'naoaplica'); }?> />
                    <label style="color: #000;" for="radio_utiliza_fralda_nao_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Se limpa sozinho(a) -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Se limpa sozinho(a).</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="se_limpa_sozinho" type="radio" id="radio_se_limpa_sozinho_sim" value="sim" 
                          <?php if(isset($dadosAutonomia->SE_LIMPA_SOZINHO)){echo isChecked($dadosAutonomia->SE_LIMPA_SOZINHO, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_se_limpa_sozinho_sim">Sim</label>

                    <input name="se_limpa_sozinho" type="radio" id="radio_se_limpa_sozinho_nao" value="nao" 
                          <?php if(isset($dadosAutonomia->SE_LIMPA_SOZINHO)){echo isChecked($dadosAutonomia->SE_LIMPA_SOZINHO, 'nao'); }?> />
                    <label style="color: #000" for="radio_se_limpa_sozinho_nao">Não</label>

                    <input name="se_limpa_sozinho" type="radio" id="radio_se_limpa_sozinho_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosAutonomia->SE_LIMPA_SOZINHO)){echo isChecked($dadosAutonomia->SE_LIMPA_SOZINHO, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_se_limpa_sozinho_parcialmente">Parcialmente</label>

                    <input name="se_limpa_sozinho" type="radio" id="radio_se_limpa_sozinho_nao_aplica" value="naoaplica" 
                          <?php if(isset($dadosAutonomia->SE_LIMPA_SOZINHO)){echo isChecked($dadosAutonomia->SE_LIMPA_SOZINHO, 'naoaplica'); }?> />
                    <label style="color: #000;" for="radio_se_limpa_sozinho_nao_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Escova os dentes sozinho(a) -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Escova os dentes sozinho(a).</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="escova_dentes_sozinho" type="radio" id="radio_escova_dentes_sozinho_sim" value="sim" 
                          <?php if(isset($dadosAutonomia->ESCOVA_DENTES_SOZINHO)){echo isChecked($dadosAutonomia->ESCOVA_DENTES_SOZINHO, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_escova_dentes_sozinho_sim">Sim</label>

                    <input name="escova_dentes_sozinho" type="radio" id="radio_escova_dentes_sozinho_nao" value="nao" 
                          <?php if(isset($dadosAutonomia->ESCOVA_DENTES_SOZINHO)){echo isChecked($dadosAutonomia->ESCOVA_DENTES_SOZINHO, 'nao'); }?> />
                    <label style="color: #000" for="radio_escova_dentes_sozinho_nao">Não</label>

                    <input name="escova_dentes_sozinho" type="radio" id="radio_escova_dentes_sozinho_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosAutonomia->ESCOVA_DENTES_SOZINHO)){echo isChecked($dadosAutonomia->ESCOVA_DENTES_SOZINHO, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_escova_dentes_sozinho_parcialmente">Parcialmente</label>

                    <input name="escova_dentes_sozinho" type="radio" id="radio_escova_dentes_sozinho_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosAutonomia->ESCOVA_DENTES_SOZINHO)){echo isChecked($dadosAutonomia->ESCOVA_DENTES_SOZINHO, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_escova_dentes_sozinho_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Guarda seus pertences sozinho(a) -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Guarda seus pertences sozinho(a).</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="guarda_pertences_sozinho" type="radio" id="radio_guarda_pertences_sozinho_sim" value="sim" 
                          <?php if(isset($dadosAutonomia->GUARDA_PERTENCES_SOZINHO)){echo isChecked($dadosAutonomia->GUARDA_PERTENCES_SOZINHO, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_guarda_pertences_sozinho_sim">Sim</label>

                    <input name="guarda_pertences_sozinho" type="radio" id="radio_guarda_pertences_sozinho_nao" value="nao" 
                          <?php if(isset($dadosAutonomia->GUARDA_PERTENCES_SOZINHO)){echo isChecked($dadosAutonomia->GUARDA_PERTENCES_SOZINHO, 'nao'); }?> />
                    <label style="color: #000" for="radio_guarda_pertences_sozinho_nao">Não</label>

                    <input name="guarda_pertences_sozinho" type="radio" id="radio_guarda_pertences_sozinho_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosAutonomia->GUARDA_PERTENCES_SOZINHO)){echo isChecked($dadosAutonomia->GUARDA_PERTENCES_SOZINHO, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_guarda_pertences_sozinho_parcialmente">Parcialmente</label>

                    <input name="guarda_pertences_sozinho" type="radio" id="radio_guarda_pertences_sozinho_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosAutonomia->GUARDA_PERTENCES_SOZINHO)){echo isChecked($dadosAutonomia->GUARDA_PERTENCES_SOZINHO, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_guarda_pertences_sozinho_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Amarra cadarços -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Amarra cadarços.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="amarra_cadarcos" type="radio" id="radio_amarra_cadarcos_sim" value="sim" 
                          <?php if(isset($dadosAutonomia->AMARRA_CADARCOS)){echo isChecked($dadosAutonomia->AMARRA_CADARCOS, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_amarra_cadarcos_sim">Sim</label>

                    <input name="amarra_cadarcos" type="radio" id="radio_amarra_cadarcos_nao" value="nao" 
                          <?php if(isset($dadosAutonomia->AMARRA_CADARCOS)){echo isChecked($dadosAutonomia->AMARRA_CADARCOS, 'nao'); }?> />
                    <label style="color: #000" for="radio_amarra_cadarcos_nao">Não</label>

                    <input name="amarra_cadarcos" type="radio" id="radio_amarra_cadarcos_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosAutonomia->AMARRA_CADARCOS)){echo isChecked($dadosAutonomia->AMARRA_CADARCOS, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_amarra_cadarcos_parcialmente">Parcialmente</label>

                    <input name="amarra_cadarcos" type="radio" id="radio_amarra_cadarcos_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosAutonomia->AMARRA_CADARCOS)){echo isChecked($dadosAutonomia->AMARRA_CADARCOS, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_amarra_cadarcos_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Abre mochila/estojo/lancheira sem auxílio -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Abre mochila/estojo/lancheira sem auxílio.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="abre_mochila" type="radio" id="radio_abre_mochila_sim" value="sim" 
                          <?php if(isset($dadosAutonomia->ABRE_MOCHILA_SEM_AUXILIO)){echo isChecked($dadosAutonomia->ABRE_MOCHILA_SEM_AUXILIO, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_abre_mochila_sim">Sim</label>

                    <input name="abre_mochila" type="radio" id="radio_abre_mochila_nao" value="nao" 
                          <?php if(isset($dadosAutonomia->ABRE_MOCHILA_SEM_AUXILIO)){echo isChecked($dadosAutonomia->ABRE_MOCHILA_SEM_AUXILIO, 'nao'); }?> />
                    <label style="color: #000" for="radio_abre_mochila_nao">Não</label>

                    <input name="abre_mochila" type="radio" id="radio_abre_mochila_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosAutonomia->ABRE_MOCHILA_SEM_AUXILIO)){echo isChecked($dadosAutonomia->ABRE_MOCHILA_SEM_AUXILIO, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_abre_mochila_parcialmente">Parcialmente</label>

                    <input name="abre_mochila" type="radio" id="radio_abre_mochila_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosAutonomia->ABRE_MOCHILA_SEM_AUXILIO)){echo isChecked($dadosAutonomia->ABRE_MOCHILA_SEM_AUXILIO, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_abre_mochila_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- É independente na realização das atividades -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">É independente na realização das atividades.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="independente_atividades" type="radio" id="radio_independente_atividades_sim" value="sim" 
                          <?php if(isset($dadosAutonomia->INDEPENDENTE_REALIZACAO_ATIVIDADES)){echo isChecked($dadosAutonomia->INDEPENDENTE_REALIZACAO_ATIVIDADES, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_independente_atividades_sim">Sim</label>

                    <input name="independente_atividades" type="radio" id="radio_independente_atividades_nao" value="nao" 
                          <?php if(isset($dadosAutonomia->INDEPENDENTE_REALIZACAO_ATIVIDADES)){echo isChecked($dadosAutonomia->INDEPENDENTE_REALIZACAO_ATIVIDADES, 'nao'); }?> />
                    <label style="color: #000" for="radio_independente_atividades_nao">Não</label>

                    <input name="independente_atividades" type="radio" id="radio_independente_atividades_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosAutonomia->INDEPENDENTE_REALIZACAO_ATIVIDADES)){echo isChecked($dadosAutonomia->INDEPENDENTE_REALIZACAO_ATIVIDADES, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_independente_atividades_parcialmente">Parcialmente</label>

                    <input name="independente_atividades" type="radio" id="radio_independente_atividades_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosAutonomia->INDEPENDENTE_REALIZACAO_ATIVIDADES)){echo isChecked($dadosAutonomia->INDEPENDENTE_REALIZACAO_ATIVIDADES, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_independente_atividades_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

              </div>

                <hr />

                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000; font-weight: bold; text-align: center; cursor: pointer;" data-toggle="collapse" data-target="#cognitivos">
                      ASPECTOS COGNITIVOS <br><button style="margin-right: 10px" type="button" class="btn btn-sm btn-danger">Abrir</button>              
                    </h5>
                  </div>
                </div>

              <div id="cognitivos" name="cognitivos" class="collapse">
                <!-- Reconhece e identifica as cores estudadas -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Reconhece e identifica as cores estudadas.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="reconhece_cores" type="radio" id="radio_reconhece_cores_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->RECONHECE_IDENTIFICA_CORES)){echo isChecked($dadosCognitivos->RECONHECE_IDENTIFICA_CORES, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_reconhece_cores_sim">Sim</label>

                    <input name="reconhece_cores" type="radio" id="radio_reconhece_cores_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->RECONHECE_IDENTIFICA_CORES)){echo isChecked($dadosCognitivos->RECONHECE_IDENTIFICA_CORES, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_reconhece_cores_nao">Não</label>

                    <input name="reconhece_cores" type="radio" id="radio_reconhece_cores_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->RECONHECE_IDENTIFICA_CORES)){echo isChecked($dadosCognitivos->RECONHECE_IDENTIFICA_CORES, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_reconhece_cores_parcialmente">Parcialmente</label>

                    <input name="reconhece_cores" type="radio" id="radio_reconhece_cores_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->RECONHECE_IDENTIFICA_CORES)){echo isChecked($dadosCognitivos->RECONHECE_IDENTIFICA_CORES, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_reconhece_cores_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Reconhece e identifica os números estudados -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Reconhece e identifica os números estudados.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="reconhece_numeros" type="radio" id="radio_reconhece_numeros_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->RECONHECE_IDENTIFICA_NUMEROS)){echo isChecked($dadosCognitivos->RECONHECE_IDENTIFICA_NUMEROS, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_reconhece_numeros_sim">Sim</label>

                    <input name="reconhece_numeros" type="radio" id="radio_reconhece_numeros_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->RECONHECE_IDENTIFICA_NUMEROS)){echo isChecked($dadosCognitivos->RECONHECE_IDENTIFICA_NUMEROS, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_reconhece_numeros_nao">Não</label>

                    <input name="reconhece_numeros" type="radio" id="radio_reconhece_numeros_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->RECONHECE_IDENTIFICA_NUMEROS)){echo isChecked($dadosCognitivos->RECONHECE_IDENTIFICA_NUMEROS, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_reconhece_numeros_parcialmente">Parcialmente</label>

                    <input name="reconhece_numeros" type="radio" id="radio_reconhece_numeros_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->RECONHECE_IDENTIFICA_NUMEROS)){echo isChecked($dadosCognitivos->RECONHECE_IDENTIFICA_NUMEROS, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_reconhece_numeros_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Reconhece e identifica as letras estudadas -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Reconhece e identifica as letras estudadas.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="reconhece_letras" type="radio" id="radio_reconhece_letras_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->RECONHECE_IDENTIFICA_LETRAS)){echo isChecked($dadosCognitivos->RECONHECE_IDENTIFICA_LETRAS, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_reconhece_letras_sim">Sim</label>

                    <input name="reconhece_letras" type="radio" id="radio_reconhece_letras_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->RECONHECE_IDENTIFICA_LETRAS)){echo isChecked($dadosCognitivos->RECONHECE_IDENTIFICA_LETRAS, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_reconhece_letras_nao">Não</label>

                    <input name="reconhece_letras" type="radio" id="radio_reconhece_letras_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->RECONHECE_IDENTIFICA_LETRAS)){echo isChecked($dadosCognitivos->RECONHECE_IDENTIFICA_LETRAS, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_reconhece_letras_parcialmente">Parcialmente</label>

                    <input name="reconhece_letras" type="radio" id="radio_reconhece_letras_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->RECONHECE_IDENTIFICA_LETRAS)){echo isChecked($dadosCognitivos->RECONHECE_IDENTIFICA_LETRAS, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_reconhece_letras_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>


                <hr />

                <!-- Diferencia letras de números -->
               <!-- Diferencia letras de números -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Diferencia letras de números.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="diferencia_letras_numeros" type="radio" id="radio_diferencia_letras_numeros_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->DIFERENCIA_LETRAS_NUMEROS)){echo isChecked($dadosCognitivos->DIFERENCIA_LETRAS_NUMEROS, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_diferencia_letras_numeros_sim">Sim</label>

                    <input name="diferencia_letras_numeros" type="radio" id="radio_diferencia_letras_numeros_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->DIFERENCIA_LETRAS_NUMEROS)){echo isChecked($dadosCognitivos->DIFERENCIA_LETRAS_NUMEROS, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_diferencia_letras_numeros_nao">Não</label>

                    <input name="diferencia_letras_numeros" type="radio" id="radio_diferencia_letras_numeros_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->DIFERENCIA_LETRAS_NUMEROS)){echo isChecked($dadosCognitivos->DIFERENCIA_LETRAS_NUMEROS, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_diferencia_letras_numeros_parcialmente">Parcialmente</label>

                    <input name="diferencia_letras_numeros" type="radio" id="radio_diferencia_letras_numeros_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->DIFERENCIA_LETRAS_NUMEROS)){echo isChecked($dadosCognitivos->DIFERENCIA_LETRAS_NUMEROS, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_diferencia_letras_numeros_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Identifica as letras do nome -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Identifica as letras do nome.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="identifica_letras_nome" type="radio" id="radio_identifica_letras_nome_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->IDENTIFICA_LETRAS_NOME)){echo isChecked($dadosCognitivos->IDENTIFICA_LETRAS_NOME, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_identifica_letras_nome_sim">Sim</label>

                    <input name="identifica_letras_nome" type="radio" id="radio_identifica_letras_nome_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->IDENTIFICA_LETRAS_NOME)){echo isChecked($dadosCognitivos->IDENTIFICA_LETRAS_NOME, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_identifica_letras_nome_nao">Não</label>

                    <input name="identifica_letras_nome" type="radio" id="radio_identifica_letras_nome_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->IDENTIFICA_LETRAS_NOME)){echo isChecked($dadosCognitivos->IDENTIFICA_LETRAS_NOME, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_identifica_letras_nome_parcialmente">Parcialmente</label>

                    <input name="identifica_letras_nome" type="radio" id="radio_identifica_letras_nome_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->IDENTIFICA_LETRAS_NOME)){echo isChecked($dadosCognitivos->IDENTIFICA_LETRAS_NOME, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_identifica_letras_nome_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Escreve o próprio nome sem auxílio -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Escreve o próprio nome sem auxílio.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="escreve_nome_sem_auxilio" type="radio" id="radio_escreve_nome_sem_auxilio_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->ESCREVE_NOME_SEM_AUXILIO)){echo isChecked($dadosCognitivos->ESCREVE_NOME_SEM_AUXILIO, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_escreve_nome_sem_auxilio_sim">Sim</label>

                    <input name="escreve_nome_sem_auxilio" type="radio" id="radio_escreve_nome_sem_auxilio_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->ESCREVE_NOME_SEM_AUXILIO)){echo isChecked($dadosCognitivos->ESCREVE_NOME_SEM_AUXILIO, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_escreve_nome_sem_auxilio_nao">Não</label>

                    <input name="escreve_nome_sem_auxilio" type="radio" id="radio_escreve_nome_sem_auxilio_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->ESCREVE_NOME_SEM_AUXILIO)){echo isChecked($dadosCognitivos->ESCREVE_NOME_SEM_AUXILIO, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_escreve_nome_sem_auxilio_parcialmente">Parcialmente</label>

                    <input name="escreve_nome_sem_auxilio" type="radio" id="radio_escreve_nome_sem_auxilio_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->ESCREVE_NOME_SEM_AUXILIO)){echo isChecked($dadosCognitivos->ESCREVE_NOME_SEM_AUXILIO, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_escreve_nome_sem_auxilio_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>


                <hr />

                <!-- Realiza pareamento -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Realiza pareamento.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="realiza_pareamento" type="radio" id="radio_realiza_pareamento_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->REALIZA_PAREAMENTO)){echo isChecked($dadosCognitivos->REALIZA_PAREAMENTO, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_realiza_pareamento_sim">Sim</label>

                    <input name="realiza_pareamento" type="radio" id="radio_realiza_pareamento_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->REALIZA_PAREAMENTO)){echo isChecked($dadosCognitivos->REALIZA_PAREAMENTO, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_realiza_pareamento_nao">Não</label>

                    <input name="realiza_pareamento" type="radio" id="radio_realiza_pareamento_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->REALIZA_PAREAMENTO)){echo isChecked($dadosCognitivos->REALIZA_PAREAMENTO, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_realiza_pareamento_parcialmente">Parcialmente</label>

                    <input name="realiza_pareamento" type="radio" id="radio_realiza_pareamento_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->REALIZA_PAREAMENTO)){echo isChecked($dadosCognitivos->REALIZA_PAREAMENTO, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_realiza_pareamento_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Mantém atenção concentrada -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Mantém atenção concentrada.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="mantem_atencao" type="radio" id="radio_mantem_atencao_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->MANTEM_ATENCAO_CONCENTRADA)){echo isChecked($dadosCognitivos->MANTEM_ATENCAO_CONCENTRADA, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_mantem_atencao_sim">Sim</label>

                    <input name="mantem_atencao" type="radio" id="radio_mantem_atencao_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->MANTEM_ATENCAO_CONCENTRADA)){echo isChecked($dadosCognitivos->MANTEM_ATENCAO_CONCENTRADA, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_mantem_atencao_nao">Não</label>

                    <input name="mantem_atencao" type="radio" id="radio_mantem_atencao_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->MANTEM_ATENCAO_CONCENTRADA)){echo isChecked($dadosCognitivos->MANTEM_ATENCAO_CONCENTRADA, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_mantem_atencao_parcialmente">Parcialmente</label>

                    <input name="mantem_atencao" type="radio" id="radio_mantem_atencao_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->MANTEM_ATENCAO_CONCENTRADA)){echo isChecked($dadosCognitivos->MANTEM_ATENCAO_CONCENTRADA, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_mantem_atencao_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Reconhece as sílabas estudadas -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Reconhece as sílabas estudadas.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="reconhece_silabas" type="radio" id="radio_reconhece_silabas_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->RECONHECE_SILABAS_ESTUDADAS)){echo isChecked($dadosCognitivos->RECONHECE_SILABAS_ESTUDADAS, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_reconhece_silabas_sim">Sim</label>

                    <input name="reconhece_silabas" type="radio" id="radio_reconhece_silabas_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->RECONHECE_SILABAS_ESTUDADAS)){echo isChecked($dadosCognitivos->RECONHECE_SILABAS_ESTUDADAS, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_reconhece_silabas_nao">Não</label>

                    <input name="reconhece_silabas" type="radio" id="radio_reconhece_silabas_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->RECONHECE_SILABAS_ESTUDADAS)){echo isChecked($dadosCognitivos->RECONHECE_SILABAS_ESTUDADAS, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_reconhece_silabas_parcialmente">Parcialmente</label>

                    <input name="reconhece_silabas" type="radio" id="radio_reconhece_silabas_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->RECONHECE_SILABAS_ESTUDADAS)){echo isChecked($dadosCognitivos->RECONHECE_SILABAS_ESTUDADAS, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_reconhece_silabas_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>


                <hr />

                <!-- Identifica as partes do corpo -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Identifica as partes do corpo.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="identifica_partes_corpo" type="radio" id="radio_identifica_partes_corpo_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->IDENTIFICA_PARTES_CORPO)){echo isChecked($dadosCognitivos->IDENTIFICA_PARTES_CORPO, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_identifica_partes_corpo_sim">Sim</label>

                    <input name="identifica_partes_corpo" type="radio" id="radio_identifica_partes_corpo_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->IDENTIFICA_PARTES_CORPO)){echo isChecked($dadosCognitivos->IDENTIFICA_PARTES_CORPO, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_identifica_partes_corpo_nao">Não</label>

                    <input name="identifica_partes_corpo" type="radio" id="radio_identifica_partes_corpo_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->IDENTIFICA_PARTES_CORPO)){echo isChecked($dadosCognitivos->IDENTIFICA_PARTES_CORPO, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_identifica_partes_corpo_parcialmente">Parcialmente</label>

                    <input name="identifica_partes_corpo" type="radio" id="radio_identifica_partes_corpo_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->IDENTIFICA_PARTES_CORPO)){echo isChecked($dadosCognitivos->IDENTIFICA_PARTES_CORPO, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_identifica_partes_corpo_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Nomeia pessoas ao seu redor e familiares -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Nomeia pessoas ao seu redor e familiares.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="nomeia_pessoas_familiares" type="radio" id="radio_nomeia_pessoas_familiares_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->NOMEIA_PESSOAS_FAMILIARES)){echo isChecked($dadosCognitivos->NOMEIA_PESSOAS_FAMILIARES, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_nomeia_pessoas_familiares_sim">Sim</label>

                    <input name="nomeia_pessoas_familiares" type="radio" id="radio_nomeia_pessoas_familiares_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->NOMEIA_PESSOAS_FAMILIARES)){echo isChecked($dadosCognitivos->NOMEIA_PESSOAS_FAMILIARES, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_nomeia_pessoas_familiares_nao">Não</label>

                    <input name="nomeia_pessoas_familiares" type="radio" id="radio_nomeia_pessoas_familiares_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->NOMEIA_PESSOAS_FAMILIARES)){echo isChecked($dadosCognitivos->NOMEIA_PESSOAS_FAMILIARES, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_nomeia_pessoas_familiares_parcialmente">Parcialmente</label>

                    <input name="nomeia_pessoas_familiares" type="radio" id="radio_nomeia_pessoas_familiares_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->NOMEIA_PESSOAS_FAMILIARES)){echo isChecked($dadosCognitivos->NOMEIA_PESSOAS_FAMILIARES, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_nomeia_pessoas_familiares_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Apresenta sequência lógica dos fatos -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Apresenta sequência lógica dos fatos.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="apresenta_sequencia_fatos" type="radio" id="radio_apresenta_sequencia_fatos_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->SEQUENCIA_LOGICA_FATOS)){echo isChecked($dadosCognitivos->SEQUENCIA_LOGICA_FATOS, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_apresenta_sequencia_fatos_sim">Sim</label>

                    <input name="apresenta_sequencia_fatos" type="radio" id="radio_apresenta_sequencia_fatos_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->SEQUENCIA_LOGICA_FATOS)){echo isChecked($dadosCognitivos->SEQUENCIA_LOGICA_FATOS, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_apresenta_sequencia_fatos_nao">Não</label>

                    <input name="apresenta_sequencia_fatos" type="radio" id="radio_apresenta_sequencia_fatos_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->SEQUENCIA_LOGICA_FATOS)){echo isChecked($dadosCognitivos->SEQUENCIA_LOGICA_FATOS, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_apresenta_sequencia_fatos_parcialmente">Parcialmente</label>

                    <input name="apresenta_sequencia_fatos" type="radio" id="radio_apresenta_sequencia_fatos_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->SEQUENCIA_LOGICA_FATOS)){echo isChecked($dadosCognitivos->SEQUENCIA_LOGICA_FATOS, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_apresenta_sequencia_fatos_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Relaciona números às suas respectivas quantidades -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Relaciona números às suas respectivas quantidades.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="relaciona_numeros_quantidades" type="radio" id="radio_relaciona_numeros_quantidades_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->RELACIONA_NUMEROS_QUANTIDADES)){echo isChecked($dadosCognitivos->RELACIONA_NUMEROS_QUANTIDADES, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_relaciona_numeros_quantidades_sim">Sim</label>

                    <input name="relaciona_numeros_quantidades" type="radio" id="radio_relaciona_numeros_quantidades_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->RELACIONA_NUMEROS_QUANTIDADES)){echo isChecked($dadosCognitivos->RELACIONA_NUMEROS_QUANTIDADES, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_relaciona_numeros_quantidades_nao">Não</label>

                    <input name="relaciona_numeros_quantidades" type="radio" id="radio_relaciona_numeros_quantidades_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->RELACIONA_NUMEROS_QUANTIDADES)){echo isChecked($dadosCognitivos->RELACIONA_NUMEROS_QUANTIDADES, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_relaciona_numeros_quantidades_parcialmente">Parcialmente</label>

                    <input name="relaciona_numeros_quantidades" type="radio" id="radio_relaciona_numeros_quantidades_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->RELACIONA_NUMEROS_QUANTIDADES)){echo isChecked($dadosCognitivos->RELACIONA_NUMEROS_QUANTIDADES, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_relaciona_numeros_quantidades_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Comunica-se com clareza -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Comunica-se com clareza.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="comunica_clareza" type="radio" id="radio_comunica_clareza_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->COMUNICA_CLAREZA)){echo isChecked($dadosCognitivos->COMUNICA_CLAREZA, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_comunica_clareza_sim">Sim</label>

                    <input name="comunica_clareza" type="radio" id="radio_comunica_clareza_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->COMUNICA_CLAREZA)){echo isChecked($dadosCognitivos->COMUNICA_CLAREZA, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_comunica_clareza_nao">Não</label>

                    <input name="comunica_clareza" type="radio" id="radio_comunica_clareza_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->COMUNICA_CLAREZA)){echo isChecked($dadosCognitivos->COMUNICA_CLAREZA, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_comunica_clareza_parcialmente">Parcialmente</label>

                    <input name="comunica_clareza" type="radio" id="radio_comunica_clareza_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->COMUNICA_CLAREZA)){echo isChecked($dadosCognitivos->COMUNICA_CLAREZA, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_comunica_clareza_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Observa semelhanças e diferenças entre os objetos -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Observa semelhanças e diferenças entre os objetos.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="observa_seme_dife" type="radio" id="radio_observa_seme_dife_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->OBSERVA_SEMELHANCA_DIFERENCA_OBJETOS)){echo isChecked($dadosCognitivos->OBSERVA_SEMELHANCA_DIFERENCA_OBJETOS, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_observa_seme_dife_sim">Sim</label>

                    <input name="observa_seme_dife" type="radio" id="radio_observa_seme_dife_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->OBSERVA_SEMELHANCA_DIFERENCA_OBJETOS)){echo isChecked($dadosCognitivos->OBSERVA_SEMELHANCA_DIFERENCA_OBJETOS, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_observa_seme_dife_nao">Não</label>

                    <input name="observa_seme_dife" type="radio" id="radio_observa_seme_dife_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->OBSERVA_SEMELHANCA_DIFERENCA_OBJETOS)){echo isChecked($dadosCognitivos->OBSERVA_SEMELHANCA_DIFERENCA_OBJETOS, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_observa_seme_dife_parcialmente">Parcialmente</label>

                    <input name="observa_seme_dife" type="radio" id="radio_observa_seme_dife_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->OBSERVA_SEMELHANCA_DIFERENCA_OBJETOS)){echo isChecked($dadosCognitivos->OBSERVA_SEMELHANCA_DIFERENCA_OBJETOS, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_observa_seme_dife_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Compreende e responde sua idade quando questionado(a) -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Compreende e responde sua idade quando questionado(a).</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="compreende_idade" type="radio" id="radio_compreende_idade_sim" value="sim" 
                          <?php if(isset($dadosCognitivos->COMPREENDER_RESPONDE_IDADE)){echo isChecked($dadosCognitivos->COMPREENDER_RESPONDE_IDADE, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_compreende_idade_sim">Sim</label>

                    <input name="compreende_idade" type="radio" id="radio_compreende_idade_nao" value="nao" 
                          <?php if(isset($dadosCognitivos->COMPREENDER_RESPONDE_IDADE)){echo isChecked($dadosCognitivos->COMPREENDER_RESPONDE_IDADE, 'nao'); }?> />
                    <label style="color: #000" for="radio_compreende_idade_nao">Não</label>

                    <input name="compreende_idade" type="radio" id="radio_compreende_idade_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosCognitivos->COMPREENDER_RESPONDE_IDADE)){echo isChecked($dadosCognitivos->COMPREENDER_RESPONDE_IDADE, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_compreende_idade_parcialmente">Parcialmente</label>

                    <input name="compreende_idade" type="radio" id="radio_compreende_idade_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosCognitivos->COMPREENDER_RESPONDE_IDADE)){echo isChecked($dadosCognitivos->COMPREENDER_RESPONDE_IDADE, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_compreende_idade_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>


              </div>

              <br><br>
              <div class="row">
                <div class="col-md-12">
                <h5 style="color: #000; font-weight: bold; text-align: center; cursor: pointer;" data-toggle="collapse" data-target="#familiar">
                    ASPECTOS DA RELAÇÃO FAMÍLIA X ESCOLA <br><button style="margin-right: 10px" type="button" class="btn btn-sm btn-danger">Abrir</button>              
                  </h5>
                </div>
              </div>

              <div id="familiar" name="familiar" class="collapse">
                <!-- Participa das reuniões quando solicitado -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Participa das reuniões quando solicitado.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="participa_reunioes" type="radio" id="radio_participa_reunioes_sim" value="sim" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->PARTICIPA_REUNIOES_SOLICITADO)){echo isChecked($dadosRelacaoFamiliaEscola->PARTICIPA_REUNIOES_SOLICITADO, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_participa_reunioes_sim">Sim</label>

                    <input name="participa_reunioes" type="radio" id="radio_participa_reunioes_nao" value="nao" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->PARTICIPA_REUNIOES_SOLICITADO)){echo isChecked($dadosRelacaoFamiliaEscola->PARTICIPA_REUNIOES_SOLICITADO, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_participa_reunioes_nao">Não</label>

                    <input name="participa_reunioes" type="radio" id="radio_participa_reunioes_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->PARTICIPA_REUNIOES_SOLICITADO)){echo isChecked($dadosRelacaoFamiliaEscola->PARTICIPA_REUNIOES_SOLICITADO, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_participa_reunioes_parcialmente">Parcialmente</label>

                    <input name="participa_reunioes" type="radio" id="radio_participa_reunioes_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->PARTICIPA_REUNIOES_SOLICITADO)){echo isChecked($dadosRelacaoFamiliaEscola->PARTICIPA_REUNIOES_SOLICITADO, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_participa_reunioes_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Deixa o aluno(a) na escola com o uniforme limpo -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Deixa o aluno(a) na escola com o uniforme limpo.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="uniforme_limpo" type="radio" id="radio_uniforme_limpo_sim" value="sim" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->UNIFORME_LIMPO)){echo isChecked($dadosRelacaoFamiliaEscola->UNIFORME_LIMPO, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_uniforme_limpo_sim">Sim</label>

                    <input name="uniforme_limpo" type="radio" id="radio_uniforme_limpo_nao" value="nao" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->UNIFORME_LIMPO)){echo isChecked($dadosRelacaoFamiliaEscola->UNIFORME_LIMPO, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_uniforme_limpo_nao">Não</label>

                    <input name="uniforme_limpo" type="radio" id="radio_uniforme_limpo_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->UNIFORME_LIMPO)){echo isChecked($dadosRelacaoFamiliaEscola->UNIFORME_LIMPO, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_uniforme_limpo_parcialmente">Parcialmente</label>

                    <input name="uniforme_limpo" type="radio" id="radio_uniforme_limpo_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->UNIFORME_LIMPO)){echo isChecked($dadosRelacaoFamiliaEscola->UNIFORME_LIMPO, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_uniforme_limpo_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Realiza banho diário -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Realiza banho diário.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="banho_diario" type="radio" id="radio_banho_diario_sim" value="sim" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->REALIZA_BANHO_DIARIO)){echo isChecked($dadosRelacaoFamiliaEscola->REALIZA_BANHO_DIARIO, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_banho_diario_sim">Sim</label>

                    <input name="banho_diario" type="radio" id="radio_banho_diario_nao" value="nao" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->REALIZA_BANHO_DIARIO)){echo isChecked($dadosRelacaoFamiliaEscola->REALIZA_BANHO_DIARIO, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_banho_diario_nao">Não</label>

                    <input name="banho_diario" type="radio" id="radio_banho_diario_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->REALIZA_BANHO_DIARIO)){echo isChecked($dadosRelacaoFamiliaEscola->REALIZA_BANHO_DIARIO, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_banho_diario_parcialmente">Parcialmente</label>

                    <input name="banho_diario" type="radio" id="radio_banho_diario_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->REALIZA_BANHO_DIARIO)){echo isChecked($dadosRelacaoFamiliaEscola->REALIZA_BANHO_DIARIO, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_banho_diario_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>


                <hr />

                <!-- Higieniza os pertences pessoais do aluno(a) (mochila, toalhas etc.) -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Higieniza os pertences pessoais do aluno(a) (mochila, toalhas etc.).</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="higieniza_pertences" type="radio" id="radio_higieniza_pertences_sim" value="sim" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->HIGIENIZA_PERTENCES_ALUNO)){echo isChecked($dadosRelacaoFamiliaEscola->HIGIENIZA_PERTENCES_ALUNO, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_higieniza_pertences_sim">Sim</label>

                    <input name="higieniza_pertences" type="radio" id="radio_higieniza_pertences_nao" value="nao" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->HIGIENIZA_PERTENCES_ALUNO)){echo isChecked($dadosRelacaoFamiliaEscola->HIGIENIZA_PERTENCES_ALUNO, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_higieniza_pertences_nao">Não</label>

                    <input name="higieniza_pertences" type="radio" id="radio_higieniza_pertences_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->HIGIENIZA_PERTENCES_ALUNO)){echo isChecked($dadosRelacaoFamiliaEscola->HIGIENIZA_PERTENCES_ALUNO, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_higieniza_pertences_parcialmente">Parcialmente</label>

                    <input name="higieniza_pertences" type="radio" id="radio_higieniza_pertences_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->HIGIENIZA_PERTENCES_ALUNO)){echo isChecked($dadosRelacaoFamiliaEscola->HIGIENIZA_PERTENCES_ALUNO, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_higieniza_pertences_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Cuidado com os materiais escolares do aluno(a) -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Cuidado com os materiais escolares do aluno(a).</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="cuida_materiais" type="radio" id="radio_cuida_materiais_sim" value="sim" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->CUIDADO_MATERIAIS_ESCOLARES)){echo isChecked($dadosRelacaoFamiliaEscola->CUIDADO_MATERIAIS_ESCOLARES, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_cuida_materiais_sim">Sim</label>

                    <input name="cuida_materiais" type="radio" id="radio_cuida_materiais_nao" value="nao" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->CUIDADO_MATERIAIS_ESCOLARES)){echo isChecked($dadosRelacaoFamiliaEscola->CUIDADO_MATERIAIS_ESCOLARES, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_cuida_materiais_nao">Não</label>

                    <input name="cuida_materiais" type="radio" id="radio_cuida_materiais_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->CUIDADO_MATERIAIS_ESCOLARES)){echo isChecked($dadosRelacaoFamiliaEscola->CUIDADO_MATERIAIS_ESCOLARES, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_cuida_materiais_parcialmente">Parcialmente</label>

                    <input name="cuida_materiais" type="radio" id="radio_cuida_materiais_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->CUIDADO_MATERIAIS_ESCOLARES)){echo isChecked($dadosRelacaoFamiliaEscola->CUIDADO_MATERIAIS_ESCOLARES, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_cuida_materiais_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- É um aluno assíduo -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">É um aluno assíduo.</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="aluno_assiduo" type="radio" id="radio_aluno_assiduo_sim" value="sim" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->ALUNO_ASSIDUO)){echo isChecked($dadosRelacaoFamiliaEscola->ALUNO_ASSIDUO, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_aluno_assiduo_sim">Sim</label>

                    <input name="aluno_assiduo" type="radio" id="radio_aluno_assiduo_nao" value="nao" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->ALUNO_ASSIDUO)){echo isChecked($dadosRelacaoFamiliaEscola->ALUNO_ASSIDUO, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_aluno_assiduo_nao">Não</label>

                    <input name="aluno_assiduo" type="radio" id="radio_aluno_assiduo_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->ALUNO_ASSIDUO)){echo isChecked($dadosRelacaoFamiliaEscola->ALUNO_ASSIDUO, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_aluno_assiduo_parcialmente">Parcialmente</label>

                    <input name="aluno_assiduo" type="radio" id="radio_aluno_assiduo_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->ALUNO_ASSIDUO)){echo isChecked($dadosRelacaoFamiliaEscola->ALUNO_ASSIDUO, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_aluno_assiduo_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>

                <hr />

                <!-- Pontualidade nos horários de entrada e saída do aluno(a) -->
                <div class="row">
                  <div class="col-md-12">
                    <h5 style="color: #000;">Pontualidade nos horários de entrada e saída do aluno(a).</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input name="pontualidade_horarios" type="radio" id="radio_pontualidade_horarios_sim" value="sim" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->PONTUALIDADE_HORARIOS_ENTRADA_SAIDA)){echo isChecked($dadosRelacaoFamiliaEscola->PONTUALIDADE_HORARIOS_ENTRADA_SAIDA, 'sim'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_pontualidade_horarios_sim">Sim</label>

                    <input name="pontualidade_horarios" type="radio" id="radio_pontualidade_horarios_nao" value="nao" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->PONTUALIDADE_HORARIOS_ENTRADA_SAIDA)){echo isChecked($dadosRelacaoFamiliaEscola->PONTUALIDADE_HORARIOS_ENTRADA_SAIDA, 'nao'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_pontualidade_horarios_nao">Não</label>

                    <input name="pontualidade_horarios" type="radio" id="radio_pontualidade_horarios_parcialmente" value="parcialmente" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->PONTUALIDADE_HORARIOS_ENTRADA_SAIDA)){echo isChecked($dadosRelacaoFamiliaEscola->PONTUALIDADE_HORARIOS_ENTRADA_SAIDA, 'parcialmente'); }?> />
                    <label style="color: #000; margin-right: 5px" for="radio_pontualidade_horarios_parcialmente">Parcialmente</label>

                    <input name="pontualidade_horarios" type="radio" id="radio_pontualidade_horarios_nao_se_aplica" value="naoaplica" 
                          <?php if(isset($dadosRelacaoFamiliaEscola->PONTUALIDADE_HORARIOS_ENTRADA_SAIDA)){echo isChecked($dadosRelacaoFamiliaEscola->PONTUALIDADE_HORARIOS_ENTRADA_SAIDA, 'naoaplica'); }?> />
                    <label style="color: #000" for="radio_pontualidade_horarios_nao_se_aplica">Não se Aplica</label>
                  </div>
                </div>


              </div>





              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <br>


            <button type="button" id="gravar_ficha" name="gravar_ficha" class="btn btn-danger">Salvar</button>         
          <!-- </form>  -->

        </div>
        <!-- /.box-body -->
      </div>  


      
	  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal -->
<div class="modal center-modal fade" id="modal- name="modal-center" tabindex="-1">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Modal title</h5>
    <button type="button" class="close" data-dismiss="modal">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <h5 style="color: #000;" class="box-title">Justificativa da falta</h5>

        <div class="input-group">
          <textarea name="textarea" row="10" id="textarea" name="textarea" class="form-control" ></textarea>
        </div>

        <!-- /.input group -->
      </div>
      <!-- /.form group -->
    </div>
    <div class="modal-footer modal-footer-uniform">
    <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Fechar</button>
    <button type="button" class="btn btn-bold btn-pure btn-primary float-right">Salvar</button>
    </div>
  </div>
  </div>
</div>
<!-- /.modal -->

<div class="modal modal-danger fade" id="modal- name="modal-danger">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title">Erro ao salvar</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
    <p>One fine body&hellip;</p>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-outline btn-light" style="color: #FFF" data-dismiss="modal">ok</button>
    </div>
  </div>
  <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<div class="modal modal-success fade" id="modal- name="modal-success">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title">Ação realizada</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
    <p>One fine body&hellip;</p>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-outline btn-light" style="color: #FFF" data-dismiss="modal">ok</button>
    </div>
  </div>
  <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script src="/template/js/escola.js"></script>