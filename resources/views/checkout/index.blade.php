@extends('layouts.simple')

@section('content')

    <el-main class="app--centered">

        <div class="app-checkout">
            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item>Checkout</el-breadcrumb-item>
            </el-breadcrumb>

            <checkout-form></checkout-form>

        </div>

    </el-main>

@stop