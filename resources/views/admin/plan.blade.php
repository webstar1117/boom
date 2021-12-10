@extends('layouts.master')

@section('title') Plan @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common.breadcrumb')
        @slot('title') Plans @endslot
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
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Price Description</th>
                                <th>Plan Description</th>
                                <th>Content</th>
                                <th>Edit</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($plans as $key => $plan)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $plan->name }} </td>
                                    <td>{{ $plan->price }}</td>
                                    <td>{{ $plan->price_description }}</td>
                                    <td>{{ $plan->plan_description }}</td>
                                    <td>{{ strlen($plan->contents) > 20 ? substr($plan->contents, 0, 20) : $plan->contents }}
                                    </td>
                                    <td style="cursor:pointer">
                                        <i class="fas fa-edit text-success" onclick="ReadyEdit('{{ $plan->id }}')"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="modal fade bs-example-modal-lg overflow-auto" id="edit_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg max-width-95">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" method="post" action="{{ url('/admin/plan/edit') }}"
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
                                <label>Price</label>
                            </div>
                            <div class="col-10">
                                <input class="w-75" type="number" step="0.01" name="price" id="price_edit">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2">
                                <label>Price Description</label>
                            </div>
                            <div class="col-10">
                                <input class="w-75" type="text" name="price_description"
                                    id="price_description_edit" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2">
                                <label>Plan Description</label>
                            </div>
                            <div class="col-10">
                                <input class="w-75" type="text" name="plan_description" id="plan_description_edit"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2">
                                <label>Contents</label>
                            </div>
                            <div class="col-10" id="contents_div">
                            </div>
                        </div>
                        <div class="mb-2 text-center">
                            <button onclick="AddContent()" class="btn btn-primary">
                                Add content
                            </button>
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
        //edit------------------------------------

        var img_folder = '/assets/images/blogs/';

        function ReadyEdit(id) {
            alert('sdf')
            $.ajax({
                type: 'POST',
                url: '/admin/plan/getOne',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                },
                success: function(data) {
                    let plan = JSON.parse(data);
                    changeModalData(plan);
                    $('#edit_modal').modal('show');

                }
            });

        }

        function DelContent(that) {
            $(that).parent().remove();
        }
     function changeModalData(plan) {
            console.log('sdf')
            let contents_dom = '';
            $('#id_edit').val(plan.id);
            $('#name_edit').val(plan.name);
            $('#price_edit').val(plan.price);
            $('#price_description_edit').val(plan.price_description);
            $('#plan_description_edit').val(plan.plan_description);

            JSON.parse(plan.contents).forEach((item, index) => {
                contents_dom += `<div class="mb-2">
                                    <input class="w-75" type="text" name="contents[]" value="${item}" required>
                                    <button onclick="DelContent(this)" class="btn btn-danger">
                                        Delete
                                    </button>
                            </div>`;
            })
            $('#contents_div').html('');
            $('#contents_div').html(contents_dom);
        }


        function EditCancel() {
            $('#edit_modal').modal('hide');
        }
        function AddContent(){
            $('#contents_div').append(
                `<div class="mb-2">
                                    <input class="w-75" type="text" name="contents[]" required>
                                    <button onclick="DelContent(this)" class="btn btn-danger">
                                        Delete
                                    </button>
                </div>`
            )
        }


    </script>
@endsection
