@extends('layouts.app')


@section('content')

    <div class="app--wrapper">
        <h2>Auctions</h2>

        @foreach($auctions as $auction)

            <div class="auction" style="display: flex">

                <div>
                    Title {{ $auction->title }} <br>
                    Autor {{ $auction->user['name'] }} <br>
                    Country {{ $auction->user->country['country_name'] }} <br>

                </div>

                <img src="{{ $auction->image }}" alt="" style="max-height: 400px">

            </div>

            <hr>

        @endforeach
    </div>

@endsection