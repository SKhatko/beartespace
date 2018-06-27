@extends('layouts.app')


@section('content')


    <div class="app--wrapper">
        <h2>Auctions</h2>

        @foreach($auctions as $auction)

            Auction {{ $auction->id }}

        @endforeach
    </div>

@endsection