@extends('layouts.simple')

@section('content')

    <el-main class="app-auth">

        <div style="text-align: center">

            <h1><i class="el-icon-success"></i> Success!</h1>
            <h2> Your order was payed</h2>
            <div class="p" style="margin-bottom: 20px;">
                You will receive order confirmation on email and will be notified about shipping status.
            </div>
            <div class="p"> You can track shipping status in <a href="{{ route('dashboard.orders') }}">Orders
                    section</a>
            </div>

            <el-button><a href="/">Home</a></el-button>
            <el-button><a href="{{ route('dashboard.orders') }}">My orders</a></el-button>
        </div>

    </el-main>

@endsection
