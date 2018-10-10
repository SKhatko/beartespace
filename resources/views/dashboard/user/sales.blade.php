@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')

    <div class="app-dashboard-sales">

        @include('dashboard.partials.profile')

        <div class="sales">
            <el-card>
                @foreach(auth()->user()->sales as $sale)
                    <div class="artwork">

                        <div class="artwork-image">
                            <img src="/imagecache/fit-100{{ $sale->artwork->image_url }}"
                                 alt="{{ $sale->artwork->image ? $sale->artwork->image->original_name : 'image' }}">
                            <a href="{{ route('artwork', $sale->artwork->id) }}" class="h6" style="display: block;">
                                {{ $sale->artwork->name }}
                            </a>
                        </div>

                        <div class="artwork-shipping">
                            <a href="{{ route('artist', $sale->order->user->id) }}" class="artwork-user">
                                <img src="/imagecache/fit-25{{ $sale->order->user->avatar_url }}" alt="">

                                {{ $sale->order->user->name }}
                            </a>

                            <div>{!! $sale->order->addressString() !!}</div>
                        </div>

                        <div class="artwork-manage">

                            <div class="artwork-price">
                                {{ currency($sale->price) }}
                            </div>

                            <div class="artwork-qty">
                                {{ $sale->qty }} pc
                            </div>

                            <div class="artwork-status">
                                {{ $sale->status }}
                            </div>

                            <el-button size="mini">Confirm shipping</el-button>

                        </div>

                    </div>





                @endforeach
            </el-card>
        </div>
    </div>

@endsection



