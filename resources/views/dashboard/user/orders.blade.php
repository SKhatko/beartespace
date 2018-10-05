@extends('dashboard.index')

@section('admin-content')

    <el-main class="app--wrapper">

        <div class="app-orders">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
                <el-breadcrumb-item>Orders</el-breadcrumb-item>
            </el-breadcrumb>

            <el-card class="box-card orders">
                <div slot="header" class="clearfix h4">Orders</div>


                @if(auth()->user()->orders()->count() > 0)

                    @foreach(auth()->user()->orders as $order)
                        <div class="order">
                            <div class="order-top">
                                Order #{{ $order->id }} from {{ $order->created_at->diffForHumans() }}
                            </div>

                            @foreach($order->sales as $sale)
                                <div class="artwork">
                                    {{----}}
                                    {{--<div class="artwork-image">--}}
                                    {{--<img src="/imagecache/height-100{{ $artwork->image_url }}"--}}
                                    {{--alt="{{ $artwork->image ? $artwork->image->original_name : 'image' }}"--}}
                                    {{--style="height: 100px;">--}}
                                    {{--</div>--}}

                                    <div class="artwork-info">

                                        {{--<a href="{{ route('artist', $artwork->user_id) }}" class="h5"--}}
                                        {{--style="margin-bottom: 6px;font-weight: bold;display: block;">--}}
                                        {{--{{ $artwork->user->name }}--}}
                                        {{--</a>--}}

                                        <a href="{{ route('artwork', $sale->artwork->id) }}" class="h5">
                                            {{ $sale->artwork->name }}
                                        </a>
                                    </div>

                                    <div class="artwork--right">

                                        <div class="artwork-price">
                                            {{ currency($sale->price) }}
                                        </div>

                                        <div class="artwork-qty">
                                            {{ $sale->qty }} pc
                                        </div>

                                        <div class="artwork-status">
                                            {{ $sale->status }}
                                        </div>

                                    </div>

                                </div>

                            @endforeach
                            <hr>

                            <div class="order-bottom">
                                <div class="order-bottom-info">
                                    Subtotal
                                </div>
                                <div class="order-bottom-price">
                                    {{ currency($order->amount) }}
                                </div>

                            </div>

                        </div>

                    @endforeach

                @else
                    <div class="h3" style="margin-bottom: 30px;">
                        You don't have any orders. Let's get shopping!
                    </div>
                @endif

                <a href="{{ route('artworks') }}" class="el-button el-button--default">Continue shopping</a>
            </el-card>

        </div>


    </el-main>

@endsection