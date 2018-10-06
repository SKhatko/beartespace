@extends('dashboard.index')

@section('dashboard-content')

    <div class="app--wrapper">
        <div class="app-dashboard">

            <el-card>
                {{--<div slot="header">--}}
                {{--<div class="dashboard-header">--}}
                {{--<span>Your Public Profile</span>--}}
                {{--<a href="/dashboard/profile" class="el-button el-button--default el-button--mini">Edit profile</a>--}}
                {{--</div>--}}
                {{--</div>--}}

                <div class="dashboard">

                    <div class="dashboard-avatar">
                        <img src="/imagecache/fit-290{{ $user->avatar_url }}" alt="">
                    </div>

                    <div class="dashboard-info">
                        <div class="h2" style="margin-bottom: 10px;">{{ $user->name }}</div>

                        <div class="h6" style="margin-bottom: 10px;">
                            <a href="/dashboard/favorites" style="margin-right: 10px;"><b>{{ $user->followedBy->count() }}</b> Following</a>
                            <a href="/dashboard/favorites"><b>{{ $user->followedUsers->count() }}</b> Followers</a>
                        </div>

                        <a href="/dashboard/profile" class="el-button el-button--default" style="width: 100%">Edit profile</a>

                    </div>
                </div>



            </el-card>

        </div>
    </div>


    {{--<dashboard></dashboard>--}}

@endsection