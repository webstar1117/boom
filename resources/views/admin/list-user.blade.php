@extends('layouts.master')

@section('title') ListUser @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common.breadcrumb')
        @slot('title') ListUser @endslot
        @slot('li_1') @endslot
    @endcomponent

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary" onclick="ReadyCreate()">
            Create New User
        </button>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Plan</th>
                                <th>Created At</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($all_users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->firstname }}</td>
                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->plan_id?$user->plan->name:null }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td style="cursor:pointer"><i class="fas fa-edit text-success" onclick="ReadyEdit(
                                        '{{ $user->id }}',
                                        '{{ $user->firstname }}',
                                        '{{ $user->lastname }}',
                                        '{{ $user->email }}',
                                        '{{ $user->plan_id }}',
                                        '{{ $user->role }}',
                                        '{{ $key }}'
                                    )"></i></td>
                                    <td style="cursor:pointer"><i class="fas fa-window-close text-danger"
                                            onclick="ReadyDel('{{ $user->id }}')"></i></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="modal fade bs-example-modal-lg" id="create_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Create New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="create_form" method="post" action="{{ url('/admin/list-user/createUser') }}">
                        {{ csrf_field() }}

                        <div class="row mb-2">
                            <div class="col-4">
                                <label>Firstname</label>
                            </div>
                            <div class="col-8">
                                <input class="w-75" type="text" name="firstname" id="firstname" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label>Lastname</label>
                            </div>
                            <div class="col-8">
                                <input class="w-75" type="text" name="lastname" id="lastname" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label>Email</label>
                            </div>
                            <div class="col-8">
                                <input class="w-75" type="email" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label>Password</label>
                            </div>
                            <div class="col-8">
                                <input class="w-75" type="password" name="password" id="password" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label>Confirm Password</label>
                            </div>
                            <div class="col-8">
                                <input class="w-75" type="password" name="password_confirmation"
                                    id="password_confirmation" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label>Role</label>
                            </div>
                            <div class="col-8">
                                <select name="role" id="role">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label>Plan</label>
                            </div>
                            <div class="col-8">
                                <select name="plan_id" id="plan_id">
                                    @foreach ($plans as $key => $mem)
                                        <option value="{{ $mem->id }}">{{ $mem->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger waves-effect waves-light">
                                Submit
                            </button>

                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="CreateCancel()">
                                Cancel
                            </button>
                        </div>
                    </form>


                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade bs-example-modal-lg" id="edit_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" method="post" action="{{ url('/admin/list-user/editUser') }}">
                        {{ csrf_field() }}

                        <div class="row mb-2">
                            <div class="col-4">
                                <label>Firstname</label>
                            </div>
                            <div class="col-8">
                                <input class="w-75" type="text" name="firstname" id="firstname_edit">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label>Lastname</label>
                            </div>
                            <div class="col-8">
                                <input class="w-75" type="text" name="lastname" id="lastname_edit">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label>Email</label>
                            </div>
                            <div class="col-8">
                                <input class="w-75" type="email" name="email" id="email_edit">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label>Role</label>
                            </div>
                            <div class="col-8">
                                <select name="role" id="role_edit">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label>Plan</label>
                            </div>
                            <div class="col-8">
                                <select name="plan_id" id="plan_edit">
                                    @foreach ($plans as $key => $mem)
                                        <option value="{{ $mem->id }}">{{ $mem->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="text" name="id" id="id_edit" hidden>
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger waves-effect waves-light">
                                Submit
                            </button>

                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="EditCancel()">
                                Cancel
                            </button>
                        </div>
                    </form>


                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade bs-example-modal-lg" id="del_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Do you really want to delete this user?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" method="post" action="{{ url('/admin/list-user/delUser') }}">
                        {{ csrf_field() }}
                        <input type="text" name="id" id="id" hidden>
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger waves-effect waves-light">
                                Submit
                            </button>
                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="DelCancel()">
                                Cancel
                            </button>
                        </div>
                    </form>


                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('script')
    <!-- plugin js -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>

    <!-- Calendar init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>

    <!-- Init js-->
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script>
        //create-----------------------------------

        function ReadyCreate(id) {
            $('#create_modal').modal('show');
        }

        function CreateCancel() {
            $('#create_modal').modal('hide');
        }

        //edit------------------------------------

        function ReadyEdit(id,firstname,lastname,email,plan_id,role,idx) {

            $('#id_edit').val(id);
            $('#firstname_edit').val(firstname);
            $('#lastname_edit').val(lastname);
            $('#email_edit').val(email);
            $('#role_edit').val(role);
            $('#plan_edit option').each(function() {
                if ($(this).val() == plan_id)
                    $(this).attr('selected', true)
            })
            $('#edit_modal').modal('show');
        }


        function EditCancel() {
            $('#edit_modal').modal('hide');
        }

        //delete-------------------------------------

        function ReadyDel(id) {
            $('#id').val(id);
            $('#del_modal').modal('show');
        }

        function DelCancel() {
            $('#del_modal').modal('hide');
        }
    </script>
@endsection
