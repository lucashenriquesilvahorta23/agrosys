<style>
	.fc-day-number {
    color: #9c9c9c; /* Altere a cor conforme desejado */
}

.image-container {
    position: relative;
}

.image-container img {
    display: block;
    width: 100%;
    height: auto;
}

.card {
    width: 100%; /* Mantenha o width como 100% para responsividade */
    height: 205px;
    background-color: #f49b5b;
    border-radius: 15px;
    position: relative;
    padding: 20px;
}

.bottom-strip {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50px;
    background-color: #dd5200;
    border-radius: 0 0 15px 15px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.card-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
}

.card-text {
    font-size: 25px;
    color: #333;
    text-align: left;
}

.quantity {
    font-size: 30px;
    font-weight: bold;
}

.icon-container {
    margin-left: 40px;
}

.icon {
    width: 50px;
    height: 50px;
}

.link-text a {
    color: white;
    font-size: 25px;
    text-decoration: none;
}

@media (max-width: 576px) {
    .card-content {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .icon-container {
        margin-left: 0;
        margin-top: 10px;
    }

    .icon {
        width: 40px;
        height: 40px;
    }

    .quantity {
        font-size: 25px;
    }

    .card {
        height: auto; /* Permite que o card ajuste a altura conforme o conteúdo */
    }
}

</style>
<style>
    .legenda {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
		color: #000
    }
    .legenda-coluna {
        flex: 1; /* Cada coluna ocupa a mesma largura */
        margin-right: 20px; /* Espaçamento entre as colunas */
    }
    .legenda-item {
        display: flex;
        align-items: center;
        font-size: 12px;
        margin-bottom: 8px; /* Espaçamento entre os itens */
        white-space: nowrap; /* Evita quebra de linha */
    }
    .cor {
        display: inline-block;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        margin-right: 8px;
        border: 1px solid #00000020;
    }

	/* Reduz o tamanho da fonte dos números dos dias */
	.fc-day-number {
		font-size: 15px; /* Ajuste o tamanho conforme necessário */
	}

	/* Caso deseje ajustar também os números dos eventos */
	.fc-event {
		font-size: 15px; /* Ajuste o tamanho conforme necessário */
	}

	/* Reduz o tamanho da fonte dos eventos */
	.fc-event {
		font-size: 12px; /* Ajuste o tamanho conforme necessário */
	}

	/* Reduz o tamanho da fonte dos cabeçalhos dos dias */
	.fc-day-header {
		font-size: 12px; /* Ajuste o tamanho conforme necessário */
	}

	/* Reduz o tamanho da fonte do título do calendário */
	.fc-title {
		font-size: 12px; /* Ajuste o tamanho conforme necessário */
	}

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	  <i class="fa fa-home"></i> Inicio
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Inicio</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="row ">
			<div class="col-xl-12 col-md-12 col-12 row align-items-center justify-content-md-center">
				<img src="/template/images/logo-agro.png" alt="">
			</div>
		</div>
		<br>
		
   
      <!-- /.row -->	      
	</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <!-- Modal HTML -->

