<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/template/img/icone.ico">

    <title>AgroSys</title>
    
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="/assets/vendor_components/bootstrap/dist/css/bootstrap.css">
	
	<!-- Bootstrap extend-->
	<link rel="stylesheet" href="/template/css/bootstrap-extend.css">
	
	<!-- theme style -->
	<link rel="stylesheet" href="/template/css/master_style.css">
	
	<!-- SoftMaterial admin skins -->
	<link rel="stylesheet" href="/template/css/skins/_all-skins.css">
	  
	<!-- weather weather -->
	<link rel="stylesheet" href="/assets/vendor_components/weather-icons/weather-icons.css">	
   
    <!-- Vector CSS -->
    <link href="/assets/vendor_components/jvectormap/lib2/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	
	<!-- Morris charts -->
	<link rel="stylesheet" href="/assets/vendor_components/morris.js/morris.css"> 	
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

	<!-- fullCalendar -->
	<link rel="stylesheet" href="../../../assets/vendor_components/fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet" href="../../../assets/vendor_components/fullcalendar/fullcalendar.print.min.css" media="print">	

	<!-- Select2 -->
	<link rel="stylesheet" href="../../../assets/vendor_components/select2/dist/css/select2.min.css">	

     
  </head>

<body class="hold-transition skin-sigeo sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/Home" class="logo">
      <!-- mini logo -->
	  <b class="logo-mini">
		  <span class="light-logo"><img src="/template/img/logo4.png" alt="logo" style="max-width: 60%; margin-left: 55px;"></span>
		  <span class="dark-logo"><img src="/template/img/logo.png" alt="logo" style="max-width: 60%; margin-left: 55px;"></span>
	  </b>
      <!-- logo-->
      <span class="logo-lg">
		  <img src="/template/img/logo4.png" alt="logo" class="light-logo" style="max-width: 60%;">
	  	  <img src="/template/img/logo.png" alt="logo" class="dark-logo" style="max-width: 60%;">
	  </span>
    </a>
    <style>


/* Estilize o container do input e o ícone de pesquisa */
.input-icon-container {
  display: flex;
  align-items: center;
  gap: 5px; /* Espaço entre o ícone e o input */
}

.search-icon img {
  width: 16px; /* Tamanho do ícone de lupa */
  height: 16px;
}

.input-icon-container input {
  padding-left: 5px;
}

.select2-results__option {
    color: #000000; /* Define a cor do texto das opções */
}


.select2-results__option--highlighted {
    color: #000000; /* Cor do texto quando a opção é destacada */
    background-color: #007bff; /* Cor de fundo da opção destacada */
}


.select2-results__option[aria-selected="true"] {
    background-color: #d1ecf1; /* Cor de fundo da opção selecionada */
    color: #000000; /* Cor do texto da opção selecionada */
}


.select2-selection__rendered {
    color: #000000; /* Cor do texto da opção selecionada no campo */
}


.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #000000; /* Define a cor do placeholder */
}

.select2-selection__choice {
    color: #000000 !important; /* Força a cor do texto para preto após a seleção */
}



		

	</style>
  
  <!-- Left side column. contains the logo and sidebar -->