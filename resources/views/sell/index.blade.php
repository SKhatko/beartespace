@extends('layouts.simple')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <div class="app-sell-index">

            <div class="h2">Thousand of art lovers can’t wait to see your art</div>

            @if(auth()->user())
                @if(auth()->user()->seller_status !== 'active')
                    <sell-profile-form style="margin-top: 20px;">
                        <el-button type="primary" slot="artist">Apply as an artist</el-button>
                        <el-button type="primary" slot="gallery">Apply as an gallery</el-button>
                    </sell-profile-form>
                @else
                    <el-button>My artworks</el-button>
                @endif
            @else
                <a href="/register" class="el-button el-button--default" style="margin-top: 20px;">
                    Sign up to apply
                </a>
            @endif

            <div class="h3" style="margin-top: 30px;">Need to make texts for this page</div>
            <p>Here we say about 2(3) subscription plans. 1 is free. 2 is 100eur/month and include publishing artworks
                in social media once a week + google search payed campaign</p>
            <p>3 could be 200eur for advertising in SoMe + goggle ads for one month</p>

        </div>
    </div>
@stop