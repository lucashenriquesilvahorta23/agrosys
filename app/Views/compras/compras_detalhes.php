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
                    <input type="hidden" name="idProcedimento" id="idProcedimento" value="<?= $idProcedimento?>">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 style="text-align: center; color: #000; font-weight: 400;" >Top 5 animais mais pesados </h2>
                                <div id="chartdiv"></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="tabela_padrao_datatable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead>
                                    <tr>
                                        <th>Lote</th>
                                        <th>Identificador</th>
                                        <th>Peso</th>
                                        <th>Valor</th>
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
                                                echo '  <td>' . frm_moeda($resultado->valor) . '</td>';
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

/**
 * Chart design taken from Samsung health app
 */

var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.paddingBottom = 30;

var idProcedimento = $("#idProcedimento").val();
$.ajax({
    type: "POST",
    url: '/Compras/getAnimaisMaisPesadosPorProcedimento',
    data: {
        idProcedimento: idProcedimento
    },
    dataType: 'json',
    success: function (data) {
      console.log(data)

      chart.data = [{
            "name": data[0].identificacao_animal + " - R$ " + data[0].valor, // Primeiro animal
            "steps": parseFloat(data[0].peso) + "Kg", // Peso do primeiro animal
            "href": "http://tst.agrosys.com.br/template/images/boi1.jpg"
        }, {
            "name": data[1].identificacao_animal + " - R$ " + data[1].valor, // Segundo animal
            "steps": parseFloat(data[1].peso) + "Kg", // Peso do segundo animal
            "href": "http://tst.agrosys.com.br/template/images/boi2.jpg"
        }, {
            "name": data[2].identificacao_animal + " - R$ " + data[2].valor, // Terceiro animal
            "steps": parseFloat(data[2].peso) + "Kg", // Peso do terceiro animal
            "href": "http://tst.agrosys.com.br/template/images/boi3.png"
        }, {
            "name": data[3].identificacao_animal + " - R$ " + data[3].valor, // Quarto animal
            "steps": parseFloat(data[3].peso) + "Kg", // Peso do quarto animal
            "href": "http://tst.agrosys.com.br/template/images/boi4.jpg"
        }, {
            "name": data[4].identificacao_animal + " - R$ " + data[4].valor, // Quinto animal
            "steps": parseFloat(data[4].peso) + "Kg", // Peso do quinto animal
            "href": "http://tst.agrosys.com.br/template/images/boi5.jpg"
        }];



      // Populando o gráfico
      chart.data = chartData;
      
    },
    error: function (error) {
      console.error('Erro ao buscar dados para a coluna:', coluna.key, error);
    }
  });

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "name";
categoryAxis.renderer.grid.template.strokeOpacity = 0;
categoryAxis.renderer.minGridDistance = 10;
categoryAxis.renderer.labels.template.dy = 35;
categoryAxis.renderer.tooltip.dy = 35;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.inside = true;
valueAxis.renderer.labels.template.fillOpacity = 0.3;
valueAxis.renderer.grid.template.strokeOpacity = 0;
valueAxis.min = 0;
valueAxis.cursorTooltipEnabled = false;
valueAxis.renderer.baseGrid.strokeOpacity = 0;

var series = chart.series.push(new am4charts.ColumnSeries);
series.dataFields.valueY = "steps";
series.dataFields.categoryX = "name";
series.tooltipText = "{valueY.value}"+"Kg";
series.tooltip.pointerOrientation = "vertical";
series.tooltip.dy = - 6;
series.columnsContainer.zIndex = 100;

var columnTemplate = series.columns.template;
columnTemplate.width = am4core.percent(50);
columnTemplate.maxWidth = 66;
columnTemplate.column.cornerRadius(60, 60, 10, 10);
columnTemplate.strokeOpacity = 0;

series.heatRules.push({ target: columnTemplate, property: "fill", dataField: "valueY", min: am4core.color("#e5dc36"), max: am4core.color("#5faa46") });
series.mainContainer.mask = undefined;

var cursor = new am4charts.XYCursor();
chart.cursor = cursor;
cursor.lineX.disabled = true;
cursor.lineY.disabled = true;
cursor.behavior = "none";

var bullet = columnTemplate.createChild(am4charts.CircleBullet);
bullet.circle.radius = 30;
bullet.valign = "bottom";
bullet.align = "center";
bullet.isMeasured = true;
bullet.mouseEnabled = false;
bullet.verticalCenter = "bottom";
bullet.interactionsEnabled = false;

var hoverState = bullet.states.create("hover");
var outlineCircle = bullet.createChild(am4core.Circle);
outlineCircle.adapter.add("radius", function (radius, target) {
    var circleBullet = target.parent;
    return circleBullet.circle.pixelRadius + 10;
})

var image = bullet.createChild(am4core.Image);
image.width = 60;
image.height = 60;
image.horizontalCenter = "middle";
image.verticalCenter = "middle";
image.propertyFields.href = "href";

image.adapter.add("mask", function (mask, target) {
    var circleBullet = target.parent;
    return circleBullet.circle;
})

var previousBullet;
chart.cursor.events.on("cursorpositionchanged", function (event) {
    var dataItem = series.tooltipDataItem;

    if (dataItem.column) {
        var bullet = dataItem.column.children.getIndex(1);

        if (previousBullet && previousBullet != bullet) {
            previousBullet.isHover = false;
        }

        if (previousBullet != bullet) {

            var hs = bullet.states.getKey("hover");
            hs.properties.dy = -bullet.parent.pixelHeight + 30;
            bullet.isHover = true;

            previousBullet = bullet;
        }
    }
})

}); // end am4core.ready()
</script>