@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    @if($artwork)
        <div class="app--wrapper">

            <div class="app-artwork">

                <div class="h3"><a href="{{ route('artist', $artwork->user->id) }}">{{ $artwork->user->name }}</a>, {{ $artwork->title }}</div>

                <div class="h4">{{ $artwork->user->country['country_name'] }}</div>

                <el-button>
                    <a href="{{ route('add-to-cart', $artwork->id) }}">Add to cart</a>
                </el-button>

                <div class="app-artwork-images">
                    @foreach($artwork->images as $image)
                        <img src="{{ $image->url }}" alt="{{ $image->name }}" style="display: block;">
                    @endforeach
                </div>

            </div>

        </div>
    @endif

@endsection