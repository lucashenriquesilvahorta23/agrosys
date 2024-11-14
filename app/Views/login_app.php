<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content= "width=device-width, user-scalable=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/template/img/favicon.png">

    <title>Sisgeo | Login</title>
  
	<!-- Bootstrap 4.1-->
	<link rel="stylesheet" href="/assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">
	
	<!-- Bootstrap extend-->
	<link rel="stylesheet" href="/template/css/bootstrap-extend.css">	
	
	<!-- Theme style -->
	<link rel="stylesheet" href="/template/css/master_style.css">

	<!-- SoftMaterial admin skins -->
	<link rel="stylesheet" href="/template/css/skins/_all-skins.css">	

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<style>
html {
    touch-action: manipulation;
}

        /* Estilos para o placeholder */
        input::placeholder {
            color: #000000; /* Define a cor do placeholder */
            font-size: 18px; /* Define o tamanho da fonte do placeholder */
            font-weight: bold; /* Define o peso da fonte do placeholder */
        }


        /* Estilos para os inputs */
        .form-control {
            font-size: 16px; /* Define o tamanho da fonte do texto do input */
            font-weight: bold; /* Define o peso da fonte do texto do input */
            padding: 10px; /* Adiciona um padding ao redor do texto do input */
            border: 1px solid #ccc; /* Define a borda do input */
            border-radius: 4px; /* Define o raio da borda do input */
            width: 100%; /* Define a largura do input */
            height: 50px; /* Define a altura do input */
        }
		

</style>
<body class="hold-transition bg-img" style="background-image: url(/template/img/fundo2.jpg)" data-overlay="1">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">
			
			<div class="col-lg-5 col-md-8 col-12">
				<div class="content">
					<img src="/template/images/logo_login.png" class="img-fluid">
				</div>
				<div class="p-40 mt-10 bg-login content-bottom">
					<form action="/AplicativoLogin/validaLogin" method="post">
						<?php 
							if(isset($errologin))
							{	
						?>
							<div class="alert alert-danger">
								<button class="close" data-close="alert"></button>
								<span><?php echo $errologin; ?> </span>
							</div>
						<?php 
							}
						?>
						<?= csrf_field() ?>
						<div class="form-group">
							<div class="input-group mb-3">
								<input type="text" id="username" name="username" class="form-control" placeholder="Login">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input type="password" name="password" class="form-control" placeholder="Senha">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<select required name="fazenda" style="height: 50px" id="fazenda" class="form-control select2">
									<option value="">Selecione uma escola</option>
								</select>
							</div>
						</div>
						  <div class="row">
							<!-- /.col -->
							
							<!-- /.col -->
							<div class="col-12 text-center">
							  <button type="submit" style="height: 50px; background-color: #852C00; border-color: #852C00; font-size: 20px; color: #FFF; font-weight: bold" class="btn btn-danger btn-block margin-top-10">ENTRAR</button>
							</div>
							<!-- /.col -->
						  </div>
					</form>			
				</div>
                <div class="content" style="text-align: center">
                    <p class="color_primary" align="justify">SISGEO é um sistema de Gestão Escolar que ajuda as escolas a gerenciarem as suas informações de forma fácil, rápida e com poucos cliques.</p>
                    <img src="/template/img/logo2.png" style="max-width:50%" class="mt-5">
				</div>
			</div>
			
			
		</div>
	</div>


	<!-- jQuery 3 -->
	<script src="/assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>
	
	<!-- popper -->
	<script src="/assets/vendor_components/popper/dist/popper.min.js"></script>
	
	<!-- Bootstrap 4.1-->
	<script src="/assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<script src="/template/js/login.js"></script>

</body>
</html>
