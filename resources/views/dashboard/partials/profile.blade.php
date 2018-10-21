@if(auth()->user())
    <div class="app-dashboard-profile">
        <el-card style="margin-bottom: 20px;">

            <div class="profile">

                <div class="profile-avatar">
                    <img src="/imagecache/fit-150{{ auth()->user()->avatar_url }}" alt="">
                </div>

                <div class="profile-info">
                    <div class="h2" style="margin-bottom: 10px;">{{ auth()->user()->name }}</div>

                    <div class="h6" style="margin-bottom: 10px;">
                        <a href="/dashboard/favorites/artists"
                           style="margin-right: 10px;"><b>{{ auth()->user()->followedBy->count() }}</b> Following</a>
                        {{--                        @if(auth()->user()->canUpload())--}}
                        {{--<a href="/dashboard/favorites"><b>{{ auth()->user()->followedUsers->count() }}</b> Followers</a>--}}
                        {{--@endif--}}

                        <a style="margin-right: 10px;"
                           href="/dashboard/favorites/artworks"><b>{{ auth()->user()->favoriteArtworks->count() }}</b>
                            Favorite Artworks</a>
                        <a style="margin-right: 10px;"
                           href="/dashboard/order"><b>{{ auth()->user()->orders->count() }}</b> Orders</a>

                    </div>

                    <hr>

                    @if(auth()->user()->canUpload())
                        <div class="h6" style="margin-bottom: 10px;">
                            <a href="/dashboard/artwork"><b>{{ auth()->user()->artworks->count() }}</b> Artworks</a>
                        </div>

                        <div class="h6" style="margin-bottom: 10px;">
                            <a href="/dashboard/sale"><b>{{ auth()->user()->sales->count() }}</b> Sales</a>
                        </div>
                    @endif

                    <a href="/dashboard/profile" class="el-button el-button--default" style="margin-bottom: 20px;">Edit
                        profile</a>
                    <a href="/dashboard/account" class="el-button el-button--default">Account Settings</a>


                    @if(auth()->user()->canUpload())
                        <a href="/dashboard/artwork/create" class="el-button el-button--default">Upload Artwork</a>
                        <a href="/dashboard/artwork" class="el-button el-button--default">Artworks</a>
                    @endif
                </div>
            </div>


        </el-card>
    </div>
@endif