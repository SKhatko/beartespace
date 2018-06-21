<div class="a-sidebar">
    <el-menu default-active="2" class="el-menu-vertical-demo" :collapse="false">
        <el-menu-item index="1">
            <i class="el-icon-menu"></i>
            <span slot="title"><a href="{{ route('dashboard') }}">Dashboard</a></span>
        </el-menu-item>
        <el-submenu index="2">
            <template slot="title">
                <i class="el-icon-location"></i>
                <span slot="title">My Purchases</span>
            </template>
            <el-menu-item index="2-1"><a href="{{ route('my_ads') }}">@lang('app.my_ads')</a></el-menu-item>
            <el-menu-item index="2-2"><a href="{{ route('create_ad') }}">@lang('app.post_an_ad')</a></el-menu-item>
            <el-menu-item index="2-3"><a href="{{ route('pending_ads') }}">@lang('app.pending_for_approval')</a>
            </el-menu-item>
            <el-menu-item index="2-4"><a href="{{ route('favorite_ads') }}">@lang('app.favourite_ads')</a>
            </el-menu-item>
        </el-submenu>

        @if($lUser->is_admin())


            <el-menu-item index="3">
                <i class="el-icon-document"></i>
                <span slot="title"><a href="{{ route('parent_categories') }}">@lang('app.categories')</a></span>
            </el-menu-item>
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

            <el-menu-item index="5">
                <i class="el-icon-document"></i>
                <span slot="title"><a href="{{ route('pages') }}"><i class="fa fa-file-word-o"></i> @lang('app.pages')
                        <span class="label label-default pull-right"><i class="fa fa-user"></i> </span></a></span>
            </el-menu-item>

            <el-menu-item index="6">
                <i class="el-icon-document"></i>
                <span slot="title"><a href="{{ route('admin_comments') }}"><i
                                class="fa fa-comment-o"></i> @lang('app.comments') <span
                                class="label label-default pull-right"><i class="fa fa-user"></i> </span></a></span>
            </el-menu-item>

            <el-menu-item index="7">
                <i class="el-icon-document"></i>
                <span slot="title"><a href="{{ route('ad_reports') }}"><i
                                class="fa fa-exclamation"></i> @lang('app.ad_reports') <span
                                class="label label-default pull-right"><i class="fa fa-user"></i> </span></a></span>
            </el-menu-item>

            <el-menu-item index="8">
                <i class="el-icon-document"></i>
                <span slot="title"><a href="{{ route('users') }}"><i
                                class="fa fa-users"></i> @lang('app.users')</a></span>
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

            <el-submenu index="10">
                <template slot="title">
                    <i class="el-icon-location"></i>
                    <span slot="title">Locations</span>
                </template>
                <el-menu-item index="10-1"><a href="{{ route('country_list') }}">@lang('app.countries')</a></el-menu-item>
                <el-menu-item index="10-2"><a href="{{ route('state_list') }}">@lang('app.states')</a></el-menu-item>
                <el-menu-item index="10-3"><a href="{{ route('city_list') }}">@lang('app.cities')</a></el-menu-item>

            </el-submenu>

            <el-menu-item index="11">
                <i class="el-icon-document"></i>
                <span slot="title"><a href="{{ route('contact_messages') }}">@lang('app.contact_messages')
                        <span class="label label-default pull-right"><i class="fa fa-user"></i> </span> </a></span>
            </el-menu-item>



            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> @lang('app.settings')<span class="fa arrow"></span> <span
                            class="label label-default pull-right"><i class="fa fa-user"></i> </span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('general_settings') }}">@lang('app.general_settings')</a></li>
                    <li><a href="{{ route('ad_settings') }}">@lang('app.ad_settings_and_pricing')</a></li>
                    <li><a href="{{ route('payment_settings') }}">@lang('app.payment_settings')</a></li>
                    <li><a href="{{ route('language_settings') }}">@lang('app.language_settings')</a></li>
                    <li><a href="{{ route('file_storage_settings') }}">@lang('app.file_storage_settings')</a></li>
                    <li><a href="{{ route('social_settings') }}">@lang('app.social_settings')</a></li>
                    <li><a href="{{ route('re_captcha_settings') }}">@lang('app.re_captcha_settings')</a></li>
                    <li><a href="{{ route('other_settings') }}">@lang('app.other_settings')</a></li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li><a href="{{ route('administrators') }}"><i class="fa fa-users"></i> @lang('app.administrators') <span
                            class="label label-default pull-right"><i class="fa fa-user"></i> </span> </a></li>


        @endif

        <el-menu-item index="11">
            <i class="el-icon-document"></i>
            <span slot="title"><a href="{{ route('profile') }}">Profile</a></span>
        </el-menu-item>

        <li><a href="{{ route('payments') }}"><i class="fa fa-money"></i> @lang('app.payments')</a></li>

        <li><a href="{{ route('change_password') }}"><i class="fa fa-lock"></i> @lang('app.change_password')</a></li>


    </el-menu>


</div>

