<el-menu default-active="{{ $index }}" class="a-menu" :collapse="false" mode="horizontal">

    <el-menu-item index="dashboard">
        <i class="el-icon-menu"></i>
        <span slot="title"><a href="{{ route('dashboard') }}">Dashboard</a></span>
    </el-menu-item>


    <el-menu-item index="profile">
        <i class="el-icon-document"></i>
        <span slot="title"><a href="{{ route('dashboard.profile') }}">Profile</a></span>
    </el-menu-item>

    <el-menu-item index="change-password">
        <i class="el-icon-document"></i>
        <span slot="title"><a href="{{ route('change-password') }}">Change Password</a></span>
    </el-menu-item>


    <el-menu-item index="payments">
        <i class="el-icon-document"></i>
        <span slot="title"><a href="{{ route('payments') }}">Payments</a></span>
    </el-menu-item>

    <el-menu-item index="favorites">
        <a href="{{ route('favorites') }}">@lang('app.favourite_ads')</a>
    </el-menu-item>


    @if($lUser->isAdmin())

        <el-submenu index="settings">
            <template slot="title">
                <i class="el-icon-setting"></i>
                <span slot="title">Done</span>
            </template>

            <el-menu-item index="users">
                <i class="el-icon-view"></i>
                <span slot="title"><a href="{{ route('admin.users') }}">Users</a></span>
            </el-menu-item>

            <el-menu-item index="translations">
                <i class="el-icon-setting"></i>
                <span slot="title"><a href="{{ route('admin.translations') }}">Translations</a></span>
            </el-menu-item>

            <el-menu-item index="languages">
                <i class="el-icon-setting"></i>
                <a href="{{ route('admin.languages') }}">Languages</a>
            </el-menu-item>

            <el-menu-item index="pages">
                <i class="el-icon-document"></i>
                <span slot="title"><a href="{{ route('admin.pages') }}">Pages</a></span>
            </el-menu-item>


        </el-submenu>

        <el-submenu index="2">
            <template slot="title">
                <i class="el-icon-location"></i>
                <span slot="title">Artworks</span>
            </template>
            <el-menu-item index="2-1"><a href="{{ route('dashboard.artworks') }}">My Artworks</a></el-menu-item>
            <el-menu-item index="2-2"><a href="{{ route('dashboard.artwork.create') }}">Upload Artwork</a></el-menu-item>
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


        <el-menu-item index="6">
            <i class="el-icon-document"></i>
            <span slot="title"><a href="{{ route('admin_comments') }}">@lang('app.comments') </a></span>
        </el-menu-item>

        <el-menu-item index="7">
            <i class="el-icon-document"></i>
            <span slot="title"><a href="{{ route('ad_reports') }}">@lang('app.ad_reports')</a></span>
        </el-menu-item>


        <el-submenu index="9">
            <template slot="title">
                <i class="el-icon-location"></i>
                <span slot="title">Appearance</span>
            </template>
            <el-menu-item index="9-1"><a href="{{ route('theme_settings') }}">@lang('app.theme_settings')</a>
            </el-menu-item>
            <el-menu-item index="9-2"><a href="{{ route('social_url_settings') }}">@lang('app.social_url')</a>
            </el-menu-item>

        </el-submenu>


        <el-menu-item index="11">
            <i class="el-icon-document"></i>
            <span slot="title"><a href="{{ route('contact_messages') }}">@lang('app.contact_messages')
                    <span class="label label-default pull-right"><i class="fa fa-user"></i> </span> </a></span>
        </el-menu-item>




        <el-submenu index="9">
            <template slot="title">
                <i class="el-icon-location"></i>
                <span slot="title">Sett</span>
            </template>
            <el-menu-item index="9-1">
                <li><a href="{{ route('general_settings') }}">@lang('app.general_settings')</a></li>
            </el-menu-item>
            <el-menu-item index="9-2">
                <li><a href="{{ route('ad_settings') }}">@lang('app.ad_settings_and_pricing')</a></li>
            </el-menu-item>
            <el-menu-item index="9-2">
                <li><a href="{{ route('payment_settings') }}">@lang('app.payment_settings')</a></li>
            </el-menu-item>
            <el-menu-item index="9-2">
                <li><a href="{{ route('file_storage_settings') }}">@lang('app.file_storage_settings')</a></li>
            </el-menu-item>
            <el-menu-item index="9-2">
                <li><a href="{{ route('social_settings') }}">@lang('app.social_settings')</a></li>
            </el-menu-item>
            <el-menu-item index="9-2">
                <li><a href="{{ route('re_captcha_settings') }}">@lang('app.re_captcha_settings')</a></li>
            </el-menu-item>
            <el-menu-item index="9-2">
                <li><a href="{{ route('other_settings') }}">@lang('app.other_settings')</a></li>
            </el-menu-item>
            <el-menu-item index="324">
                <a href="{{ route('administrators') }}"><i class="fa fa-users"></i> @lang('app.administrators') <span
                            class="label label-default pull-right"><i class="fa fa-user"></i> </span> </a>
            </el-menu-item>

        </el-submenu>

    @endif

</el-menu>
