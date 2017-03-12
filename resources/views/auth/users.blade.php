@extends("layouts.app")

@section("css")

    <style>

        .modal-footer {
            border-top-color: #3c8dbc;
            border-width: 2px;
        }

        .detail_row span {

            font-weight: 600;
            color: cornflowerblue;
        }

        .detail_row input {
            height: 27px;
            border: 1px solid silver;
        }

        .detail_row select {
            width: 170px;
            height: 27px;
            font-size: smaller;
        }

        .container {
            text-align: center;

        }

        th {

            text-align: center;
        }

        .table_content {

            display: inline-block;
            width: 950px;
            margin-top: 35px;
            margin-left: -22px;
        }

        .pagination {
            display: inline-block;
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

        .imgProfile {

            background: url("http://assets.ngin.com/site_files/2731/i/blank-profile.png");
            background-size: 113px 100px;
            background-repeat: no-repeat;
            height: 104px;

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
                        <th>User Name</th>
                        <th>center</th>
                        <th>role</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($users as $user)


                        <tr id="row-{{ $user->id }}">
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->nom }}</td>
                            <td>{{ $user->label }}</td>
                            <td>

                                <button type="button" id="editButton" class="btn btn-default editButton"
                                        data-user-id="{{ $user->id }}" data-toggle="modal" data-target="#myModalEdit">
                                    Edit
                                </button>

                                <button type="button" id="removeButton" class="btn btn-warning removeButton"
                                        data-user-id="{{ $user->id }}" data-toggle="modal" data-target="#myModalRemove">
                                    Remove
                                </button>
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


    <!-- Modal edit -->
    <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">profile</h4>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-3">

                            <div class="imgProfile">
                            </div>


                        </div>

                        <div class="col-md-4">
                            <div class="profil_content">

                                <div class="detail_row">
                                    <span>Nom</span><label>
                                        <input class="form-control" value="amine" id="us_nom" type="text"
                                               placeholder="nom">

                                    </label>
                                </div>

                                <div class="detail_row">
                                    <span>Prenom</span><label>
                                        <input class="form-control" id="us_prenom" type="text" value="Aouidane"
                                               placeholder="prenom">

                                    </label>
                                </div>

                                <div class="detail_row">
                                    <span>Pseudo</span><label>
                                        <input class="form-control" id="us_username" type="text" value="amineDev"
                                               placeholder="pseudo">

                                    </label>
                                </div>

                            </div>


                        </div>


                        <div class="col-md-4 col-md-offset-1">
                            <div class="profil_content">

                                <div class="detail_row">
                                    <span>Roles</span>
                                    <label>

                                        <select id="role_select" class="form-control">

                                            @foreach($roles as $role)

                                                <option id="{{ $role->id }}">{{ $role->label }}</option>

                                            @endforeach


                                        </select>
                                    </label>
                                </div>

                                <div class="detail_row">
                                    <span>Centres</span><label>

                                        <select id="centres_select" class="form-control">

                                            @foreach($centres as $centre)

                                                <option id="{{ $centre->id }}">{{ $centre->nom }}</option>

                                            @endforeach


                                        </select>

                                    </label>
                                </div>

                            </div>

                        </div>


                    </div><!-- end row -->


                </div><!-- end modal-content -->


                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="saveEditButton" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal remove -->
    <div class="modal fade" id="myModalRemove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                </div>
                <div class="modal-body removeModalBody">

                    <h4 style="text-align: center; color: indianred">Merci de confirmer la supression !</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anuller</button>
                    <button type="button" id="confirmDeleteButton" class="btn btn-primary">Confimer</button>
                </div>
            </div>
        </div>
    </div>




    @include("partials.footer")

@endsection


