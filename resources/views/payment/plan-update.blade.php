@extends('layouts.app')

@section('content')


    <el-main class="app-auth">

        @if(auth()->user())

            <el-card class="box-card app-auth-login">
                <div slot="header" class="clearfix">
                    <i class="el-icon-success"></i> &nbsp;
                   Update your subscription in order to continue using our service
                </div>

                Payments info will be placed here

            </el-card>

        @endif

    </el-main>

@endsection
