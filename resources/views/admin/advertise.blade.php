@extends('layouts.master')

@section('title') Advertise @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common.breadcrumb')
        @slot('title') Advertise @endslot
        @slot('li_1')  @endslot
    @endcomponent

    <button  class="text-white" style="position: relative;left: 90%;bottom: 17px;">
        <a href="{{ url('/admin/advertise/add') }}">
        Add Advertise
        </a>
    </button>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>Advertise Name</th>
                                <th>Edit</th>
                            </tr>
                        </thead>


                        <tbody>
                        @foreach($all_advertise as $key=>$advertise)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$advertise->advertise_name}}</td>
                                <td style="cursor:pointer">
                                    <a href="{{ url('admin/advertise/'.$advertise->advertise_id) }}">
                                        <i class="fas fa-edit text-success">
                                        </i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
        
            </div>
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

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection
