@extends('layouts.master')

@section('title') Contact @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common.breadcrumb')
@slot('title') Contacts @endslot
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sr.no</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Memorial Name</th>
                            <th>Message Subject</th>
                            <th>Message Content</th>
                            <th>Created At</th>
                            <th>Delete</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($contacted_messages as $key=>$mess)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$mess->name}}</td>
                            <td>{{$mess->email}}</td>
                            <td>{{$mess->memorial_name}}</td>
                            <td>{{strlen($mess->message_subject)>20?substr($mess->message_subject,0,20):$mess->message_subject}}</td>
                            <td>{{strlen($mess->message_content)>20?substr($mess->message_content,0,20):$mess->message_content}}</td>
                            <td>{{$mess->created_at}}</td>
                            <td style="cursor:pointer"><i class="fas fa-window-close text-danger" onclick="ReadyDel('{{$mess->id}}')"></i></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="modal fade bs-example-modal-lg" id="del_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Do you really want to delete this contacted message?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_form" method="post" action="{{url('/admin/contact/delete')}}" >
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