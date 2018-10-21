@extends('layouts.simple')

@section('content')

    <el-main class="app-auth">

        <el-card class="box-card app-auth-login">
            <div slot="header" class="clearfix">Sign in</div>

            @include('partials.errors')

            <login-form></login-form>

            <div class="h5" style="margin: 20px 0; text-align: center;">or</div>

            <a href="/login/facebook" class="el-button el-button--default is-plain" style="display: block;">
                Continue with Facebook
            </a>

            <a href="/login/google" class="el-button el-button--default is-plain"
               style="display: block;margin: 15px 0;">
                Continue with Google
            </a>

            <!--<a href="/login/twitter" class="el-button el-button&#45;&#45;default is-plain" style="display: block;margin: 0;">-->
            <!--Continue with Twitter-->
            <!--</a>-->

            <p class="small">
                By Signing up, you agree that you've read and accepted our <a href="/pages/user-agreement"
                                                                               target="_blank"
                                                                               style="font-weight: bold;">User
                    Agreement</a>, you're at least 18 years
                old, and you consent to our <a href="/page/cookies-and-privacy" target="_blank"
                                               style="font-weight: bold;">Privacy Notice</a> and receiving marketing
                communications from us.
            </p>

        </el-card>

    </el-main>

@endsection
