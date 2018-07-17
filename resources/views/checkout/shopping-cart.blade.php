@extends('layouts.app')

@section('content')

    <div class="app--wrapper">
        <el-card>

            <h2>Shopping cart</h2>

            @if($artworks)
                @foreach($artworks as $artwork)
                    <el-row :gutter="20" style="margin-bottom:20px;">

                        <el-col :sm="10">
                            <img src="{{ $artwork['item']->images()->first()->name }}" alt="" style="width: 100%;">
                        </el-col>

                        <el-col :sm="12">
                            <p>{{ $artwork['item']['title'] }}</p>
                            <p>{{ $artwork['item']->user->name }}</p>
                            @if($artwork['item']->user->country)
                                <p>{{ $artwork['item']->user->country->name }}</p>
                            @endif
                        </el-col>
                        <el-col :sm="2">
                            {{ $artwork['item']['price'] }}
                            <el-button type="text">
                                <a href="{{ route('remove-from-cart', $artwork['item']['id']) }}"><span
                                            class="el-icon-delete"></span></a>
                            </el-button>
                        </el-col>
                    </el-row>

                @endforeach


                <hr>

                <el-row :gutter="20">
                    <el-col :span="22">
                        Subtotal
                    </el-col>
                    <el-col :span="2">
                        {{ $totalPrice }}
                    </el-col>
                </el-row>

                <hr>

                <el-button type="success"><a href="{{ route('checkout') }}">Checkout</a></el-button>


            @else

                <p>
                    No items here
                </p>

            @endif

            <el-button><a href="{{ route('home') }}">Continue shopping</a></el-button>

        </el-card>
    </div>

@stop