<div class="content-wrapper" style="margin-left: 300px">
    <section class="content-header">
        <h1>
            <i class="fa fa-globe"></i> Detalhes
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Animais</a></li>
            <li class="breadcrumb-item active">Detalhes</li>
        </ol>
    </section>
    <style>
        #chartdiv1 {
            width: 100%;
            height: 500px;
        }

        #chartdiv2 {
        width: 100%;
        height: 500px;
        }

        #chartdiv3 {
        width: 100%;
        height: 500px;
        }

        </style>

    <section class="content">
        <?php helper('mensagem'); ?>
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Detalhes</h3>
                    </div>
                    <div class="box-body">
                    <input type="hidden" name="idProcedimento" id="idProcedimento" value="<?= $idProcedimento?>">

                    <div class="row">
                            <div class="col-md-6">
                                <h2 style="text-align: center; color: #000; font-weight: 400;" >Vacinas aplicadas </h2>
                                <div id="chartdiv1"></div>
                            </div>
                            <div class="col-md-6">
                                <h2 style="text-align: center; color: #000; font-weight: 400;" >Medicamentos aplicadas </h2>
                                <div id="chartdiv2"></div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="tabela_padrao_datatable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead>
                                    <tr>
                                        <th>Lote</th>
                                        <th>Identificador</th>
                                        <th>Peso</th>
                                        <th>Vacinas aplicadas</th>
                                        <th>Medicamentos aplicadas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if ($resultados != "") {
                                            foreach ($resultados as $resultado) {
                                                echo '<tr>';
                                                echo '  <td>' . $resultado->NOME_LOTE    . '</td>';
                                                echo '  <td>' . $resultado->identificacao_animal . '</td>';
                                                echo '  <td>' . $resultado->peso . 'Kg</td>';
                                                echo '  <td>' . mostrarDados($resultado->id_procedimento_curral_animal, "vacinas") . '</td>';
                                                echo '  <td>' . mostrarDados($resultado->id_procedimento_curral_animal, "medicamentos") . '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="/template/js/escola.js"></script>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart
var chart = am4core.create("chartdiv1", am4charts.PieChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
var idProcedimento = $("#idProcedimento").val();

$.ajax({
    type: "POST",
    url: '/ProcLotes/getVacinasAgrupadas',
    data: {
        idProcedimento: idProcedimento

    },
    dataType: 'json',
    success: function (data) {
      const chartData = [];
      var valor = 0;
      var valorTotal = 0;
      for (let item of data) {
          valor = parseFloat(item.total); // Garante que o valor seja numérico

          if (isNaN(valor)) { // Verifica se a conversão para número foi bem-sucedida
              valor = 0;
          }

          valorTotal = valor
              .toFixed(2)
              .replace(".", ",")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ".");

          chartData.push({
              country: item.nome,
              value: parseInt(item.total_vacinas)
          });
      }


      // Populando o gráfico
      chart.data = chartData;
      
    },
    error: function (error) {
      console.error('Erro ao buscar dados para a coluna:', coluna.key, error);
    }
  });

var series = chart.series.push(new am4charts.PieSeries());
series.dataFields.value = "value";
series.dataFields.radiusValue = "value";
series.dataFields.category = "country";
series.slices.template.cornerRadius = 6;
series.colors.step = 3;

series.hiddenState.properties.endAngle = -90;

chart.legend = new am4charts.Legend();

}); // end am4core.ready()
</script>


<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart
var chart = am4core.create("chartdiv2", am4charts.PieChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
var idProcedimento = $("#idProcedimento").val();

$.ajax({
    type: "POST",
    url: '/ProcLotes/getMedicamentoAgrupadas',
    data: {
        idProcedimento: idProcedimento

    },
    dataType: 'json',
    success: function (data) {
      console.log(data)
      const chartData = [];
      var valor = 0;
      var valorTotal = 0;
      for (let item of data) {
          valor = parseFloat(item.total); // Garante que o valor seja numérico

          if (isNaN(valor)) { // Verifica se a conversão para número foi bem-sucedida
              valor = 0;
          }

          valorTotal = valor
              .toFixed(2)
              .replace(".", ",")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ".");

          chartData.push({
              country: item.nome,
              value: parseInt(item.total_medicacoes)
          });
      }


      // Populando o gráfico
      chart.data = chartData;
      
    },
    error: function (error) {
      console.error('Erro ao buscar dados para a coluna:', coluna.key, error);
    }
  });

var series = chart.series.push(new am4charts.PieSeries());
series.dataFields.value = "value";
series.dataFields.radiusValue = "value";
series.dataFields.category = "country";
series.slices.template.cornerRadius = 6;
series.colors.step = 3;

series.hiddenState.properties.endAngle = -90;

chart.legend = new am4charts.Legend();

}); // end am4core.ready()
</script>
