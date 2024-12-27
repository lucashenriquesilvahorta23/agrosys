<div class="content-wrapper" style="margin-left: 300px">
    <section class="content-header">
        <h1>
            <i class="fa fa-globe"></i> Dashboard
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </section>
    <style>
        #chartdiv {
        width: 100%;
        height: 400px;
        }

        #chartdiv2 {
        width: 100%;
        height: 400px;
        }

        #chartdiv3 {
        width: 100%;
        height: 400px;
        }

        #chartdiv4 {
        width: 100%;
        height: 400px;
        }

        #chartdiv5 {
        width: 100%;
        height: 400px;
        }

        #chartdiv6 {
        width: 100%;
        height: 400px;
        }

        #chartdiv7 {
        width: 100%;
        height: 400px;
        }

        </style>

    <section class="content">
        <?php helper('mensagem'); ?>
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 style="text-align: center; color: #000; font-weight: 400;" >Top 10 animais mais promissores </h2>
                                <div id="chartdiv"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h2 style="text-align: center; color: #000; font-weight: 400;" >5 Vacinas mais aplicada </h2>
                                <div id="chartdiv4"></div>
                            </div>
                            <div class="col-md-6">
                                <h2 style="text-align: center; color: #000; font-weight: 400;" >5 Medicamento mais aplicados </h2>
                                <div id="chartdiv5"></div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h2 style="text-align: center; color: #000; font-weight: 400;" >Problemas mais recorrentes </h2>
                                <div id="chartdiv6"></div>
                            </div>
                            <div class="col-md-6">
                                <h2 style="text-align: center; color: #000; font-weight: 400;" >Resumo de problemas por lote</h2>
                                <div id="chartdiv7"></div>
                            </div>
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

$.ajax({
    type: "POST",
    url: '/Home/getAnimaisMaisPesadosPorProcedimento',
    data: {
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
        }, {
            "name": data[5].identificacao_animal + " - R$ " + data[5].valor, // Primeiro animal
            "steps": parseFloat(data[5].peso) + "Kg", // Peso do primeiro animal
            "href": "http://tst.agrosys.com.br/template/images/boi1.jpg"
        }, {
            "name": data[6].identificacao_animal + " - R$ " + data[6].valor, // Segundo animal
            "steps": parseFloat(data[6].peso) + "Kg", // Peso do segundo animal
            "href": "http://tst.agrosys.com.br/template/images/boi2.jpg"
        }, {
            "name": data[7].identificacao_animal + " - R$ " + data[7].valor, // Terceiro animal
            "steps": parseFloat(data[7].peso) + "Kg", // Peso do terceiro animal
            "href": "http://tst.agrosys.com.br/template/images/boi3.png"
        }, {
            "name": data[8].identificacao_animal + " - R$ " + data[8].valor, // Quarto animal
            "steps": parseFloat(data[8].peso) + "Kg", // Peso do quarto animal
            "href": "http://tst.agrosys.com.br/template/images/boi4.jpg"
        }, {
            "name": data[9].identificacao_animal + " - R$ " + data[9].valor, // Quinto animal
            "steps": parseFloat(data[9].peso) + "Kg", // Peso do quinto animal
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

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv2", am4charts.XYChart);

// Add data
chart.data = [{
  "country": "USA",
  "visits": 2025
}, {
  "country": "China",
  "visits": 1882
}, {
  "country": "Japan",
  "visits": 1809
}];

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



<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv3", am4charts.XYChart);

// Add data
chart.data = [{
  "country": "USA",
  "visits": 2025
}, {
  "country": "China",
  "visits": 1882
}, {
  "country": "Japan",
  "visits": 1809
}];

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

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv4", am4charts.PieChart);

// Habilitando a legenda
chart.legend = new am4charts.Legend();

$.ajax({
    type: "POST",
    url: '/Home/getVacina',
    data: {},
    dataType: 'json',
    success: function (data) {
        console.log(data);
        const chartData = [];
        for (let item of data) {
            chartData.push({
                country: item.nome,
                litres: parseInt(item.total_vacinas)
            });
        }

        // Populando o gráfico
        chart.data = chartData;
    },
    error: function (error) {
        console.error('Erro ao buscar dados para a coluna:', error);
    }
});

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

chart.hiddenState.properties.radius = am4core.percent(0);

}); // end am4core.ready()
</script>
<!-- Chart code -->
<script>
am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("chartdiv5", am4charts.PieChart);

    // Habilitando a legenda
    chart.legend = new am4charts.Legend();

    $.ajax({
        type: "POST",
        url: '/Home/getMedicamentos',
        data: {},
        dataType: 'json',
        success: function (data) {
            console.log(data);
            const chartData = [];
            for (let item of data) {
                chartData.push({
                    country: item.nome,
                    litres: parseInt(item.total_medicacoes)
                });
            }

            // Populando o gráfico
            chart.data = chartData;
        },
        error: function (error) {
            console.error('Erro ao buscar dados para a coluna:', error);
        }
    });

    // Add and configure Series
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "litres";
    pieSeries.dataFields.category = "country";
    pieSeries.slices.template.stroke = am4core.color("#fff");
    pieSeries.slices.template.strokeOpacity = 1;

    // This creates initial animation
    pieSeries.hiddenState.properties.opacity = 1;
    pieSeries.hiddenState.properties.endAngle = -90;
    pieSeries.hiddenState.properties.startAngle = -90;

    chart.hiddenState.properties.radius = am4core.percent(0);

}); // end am4core.ready()
</script>



