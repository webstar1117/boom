@extends('layouts.master')

@section('title') Food-Edit @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common.breadcrumb')
@slot('title') Food Edit @endslot
@slot('li_1') @endslot
@endcomponent

<button id="add_button" class="text-white" style="position: relative;left: 84%;bottom: 17px; background:green">

    Add buy diamond limit

</button>


<div class="row">
    <div class="col-12">
        <div class="card">
            <form method="post" action="{{ url('/admin/buy-diamonds-limit/edit') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="card-body">
                    <div id="total_div" class="mb-3">
                        @foreach($all_buy_diamonds_limit as $key=>$buy_diamonds_limit)
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Buy&nbsp;&nbsp;{{$key+1}}
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="diamonds_amount[{{$key}}]" value="{{$buy_diamonds_limit->buy_diamonds_limit_diamonds_amount}}" required>&nbsp;&nbsp;diamonds-
                                <input type="number" name="inr_amount[{{$key}}]" value="{{$buy_diamonds_limit->buy_diamonds_limit_inr_amount}}" required> inr
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-danger" onclick="Remove(this)">
                                    Remove
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <button id="update_button" type="submit" class="btn btn-primary">Update</button>
                        @if(Session::get('no-data'))
                        <h6 class="text-danger">
                            {{Session::get('no-data')}}
                        </h6>
                        @endif
                    </div>



                </div>
            </form>
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
    $(document).ready(function() {
        $('#add_button').click(function() {
            var div_len = $('#total_div').children().length;
            console.log(div_len);

            $('#total_div').append(
                `<div class="row mb-2">
                        <div class="col-md-3">
                            Buy&nbsp;&nbsp;${div_len+1}
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="diamonds_amount[${div_len}]" value="" required>&nbsp;&nbsp;diamonds-
                            <input type="number" name="inr_amount[${div_len}]" value="" required> inr                           
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-danger" onclick="Remove(this)">
                                Remove
                            </button>
                        </div>
                    </div>
                    `
            )
        })
    })

    function Remove(that) {
        $(that).parent().parent().remove();
    }
</script>

@endsection