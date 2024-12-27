<div class="content-wrapper" style="margin-left: 300px">
    <section class="content-header">
        <h1>
            <i class="fa fa-globe"></i> Compras
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Animais</a></li>
            <li class="breadcrumb-item active">Compras</li>
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
                        <h3 class="box-title">Compras</h3>
                    </div>
                    <div class="box-body">
                    <div class="row">
                            <div class="col-md-12">
                                <h2 style="text-align: center; color: #000; font-weight: 400;" >Quantidade de compras </h2>
                                <div id="chartdiv"></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="tabela_padrao_datatable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead>
                                    <tr>
                                        <th style="text-align: center" >Ações</th>
                                        <th>Descrição</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if ($resultados != "") {
                                            foreach ($resultados as $resultado) {
                                                echo '<tr>';
                                                echo '	<td align="center">';				
                                                echo '		<a href="/Compras/Detalhes/'.base64_encode($resultado->id_procedimento_compra    ).'" >';
                                                echo '<button class="btn btn-success btn-sm" title="Detalhes"><i class="fa fa-file "></i></button>';
                                                echo '		</a>';
                                                echo '  <td>' . $resultado->descricao . '</td>';
                                                echo '  <td>' . inverterData($resultado->data) . '</td>';
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

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);

  $.ajax({
    type: "POST",
    url: '/Compras/getQuantidadeAnimaisPorProcedimento',
    data: {
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
              country: item.procedimento + " - R$ " + valorTotal,
              visits: parseInt(item.quantidade)
          });
      }


      // Populando o gráfico
      chart.data = chartData;
      
    },
    error: function (error) {
      console.error('Erro ao buscar dados para a coluna:', coluna.key, error);
    }
  });

// Create axes

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;

categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
  if (target.dataItem && target.dataItem.index & 2 == 2) {
    return dy + 25;
  }
  return dy;
});

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

// Create series
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.name = "Visits";
series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
series.columns.template.fillOpacity = .8;

var columnTemplate = series.columns.template;
columnTemplate.strokeWidth = 2;
columnTemplate.strokeOpacity = 1;

}); // end am4core.ready()
</script>
