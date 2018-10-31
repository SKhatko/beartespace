@extends('dashboard.index')

@section('dashboard-content')

    <div class="app-dashboard-index">

        @include('dashboard.partials.profile')

        <artworks-block style="margin-top: 30px;"
                artworks_="{{ $user->favoriteArtworks->load('user:id,first_name,last_name,user_name,name,url')->take(4) }}">
            <template slot="header">
                <div class="h2">Favorite Artworks</div>
            </template>
            <template slot="footer">
                <a href="{{ route('dashboard.favorites', 'artworks') }}" class="el-button el-button--default">See more
                    favorite Artworks</a>
            </template>
        </artworks-block>

        @if($user->followedUsers->count())
            <div class="h3" style="margin-bottom: 20px;">Followed Artists</div>
            @include('seller.artists-block', ['artists' => $user->followedUsers->take(4)])
        @endif

    </div>

@endsection