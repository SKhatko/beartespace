@extends('layouts.app')

@section('content')

    <div class="app--wrapper">
        <el-card>

            <h2>Shopping cart</h2>

            @if($artworks)
                @foreach($artworks as $artwork)
                    <div class="item">
                        {{ $artwork['item']['title'] }} - {{ $artwork['item']['price'] }}
                        <el-button type="text">
                            <a href="{{ route('remove-from-cart', $artwork['item']['id']) }}"><span class="el-icon-delete"></span></a>
                        </el-button>
                    </div>


                @endforeach

            @else

                no items here

            @endif

            Total {{ $totalPrice }}

        </el-card>
    </div>

@stop