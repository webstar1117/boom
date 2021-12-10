@extends('layouts.master')

@section('title') FoodGemLimit @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common.breadcrumb')
        @slot('title') FoodGemLimit @endslot
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
                                <th>Min-Food(gems)</th>
                                <th>Max-Food(gems)</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($all_attack_limit as $key=>$attack_limit)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$attack_limit->attack_limit_min}}</td>
                                <td>{{$attack_limit->attack_limit_max}}</td>
                                <td style="cursor:pointer">
                                    <a href="{{ url('admin/attack-limit/edit') }}">
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


@endsection
