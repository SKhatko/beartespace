@extends('dashboard.index')

@section('dashboard-content')

    <div class="app--wrapper">
        <div class="app-payments">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
                <el-breadcrumb-item>Payments</el-breadcrumb-item>
            </el-breadcrumb>

            <el-card>

                Payments
            </el-card>

        </div>
    </div>

@endsection