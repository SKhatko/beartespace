@extends('layouts.simple')

@section('content')

    <el-main class="app-auth">

        <el-card class="box-card app-auth-login">
            <div slot="header" class="clearfix">Sign in</div>

            @include('partials.errors')

            <login-form old_="{{ json_encode(old()) }}"></login-form>

        </el-card>

    </el-main>

@endsection
