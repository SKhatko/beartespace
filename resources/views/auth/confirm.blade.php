@extends('layouts.app')

@section('content')


    <el-main class="app-auth">

        <el-card class="box-card app-auth-login">
            <div slot="header" class="clearfix"><i class="el-icon-success"></i> Confirmation is sent to your Email</div>

            <p>
                Confirmation has been send to your Email.
            </p>
            <p>
                Follow the link from your Email to continue.
            </p>

            <p>Click <el-button type="text"><a href="{{ route('confirm-email.resend') }}">here</a></el-button>
                 to send verification email again </p>

        </el-card>

    </el-main>

@endsection
