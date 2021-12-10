@extends('layouts.master-layouts')

@section('title')
    @lang('translation.Preloader')
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/new-design/css/creatememorial/about.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <section class="create-memorial-section">
        <div class="container">
            <h2 class="heading2">Create a Memorial Website</h2>
            <div class="memorial-step-wrapper">
                @foreach ($order_titles as $x => $title)
                    <div class="mr-2 step  @if ($title['status']) active @endif">
                        <p>{{ $title['name'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="main-input-box needs-validation text-center" novalidate>
                    <h5 class="text-center mb-5">
                        Sign in to your account
                    </h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                With your social profile:
                            </div>
                            <div class="mb-3">
                                <small class="font-italic">
                                    (This does not give us permission to post.)
                                </small>
                            </div>

                            <div class="mb-3">
                                <a href="javascript:void();">
                                    <button class="btn btn-danger">
                                        <i class="fab fa-facebook mr-2"></i>
                                        Sign in with Facebook
                                    </button>
                                </a>
                            </div>
                            <div class="mb-3">
                                <a class="mr-5"
                                    href="{{ url('google/redirect?memorial_id=' . $memorial_id . '&plan_id=' . $plan_id) }}">
                                    <button class="btn btn-danger">
                                        <i class="fab fa-google mr-2"></i>
                                        Sign in with Google
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                Your account details:
                            </div>
                            <div id="sign_up_detail" class="mb-3">
                                <small class="font-italic">
                                    Already have an account?
                                    <span id="sign_in_btn" class="text-primary cursor-pointer"> Sign in here</span>.
                                </small>
                            </div>
                            <div id="sign_in_detail" class="mb-3" style="display:none">
                                <small class="d-flex justify-content-between font-italic">
                                    <span id="back_to_sign_up" class="text-primary cursor-pointer"> Back to sign up</span>
                                    <span id="forgot_password" class="text-danger cursor-pointer"> Forgot password</span>
                                    <a id="password_reset_anchor" href="{{ url('/auth-login/reset') }}" hidden></a>
                                </small>
                            </div>
                            <div class="mb-3">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="p-2">
                                    <div id="sign_up_div">
                                        <form action="{{ url('auth-register') }}" method="post">
                                            @csrf

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="firstname" id="firstname"
                                                    placeholder="Enter firstname" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="lastname" id="lastname"
                                                    placeholder="Enter lastname" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="email" id="email"
                                                    placeholder="Enter email" required>
                                            </div>

                                            <div class="form-group">
                                                <input type="password" class="form-control" minlength="6" name="password"
                                                    id="password" placeholder="Enter password" required>
                                            </div>
                                            <input type="text" name="memorial_id" value="{{ $memorial_id }}" hidden>
                                            @if ($plan_id)
                                                <input type="hidden" name="plan_id" value="{{ $plan_id }}">
                                            @endif
                                            <div class="mt-3">
                                                <button class="btn get-started-btn"
                                                    type="submit">Continue</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="sign_in_div" style="display:none">
                                        <form action="{{ url('auth-login') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="email" id="email"
                                                    placeholder="Enter email" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" minlength="6" name="password"
                                                    id="password" placeholder="Enter password" required>
                                            </div>
                                            <input type="text" name="memorial_id" value="{{ $memorial_id }}" hidden>
                                            @if ($plan_id)
                                                <input type="hidden" name="plan_id" value="{{ $plan_id }}">
                                            @endif
                                            <div class="mt-3">
                                                <button class="btn btn-primary btn-block waves-effect waves-light"
                                                    type="submit">Continue</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="reset_password_div" style="display:none">
                                        <form method="post" action="/reset-password/email">
                                            @csrf
                                            <div class="form-group">
                                                <label for="useremail">Email</label>
                                                <input type="email" class="form-control" id="useremail" name="email"
                                                    placeholder="Enter email">
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-12 text-right">
                                                    <button style="color:white!important"
                                                        class="btn btn-primary w-md waves-effect waves-light"
                                                        type="submit">Reset</button>
                                                </div>
                                            </div>
                                        </form>
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
<script src="{{ URL::asset('/assets/js/modal-sign-in.js') }}"></script>

    <script>
        $(document).ready(function() {
            console.log('sdfsdf')
            let moreDetailKey = true;
            $('#more_detail_btn').click(function() {
                if (moreDetailKey)
                    $('#more_detail').css('display', 'block');
                else
                    $('#more_detail').css('display', 'none');
                moreDetailKey = !moreDetailKey;
            })

        })
    </script>
@endsection
