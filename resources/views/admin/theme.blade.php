@extends('layouts.master')

@section('title') Theme @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common.breadcrumb')
        @slot('title') Themes @endslot
        @slot('li_1') @endslot
    @endcomponent

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary" onclick="ReadyCreate()">
            Create New Theme
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
                                <th>Name</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>CSS File Name</th>
                                <th>Created At</th>
                                <th>Edit</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($themes as $key => $th)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $th->name }} </td>
                                    <td>{{ $th->theme_category->name }}</td>
                                    <td style="width:10%">
                                        <img class="w-100" src="{{ asset('/assets/images/themes/screenshot/' . $th->image) }}" />
                                    </td>
                                    <td>{{ $th->css_file }}</td>
                                    <td>{{ $th->created_at }}</td>
                                    <td style="cursor:pointer"><i class="fas fa-edit text-success" onclick="ReadyEdit(
                                        '{{ $th->id }}','{{ $th->name }}','{{ $th->category_id }}','{{ $th->image }}',
                                        '{{ $th->css_file }}'
                                        )"></i></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="modal fade bs-example-modal-lg overflow-auto" id="create_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg max-width-95">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Create New Theme</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="create_form" method="post" action="{{ url('/admin/theme/create') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row mb-2">
                            <div class="col-2">
                                <label>Name</label>
                            </div>
                            <div class="col-10">
                                <input class="w-75" type="text" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2">
                                <label>Category</label>
                            </div>
                            <div class="col-10">
                                <select name="category_id" id="category_id" required>
                                    @foreach ($theme_categories as $key => $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2">
                                <span>image</span>
                            </div>
                            <div class="col-10">
                                <div class="mb-2">
                                    <img id="image" class="w-50" />
                                </div>
                                <div>
                                    <input name="image" id="imgInp" type="file" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2">
                                <label>CSS File Name</label>
                            </div>
                            <div class="col-10">
                                <input class="w-75" type="file" name="css_file" id="css_file" required>
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
    <div class="modal fade bs-example-modal-lg overflow-auto" id="edit_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg max-width-95">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit Theme</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" method="post" action="{{ url('/admin/theme/edit') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row mb-2">
                            <div class="col-2">
                                <label>Name</label>
                            </div>
                            <div class="col-10">
                                <input class="w-75" type="text" name="name" id="name_edit" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2">
                                <label>Category</label>
                            </div>
                            <div class="col-10">
                                <select name="category_id" id="category_id_edit" required>
                                    @foreach ($theme_categories as $key => $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2">
                                <span>image</span>
                            </div>
                            <div class="col-10">
                                <div class="mb-2">
                                    <img id="image_edit" class="w-50" />
                                </div>
                                <div>
                                    <input name="image" id="imgInp_edit" type="file">
                                </div>
                                <div>
                                    <span>
                                        Current Image:
                                    </span>
                                    <span id="current_image_name">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2">
                                <label>CSS File Name</label>
                            </div>
                            <div class="col-10">
                                <div>
                                    <input class="w-75" type="file" name="css_file" id="css_file_edit">
                                </div>
                                <div>
                                    <span>
                                        Current CSS File:
                                    </span>
                                    <span id="current_css_file_name">
                                    </span>
                                </div>
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
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Do you really want to delete this theme?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" method="post" action="{{ url('/admin/theme/delete') }}">
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
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
            $('#name').val('');
            $('#image').attr('src', '');
            $('#imgInp').attr('src', '');
            $('#image').val('');
            $('#imgInp').val('');

            $('#create_modal').modal('hide');
        }

        //edit------------------------------------

        var img_folder = '/assets/images/themes/';
        var css_folder = '/assets/css/';

        function ReadyEdit(id, name, category_id, image, css_file) {
            $('#id_edit').val(id);
            $('#name_edit').val(name);
            $('#category_id_edit').val(category_id);
            $('#image_edit').attr('src', img_folder + image);
            $('#imgInp_edit').attr('src', img_folder + image);
            $('#current_image_name').text(image);
            $('#current_css_file_name').text(css_file);
            $('#edit_modal').modal('show');
        }


        function EditCancel() {
            $('#id_edit').val('');
            $('#name_edit').val('');
            $('#category_id_edit').val('');
            $('#image_edit').val('');
            $('#imgInp_edit').val( '');
            $('#current_image_name').text('');
            $('#current_css_file_name').text('');

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
