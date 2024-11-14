<!-- Header Navbar -->
<?php 
  $this->session = \Config\Services::session();
  $this->usuario = $this->session->get('dadoslogin');
  $this->escola = $this->session->get('escola');
?>
<nav class="navbar navbar-static-top" style="height: 130px; display: flex; justify-content: center;">
	  	
          <!-- Sidebar toggle button-->
          <img src="/template/images/logo_branca.png" alt="logo" class="light-logo" style="max-width: 50%; ">
          


        </nav>
      </header>