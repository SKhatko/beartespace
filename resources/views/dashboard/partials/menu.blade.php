<el-menu default-active="{{ $index }}" class="a-menu" :collapse="false" mode="horizontal">






    @if($lUser->isAdmin())

        <el-submenu index="2">
            <template slot="title">
                <i class="el-icon-location"></i>
                <span slot="title">Artworks</span>
            </template>
            <el-menu-item index="2-3"><a href="{{ route('pending_ads') }}">Pending for aprooval</a>
            </el-menu-item>

        </el-submenu>


        <el-submenu index="4">
            <template slot="title">
                <i class="el-icon-location"></i>
                <span slot="title">@lang('app.ads')</span>
            </template>
            <el-menu-item index="4-1"><a href="{{ route('approved_ads') }}">@lang('app.approved_ads')</a>
            </el-menu-item>
            <el-menu-item index="4-2"><a
                        href="{{ route('admin_pending_ads') }}">@lang('app.pending_for_approval')</a>
            </el-menu-item>
            <el-menu-item index="4-3"><a href="{{ route('admin_blocked_ads') }}">@lang('app.blocked_ads')</a>
            </el-menu-item>
        </el-submenu>



    @endif

</el-menu>
