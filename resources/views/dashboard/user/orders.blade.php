@extends('dashboard.index')

@section('dashboard-content')

    <div class="app-dashboard-orders">

        @include('dashboard.partials.profile')

        <div class="orders">
            <el-card>
                <div slot="header" class="clearfix h4">Orders</div>

                @if(auth()->user()->orders()->count() > 0)pa

                @foreach(auth()->user()->orders as $order)
                    <div class="order">
                        <div class="order-top">
                            Order #{{ $order->id }} from {{ $order->created_at->diffForHumans() }}
                        </div>

                        @foreach($order->sales as $sale)
                            <div class="artwork">

                                <div class="artwork-image">
                                    <img src="/imagecache/fit-100{{ $sale->artwork->image_url }}"
                                         alt="{{ $sale->artwork->image ? $sale->artwork->image->original_name : 'image' }}">
                                </div>

                                <div class="artwork-info">

                                    <a href="{{ route('artist', $sale->artwork->user->id) }}" class="artwork-artist">
                                        <img src="/imagecache/fit-25{{ $sale->artwork->user->avatar_url }}" alt="">

                                        {{ $sale->artwork->user->name }}
                                    </a>

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


    </div>

@endsection