@extends('layouts.master-layouts')

@section('title')
register
@endsection

@section('content')

<div class="account-pages my-5 pt-5">
    <div>
        <form id="register_form" method="POST" action="/auth-register">
            {{ csrf_field() }}
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card overflow-hidden bg-white">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h6>Account Detail</h6>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div class="p-2">
                                <form action="{{ url('auth-register') }}" method="post">
                                    <div class="form-group">
                                        <label for="firstname">Firstname<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter firstname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Lastname<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter lastname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter email" required>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-secondary btn-block waves-effect waves-light" onclick="sendOTP()" type="button">Send OTP</button>
                                    </div>

                                    <div class="form-group">
                                        <label for="otp">OTP<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="otp" id="otp" placeholder="Enter OTP" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" minlength="6" name="password" id="password" placeholder="Enter password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Confirm Password<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" minlength="6" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" required>
                                    </div>
                                    <p id="match_password" class="text-danger">Password is not matched!</p>
                                    <div class="mt-3 text-center">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Register</button>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="mt-5 text-center">
            <p style="color:white;">Already have an account ? <a href="auth-login" class="font-weight-medium">
                    Login</a> </p>

        </div>
    </div>
</div>





@endsection

@section('script')
@include('common.toastr')
<script>
    $(document).ready(function() {
        $("#match_password").hide();
        $('#password').keyup(function() {
            MatchPassword();
        })
        $('#password_confirmation').keyup(function() {
            MatchPassword();
        })
    })

    function MatchPassword() {
        if ($('#password').val() != $('#password_confirmation').val()) {
            $("#match_password").show();
        } else {
            $("#match_password").hide();
        }
    }

    function sendOTP() {
        let email = $('#email').val();
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test(email)) {
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("Invalid Email");
            return;
        }

        $.ajax({
            type: 'POST',
            url: `/auth-register/send-otp`,
            data: {
                "_token": "{{ csrf_token() }}",
                email
            },
            success: function(data) {
                if (data == 'invalid-email') {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.error("Invalid Email");
                }
                if(data=='success'){
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success("OTP is sent successfully!");
                }
            }
        });
    }
</script>

@endsection