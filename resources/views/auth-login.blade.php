@extends('layouts.master-layouts')

@section('title')
    login
@endsection
@section('content')

    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card overflow-hidden bg-white">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5>With your email:</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row social-sign-in-gap">
                            <div class="col-md-6 col-xs-12 text-center">
                                <a href="{{ url('google/redirect') }}">
                                    <button class="btn btn-danger">
                                        <i class="fab fa-google mr-2"></i>
                                        Sign in with Google
                                    </button>
                                </a>
                            </div>
                            <div class="col-md-6 col-xs-12 text-center">
                                <a href="{{ url('facebook/redirect') }}">
                                    <button class="btn btn-danger">
                                        <i class="fab fa-facebook mr-2"></i>
                                        Sign in with Facebook
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="p-2">
                                <form class="form-horizontal" method='post' action="/auth-login">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="username">Email<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            placeholder="Enter username" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">Password<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password-field"
                                            placeholder="Enter password" required>
                                        <span style="color:black;padding-right:23px" toggle="#password-field"
                                            class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                    <input type="hidden" class="form-control" name="key" value="from_login_page">
                                    <div class="mt-3 text-center">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log
                                            In</button>
                                    </div>


                                    <div class="mt-4 text-center" style="color:white">
                                        <a href="{{ url('/auth-login/reset') }}">
                                            <i class="mdi mdi-lock mr-1"></i>Forgot your password?
                                        </a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p style="color:white">Don't have an account ? <a href="/auth-register" class="font-weight-medium">
                                Signup now </a> </p>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    @include('common.toastr')

    <script>
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endsection
