@extends('dashboard.index')

@section('admin-content')

    <el-main class="app--centered">

        <div class="app-orders">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
                <el-breadcrumb-item>Orders</el-breadcrumb-item>
            </el-breadcrumb>

            <el-card class="box-card orders">
                <div slot="header" class="clearfix h4">Orders</div>


                @if($orders->count() > 0)

                    @foreach($orders as $order)
                        <div class="order">
                            @if(count(json_decode($order->artworks)) > 0)
                                @foreach(json_decode($order->artworks) as $artwork)
                                    <div class="artwork">
                                        <div class="artwork-image">
                                            <img src="/imagecache/height-100{{ $artwork->image_url }}"
                                                 alt="{{ $artwork->image ? $artwork->image->original_name : 'image' }}"
                                                 style="height: 100px;">
                                        </div>

                                        <div class="artwork-info">

                                            <a href="{{ route('artist', $artwork->user_id) }}" class="h5"
                                               style="margin-bottom: 6px;font-weight: bold;display: block;">
                                                {{ $artwork->user->name }}
                                            </a>

                                            <a href="{{ route('artwork', $artwork->id) }}" class="h5">
                                                {{ $artwork->name }}
                                            </a>
                                        </div>

                                        <div class="artwork--right">

                                            <div class="artwork-price">
                                                {{ $artwork->formatted_price }}
                                            </div>

                                            <div class="artwork-qty">
                                                {{ $cartArtworks[$artwork->id] }} pc
                                            </div>

                                            <div class="artwork-status">
                                                Payed
                                            </div>

                                        </div>

                                    </div>

                                @endforeach
                            @endif

                            <div class="order-bottom">
                                <div class="order-bottom-info">
                                    Subtotal
                                </div>
                                <div class="order-bottom-price">
                                    {{ currency($order->price, null, session('currency')) }}
                                </div>
                            </div>
                            {{ $artwork->id . '-' . $artwork->created_at }}

                        </div>

                    @endforeach

                @else
                    <div class="h3" style="margin-bottom: 30px;">
                        You don't have any orders. Let's get shopping!
                    </div>
                @endif

                <el-button><a href="{{ route('artworks') }}">Continue shopping</a></el-button>
            </el-card>

        </div>


    </el-main>

@endsection