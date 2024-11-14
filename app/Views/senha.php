<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<body class="hold-transition bg-img" style="background-image: url(/template/img/fundo2.jpg)" data-overlay="1">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">
			
			<div class="col-lg-5 col-md-8 col-12">
				<div class="content">
					<img src="/template/img/logo.png" class="img-fluid">
				</div>
				<div class="p-40 mt-10 bg-login content-bottom">
					<form action="/Login/Recovery" method="post">
						<?= csrf_field() ?>
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text bg-danger border-danger"><i class="ti-user"></i></span>
								</div>
								<input type="text" id="username" name="username" class="form-control" placeholder="CPF">
							</div>
						</div>
						<div class="row">
						<!-- /.col -->
						<!-- /.col -->
						<div class="col-12 text-center">
							<button type="submit" class="btn btn-danger btn-block margin-top-10">Recuperar senha</button>
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
