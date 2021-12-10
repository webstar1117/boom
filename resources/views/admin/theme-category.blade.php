@extends('layouts.master')

@section('title') Theme-category @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common.breadcrumb')
@slot('title') Theme-category @endslot
@slot('li_1') @endslot
@endcomponent

<div class="d-flex justify-content-end">
    <button class="btn btn-primary" onclick="ReadyCreate()">
        Create New Category
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
                            <th>Category Name</th>
                            <th>Edit</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($theme_categories as $key=>$cate)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$cate->name}}</td>
                            <td style="cursor:pointer"><i class="fas fa-edit text-success" onclick="ReadyEdit('{{$cate}}','{{$key}}')"></i></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="modal fade bs-example-modal-lg" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Create New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="create_form" method="post" action="{{url('/admin/theme-category/create')}}">
                    {{ csrf_field() }}
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Category Name</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="text" name="category" id="category" required>
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
<div class="modal fade bs-example-modal-lg" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_form" method="post" action="{{url('/admin/theme-category/edit')}}">
                    {{ csrf_field() }}

                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Category Name</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="text" name="category" id="category_edit">
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Do you really want to delete this category?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_form" method="post" action="{{url('/admin/theme-category/delete')}}">
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

    function ReadyEdit(cate, idx) {
        var cate = JSON.parse(cate);
        $('#id_edit').val(cate.id);
        $('#category_edit').val(cate.name);
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