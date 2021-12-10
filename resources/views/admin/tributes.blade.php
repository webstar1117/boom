@extends('layouts.master')

@section('title') Tribute @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')

    @component('common.breadcrumb')
        @slot('title') Tributes @endslot
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
                                <th>Memorial Name</th>
                                <th>Author</th>
                                <th>Tribute</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($tributes as $key => $tribute)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $tribute->memorial->site_address }}</td>
                                    <td>{{ $tribute->user->firstname }}&nbsp;{{ $tribute->user->lastname }} </td>
                                    <td>{{ $tribute->content }}</td>
                                    <td style="cursor:pointer"><i class="fas fa-window-close text-danger"
                                            onclick="ReadyDel('{{ $tribute->id }}')"></i></td>
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
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Do you really want to delete this tribute?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" method="get" action="{{ url('/admin/tributes/delete') }}">
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
