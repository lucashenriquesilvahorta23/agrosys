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
        #chartdiv {
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
                        <div class="table-responsive">
                            <table id="tabela_padrao_datatable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead>
                                    <tr>
                                        <th>Lote</th>
                                        <th>Identificador</th>
                                        <th>Tipo</th>
                                        <th>Observações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if ($resultados != "") {
                                            foreach ($resultados as $resultado) {
                                                echo '<tr>';
                                                echo '  <td>' . $resultado->NOME_LOTE    . '</td>';
                                                echo '  <td>' . $resultado->identificacao_animal . '</td>';
                                                echo '  <td>' . $resultado->nome . '</td>';
                                                echo '  <td>' . $resultado->observacoes . '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>

<!--                         <div class="row">
                            <div class="col-md-12">
                                <h2 style="text-align: center; color: #000; font-weight: 400;" >Quantidade de problemas por lote </h2>
                                <div id="chartdiv"></div>
                            </div>
                        </div> -->
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
	<!-- jQuery 3 -->
	<script src="/assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>
<!-- Chart code -->
<script>






am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Função para gerar tons similares à cor base
function generateSimilarColors(baseColor, count) {
  let colors = [];
  let base = am4core.color(baseColor);
  for (let i = 0; i < count; i++) {
    colors.push(base.lighten(i * 0.1).hex);
  }
  return colors;
}

// Define uma paleta de cores baseada na cor #415e4a
const baseColor = "#415e4a";
const palette = generateSimilarColors(baseColor, 10);

// Gráfico 1
var chart1 = am4core.create("chartdiv", am4charts.PieChart3D);
chart1.hiddenState.properties.opacity = 0;

$.ajax({
        type: "POST",
        url: '/Procedimentos/getGraficos1',
        data: {
        },
        dataType: 'json',
        success: function (data) {
            const chartData = [];

            for (let item of data) {
                chartData.push({
                    country: item.vacina,
                    litres: parseInt(item.quantidade)
                });
            }

                    // Populando o gráfico
            chart1.data = chartData;
          
          
        },
        error: function (error) {
          console.error('Erro ao buscar dados para a coluna:', coluna.key, error);
        }
      });

chart1.legend = new am4charts.Legend();


var series1 = chart1.series.push(new am4charts.PieSeries3D());
series1.dataFields.value = "litres";
series1.dataFields.category = "country";

// Aplicar cores da paleta
series1.slices.template.propertyFields.fill = "color";
chart1.data.forEach((item, index) => {
  item.color = palette[index % palette.length];
});

// Gráfico 2
var chart2 = am4core.create("chartdiv2", am4charts.PieChart3D);
chart2.hiddenState.properties.opacity = 0;

chart2.legend = new am4charts.Legend();
chart2.data = chart1.data;

var series2 = chart2.series.push(new am4charts.PieSeries3D());
series2.dataFields.value = "litres";
series2.dataFields.category = "country";

// Aplicar cores da paleta
series2.slices.template.propertyFields.fill = "color";
chart2.data.forEach((item, index) => {
  item.color = palette[index % palette.length];
});


}); // end am4core.ready()
</script>



<!-- Chart code -->
<script>


am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Função para gerar tons similares à cor base
function generateSimilarColors(baseColor, count) {
  let colors = [];
  let base = am4core.color(baseColor);
  for (let i = 0; i < count; i++) {
    colors.push(base.lighten(i * 0.1).hex);
  }
  return colors;
}

// Define uma paleta de cores baseada na cor #8b6f47
const baseColor = "#8b6f47";
const palette = generateSimilarColors(baseColor, 10);

// Gráfico
var chart2 = am4core.create("chartdiv2", am4charts.PieChart3D);
chart2.hiddenState.properties.opacity = 0;

chart2.legend = new am4charts.Legend();


$.ajax({
        type: "POST",
        url: '/Procedimentos/getGraficos2',
        data: {
        },
        dataType: 'json',
        success: function (data) {
            const chartData = [];

            for (let item of data) {
                chartData.push({
                    country: item.medicamento,
                    litres: parseInt(item.quantidade)
                });
            }

                    // Populando o gráfico
                    chart2.data = chartData;
          
          
        },
        error: function (error) {
          console.error('Erro ao buscar dados para a coluna:', coluna.key, error);
        }
      });




var series2 = chart2.series.push(new am4charts.PieSeries3D());
series2.dataFields.value = "litres";
series2.dataFields.category = "country";

// Aplicar cores da paleta
series2.slices.template.propertyFields.fill = "color";
chart2.data.forEach((item, index) => {
  item.color = palette[index % palette.length];
});

}); // end am4core.ready()
</script>


<!-- Chart code -->
<script>
// Gráfico 2
var chart3 = am4core.create("chartdiv3", am4charts.PieChart);
chart3.hiddenState.properties.opacity = 0;

chart3.data = [
  { country: "Lithuania", value: 401 },
  { country: "Czech Republic", value: 300 },
  { country: "Ireland", value: 200 },
  { country: "Germany", value: 165 },
  { country: "Australia", value: 139 },
  { country: "Austria", value: 128 }
];
chart3.radius = am4core.percent(70);
chart3.innerRadius = am4core.percent(40);
chart3.startAngle = 180;
chart3.endAngle = 360;

var series3 = chart3.series.push(new am4charts.PieSeries());
series3.dataFields.value = "value";
series3.dataFields.category = "country";

series3.slices.template.cornerRadius = 10;
series3.slices.template.innerCornerRadius = 7;
series3.slices.template.draggable = true;
series3.slices.template.inert = true;
series3.alignLabels = false;

series3.hiddenState.properties.startAngle = 90;
series3.hiddenState.properties.endAngle = 90;

chart3.legend = new am4charts.Legend();

// Aplicar cores da paleta
series3.slices.template.propertyFields.fill = "color";
chart3.data.forEach((item, index) => {
  item.color = palette[index % palette.length];
});

</script>