@extends('user_navbar')
@section('content')

    {{-- Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="storeMobile" action="{{ route('storeUser') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-body">

                            <div class="mb-1">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-1">
                                <label for="name" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" required>
                            </div>
                            <div class="mb-1">
                                <label for="name" class="form-label">Password</label>
                                <input type="text" class="form-control" name="password" required>
                            </div>

                        </div>
                        <div class="form-actions">
                            <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                                <i class="feather icon-x"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check-square-o"></i> Save
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- End Modal --}}


    {{-- Edit Modal --}}

    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="editmobile" action="{{ route('updateUser') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-body">

                            <div class="mb-1">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" type="hidden" name="id" id="id" value="Update">
                                <input type="text" class="form-control" id="vname" name="name" required>
                            </div>
                            <div class="mb-1">
                                <label for="name" class="form-label">Email</label>
                                <input type="text" class="form-control" id="vemail" name="email" required>
                            </div>
                            <div class="mb-1">
                                <label for="name" class="form-label">Password</label>
                                <input type="text" class="form-control" id="vpassword" name="password" required>
                            </div>

                           

                        </div>
                        <div class="form-actions">
                            <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                                <i class="feather icon-x"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check-square-o"></i> Save
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- End Edit Modal --}}


    {{-- Delete Modal --}}

  

    {{-- End Delete Modal --}}
    <style>
        .card {
            border-radius: 12px;

        }
    </style>

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @if (session('success'))
                    <div class="alert alert-success" id="successMessage">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('danger'))
                    <div class="alert alert-danger" id="dangerMessage" style="color: red;">
                        {{ session('danger') }}
                    </div>
                @endif

                {{-- <button type="button" class="btn btn-primary ml-1" data-toggle="modal" data-target="#exampleModal">
                    <i class="bi bi-plus"></i> Add User
                </button> --}}

                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 latest-update-tracking mt-1 ">
                    <div class="card ">
                        <div class="card-header latest-update-heading d-flex justify-content-between">
                            <h4 class="latest-update-heading-title text-bold-500">Available Users</h4>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Created At</th>

                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Action</th>
                                        <!-- <th>Logout User</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->created_at }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->password_text }}</td>
                                            <td>
                                                <a href="" onclick="edit({{ $user->id }})" data-toggle="modal"
                                                    data-target="#exampleModal1">
                                                    <i class="feather icon-edit"></i></a>
                                            </td>
                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <script>
        //  Edit Function
        function edit(value) {
            console.log(value);
            var id = value;
            $.ajax({
                type: "GET",
                url: '/edituser/' + id,
                success: function (data) {
                    $("#editmobile").trigger("reset");

                    $('#id').val(data.result.id);
                    $('#vname').val(data.result.name);
                    $('#vemail').val(data.result.email);
                    $('#vpassword').val(data.result.password_text);
                    $('#is_active').val(data.result.is_active);


                },
                error: function (error) {
                    console.log('Error:', error);
                }
            });
        }

        // End Edit Function

        //  Delete Function
        function remove(value) {
            console.log(value);
            var id = value;
            $.ajax({
                type: "GET",
                url: '/editgroup/' + id,
                success: function (data) {
                    $("#deleteMobile").trigger("reset");

                    $('#did').val(data.result.id);
                    $('#dname').val(data.result.name);

                },
                error: function (error) {
                    console.log('Error:', error);
                }
            });
        }

        // End Edit Function
    </script>

@endsection