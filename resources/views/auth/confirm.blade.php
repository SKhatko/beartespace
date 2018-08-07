@extends('layouts.app')

@section('content')


    <el-main class="app-auth">

        <el-card class="box-card app-auth-login">
            <div slot="header" class="clearfix"><i class="el-icon-success"></i> &nbsp; Confirmation is sent to Email box</div>

            <p>
                Confirmation has been send to {{ auth()->user()->email }}.
            </p>
            <p>
                Please go to your email box and follow the link to continue.
            </p>

            <p>Click <el-button type="text"><a href="{{ route('confirm-email.resend') }}">here</a></el-button>
                 to send verification email again </p>

        </el-card>

    </el-main>

@endsection