<!-- Chart code -->
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdiv6", am4charts.PieChart);

        // Habilitando a legenda
        chart.legend = new am4charts.Legend();

        $.ajax({
            type: "POST",
            url: '/Home/getProblemasRecorrentes',
            dataType: 'json',
            success: function (data) {

                // Processando os dados recebidos
                const chartData = data.map(item => ({
                    country: item.tipo_problema,
                    litres: parseInt(item.quantidade_problemas)
                }));

                // Atribuindo os dados processados ao gráfico
                chart.data = chartData;

                // Criando séries com os dados
                createSeries('quantidade_procedimentos', 'Quantidade de problemas');
            },
            error: function (error) {
                console.error('Erro ao buscar dados:', error);
            }
        });

        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "litres";
        pieSeries.dataFields.category = "country";
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeOpacity = 1;

        // This creates initial animation
        pieSeries.hiddenState.properties.opacity = 1;
        pieSeries.hiddenState.properties.endAngle = -90;
        pieSeries.hiddenState.properties.startAngle = -90;

        chart.hiddenState.properties.radius = am4core.percent(0);

    }); // end am4core.ready()
</script>

<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        var chart = am4core.create('chartdiv7', am4charts.XYChart);
        chart.colors.step = 2;

        // Configuração da legenda
        chart.legend = new am4charts.Legend();
        chart.legend.position = 'top';
        chart.legend.paddingBottom = 20;
        chart.legend.labels.template.maxWidth = 95;

        // Configuração do eixo X
        var xAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        xAxis.dataFields.category = 'NOME_LOTE';
        xAxis.renderer.cellStartLocation = 0.1;
        xAxis.renderer.cellEndLocation = 0.9;
        xAxis.renderer.grid.template.location = 0;

        // Configuração do eixo Y
        var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
        yAxis.min = 0;

        // Função para criar séries
        function createSeries(value, name) {
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueY = value;
            series.dataFields.categoryX = 'NOME_LOTE';
            series.name = name;

            series.events.on("hidden", arrangeColumns);
            series.events.on("shown", arrangeColumns);

            var bullet = series.bullets.push(new am4charts.LabelBullet());
            bullet.interactionsEnabled = false;
            bullet.dy = 30;
            bullet.label.text = '{valueY}';
            bullet.label.fill = am4core.color('#ffffff');

            return series;
        }

        // Chamando o AJAX para buscar os dados
        $.ajax({
            type: "POST",
            url: '/Home/getProblemasPorLote',
            dataType: 'json',
            success: function (data) {

                // Processando os dados recebidos
                const chartData = data.map(item => ({
                    NOME_LOTE: item.NOME_LOTE,
                    quantidade_procedimentos: parseInt(item.quantidade_procedimentos)
                }));

                // Atribuindo os dados processados ao gráfico
                chart.data = chartData;

                // Criando séries com os dados
                createSeries('quantidade_procedimentos', 'Quantidade de problemas');
            },
            error: function (error) {
                console.error('Erro ao buscar dados:', error);
            }
        });

        // Função para organizar colunas
        function arrangeColumns() {
            var series = chart.series.getIndex(0);

            var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
            if (series.dataItems.length > 1) {
                var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
                var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
                var delta = ((x1 - x0) / chart.series.length) * w;
                if (am4core.isNumber(delta)) {
                    var middle = chart.series.length / 2;

                    var newIndex = 0;
                    chart.series.each(function(series) {
                        if (!series.isHidden && !series.isHiding) {
                            series.dummyData = newIndex;
                            newIndex++;
                        } else {
                            series.dummyData = chart.series.indexOf(series);
                        }
                    });
                    var visibleCount = newIndex;
                    var newMiddle = visibleCount / 2;

                    chart.series.each(function(series) {
                        var trueIndex = chart.series.indexOf(series);
                        var newIndex = series.dummyData;

                        var dx = (newIndex - trueIndex + middle - newMiddle) * delta;

                        series.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
                        series.bulletsContainer.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
                    });
                }
            }
        }

    }); // end am4core.ready()
</script>
