@extends('backend.auth.app')
@section('title', 'Forgot password')

@section('content')
    <div class="login_page_bg">
        <div class=" screen">
            <div class="screen__content">
                <div class="">
                    <p class="login-box-msg cus-login-box-msg mt-3 text-left pl-4 pt-5 ml-1">{{ _trans('auth.Forgot your password?') }}</p>
                </div>
                <div class="login">
                    <div class="input-group mb-3 login__field">
                        <input type="email" name="email" id="email" class="form-control" placeholder="{{ _trans('common.Email') }}">
                    </div>
                    <p class="text-danger __email small-text"></p>
                    <div class="">
                        <div class=" text-left">
                            <button type="button"
                                    class="login-panel-btn  mb-3 submit_btn">{{ _trans('auth.Send Code') }}</button>
                        </div>
                    </div>
                    <div class="text-left">
                        <a href="{{ route('adminLogin') }}"
                           class="">{{ _trans('auth.Back to Sign in') }}</a>
                    </div>
                </div>


            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('public/frontend/js/auth.js') }}"></script>
@endsection
