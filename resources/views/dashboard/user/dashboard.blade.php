@extends('dashboard.index')

@section('dashboard-content')

    <div class="app--wrapper">
        <div class="app-dashboard">

            <el-card style="margin-bottom: 20px;">

                <div class="dashboard">

                    <div class="dashboard-avatar">
                        <img src="/imagecache/fit-150{{ $user->avatar_url }}" alt="">
                    </div>

                    <div class="dashboard-info">
                        <div class="h2" style="margin-bottom: 10px;">{{ $user->name }}</div>

                        <div class="h6" style="margin-bottom: 10px;">
                            <a href="/dashboard/favorites"
                               style="margin-right: 10px;"><b>{{ $user->followedBy->count() }}</b> Following</a>
                            <a href="/dashboard/favorites"><b>{{ $user->followedUsers->count() }}</b> Followers</a>
                        </div>

                        <hr>
                        <div class="h6" style="margin-bottom: 10px;">
                            <a href="/dashboard/order"><b>{{ $user->orders->count() }}</b> Orders</a>
                        </div>

                        <a href="/dashboard/profile" class="el-button el-button--default" style="margin-bottom: 20px;">Edit profile</a>
                        <a href="/dashboard/account" class="el-button el-button--default">Edit account</a>

                    </div>
                </div>


            </el-card>

            @if($user->favoriteArtworks->count())
                <div class="h3">Favorite artworks</div>
                <artworks-block artworks_="{{ $user->favoriteArtworks->take(4) }}"></artworks-block>
            @else


            @endif

        </div>
    </div>


    {{--<dashboard></dashboard>--}}

@endsection