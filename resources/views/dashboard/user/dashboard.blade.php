@extends('dashboard.index')

@section('dashboard-content')

    <div class="app-dashboard-index">

        @include('dashboard.partials.profile')

        @if($user->favoriteArtworks->count())
            <div class="h3">Favorite artworks</div>
            <artworks-block artworks_="{{ $user->favoriteArtworks->take(4) }}"></artworks-block>
        @else


        @endif

    </div>

@endsection