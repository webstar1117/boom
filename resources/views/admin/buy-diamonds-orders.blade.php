@extends('layouts.master')

@section('title') Buy diamonds orders @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common.breadcrumb')
        @slot('title') Buy diamonds orders @endslot
        @slot('li_1')  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>Usernane</th>
                                <th>Email</th>
                                <th>Diamond</th>
                                <th>INR</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>


                        <tbody>
                        @foreach($all_buy_diamonds_orders as $key=>$buy_diamonds_orders)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$buy_diamonds_orders->user->name}}</td>
                                <td>{{$buy_diamonds_orders->user->email}}</td>
                                <td>{{$buy_diamonds_orders->buy_diamonds_orders_diamonds}}</td>
                                <td>{{$buy_diamonds_orders->buy_diamonds_orders_inr}}</td>
                                <td>{{$buy_diamonds_orders->buy_diamonds_orders_created_date}}</td>
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
