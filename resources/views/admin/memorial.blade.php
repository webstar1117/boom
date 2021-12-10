@extends('layouts.master')

@section('title') Memorial @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')

    @component('common.breadcrumb')
        @slot('title') Memorials @endslot
        @slot('li_1') @endslot
    @endcomponent

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="javascript:;" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
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
                                <th>Author</th>
                                <th>Firstname</th>
                                <th>Middlename</th>
                                <th>Lastname</th>
                                <th>Relationship</th>
                                <th>Designation</th>
                                <th>Born year</th>
                                <th>Born month</th>
                                <th>Born day</th>
                                <th>Born city</th>
                                <th>Born state</th>
                                <th>Born country</th>
                                <th>Passed year</th>
                                <th>Passed month</th>
                                <th>Passed day</th>
                                <th>Passed city</th>
                                <th>Passed state</th>
                                <th>Passed country</th>
                                <th>Site address</th>
                                <th>Plan</th>
                                <th>Privacy</th>
                                <th>Payment Status</th>
                                <th>Payment Created Date</th>
                                <th>Theme</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($memorials as $key => $memorial)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $memorial->user->firstname }}&nbsp;{{ $memorial->user->lastname }} </td>
                                    <td>{{ $memorial->firstname }}</td>
                                    <td>{{ $memorial->middlename }}</td>
                                    <td>{{ $memorial->lastname }}</td>
                                    <td>{{ $memorial->relationship->name }}</td>
                                    <td>{{ $memorial->designation->name }}</td>
                                    <td>{{ $memorial->born_year }}</td>
                                    <td>{{ $memorial->born_month }}</td>
                                    <td>{{ $memorial->born_day }}</td>
                                    <td>{{ $memorial->born_city }}</td>
                                    <td>{{ $memorial->born_state }}</td>
                                    <td>{{ $memorial->born_country }}</td>
                                    <td>{{ $memorial->passed_year }}</td>
                                    <td>{{ $memorial->passed_month }}</td>
                                    <td>{{ $memorial->passed_day }}</td>
                                    <td>{{ $memorial->passed_city }}</td>
                                    <td>{{ $memorial->passed_state }}</td>
                                    <td>{{ $memorial->passed_country }}</td>
                                    <td>{{ $memorial->site_address }}</td>
                                    <td>{{ $memorial->plan->name }}</td>
                                    <td>{{ $memorial->privacy_name }}</td>
                                    <td>{{ $memorial->payment_status }}</td>
                                    <td>{{ $memorial->payment_created_date }}</td>
                                    <td>{{ $memorial->theme->name }}</td>
                                    <td style="cursor:pointer"><i class="fas fa-window-close text-danger"
                                            onclick="ReadyDel('{{ $memorial->id }}')"></i></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


    <div class="modal fade bs-example-modal-lg" id="del_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Do you really want to delete this memorial?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" method="get" action="{{ url('/admin/memorial/delete') }}">
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
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>

    <!-- Init js-->
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 300,
            });
        });

        //create-----------------------------------

        function ReadyCreate(id) {
            $('#create_modal').modal('show');
        }

        function CreateCancel() {
            $('#create_modal').modal('hide');
        }

        //edit------------------------------------

        var img_folder = '/assets/images/memorials/';

        function ReadyEdit(id, title, subtitle, image, content, category) {
            $('#id_edit').val(id);
            $('#title_edit').val(title);
            $('#subtitle_edit').val(subtitle);
            $('#image_edit').attr('src', img_folder + image);
            $('#content_edit').summernote('destroy');
            $('#content_edit').summernote('code', content);
            $('#category_edit').val(category);
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

        $("#imgInp").change(function() {
            readURL(this, '#image');
        });
        $("#imgInp_edit").change(function() {
            readURL(this, '#image_edit');
        });

        function readURL(input, param) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(param).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
