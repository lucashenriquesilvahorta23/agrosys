<!-- Header Navbar -->
<?php 
  $this->session = \Config\Services::session();
  $this->usuario = $this->session->get('dadoslogin');
  $this->escola = $this->session->get('escola');
?>
<style>

.center {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  height: 100vh;
}

.circle {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  box-shadow: 0px 0px 1px 1px #0000001a;
}

.pulse {
  animation: pulse-animation 2s infinite;
}

@keyframes pulse-animation {
  0% {
    box-shadow: 0 0 0 0px rgba(0, 0, 0, 0.2);
  }
  100% {
    box-shadow: 0 0 0 20px rgba(0, 0, 0, 0);
  }
}


.master{
  color:black;
  float:right;
}

@media (max-width:900px){
  .master{
    display:none
  }
}
</style>
<nav class="navbar navbar-static-top" style="color: #000; background-color: #FFF;" >
	  	
          <!-- Sidebar toggle button-->
              <h3 style="margin-left: 20px" >Seja Bem-vindo!</h3>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">		
              <li style="line-height: 60px; font-size: 20px; display: flex; justify-content: center; align-items: center">
                
                
              <p style="margin-top: 12px; margin-left: 30px" ><?php echo $this->escola->NOME;?></p>
              </li>
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php 
                    if(isset($this->escola->NOME_ALEATORIO)){
                      echo '<img  src="'.LINK_UPLOAD.$this->escola->NOME_ALEATORIO.'" class="user-image " alt="User Image">';
                    }else{
                      echo '<img src="/uploads/padrao.png" class="user-image " alt="User Image">';
                    }
                  ?>
                </a>
                <ul class="dropdown-menu scale-up">
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="row no-gutters">
                        <div role="separator" class="divider col-12"></div>
                        <div role="separator" class="divider col-12"></div>
                        <div class="col-12 text-left">
                            <a href="/Login/Sair"><i class="fa fa-power-off"></i> Sair</a>
                        </div>				
                    </div>
                    <!-- /.row -->
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>


<div style="color: #000!important" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel"> <strong> Notificações de falta</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <?php
          $turmas = getTurma($this->escola->ID_ESCOLA);
          if($turmas != ""){
            foreach ($turmas as $key => $turma) {
              $chamadas = getChamadas($turma->ID_TURMA);
              $img_notificacao = "";
              if($chamadas != "" && $chamadas != null){
                $img_notificacao = '<img data-toggle="modal" data-target=".bs-example-modal-lg" style="width: 20px; height: 20px; margin-left: 10px" class="pulse circle"  src="/template/images/alert.png" class="user-image " alt="User Image">';
              }

              echo '
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-3">
                        <h5 style="color: #000; font-weight: bold; cursor: pointer; display: flex;" >
                        '.$turma->NOME_TURMA.$img_notificacao.'             
                        
                        </h5>  
                      </div>
                      <div class="col-md-4">
                        <button style="margin-right: 10px" type="button" data-toggle="collapse" data-target="#turma-'.$turma->ID_TURMA.'" class="btn btn-sm btn-danger">Abrir</button> 
                      </div>
                    </div>

                    
                  </div>
                </div>
                <div id="turma-'.$turma->ID_TURMA.'" name="turma-'.$turma->ID_TURMA.'" class="collapse">';
                  $chamadas = getChamadas($turma->ID_TURMA);
                  if($chamadas != "" && $chamadas != null){
                    foreach ($chamadas as $chamada) {
                      echo '<p style="font-size: 15px" >'.inverterData($chamada->DATA).'</p> ';
                      $alunos = getAlunosChamadas($chamada->ID_CHAMADA);
                      foreach ($alunos as $aluno) {
                        echo '<p style="font-weight: bold;" >'.$aluno->NOME_ALUNO.' - '.$aluno->FILIACAO_1_TELEFONE.'</br><span style="font-weight: lighter;" >Justificativa:  '.$aluno->OBSERVACOES.' </span></p> ';
                      }
                    }
                    echo'<a href="/Home/marcarComoLido/'.$chamada->ID_NOTIFICACAO_FALTA_CHAMADA.'" style="margin-right: 10px; color: #FFF" class="btn btn-sm btn-danger">Marcar como lido</a> ';
                  }else{
                    echo '<p>Sem Notificações</p>';
                  }
                echo'</div>
                <hr>
              ';
            }
          }
 

        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success waves-effect text-left" onclick="imprimirPagina()">Imprimir</button>

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
    function imprimirPagina() {
        window.print();
    }
</script>