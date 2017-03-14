@extends("layouts.app")
@section("css")


    <style>

        td{

            cursor: pointer;
        }
    </style>
    @endsection

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

                <div class="form-group">
                    <label>Date:</label>

                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker">
                    </div>
                    <!-- /.input group -->
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <!-- AREA CHART -->
                    <div class="box box-primary">
                        <div class="box-header with-border">

                            <h3 class="box-title">Taux Presence</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <div class="box-body">
                                    <div class="chart">
                                        <canvas id="barChart" style="height:250px"></canvas>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- DONUT CHART -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Etats Financiers </h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="chart">
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="barChart_4" style="height:250px"></canvas>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col (LEFT) -->
                <div class="col-md-6">
                    <!-- LINE CHART -->
                    <div class="box box-info">
                        <div class="box-header with-border">

                            <h3 class="box-title">Taux Occupation </h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="chart">
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="barChartOccupation" style="height:250px"></canvas>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- /.box -->

                    <!-- BAR CHART -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Taux</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="barChart_4" style="height:250px"></canvas>
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



            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });

            var array = JSON.parse('<?php echo json_encode($presenceData); ?>');
            var arrayOcc = JSON.parse('<?php echo json_encode($occupationData); ?>');
            var presenceArrayData = [];
            var presenceColorArray = [];

            var occupationArrayData = [];
            var occupationColorArray = [];
            console.log(array);


            function getArrays(array) {

                var colorArray = [];
                var arrayData = [];

                for (var stat of array) {


                    var seuil = parseFloat(stat.seuil);
                    var tolerance = parseFloat(stat.tolerance);//+ 14
                    var prevision = parseFloat(stat.prevision);

                    var couleur = "green";
                    var marge = seuil + tolerance;
                    if (prevision < seuil) {

                        couleur = "red";
                        presenceColorArray.push("red");
                        console.log("Pr : " + prevision + " S: " + seuil + " , Tol : " + tolerance + " Marge : " + marge + " --> red")
                    } else {


                        var couleur = "green";
                        console.log("Pr : " + prevision + " S: " + seuil + " , Tol : " + tolerance + " Marge : " + marge + " --> green")


                    }


                    if (prevision > seuil && prevision <= marge) {

                        couleur = "yellow";
                        console.log("Pr : " + prevision + " S: " + seuil + " , Tol : " + tolerance + " Marge : " + marge + " --> yellow")

                    }

                    colorArray.push(couleur);
                    arrayData.push(prevision);


                }

                return [colorArray, arrayData];


            }


            var presenceChartArrays = getArrays(array);
            var occupationChartArrays = getArrays(arrayOcc);

            presenceColorArray = presenceChartArrays[0];
            presenceArrayData = presenceChartArrays[1];

            occupationColorArray = occupationChartArrays[0];
            occupationArrayData = occupationChartArrays[1];

            console.log("colors :");
            console.log(occupationColorArray);
            console.log("previsions");
            console.log(occupationArrayData);

            var dataPresence = {
                label: "presence",
                fillColor: presenceColorArray,
                strokeColor: "rgba(60,141,188,0.8)",
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: presenceArrayData
            };

            var dataOccupation = {
                label: "presence",
                fillColor: occupationColorArray,
                strokeColor: "rgba(60,141,188,0.8)",
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: occupationArrayData
            };

            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            //  var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            //  var areaChart = new Chart(areaChartCanvas);

            var areaChartData = {
                labels: ["Jan", "Fev", "Mar", "Avr", "May", "Juin", "Juillet", "Aout", "Sep", "Oct", "Nov", "Dec"],

                datasets: [dataPresence]


            };

            var occupationAreaChartData = {
                labels: ["Jan", "Fev", "Mar", "Avr", "May", "Juin", "Juillet", "Aout", "Sep", "Oct", "Nov", "Dec"],

                datasets: [dataOccupation]


            };


            //-------------
            //- BAR CHART -
            //-------------

            var occupationBarChartCanvas = $("#barChartOccupation").get(0).getContext("2d");
            var occupationBarChart = new Chart(occupationBarChartCanvas);
            var barChartDataOccupation = occupationAreaChartData;

            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas);
            var barChartData = areaChartData;


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


            barChartOptions.datasetFill = false;
            barChart.Bar(barChartData, barChartOptions);
            occupationBarChart.Bar(barChartDataOccupation, barChartOptions);


        })
        ;
    </script>

@endsection
