@extends("layouts.app")
@section("css")


    <style>

        td {

            cursor: pointer;
        }

        .datePiker .form-group {
            margin-left: 16px;
            width: 200px;
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
            <div class="row datePiker">


                <div class="col-md-3">
                    <div class="form-group">
                        <label>Mois:</label>

                        <select id="mois_select" class="form-control">

                            <option id="0">Select</option>
                            <option id="1">AVRIL</option>
                            <option id="2">MAI</option>
                            <option id="3">JUIN</option>
                            <option id="4">JUILLET</option>
                            <option id="5">AOUT</option>
                            <option id="6">SEPTEMBRE</option>
                            <option id="7">OCTOBRE</option>
                            <option id="8">NOVEMBRE</option>
                            <option id="9">DECEMBRE</option>
                            <option id="10">JANVIER</option>
                            <option id="11">FEVRIER</option>
                            <option id="12">MARS</option>


                        </select>
                    </div>
                </div>

                <div class="col-md-3">

                    <div class="form-group">
                        <label>Année:</label>

                        <select id="year_select" class="form-control">

                            @for ($i = 2000; $i < 2030; $i++)
                                <option id="{{ $i }}">{{ $i  }}</option>
                            @endfor

                        </select>
                    </div>
                </div>

                <div class="col-md-6">
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

                    <!-- /.box -->

                </div>

                <div class="col-md-6">

                    <div class="box box-primary">
                        <div class="box-header with-border">

                            <h3 class="box-title">Taux Occupation</h3>

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
                                        <canvas id="barChartOccupation" style="height:250px"></canvas>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
                <!-- /.col (LEFT) -->

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


            var currentMoth = "{{ $month }}";

            var currentYear = "{{ $year }}";


            var array = JSON.parse('<?php echo json_encode($presenceData); ?>');
            var arrayOcc = JSON.parse('<?php echo json_encode($occupationData); ?>');
            var getByMoth = "{{ $getByMonth }}";
            var presenceArrayData = [];
            var presenceColorArray = [];

            var occupationArrayData = [];
            var occupationColorArray = [];
            var arrayPresenceAssetsMonth = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            var arrayOccupationAssetsMonth = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            var labelMonth = ["AVRIL", "MAI", "JUIN", "JUILLET", "AOUT", "SEPTEMBRE", "OCTOBRE", "NOVEMBRE", "DECEMBRE", "JABNVIER", "FEVRIER", "MARS"];

            if (currentMoth) {

                var mothLabel = labelMonth[currentMoth-1];
               // alert("is cuurent month --> " + currentMoth +" -> "+mothLabel);
                $('#mois_select').val(mothLabel);

            } else {

                $('#mois_select').val("Select");
            }
           // alert("current month -> " + currentMoth);
           // alert("current year -> " + currentYear);

            $('#year_select').val(currentYear);

            $('#mois_select').change(function () {

                var selectedMothId = $(this).find('option:selected').attr('id');
                currentMoth = selectedMothId;


                var path = "";
                if (selectedMothId == 0) {

                    path = "/" + currentYear;

                } else {

                    path = "/" + currentYear + "/" + currentMoth;


                }


                window.location.href = path;
            });


            $('#year_select').change(function () {

                var selectedYearId = $(this).find('option:selected').attr('id');
                currentYear = selectedYearId;


                var path = "";
                if (currentMoth == 0) {

                    path = "/" + currentYear;

                } else {

                    path = "/" + currentYear + "/" + currentMoth;


                }


                window.location.href = path;
            });


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


            if (getByMoth) {

                if (array.length > 0) {
                    var monthPresenceIndex = array[0].idMois;
                    arrayPresenceAssetsMonth[monthPresenceIndex - 1] = array[0].nbJours;
                    presenceArrayData = arrayPresenceAssetsMonth;
                }


                if (arrayOcc.length > 0) {

                    var monthOccupationIndex = arrayOcc[0].idMois;
                    arrayOccupationAssetsMonth[monthOccupationIndex - 1] = arrayOcc[0].nbJours;
                    occupationArrayData = arrayOccupationAssetsMonth;
                }


            }

            console.log("colors :");
            console.log(presenceColorArray);
            console.log("previsions");
            console.log(presenceArrayData);


            var dataPresence = {
                label: "Presence",
                fillColor: presenceColorArray,
                strokeColor: "rgba(60,141,188,0.8)",
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: presenceArrayData
            };

            var dataOccupation = {
                label: "Occupation",
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
                labels: labelMonth,

                datasets: [dataPresence]


            };

            var occupationAreaChartData = {
                labels: labelMonth,


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
