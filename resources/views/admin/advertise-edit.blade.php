@extends('layouts.master')

@section('title') Advertise-Edit @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common.breadcrumb')
        @slot('title') Advertise Edit @endslot
        @slot('li_1')  @endslot
    @endcomponent
    
    <button  class="text-white" style="position: relative;left: 96%;bottom: 17px;">
        <a href="{{ url('/admin/advertise') }}">
        List All
        </a>
    </button>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
               
                <form method="post" action="{{ url('/admin/advertise/confirmEdit') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Advertise Name</span>
                        </div>
                        <div class="col-8">
                            <textarea class="w-50" type="text" name="name" style="height:300px" required> 
                            {{$advertise->advertise_name}}
                            </textarea> 
                        </div>
                        <input type=text name="id" value="{{$advertise->advertise_id}}" hidden>
                    </div>
                    <div class="text-center">
                        <button type="submit">Submit</button>                 
                    </div>
                </form>
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
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#srcImg').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
            }

            $("#imgInp").change(function(){
                readURL(this);
            });
    </script>
@endsection
