<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/template/img/favicon.png">

    <title>AgroSys | Login</title>
  
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
<body class="hold-transition bg-img" style="background-image: url(/template/img/fundo2.jpg)" data-overlay="1">
	
	<div class="container h-p100">
		<div class="row		 justify-content-md-center h-p100">
			
			<div class="col-lg-5 col-md-8 col-12">
				<div class="content">
					<img src="/template/images/logo-agro.png" class="img-fluid">
				</div>
				<div class="p-40 mt-10 bg-login content-bottom">
					<form action="/Login/validaLogin" method="post">
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
								<div class="input-group-prepend">
									<span class="input-group-text bg-danger border-danger"><i class="ti-user"></i></span>
								</div>
								<input type="text" id="username" name="username" class="form-control" placeholder="CPF">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text bg-danger border-danger"><i class="ti-lock"></i></span>
								</div>
								<input type="password" name="password" class="form-control" placeholder="Senha">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text bg-danger border-danger"><i class="ti-world"></i></span>
								</div>
								<select required name="profissional_fazenda" id="profissional_fazenda" class="form-control select2">
									<option value="">Selecione uma fazenda</option>
								</select>
							</div>
						</div>
						  <div class="row">
							<!-- /.col -->
							<div class="col-6">
							 <div class="fog-pwd text-right">
								<a href="/Login/Senha"><i class="ion ion-locked"></i> Esqueceu sua senha?</a><br>
							  </div>
							</div>
							<!-- /.col -->
							<div class="col-12 text-center">
							  <button type="submit" class="btn btn-danger btn-block margin-top-10">ENTRAR</button>
							</div>
							<!-- /.col -->
						  </div>
					</form>			
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
