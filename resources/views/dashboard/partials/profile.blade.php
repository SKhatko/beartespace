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
                        <a href="/dashboard/favorites"
                           style="margin-right: 10px;"><b>{{ auth()->user()->followedBy->count() }}</b> Following</a>
                        <a href="/dashboard/favorites"><b>{{ auth()->user()->followedUsers->count() }}</b> Followers</a>
                    </div>

                    <hr>
                    <div class="h6" style="margin-bottom: 10px;">
                        <a href="/dashboard/order"><b>{{ auth()->user()->orders->count() }}</b> Orders</a>
                    </div>

                    <div class="h6" style="margin-bottom: 10px;">
                        <a href="/dashboard/artwork"><b>{{ auth()->user()->artworks->count() }}</b> Artworks</a>
                    </div>

                    <div class="h6" style="margin-bottom: 10px;">
                        <a href="/dashboard/sale"><b>{{ auth()->user()->sales->count() }}</b> Sales</a>
                    </div>

                    <a href="/dashboard/profile" class="el-button el-button--default" style="margin-bottom: 20px;">Edit
                        profile</a>
                    <a href="/dashboard/account" class="el-button el-button--default">Edit account</a>


                    <a href="/dashboard/artwork/create" class="el-button el-button--default">Upload Artwork</a>
                    <a href="/dashboard/artwork" class="el-button el-button--default">Artworks</a>
                </div>
            </div>


        </el-card>
    </div>
@endif