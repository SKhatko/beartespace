@extends('layouts.app')

@section('content')


    <el-main class="app-auth">

        <el-card class="box-card app-auth-login">
            <div slot="header" class="clearfix">Confirmation is sent to your Email</div>

            <p>
                Confirmation has been send to your Email.
            </p>
            <p>
                Follow the link from your Email to continue.
            </p>

            <p>Click <a href="{{ route('register.verify') }}">here</a> to send verification email again </p>

        </el-card>

    </el-main>

@endsection
