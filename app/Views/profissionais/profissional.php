<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 300px" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-paw"></i> Animais
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Animais</a></li>
        <li class="breadcrumb-item active">Listagem</li>
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

    <!-- Main content -->
    <section class="content">
    <?php helper('mensagem');?>
        <div class="row">		
            <div class="col-12">         
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Animais</h3>
                        <div class="box-controls pull-right">
                            <a href="/Animais/Inserir"><button class="btn btn-md btn-info"><i class="fa fa-plus"></i> Novo</button></a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="tabela_padrao_datatable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead>
                                    <tr>
                                        <th>Ações</th>
                                        <th>Identificação</th>
                                        <th>Nome</th>
                                        <th>Raça</th>
                                        <th>Sexo</th>
                                        <th>Peso Inicial</th>
                                        <th>Peso Atual</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if($resultados != ""){
                                        foreach ($resultados as $resultado) {
                                            echo '<tr>';
                                                echo '  <td align="center">';				
                                                echo '      <a href="/Animais/Editar/'.base64_encode($resultado->ID_PROFISSIONAL).'" >';
                                                echo '<button class="btn btn-success btn-sm" title="Editar informações"><i class="fa fa-edit"></i></button>';
                                                echo '      </a>';
                                                echo '      <a href="/Animais/Excluir/'.base64_encode($resultado->ID_PROFISSIONAL).'" onclick="return confirm(\'Deseja continuar?\')">';
                                                echo '<button class="btn btn-warning btn-sm" title="Excluir"><i class="fa fa-trash"></i></button>';
                                                echo '      </a>';
                                                echo '<button data-toggle="modal" data-target="#exampleModalCenter" data-identificacao="'.$resultado->IDENTIFICACAO.'" class="btn btn-primary btn-sm btnModal" title="Evolução de peso"><i class="fa fa-eye"></i></button>';
                                                
                                                echo '  </td>';
                                                echo '  <td>'.$resultado->IDENTIFICACAO.'</td>';
                                                echo '  <td>'.$resultado->NOME.'</td>';
                                                echo '  <td>'.$resultado->RACA.'</td>';
                                                echo '  <td>'.$resultado->SEXO.'</td>';
                                                echo '  <td>'.$resultado->PESO_INICIAL.' kg</td>';
                                                echo '  <td>'.$resultado->PESO_ATUAL.' kg</td>';
                                                echo '  <td>'.$resultado->STATUS.'</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                                </tbody>				  
                            </table>
                        </div>              
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->          
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="/template/js/escola.js"></script>
<!-- Modal -->
<div style="color: #000" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Evolução de peso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div id="chartdiv"></div>
            </div>
            <div class="col-md-12">
                <h2 style="text-align: center; color: #000; font-weight: 400;" >Histórico de vacinas </h2>
                <div id="chartdiv2"></div>
            </div>
            <div class="col-md-12">
                <h2 style="text-align: center; color: #000; font-weight: 400;" >Histórico de medicamentos </h2>
            <div id="chartdiv3"></div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
	<!-- jQuery 3 -->
	<script src="/assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>
<!-- Chart code -->
<!-- Chart code -->
<script>
    $(document).ready(function () {
    let chartInitialized = false; // Flag para evitar múltiplas inicializações

    // Evento click no botão "Evolução de peso"
    $('.btnModal').on('click', function () {
        // Pega o valor de IDENTIFICACAO
        var identificacao = $(this).data('identificacao');
        console.log(identificacao)
        
        initChart(identificacao);
    });

    function initChart(identificacao) {
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv", am4charts.XYChart);
            var chart2 = am4core.create("chartdiv2", am4charts.PieChart);
            var chart3 = am4core.create("chartdiv3", am4charts.PieChart);



            $.ajax({
                type: "POST",
                url: '/Animais/getPesoEDataPesagem',
                data: { identificacao: identificacao }, 
                dataType: 'json',
                success: function (data) {
                    


                    const chartData = data.map(item => {
                        return {
                            year: item.data_pesagem, // Converte string para objeto Date
                            italy: parseFloat(item.peso) // Converte string para número
                        };
                    });


                    console.log(chartData)


                    // Preencher os dados do gráfico
                    chart.data = chartData; 
                },
                error: function (error) {
                    console.error('Erro ao buscar dados:', error);
                }
            });

            $.ajax({
                type: "POST",
                url: '/Animais/getVacinasAgrupadasPorProcedimento',
                data: { identificacao: identificacao }, 
                dataType: 'json',
                success: function (data) {

                    const chartData2 = data.map(item => {
                        return {
                            country: item.nome, // Converte string para objeto Date
                            litres: parseFloat(item.total_vacinas) // Converte string para número
                        };
                    });
                    chart2.data = chartData2; 


                },
                error: function (error) {
                    console.error('Erro ao buscar dados:', error);
                }
            });

            $.ajax({
                type: "POST",
                url: '/Animais/getMedicacoesAgrupadasPorProcedimento',
                data: { identificacao: identificacao }, 
                dataType: 'json',
                success: function (data) {

                    const chartData3 = data.map(item => {
                        return {
                            country: item.nome, // Converte string para objeto Date
                            litres: parseFloat(item.total_medicacoes) // Converte string para número
                        };
                    });
                    
                    chart3.data = chartData3; 

                },
                error: function (error) {
                    console.error('Erro ao buscar dados:', error);
                }
            });



            
            // Create category axis
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "year";
            categoryAxis.renderer.opposite = true;

            // Create value axis
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.title.text = "Place taken";
            valueAxis.renderer.minLabelPosition = 0.01;

            // Create series
            var series1 = chart.series.push(new am4charts.LineSeries());
            series1.dataFields.valueY = "italy";
            series1.dataFields.categoryX = "year";
            series1.name = "Dados";
            series1.bullets.push(new am4charts.CircleBullet());
            series1.tooltipText = "Peso do animal na data de {categoryX}: {valueY}Kg";
            series1.legendSettings.valueText = "{valueY}";
            series1.visible  = false;


            // Add chart cursor
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.behavior = "zoomY";


            let hs1 = series1.segments.template.states.create("hover")
            hs1.properties.strokeWidth = 5;
            series1.segments.template.strokeWidth = 1;


            // Add legend
            chart.legend = new am4charts.Legend();
            chart.legend.itemContainers.template.events.on("over", function(event){
            var segments = event.target.dataItem.dataContext.segments;
            segments.each(function(segment){
                segment.isHover = true;
            })
            })

            chart.legend.itemContainers.template.events.on("out", function(event){
            var segments = event.target.dataItem.dataContext.segments;
            segments.each(function(segment){
                segment.isHover = false;
            })
            })



            // Add and configure Series for chart2
            var pieSeries2 = chart2.series.push(new am4charts.PieSeries());
            pieSeries2.dataFields.value = "litres";
            pieSeries2.dataFields.category = "country";
            pieSeries2.slices.template.stroke = am4core.color("#fff");
            pieSeries2.slices.template.strokeOpacity = 1;

            // This creates initial animation for chart2
            pieSeries2.hiddenState.properties.opacity = 1;
            pieSeries2.hiddenState.properties.endAngle = -90;
            pieSeries2.hiddenState.properties.startAngle = -90;

            chart2.hiddenState.properties.radius = am4core.percent(0);

            // Add a legend to chart2
            chart2.legend = new am4charts.Legend();

            // Add and configure Series for chart3
            var pieSeries3 = chart3.series.push(new am4charts.PieSeries());
            pieSeries3.dataFields.value = "litres";
            pieSeries3.dataFields.category = "country";
            pieSeries3.slices.template.stroke = am4core.color("#fff");
            pieSeries3.slices.template.strokeOpacity = 1;

            // This creates initial animation for chart3
            pieSeries3.hiddenState.properties.opacity = 1;
            pieSeries3.hiddenState.properties.endAngle = -90;
            pieSeries3.hiddenState.properties.startAngle = -90;

            chart3.hiddenState.properties.radius = am4core.percent(0);

            // Add a legend to chart3
            chart3.legend = new am4charts.Legend();


           

        

        }); // end am4core.ready()
    }
});


</script>

