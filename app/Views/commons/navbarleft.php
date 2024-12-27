<!-- Left side column. contains the logo and sidebar -->
<style>
  .treeview-menu a {
    /* word-wrap: break-word;
    white-space: normal;  */
  }

</style>
<aside class="main-sidebar bg-login" style="width: 300px">
    <!-- sidebar-->
    <section class="sidebar">
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="user-profile treeview">
          <a href="#">
            <span>Usuário: <?php $this->session = \Config\Services::session();
        $this->usuario = $this->session->get('dadoslogin'); echo $this->usuario->NOME;?></span><br>
            <span><?php setlocale(LC_TIME, 'pt_BR.UTF-8'); echo strftime('%A, %d de %B de %Y');?></span><br><br>
          </a>
        </li>
        <li class="<?php if(substr($_SERVER["REQUEST_URI"], 1) == 'Home'){echo 'active';}?>">
          <a href="/Home">
            <i class="fa fa-home"></i> <span>Dashbaord</span>
          </a>
        </li>
        <?php
          $varmenu = '';
          foreach($permissaomenu->getResult() as $menu){
              // Verifica se o link atual corresponde ao menu
              if($menu->LINK == substr($_SERVER["REQUEST_URI"], 1)){
                  $active = ' class="active"';
              } else {
                  // Verifica se há submenus
                  if(count($menu->submenu->getResult()) > 0){
                      $active = ' class="treeview"';
                  } else {
                      $active = '';
                  }
              }
              
              $varmenu = $varmenu.'
              <li '.$active.'>';
                  $varmenu = $varmenu.'<a href="'.base_url().$menu->LINK.'">';
                  $varmenu = $varmenu.'<i class="'.$menu->ICONE.'"></i>
                      <span>'.$menu->DESCRICAO.'</span>';
                      // Verifica se há submenus
                      if(count($menu->submenu->getResult()) > 0){
                          $varmenu = $varmenu.'<span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i>
                          </span>';
                      }
                  $varmenu = $varmenu.' </a>
              ';
              // Adiciona submenus, se existirem
              if(count($menu->submenu->getResult()) > 0){
                  $varmenu = $varmenu.'<ul class="treeview-menu">';
                      foreach ($menu->submenu->getResult() as $submenu){
                          if($submenu->LINK == substr($_SERVER["REQUEST_URI"], 1)){
                              $active = ' active ';
                              $varmenu = str_replace('editarativo', 'class="treeview menu-open"', $varmenu);
                          } else {
                              $active = '';
                          }
                          $varmenu = $varmenu.'<li class="'.$active.'"><a href="'.base_url().$submenu->LINK.'"><i class="'.$submenu->ICONE.'"></i>&nbsp' .$submenu->DESCRICAO.'</a></li>';
                      }
                  $varmenu = $varmenu.'</ul> ';
              }
              $varmenu = $varmenu. '</li>'; 
              echo $varmenu;
              $varmenu = '';
          }
          ?>   

        <li class="">
          <a href="/Login/Sair">
            <i class="fa fa-sign-out"></i>
            <span>Sair</span>
          </a>
        </li>   
        
      </ul>
    </section>
  </aside>