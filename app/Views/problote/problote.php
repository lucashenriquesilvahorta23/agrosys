<div class="content-wrapper" style="margin-left: 300px">
    <section class="content-header">
        <h1>
            <i class="fa fa-globe"></i> Problemas de lote
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Animais</a></li>
            <li class="breadcrumb-item active">Procedimento de lote</li>
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
                        <h3 class="box-title">Procedimento de lote</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 style="text-align: center; color: #000; font-weight: 400;" >Quantidade de problemas por lote </h2>
                                <div id="chartdiv"></div>
                            </div>
                        </div>
                        <br><br><br><br>
                        <div class="table-responsive">
                            <table id="tabela_padrao_datatable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead>
                                    <tr>
                                        <th style="text-align: center" >Ações</th>
                                        <th>Lote</th>
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
                                                echo '		<a href="/ProbLotes/Detalhes/'.base64_encode($resultado->id_procedimento_problema).'" >';
                                                echo '<button class="btn btn-success btn-sm" title="Detalhes"><i class="fa fa-file "></i></button>';
                                                echo '		</a>';
                                                echo '  <td>' . $resultado->NOME_LOTE . '</td>';
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

var container = am4core.create("chartdiv", am4core.Container);
container.width = am4core.percent(100);
container.height = am4core.percent(100);
container.layout = "horizontal";


var chart = container.createChild(am4charts.PieChart);

$.ajax({
    type: "POST",
    url: '/ProbLotes/getProblemasPorLote', // Endpoint para retornar dados
    data: {},
    dataType: 'json',
    success: function (data) {
        const chartData = [];

        // Processar os dados recebidos
        for (let item of data) {
            chartData.push({
                country: item.lote.NOME_LOTE, // Nome do lote
                litres: parseInt(item.lote.quantidade_procedimentos), // Quantidade de procedimentos
                subData: item.problemasPorTipo.map(tipo => ({
                    name: tipo.tipo_problema, // Nome do tipo de problema
                    value: parseInt(tipo.quantidade_problemas) // Quantidade de problemas por tipo
                }))
            });
        }

        // Populando o gráfico principal
        chart.data = chartData;
    },
    error: function (error) {
        console.error('Erro ao buscar dados para o gráfico:', error);
    }
});


// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";
pieSeries.slices.template.states.getKey("active").properties.shiftRadius = 0;
//pieSeries.labels.template.text = "{category}\n{value.percent.formatNumber('#.#')}%";

pieSeries.slices.template.events.on("hit", function(event) {
  selectSlice(event.target.dataItem);
})

var chart2 = container.createChild(am4charts.PieChart);
chart2.width = am4core.percent(30);
chart2.radius = am4core.percent(80);

// Add and configure Series
var pieSeries2 = chart2.series.push(new am4charts.PieSeries());
pieSeries2.dataFields.value = "value";
pieSeries2.dataFields.category = "name";
pieSeries2.slices.template.states.getKey("active").properties.shiftRadius = 0;
//pieSeries2.labels.template.radius = am4core.percent(50);
//pieSeries2.labels.template.inside = true;
//pieSeries2.labels.template.fill = am4core.color("#ffffff");
pieSeries2.labels.template.disabled = true;
pieSeries2.ticks.template.disabled = true;
pieSeries2.alignLabels = false;
pieSeries2.events.on("positionchanged", updateLines);

var interfaceColors = new am4core.InterfaceColorSet();

var line1 = container.createChild(am4core.Line);
line1.strokeDasharray = "2,2";
line1.strokeOpacity = 0.5;
line1.stroke = interfaceColors.getFor("alternativeBackground");
line1.isMeasured = false;

var line2 = container.createChild(am4core.Line);
line2.strokeDasharray = "2,2";
line2.strokeOpacity = 0.5;
line2.stroke = interfaceColors.getFor("alternativeBackground");
line2.isMeasured = false;

// Adicionar legenda ao gráfico principal
chart.legend = new am4charts.Legend();
chart.legend.position = "bottom"; // Posição da legenda (pode ser "right", "left", "top", "bottom")
chart.legend.valueLabels.template.text = "{value}"; // Mostrar o valor na legenda (opcional)
chart.legend.labels.template.wrap = true; // Permite quebrar linha no texto da legenda

// Adicionar legenda ao gráfico secundário
chart2.legend = new am4charts.Legend();
chart2.legend.position = "bottom"; // Posição da legenda (ajuste conforme necessário)
chart2.legend.valueLabels.template.text = "{value}"; // Mostrar valores na legenda
chart2.legend.labels.template.fill = am4core.color("#000000"); // Cor do texto da legenda


var selectedSlice;

function selectSlice(dataItem) {

  selectedSlice = dataItem.slice;

  var fill = selectedSlice.fill;

  var count = dataItem.dataContext.subData.length;
  pieSeries2.colors.list = [];
  for (var i = 0; i < count; i++) {
    pieSeries2.colors.list.push(fill.brighten(i * 2 / count));
  }

  chart2.data = dataItem.dataContext.subData;
  pieSeries2.appear();

  var middleAngle = selectedSlice.middleAngle;
  var firstAngle = pieSeries.slices.getIndex(0).startAngle;
  var animation = pieSeries.animate([{ property: "startAngle", to: firstAngle - middleAngle }, { property: "endAngle", to: firstAngle - middleAngle + 360 }], 600, am4core.ease.sinOut);
  animation.events.on("animationprogress", updateLines);

  selectedSlice.events.on("transformed", updateLines);

//  var animation = chart2.animate({property:"dx", from:-container.pixelWidth / 2, to:0}, 2000, am4core.ease.elasticOut)
//  animation.events.on("animationprogress", updateLines)
}


function updateLines() {
  if (selectedSlice) {
    var p11 = { x: selectedSlice.radius * am4core.math.cos(selectedSlice.startAngle), y: selectedSlice.radius * am4core.math.sin(selectedSlice.startAngle) };
    var p12 = { x: selectedSlice.radius * am4core.math.cos(selectedSlice.startAngle + selectedSlice.arc), y: selectedSlice.radius * am4core.math.sin(selectedSlice.startAngle + selectedSlice.arc) };

    p11 = am4core.utils.spritePointToSvg(p11, selectedSlice);
    p12 = am4core.utils.spritePointToSvg(p12, selectedSlice);

    var p21 = { x: 0, y: -pieSeries2.pixelRadius };
    var p22 = { x: 0, y: pieSeries2.pixelRadius };

    p21 = am4core.utils.spritePointToSvg(p21, pieSeries2);
    p22 = am4core.utils.spritePointToSvg(p22, pieSeries2);

    line1.x1 = p11.x;
    line1.x2 = p21.x;
    line1.y1 = p11.y;
    line1.y2 = p21.y;

    line2.x1 = p12.x;
    line2.x2 = p22.x;
    line2.y1 = p12.y;
    line2.y2 = p22.y;
  }
}

chart.events.on("datavalidated", function() {
  setTimeout(function() {
    selectSlice(pieSeries.dataItems.getIndex(0));
  }, 1000);
});


}); // end am4core.ready()
</script>