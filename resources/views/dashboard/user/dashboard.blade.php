@extends('dashboard.index')

@section('dashboard-content')

    <div class="app-dashboard-index">

        @include('dashboard.partials.profile')

        @if($user->favoriteArtworks->count())
            <div class="h3" style="margin-bottom: 20px;">Favorite artworks</div>
            <artworks-block artworks_="{{ $user->favoriteArtworks->take(4) }}"></artworks-block>
        @endif

        @if($user->followedUsers->count())
            <div class="h3" style="margin-bottom: 20px;">Followed Artists</div>
            @include('seller.artists-block', ['artists' => $user->followedUsers->take(4)])
        @endif

    </div>

@endsection