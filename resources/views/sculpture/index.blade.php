@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <h2>Sculptures</h2>

        @foreach($sculptures as $sculpture)

            <div class="sculpture" style="display: flex">

                <div>
                    Title {{ $sculpture->title }} <br>
                    Autor {{ $sculpture->user['name'] }} <br>
                    Country {{ $sculpture->user->country['country_name'] }} <br>

                </div>


                <img src="{{ $sculpture->image }}" alt="" style="max-height: 400px">


            </div>

            <hr>
        @endforeach

    </div>

@endsection