@extends('layouts.master-layouts')

@section('title')

    @lang('translation.Preloader')
@endsection
@section('content')

    <!-- banner area -->
    <section class="banner-content">
        <img src="{{ asset('/assets/images/logo.png') }}" alt="">
        <h2>Create a Memorial Website</h2>
        <p>Preserve and Share Memories of your Loved One</p>
    </section>

    <!-- our story area -->
    <section class="our-story-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="heading2">My account</h2>
                    <div class="total-content" style="margin-top:50px">
                        <div class="row account-box-shadow">
                            <div class="col-md-6 text-center font-16" style="cursor:pointer">
                                <a href="{{ url('my-memorial') }}">
                                    MY MEMORIALS
                                </a>
                            </div>
                            <div class="col-md-6 text-center font-16 border-bottom-3">
                                ACCOUNT INFORMATION
                            </div>
                        </div>
                        @include('common.error-div')
                        @if (Session::has('reset_password'))
                            <div class="alert alert-success text-center">
                                <a href="javascript:;" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('reset_password') }}</p>
                            </div>
                        @endif
                        @if (Session::has('account_reset'))
                            <div class="alert alert-success text-center">
                                <a href="javascript:;" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                        <div class="mt-5 p-5">
                            <div>
                                <h3 class="mb-5">
                                    Update your account information
                                </h3>
                                @if ($errors->any())
                                    <label for="firstname"
                                        class="error">{{ $errors->first('firstname') }}</label><br>
                                    <label for="lastname"
                                        class="error">{{ $errors->first('lastname') }}</label><br>
                                    <label for="email" class="error">{{ $errors->first('email') }}</label><br>
                                    <label for="old_password"
                                        class="error">{{ $errors->first('old_password') }}</label><br>
                                    <label for="new_password"
                                        class="error">{{ $errors->first('new_password') }}</label>
                                @endif
                                <div class="row">

                                    <div class="col-md-8">
                                        <form action="{{ url('/account/edit') }}" method="post">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label for="firstname">Firstname<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->firstname }}" name="firstname" id="firstname"
                                                    placeholder="Enter firstname" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Lastname<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->lastname }}" name="lastname" id="lastname"
                                                    placeholder="Enter lastname" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->email }}" name="email" id="email"
                                                    placeholder="Enter email" required>
                                            </div>

                                            <div class="mb-4">
                                                <input type="checkbox" name="passKey" id="passKey">
                                                &nbsp; Change password
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Current Password<span
                                                        class="text-danger">*</span></label>
                                                <input type="password" class="form-control" minlength="6"
                                                    name="old_password" id="old_password"
                                                    placeholder="Enter current password" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">New Password<span
                                                        class="text-danger">*</span></label>
                                                <input type="password" class="form-control" minlength="6"
                                                    name="new_password" id="new_password" placeholder="Enter new password"
                                                    disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Confirm Password<span
                                                        class="text-danger">*</span></label>
                                                <input type="password" class="form-control" minlength="6"
                                                    name="new_password_confirmation" id="new_password_confirmation"
                                                    placeholder="Confirm new password" disabled>
                                            </div>

                                            <div class="mt-3">
                                                <button class="btn btn-primary btn-block waves-effect waves-light"
                                                    type="submit">Save</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('input[type=checkbox]').change(
                function() {
                    if (this.checked) {
                        $("#old_password").removeAttr('disabled');
                        $("#new_password").removeAttr('disabled');
                        $("#new_password_confirmation").removeAttr('disabled');
                    } else {
                        $("#old_password").attr('disabled', 'disabled');
                        $("#new_password").attr('disabled', 'disabled');
                        $("#new_password_confirmation").attr('disabled', 'disabled');
                    }
                });
        });
    </script>
@endsection
