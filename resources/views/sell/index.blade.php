@extends('layouts.simple')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <div class="app-sell-index">

            <div class="h2">Thousand of art lovers can’t wait to see your art</div>

            <a href="/sell/profile-name/artist" class="el-button el-button--default is-plain" style="margin-top: 20px;">I'm an Artist, I want to sell my Artworks</a>

            <a href="/sell/profile-name/gallery" class="el-button el-button--default is-plain" style="margin-top: 20px;">I'm a collector/gallery, I want to sell my art</a>

            <div class="h3" style="margin-top: 30px;">Need to make texts for this page</div>
            <p>Here we say about 2(3) subscription plans. 1 is free. 2 is 100eur/month and include publishing artworks
                in social media once a week + google search payed campaign</p>
            <p>3 could be 200eur for advertising in SoMe + goggle ads for one month</p>

        </div>
    </div>
@stop