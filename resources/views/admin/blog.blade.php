@extends('layouts.master')

@section('title') Blog @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')

    @component('common.breadcrumb')
        @slot('title') Blogs @endslot
        @slot('li_1') @endslot
    @endcomponent

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary" onclick="ReadyCreate()">
            Create New Blog
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
                                <th>Author</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Title Image</th>
                                <th>Content</th>
                                <th>Categories</th>
                                <th>Created At</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($blogs as $key => $blog)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $blog->user->firstname }}&nbsp;{{ $blog->user->lastname }} </td>
                                    <td>{{ strlen($blog->title) > 20 ? substr($blog->title, 0, 20) : $blog->title }}</td>
                                    <td>{{ strlen($blog->subtitle) > 20 ? substr($blog->subtitle, 0, 20) : $blog->subtitle }}
                                    </td>
                                    <td>{{ $blog->image }}</td>
                                    <td>{{ strlen($blog->content) > 20 ? substr($blog->content, 0, 20) : $blog->content }}
                                    </td>
                                    <td>{{ $blog->blog_category->name }}</td>
                                    <td>{{ $blog->created_at }}</td>
                                    <td style="cursor:pointer"><i class="fas fa-edit text-success" onclick="ReadyEdit(
                                        '{{ $blog->id }}','{{ $blog->title }}','{{ $blog->subtitle }}','{{ $blog->image }}',
                                        `{{ $blog->content }}`,'{{ $blog->category }}'
                                        )"></i></td>
                                    <td style="cursor:pointer"><i class="fas fa-window-close text-danger"
                                            onclick="ReadyDel('{{ $blog->id }}')"></i></td>
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
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Create New Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="create_form" method="post" action="{{ url('/admin/blog/create') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row mb-2">
                            <div class="col-2">
                                <label>Title</label>
                            </div>
                            <div class="col-10">
                                <input class="w-75" type="text" name="title" id="title" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2">
                                <label>Subtitle</label>
                            </div>
                            <div class="col-10">
                                <input class="w-75" type="text" name="subtitle" id="subtitle" required>
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
                                <label>Content</label>
                            </div>
                            <div class="col-10">
                                <textarea name="content" id="content"></textarea>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2">
                                <label>Categories</label>
                            </div>
                            <div class="col-10">
                                <select name="category" id="category" required>
                                    @foreach ($blog_categories as $key => $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
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
    <div class="modal fade bs-example-modal-lg overflow-auto" id="edit_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg max-width-95">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" method="post" action="{{ url('/admin/blog/edit') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row mb-2">
                            <div class="col-2">
                                <label>Title</label>
                            </div>
                            <div class="col-10">
                                <input class="w-75" type="text" name="title" id="title_edit" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2">
                                <label>Subtitle</label>
                            </div>
                            <div class="col-10">
                                <input class="w-75" type="text" name="subtitle" id="subtitle_edit" required>
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
                                    <input name="image" id="imgInp_edit" type="file" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2">
                                <label>Content</label>
                            </div>
                            <div class="col-10">
                                <textarea class="ckeditor form-control" name="content" id="content_edit"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2">
                                <label>Categories</label>
                            </div>
                            <div class="col-10">
                                <select name="category" id="category_edit" required>
                                    @foreach ($blog_categories as $key => $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
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
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Do you really want to delete this blog?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" method="post" action="{{ url('/admin/blog/delete') }}">
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

        var img_folder = '/assets/images/blogs/';

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
