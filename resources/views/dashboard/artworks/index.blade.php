@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    @include('partials.errors')

    @foreach($artworks as $artwork)
        <div class="artwork">

            <a href="{{ route('artwork', $artwork->id) }}" class="h2" target="_blank">{{ $artwork->title }}</a>

            <div class="artwork-image">
                @if($artwork->images()->first())
                    <img src="{{ $artwork->images()->first()->url }}" alt="" style="max-width: 200px; max-height: 200px">
                @endif
            </div>

            <div>
                <el-button type="text">
                    <a href="{{ route('dashboard.artwork.edit', $artwork->id) }}">Edit</a>
                </el-button>
            </div>

        </div>

        <hr>


    @endforeach

@endsection
