@extends('layouts.app')

@section('content')


    <div class="app-login">

        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <div class="app-login__title">Login</div>
            </div>

            <form class="app-login-form" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}


                <el-form>
                    <el-form-item label="E-Mail Address" required>
                        <el-input placeholder="Email" value="{{ old('email') }}" name="email" autofocus></el-input>
                    </el-form-item>

                    <el-form-item label="Password" required>
                        <el-input placeholder="Password" value="{{ old('password') }}" name="password"></el-input>
                    </el-form-item>

                    <el-form-item>
                        <el-checkbox {{ old('remember') ? 'checked' : '' }} name="remember">Remember Me</el-checkbox>
                    </el-form-item>

                    <el-form-item>
                        <el-button type="primary" native-type="submit">Primary</el-button>

                        <el-button type="text">
                            <a href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </el-button>

                    </el-form-item>

                </el-form>


                @if(get_option('enable_recaptcha_login') == 1)
                    <div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="g-recaptcha"
                                 data-sitekey="{{get_option('recaptcha_site_key')}}"></div>
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                </span>
                            @endif
                        </div>
                    </div>
                @endif


            </form>

        </el-card>


    </div>

    {{--                        @include('admin.flash_msg')--}}
    {{--                        @include('auth.social_login')--}}


@endsection
