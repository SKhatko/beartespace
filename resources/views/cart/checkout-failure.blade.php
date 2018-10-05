@extends('layouts.simple')

@section('content')

    <el-main class="app-auth">

        <div style="text-align: center">

            <h1><i class="el-icon-error"></i> Failure!</h1>
            <h2> Your order has not been payed</h2>
            <div class="p">{{ $message }}</div>
            <div class="p"><a href="{{ route('checkout') }}">Try again</a> or <a href="/">contact us for support</a>
            </div>

            <el-button><a href="/artwork">Artworks</a></el-button>
            <el-button><a href="{{ route('dashboard.orders') }}">My orders</a></el-button>
        </div>

    </el-main>

@endsection
