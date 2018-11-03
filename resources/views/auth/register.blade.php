@extends('layouts.simple')

@section('content')

    <el-main class="app-auth">

        <el-card class="box-card app-auth-register">
            <div slot="header" class="clearfix">New User Registration</div>

            @include('partials.errors')

            <register-form old_="{{ json_encode(old()) }}"></register-form>

        </el-card>

    </el-main>

@endsection
