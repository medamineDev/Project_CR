@extends("layouts.app")

@section("css")

    <style>

        th {

            text-align: center;
        }

        td {

            border-left: 1px solid silver;
        }

        .table_content {

            display: inline-block;
            width: 950px;
            margin-top: 35px;
            margin-left: -22px;
        }

        .table {
            background-color: rgba(178, 150, 150, 0.22);
            margin-left: -22px;
        }

        thead {

            border: 1px solid rgba(192, 192, 192, 0.53);
            background-color: silver;
            text-align: center;
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
                <small>Monthly</small>

            </h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">monthly</li>

            </ol>

        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">

                <div class="col-md-2" style="display: table-cell;">


                    <div class="thisYear" style="vertical-align: middle">

                        <h3>Fevrier/2017</h3>
                    </div>

                </div>

                <div class="col-md-10">


                    <div class="table_content">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Data</th>
                                <th>Avril</th>
                                <th>Mai</th>
                                <th>Juin</th>
                                <th>Juillet</th>
                                <th>Aout</th>
                                <th>Oct</th>
                                <th>Sep</th>
                                <th>Nov</th>
                                <th>Dec</th>
                                <th>Jan</th>
                                <th>Fev</th>
                                <th>Mar</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <th scope="row">Occupation(jours)</th>

                                @if($occupationData)
                                    @foreach($occupationData  as $occupation)

                                        <td id="col-{{ $occupation->id }}">{{ $occupation->nbJours }} </td>


                                    @endforeach


                                @else
                                    @for ($i = 0; $i < 12; $i++)
                                        <td></td>
                                    @endfor

                                @endif

                            </tr>


                            <tr>
                                <th scope="row">Presences(jours)</th>

                                @if($presenceData)
                                    @foreach($presenceData  as $presence)

                                        <td id="col-P-{{ $presence->id }}">{{ $presence->nbJours }} </td>


                                    @endforeach


                                @else
                                    @for ($i = 0; $i < 12; $i++)
                                        <td></td>
                                    @endfor

                                @endif

                            </tr>



                            <tr>
                                <th scope="row">Etat Financier($)</th>

                                @if($productData)
                                    @foreach($productData  as $product)

                                        <td id="col-P-{{ $product->id }}">{{ $product->montant }} </td>


                                    @endforeach


                                @else
                                    @for ($i = 0; $i < 12; $i++)
                                        <td></td>
                                    @endfor

                                @endif

                            </tr>




                            </tbody>
                        </table>

                    </div>


                </div>


            </div>


        </section>
        <!-- /.content -->
    </div>

    @include("partials.footer")

@endsection