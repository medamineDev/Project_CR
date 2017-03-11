@extends("layouts.app")

@section("css")

<style>


    .container{
        text-align: center;

    }

    th{

        text-align: center;
    }

    .table_content{

        display: inline-block;
        width: 950px;
        margin-top: 35px;
        margin-left: -22px;
    }
    .pagination{
        display: inline-block;
    }

    .table{
        background-color: rgba(178, 150, 150, 0.22);
        margin-left: -22px;
    }
    thead{

        border: 1px solid rgba(192, 192, 192, 0.53);
        background-color: silver;
        text-align: center;
    }

</style>

@endsection

@section("content")

    @include("partials.header")

    <div class="content-wrapper">

        <div class="container">


            <div class="table_content">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>center</th>
                        <th>role</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($users as $user)


                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>

                                <button type="button" class="btn btn-default">Edit</button>
                                <button type="button" class="btn btn-warning">Remove</button>

                            </td>
                        </tr>

                    @endforeach


                    </tbody>
                </table>


                <div class="pagination">
                    {!! $users->render() !!}
                </div>


            </div>



        </div>




    </div>



    @include("partials.footer")

@endsection


@section("javascript")



@endsection

