@extends('layouts.master')

@section('title') @lang('translation.Dashboard') @endsection

@section('content')

@component('common.breadcrumb')
@slot('title') Dashboard @endslot
@slot('li_1') Welcome to Skote Dashboard @endslot
@endcomponent

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-nowrap table-centered mb-0">
                <tbody>
                    <tr>
                        <td>
                            <h5 class="text-truncate font-size-14 m-0">Active users</h5>
                        </td>
                        <td>
                            <div class="team">
                                <a href="{{ url('/admin/dashboard/active-users') }}" class="team-member d-inline-block">
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="text-truncate font-size-14 m-0">Online users</h5>
                        </td>
                        <td>
                            <div class="team">
                                <a href="{{ url('/admin/dashboard/online-users') }}" class="team-member d-inline-block">
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="text-truncate font-size-14 m-0">Free membership player</h5>
                        </td>
                        <td>
                            <div class="team">
                                <a  href="{{ url('/admin/dashboard/free-membership-player') }}" class="team-member d-inline-block">
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="text-truncate font-size-14 m-0">Medium membership players</h5>
                        </td>
                        <td>
                            <div class="team">
                                <a href="{{ url('/admin/dashboard/medium-membership-player') }}" class="team-member d-inline-block">
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="text-truncate font-size-14 m-0">Upgrade membership players</h5>
                        </td>
                        <td>
                            <div class="team">
                                <a href="{{ url('/admin/dashboard/upgrade-membership-player') }}" class="team-member d-inline-block">
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="text-truncate font-size-14 m-0">Recent registered users</h5>
                        </td>
                        <td>
                            <div class="team">
                                <a href="{{ url('/admin/dashboard/recent-registered-users') }}" class="team-member d-inline-block">
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="text-truncate font-size-14 m-0">Blocked users</h5>
                        </td>
                        <td>
                            <div class="team">
                                <a href="{{ url('/admin/dashboard/blocked-users') }}" class="team-member d-inline-block">
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="text-truncate font-size-14 m-0">Recent INR Deposits players</h5>
                        </td>
                        <td>
                            <div class="team">
                                <a href="javascript: void(0);" class="team-member d-inline-block">
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                            not yet
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="text-truncate font-size-14 m-0">Total INR Deposits users</h5>
                        </td>
                        <td>
                            <div class="team">
                                <a href="javascript: void(0);" class="team-member d-inline-block">
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                            not yet
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="text-truncate font-size-14 m-0">Total tournaments posted</h5>
                        </td>
                        <td>
                            <div class="team">
                                <a href="javascript: void(0);" class="team-member d-inline-block">
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                            not yet
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="text-truncate font-size-14 m-0">Chat Enable/Disable option:</h5>
                        </td>
                        <td>
                            <div class="team">
                                <div class="custom-control custom-switch custom-switch-lg mb-3" dir="ltr">
                                    <input type="checkbox" name="chat_switch" class="custom-control-input" id="chat_switch" >
                                    <label class="custom-control-label" for="chat_switch"></label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="text-truncate font-size-14 m-0">Site online/offline:</h5>
                        </td>
                        <td>
                            <div class="team">
                                <div class="custom-control custom-switch custom-switch-lg mb-3" dir="ltr">
                                    <input type="checkbox" name="site_switch" class="custom-control-input" id="site_switch">
                                    <label class="custom-control-label" for="site_switch"></label>
                                </div>
                            </div>
                            <input type="text" id="chat_site_id" name="id" hidden>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- end table responsive -->
    </div>
</div>
@endsection

@section('script')
<!-- plugin js -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Calendar init -->
<script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
<script>
    $("#chat_switch").change(function() {
        var id=$('#chat_site_id').val();
        var chat;
        if ($(this).prop("checked") == true) {
            chat=1;
        } else {
            chat=0;
        }

        $.ajax({
            type: 'POST',
            url: '/admin/dashboard/chat',
            data: {
                "_token": "{{ csrf_token() }}",
                id,
                chat
            },
            success: function(data) {
                console.log(data)
                if (data == 'success')
                    location.reload();
            }
        });
    });

    $("#site_switch").change(function() {
        var id=$('#chat_site_id').val();
        var site;
        if ($(this).prop("checked") == true) {
            site=1;
        } else {
            site=0;
        }

        $.ajax({
            type: 'POST',
            url: '/admin/dashboard/site',
            data: {
                "_token": "{{ csrf_token() }}",
                id,
                site
            },
            success: function(data) {
                console.log(data)
                if (data == 'success')
                    location.reload();
            }
        });
    });
    
</script>
@endsection