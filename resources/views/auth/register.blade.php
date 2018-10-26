@extends('layouts.simple')

@section('content')

    <el-main class="app-auth">

        <el-card class="box-card app-auth-register">
            <div slot="header" class="clearfix">New User Registration</div>

            @include('partials.errors')

            <register-form user-type_="{{ $userType ?? 'user' }}"></register-form>

        </el-card>

    </el-main>

@endsection
