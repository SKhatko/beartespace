@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    @include('partials.errors')

    @foreach($artworks as $artwork)
        <div class="artwork">

            <h2>{{ $artwork->id . '. ' . $artwork->title }}</h2>

            <img src="{{ $artwork->images()->first()->name }}" alt="" style="max-width: 200px; max-height: 200px">


            <div class="d">
                <el-button type="success">
                    <a href="{{ route('dashboard.artwork.edit', $artwork->id) }}">Edit</a>
                </el-button>

                <el-button type="danger">
                    <a href="{{ route('dashboard.artwork.destroy', $artwork->id) }}">Delete</a>
                </el-button>
            </div>

        </div>

        <hr>


    @endforeach

@endsection
