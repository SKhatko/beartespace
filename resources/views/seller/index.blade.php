@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-artists">

            <main>
                <artists-menu></artists-menu>

                <div class="artists">

                    @include('seller/artists-block', ['artists' => $artists])

                </div>

            </main>


            <div class="artists-bottom">

                <el-button><a href="/selection/artist">See artists of the week</a></el-button>

                @if($artists->hasMorePages())
                    <el-button><a href="{{  $artists->nextPageUrl() }}">See more Artists</a></el-button>
                @endif
                <el-button><a href="{{ route('artworks') }}">Go to Artworks</a></el-button>
                <el-button><a href="{{ route('auctions') }}">Go to Auctions</a></el-button>
            </div>

            {{ $artists->links() }}

        </div>


    </div>

@endsection