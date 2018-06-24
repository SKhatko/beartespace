@extends('layouts.app')

@section('content')

    <el-main class="app-auth">

        <el-card class="box-card app-auth-register">
            <div slot="header" class="clearfix">New User Registration</div>

            <el-form method="POST" action="{{ route('register') }}">

                @include('partials.errors')

                {{ csrf_field() }}

                <el-row :gutter="20">
                    <el-col :sm="12">
                        <el-form-item label="First Name" required>
                            <el-input name="first_name" value="{{ old('first_name') }}" autofocus></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :sm="12">
                        <el-form-item label="Last Name" required>
                            <el-input name="last_name" value="{{ old('last_name') }}"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>




                <el-form-item label="E-Mail Address" required>
                    <el-input type="email" placeholder="Email" value="{{ old('email') }}" name="email"
                              autofocus></el-input>
                </el-form-item>

                <el-form-item label="Password" required>
                    <el-input type="password" placeholder="Password" value="{{ old('password') }}"
                              name="password"></el-input>
                </el-form-item>


                <!-- TODO Social login -->
                {{--                        @include('auth.social_login')--}}



            <!-- TODO recaptcha -->

                @if(get_option('enable_recaptcha_registration') == 1)
                    <div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="g-recaptcha" data-sitekey="{{get_option('recaptcha_site_key')}}"></div>
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                </span>
                            @endif
                        </div>
                    </div>
                @endif

                <div>
                    By Registering, you agree that you've read and accepted our User Agreement, you're at least 18 years old, and you consent to our Privacy Notice and receiving marketing communications from us.
                </div>

                <el-form-item>
                    <el-button type="primary" native-type="submit">Register</el-button>

                    <el-button type="text">
                        <a href="{{ route('login') }}">
                            or Login
                        </a>
                    </el-button>

                </el-form-item>

            </el-form>

        </el-card>

    </el-main>

@endsection
