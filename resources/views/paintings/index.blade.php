@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <h2>Paintings</h2>

        @foreach($paintings as $painting)

            <div class="painting" style="display: flex">

                <div>
                    Title {{ $painting->title }} <br>
                    Autor {{ $painting->user['name'] }} <br>
                    Country {{ $painting->user->country['country_name'] }} <br>

                </div>


                <img src="{{ $painting->image }}" alt="" style="max-height: 400px">


            </div>

            <hr>

        @endforeach
    </div>

@endsection