@section("javascript")


    <script type="text/javascript">

        $(document).ready(function () {

            var selectedUser = 0;
            $(".removeModalBody").hide();

            var editedUser = {};


            <!--------------  ws calls -------------->


            function removeUserFn(userId, _callback) {


                var wsUrl = 'removeUser/' + userId;
                $.ajax({
                    url: wsUrl,
                    type: 'get',
                    error: function () {

                        _callback(false)
                    },
                    success: function (data) {

                        var status = data["status"];
                        _callback(status);


                    }

                });


            }


            function getUserById(userId, _callback) {


                var wsUrl = 'getUserById/' + userId;
                $.ajax({
                    url: wsUrl,
                    type: 'get',
                    error: function () {

                        _callback(false, false)
                    },
                    success: function (data) {

                        var status = data["status"];
                        var response = data["response"];
                        _callback(status, response);

                    }

                });


            }


            function editUser(user, _callback) {


                var wsUrl = 'editUser/';
                $.ajax({
                    url: wsUrl,
                    type: 'put',
                    data: {user: user},

                    error: function () {

                        _callback(false, false)
                    },
                    success: function (data) {

                        var status = data["status"];
                        var response = data["response"];
                        _callback(status, response);

                    }

                });


            }


            <!--------------  end  ws calls -------------->



            $('#saveEditButton').click(function () {

                editedUser = {
                    userId: selectedUser,
                    userRole: $("#role_select").find('option:selected').attr('id'),
                    userCenter: $("#centres_select").find('option:selected').attr('id'),
                    firstName: $("#us_nom").val(),
                    lastName: $("#us_prenom").val(),
                    userName: $("#us_username").val()
                };
                editUser(editedUser, function (status, updatedObject) {

                    if (updatedObject) {

                        console.log(updatedObject);

                        $('#myModalEdit').modal("hide");
                        showSuccessMessage(false);


                        /* edit row without calling Ws  again */
                        var centerName = $("#centres_select").find('option:selected').val();
                        var roleName = $("#role_select").find('option:selected').val();
                        $("#row-" + selectedUser + " td:nth-child(2)").html(editedUser["firstName"]);
                        $("#row-" + selectedUser + " td:nth-child(3)").html(editedUser["lastName"]);
                        $("#row-" + selectedUser + " td:nth-child(4)").html(editedUser["userName"]);
                        $("#row-" + selectedUser + " td:nth-child(5)").html(centerName);
                        $("#row-" + selectedUser + " td:nth-child(6)").html(roleName);


                        /* animate row */
                        $('#row-' + selectedUser).fadeIn(500);
                        $('#row-' + selectedUser).fadeOut(500);
                        $('#row-' + selectedUser).fadeIn(500);



                    } else {

                        showErrorMessage(false);

                    }

                });


            });


            $('.editButton').click(function () {

                var dataUserId = this.getAttribute('data-user-id');
                selectedUser = dataUserId;

                getUserById(selectedUser, function (isFound, user) {

                    if (isFound) {

                        var firstName = user["first_name"];
                        var lastName = user["last_name"];
                        var userName = user["username"];
                        var centreName = user["nom"];
                        var roleName = user["label"];
                        $("#centres_select").val(centreName);
                        $("#role_select").val(roleName);
                        $("#us_nom").val(firstName);
                        $("#us_prenom").val(lastName);
                        $("#us_username").val(userName);


                    } else {

                        showErrorMessage(false);
                        $('#myModalEdit').modal("hide");
                    }

                });


            });


            $('.removeButton').click(function () {

                var dataUserId = this.getAttribute('data-user-id');
                selectedUser = dataUserId;


            });
            $('#confirmDeleteButton').click(function () {


                removeUserFn(selectedUser, function (isRemoved) {

                    if (isRemoved) {

                        $('#myModalRemove').modal("hide");
                        $('#row-' + selectedUser).css("background-color", "red");
                        $('#row-' + selectedUser).fadeIn(500);
                        $('#row-' + selectedUser).fadeOut(500);
                        $('#row-' + selectedUser).fadeIn(500);
                        $('#row-' + selectedUser).fadeOut(500);
                        setTimeout(function () {

                            $('#row-' + selectedUser).hide(1000);
                            $('#row-' + selectedUser).remove();

                            /* if no rows in table , refresh */
                            var countTotalRows =  $('tbody tr').length;
                            if(countTotalRows == 0){

                                location.reload();
                            }

                        }, 2500);



                        showSuccessMessage(false);
                    } else {

                        showErrorMessage(false);
                    }

                });


            });


            $('#myModalEdit').on('shown.bs.modal', function () {


            })
            $('#myModalRemove').on('shown.bs.modal', function () {

                $(".removeModalBody").show(200);


            })
            $('#myModalRemove').on('hide.bs.modal', function () {

                $(".removeModalBody").hide(200);


            })


        })

    </script>

@endsection

