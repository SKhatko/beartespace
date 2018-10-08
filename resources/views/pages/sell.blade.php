@extends('layouts.simple')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <div class="app-sell">
            Sell Artworks with us. Here would be all information about subscriptions and tariffs
        </div>
    </div>
@stop