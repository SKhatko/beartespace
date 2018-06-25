@extends('layouts.app')

@section('content')

    <el-main class="app-auth">

        <el-card class="box-card app-auth-login">
            <div slot="header" class="clearfix">Login</div>

            <el-form method="POST" action="{{ route('login') }}">

                @include('partials.errors')

                {{ csrf_field() }}

                <el-form-item label="E-Mail Address" required>
                    <el-input type="email" placeholder="Email" value="{{ old('email') }}" name="email" autofocus></el-input>
                </el-form-item>

                <el-form-item label="Password" required>
                    <el-input type="password" placeholder="Password" value="{{ old('password') }}" name="password"></el-input>
                </el-form-item>

                <el-form-item>
                    <el-checkbox {{ old('remember') ? 'checked' : '' }} name="remember">Remember Me</el-checkbox>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" native-type="submit">Login</el-button>

                    <el-button type="text">
                        <a href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </el-button>

                </el-form-item>


                <!-- TODO Social login -->
                {{--                        @include('auth.social_login')--}}



            </el-form>

        </el-card>

    </el-main>

@endsection
