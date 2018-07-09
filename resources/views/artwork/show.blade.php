@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <h2>Painting</h2>

        <h3><a href="{{ route('artist', $artwork->user->id) }}">{{ $artwork->user->name }}</a></h3>

        <div class="artwork" style="display: flex">

            <div>
                Title {{ $artwork->title }} <br>
                Country {{ $artwork->user->country['country_name'] }} <br>
                <el-button>
                    <a href="{{ route('add-to-cart', $artwork->id) }}">Add to cart</a>
                </el-button>
            </div>

            @foreach($artwork->images as $image)
                <img src="{{ $image->name }}" alt="" style="max-height: 400px">
            @endforeach

        </div>
        <hr>
    </div>

@endsection