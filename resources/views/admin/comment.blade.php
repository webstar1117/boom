@extends('layouts.master')

@section('title') Comment @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common.breadcrumb')
@slot('title') Comments @endslot
@slot('li_1') @endslot
@endcomponent

<div class="d-flex justify-content-end">
    <button class="btn btn-primary" onclick="ReadyCreate()">
        Create New Comment
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
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sr.no</th>
                            <th>Blog Title</th>
                            <th>Comment Author</th>
                            <th>Comment Content</th>
                            <th>Created At</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($comments as $key=>$comment)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$comment->blog->title}} </td>
                            <td>{{$comment->user->firstname}}&nbsp;{{$comment->user->lastname}} </td>
                            <td>{{strlen($comment->content)>20?substr($comment->content,0,20):$comment->content}}</td>
                            <td>{{$comment->created_at}}</td>
                            <td style="cursor:pointer"><i class="fas fa-edit text-success" onclick="ReadyEdit('{{$comment}}')"></i></td>
                            <td style="cursor:pointer"><i class="fas fa-window-close text-danger" onclick="ReadyDel('{{$comment->id}}')"></i></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="modal fade bs-example-modal-lg overflow-auto" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Create New Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="create_form" method="post" action="{{url('/admin/comment/create')}}">
                    {{ csrf_field() }}
                    <div class="row mb-2">
                        <div class="col-2">
                            <label>Blog Names</label>
                        </div>
                        <div class="col-10">
                            <select class="w-100" name="blog_id" id="blog_id" required>
                                @foreach($blogs as $key=>$blog)
                                <option value="{{$blog->id}}">{{$blog->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-2">
                            <label>Content</label>
                        </div>
                        <div class="col-10">
                            <textarea class="w-100" name="content" id="content"></textarea>
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
<div class="modal fade bs-example-modal-lg overflow-auto" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_form" method="post" action="{{url('/admin/comment/edit')}}">
                    {{ csrf_field() }}
                    <div class="row mb-2">
                        <div class="col-2">
                            <label>Content</label>
                        </div>
                        <div class="col-10">
                            <textarea class="ckeditor form-control" name="content" id="content_edit" required></textarea>
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
<div class="modal fade bs-example-modal-lg" id="del_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Do you really want to delete this comment?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_form" method="post" action="{{url('/admin/comment/delete')}}">
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

    function ReadyEdit(comment) {
        var comment = JSON.parse(comment);

        $('#id_edit').val(comment.id);
        $('#content_edit').val(comment.content);
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