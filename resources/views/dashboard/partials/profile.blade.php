@if(auth()->user())
    <div class="app-dashboard-partials-profile">
        <el-card :body-style="{ padding: '0px' }">
            <div class="app-dashboard-partials-profile__avatar">
                <img src="/imagecache/fit-150{{ auth()->user()->avatar_url }}" alt="">
            </div>

            <div class="app-dashboard-partials-profile__info">
                <div class="h2" style="margin-bottom: 10px;">{{ auth()->user()->name }}</div>

                @if(!auth()->user()->email_verified)
                    <el-tag type="danger" size="mini" style="margin-bottom: 10px;">Email not confirmed.
                    </el-tag> <a href="{{ route('confirm-email.resend') }}" class="el-button el-button--text">
                        Send
                        confirmation</a>
                @endif

                <div class="h6" style="margin-bottom: 10px;">
                    <a href="/dashboard/favorites/artists"
                       style="margin-right: 10px;"><b>{{ auth()->user()->followedBy->count() }}</b>
                        Following</a>
                    {{--                        @if(auth()->user()->seller_status === 'active')--}}
                    {{--<a href="/dashboard/favorites"><b>{{ auth()->user()->followedUsers->count() }}</b> Followers</a>--}}
                    {{--@endif--}}

                    <a style="margin-right: 10px;"
                       href="/dashboard/favorites/artworks"><b>{{ auth()->user()->favoriteArtworks->count() }}</b>
                        Favorite Artworks</a>
                    <a style="margin-right: 10px;"
                       href="/dashboard/order"><b>{{ auth()->user()->orders->count() }}</b> Orders</a>

                </div>

                <hr>

                @if(auth()->user()->seller_status === 'active')
                    <div class="h6" style="margin-bottom: 10px;">
                        <a href="/dashboard/artworks"><b>{{ auth()->user()->artworks->count() }}</b> Artworks</a>
                    </div>

                    <div class="h6" style="margin-bottom: 10px;">
                        <a href="/dashboard/sale"><b>{{ auth()->user()->sales->count() }}</b> Sales</a>
                    </div>
                @endif

                <a href="/dashboard/profile" class="el-button el-button--text" style="margin: 0 20px 0px 0"><i
                            class="el-icon-edit"></i><span>Edit profile</span></a>

                <a href="/dashboard/account" class="el-button el-button--text" style="margin-bottom: 20px; margin-left: 0;"><i
                            class="el-icon-setting"></i><span>Account Settings</span></a>

                @if(auth()->user()->seller_status === 'active')
                    <div>
                        <a href="/dashboard/artworks/create" class="el-button el-button--default"
                           style="margin-bottom: 20px;">Upload Artwork</a>
                        <a href="/dashboard/artworks" class="el-button el-button--default"
                           style="margin-left: 0;">My Artworks</a>
                    </div>
                @endif


            </div>
        </el-card>
    </div>
@endif