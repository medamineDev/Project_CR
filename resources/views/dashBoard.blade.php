@extends("layouts.app")

@section("content")

    @include("partials.header")

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <h1>
                Dashboard
                <small>Version 2.0</small>

            </h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>

            </ol>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <!-- AREA CHART -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">RH Absenceses</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="areaChart" style="height:250px"></canvas>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- DONUT CHART -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Taux Occupation </h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="pieChart" style="height:250px"></canvas>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col (LEFT) -->
                <div class="col-md-6">
                    <!-- LINE CHART -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Etats Financiers </h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="lineChart" style="height:250px"></canvas>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- BAR CHART -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Taux Presence</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="barChart" style="height:250px"></canvas>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col (RIGHT) -->
            </div>


        </section>
        <!-- /.content -->
    </div>

    @include("partials.footer")

@endsection


@section("javascript")

    <script>
        $(function () {
            var array=   JSON.parse('<?php echo json_encode($stats); ?>');
            //  alert(array);
            var arrayData=[];
            for(var stat of array ){


                var seuil = stat.seuil;
                var tolerance = stat.tolerance;
                var prevision = stat.prevision;

                var couleur = "green";
                var marge = seuil+tolerance;
                if(prevision< (marge)){

                    couleur ="red";
                }

                if(prevision > tolerance && prevision <marge){

                    couleur ="yellow";
                }

                var data = {
                    label: "January",
                    fillColor: "rgba(210, 214, 222, 1)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [prevision]
                };


                arrayData.push(data);


            }



            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            var data=  {
                label: "January",
                /*    fillColor: "rgba(210, 214, 222, 1)",
                 strokeColor: "rgba(210, 214, 222, 1)",
                 pointColor: "rgba(210, 214, 222, 1)",
                 pointStrokeColor: "#c1c7d1",
                 pointHighlightFill: "#fff",*/
                fillColor: ["rgba(220,220,220,0.5)", "navy", "red", "orange"],
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81]
                // data: [65]
            };
            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var areaChart = new Chart(areaChartCanvas);

            var areaChartData = {
               // labels: ["January", "February", "March", "April", "May", "June", "July","March", "April", "May", "June", "July"],
                labels: ["January", "February", "March", "April"],
                datasets: [
                        data

                ]
            };





            //areaChartData.datasets[1].fillColor = "red";


            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas);
            var barChartData = areaChartData;
          /*  barChartData.datasets[1].fillColor = "#00a65a";
            barChartData.datasets[1].strokeColor = "#00a65a";
            barChartData.datasets[1].pointColor = "#00a65a";*/
            var barChartOptions = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: "rgba(0,0,0,.05)",
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //String - A legend template
                //add legend
                //Boolean - whether to make the chart responsive
                responsive: true,
                maintainAspectRatio: true
            };



      /*     for( var i=0;i< 2;i++){
                var bars = areaChartData.datasets[i];

                //You can check for bars[i].value and put your conditions here
                var barVal = bars.data[0];

                //alert(barVal);
                if(barVal> 50){
                    bars.fillColor = "red";
                }else{
                    bars.fillColor = "green";
                }


            }*/


            barChartOptions.datasetFill = false;
            barChart.Bar(barChartData, barChartOptions);




        });
    </script>

    @endsection
