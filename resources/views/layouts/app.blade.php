<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@section('title') BeArteSpace @show</title>

    {{--<link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">--}}

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/icons.css') }}" rel="stylesheet">

    @yield('page-css')

    <script>
        window.trans = {!! $translations !!};

        window.errors = {!! json_encode($errors->all()) !!}

    </script>

</head>
<body class="@if(is_rtl()) rtl @endif">

<div id="app" class="app">

    <el-container>

        <el-header height="auto" class="app-header">

            <div class="app-header--top">

                @if(Request::segment(1) === 'dashboard')
                    <div class="app-header-logo">
                        <a class="app-header-logo__link" href="{{ route('home') }}">
                            <img src="/images/logo-100.png" alt="BeArteSpace logo"/>
                        </a>
                    </div>
                @endif

                <div class="app-header-languages">
                    <el-dropdown trigger="hover">
                      <span class="el-dropdown-link">
                          {{$current_lang->name ?? 'en' }}
                          <i class="el-icon-arrow-down el-icon--right"></i>
                      </span>
                        <el-dropdown-menu slot="dropdown">
                            @foreach(get_languages() as $lang)
                                @if($lang->code !== app()->getLocale())
                                    <el-dropdown-item>
                                        <a href="{{ route('switch_language', $lang->code) }}">{{ $lang->name }}</a>
                                    </el-dropdown-item>
                                @endif
                            @endforeach
                        </el-dropdown-menu>
                    </el-dropdown>
                </div>

                <div class="app-header-auth">
                    @if (Auth::guest())
                        <a href="{{ route('login') }}">@lang('portal.login')</a>&nbsp; | &nbsp; <a
                                href="{{ route('register') }}">@lang('portal.signup')</a>
                    @else
                        <el-dropdown trigger="hover">
                      <span class="el-dropdown-link">
                         {{ auth()->user()->name }}
                          {{--                          <img src="{{auth()->user()->get_gravatar()}}" class="app-header-auth__photo"/>--}}

                          <i class="el-icon-arrow-down el-icon--right"></i>
                      </span>
                            <el-dropdown-menu slot="dropdown">

                                <el-dropdown-item>
                                    <a href="{{route('dashboard')}}" class="el-dropdown-link">Dashboard</a>
                                </el-dropdown-item>

                                <el-dropdown-item>
                                    <a href="{{route('dashboard.profile')}}" class="el-dropdown-link">Profile</a>
                                </el-dropdown-item>

                                @if(!$lUser->isUser())

                                    <el-dropdown-item>
                                        <a href="{{route('dashboard.artworks')}}" class="el-dropdown-link">My Artworks</a>
                                    </el-dropdown-item>

                                    <el-dropdown-item>
                                        <a href="{{route('dashboard.artwork.create')}}" class="el-dropdown-link">Upload Artwork</a>
                                    </el-dropdown-item>

                                @endif

                                @if($lUser->isAdmin())

                                    <el-dropdown-item>
                                        <i class="el-icon-message"></i>
                                        <a href="{{route('admin.messages')}}" class="el-dropdown-link">Messages</a>
                                    </el-dropdown-item>

                                    <el-dropdown-item>
                                        <i class="icon-user"></i>
                                       <a href="{{ route('admin.users') }}">Users</a>
                                    </el-dropdown-item>

                                    <el-dropdown-item>
                                        <i class="el-icon-tickets"></i>
                                        <a href="{{ route('admin.translations') }}">Translations</a>
                                    </el-dropdown-item>

                                    <el-dropdown-item>
                                        <i class="el-icon-setting"></i>
                                        <a href="{{ route('admin.languages') }}">Languages</a>
                                    </el-dropdown-item>

                                    <el-dropdown-item>
                                        <i class="el-icon-document"></i>
                                       <a href="{{ route('admin.pages') }}">Pages</a>
                                    </el-dropdown-item>

                                @endif

                                <el-dropdown-item>
                                    <a href="{{route('change-password')}}" class="el-dropdown-link">Change Password</a>
                                </el-dropdown-item>

                                <el-dropdown-item>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                       class="el-dropdown-link">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </el-dropdown-item>

                            </el-dropdown-menu>
                        </el-dropdown>
                    @endif
                </div>

                <a href="{{ route('shopping-cart') }}" class="app-header-basket">

                    @if(session('cart') && session('cart')->totalQuantity > 0)
                        <span class="el-icon-goods"></span><sup>{{ session('cart')->totalQuantity }}</sup>
                    @else
                        <span class="el-icon-sold-out"></span>
                    @endif

                </a>

            </div>

            @if(Request::segment(1) !== 'dashboard')
                <div class="app-header--bottom">

                    <div class="app-header-logo">
                        <a class="app-header-logo__link" href="{{ route('home') }}">
                            <img src="/images/logo-200.png" title="BeArteSpae" alt="BeArteSpace logo"/>
                        </a>
                    </div>

                    <div class="app-header-links">

                        <a href="{{ route('artists') }}">@lang('portal.artists')</a>
                        <a href="{{ route('artworks') }}">@lang('portal.artworks')</a>
                        <a href="{{ route('auctions') }}">@lang('portal.auction')</a>

                        <el-dropdown trigger="hover">
                      <span class="el-dropdown-link">
                       @lang('portal.about-us')
                      </span>
                            <el-dropdown-menu slot="dropdown">
                                <el-dropdown-item><a href="{{ route('rules')}}">About BeArteSpace</a></el-dropdown-item>
                                <el-dropdown-item><a href="{{ route('rules')}}">BeArte Gallery</a></el-dropdown-item>
                                <el-dropdown-item><a href="{{ route('rules')}}">BeArte Design</a></el-dropdown-item>
                            </el-dropdown-menu>
                        </el-dropdown>
                        <el-dropdown trigger="hover">
                      <span class="el-dropdown-link">
                       @lang('portal.information')
                      </span>
                            <el-dropdown-menu slot="dropdown">
                                <el-dropdown-item><a href="{{ route('rules')}}">Terms and Conditions</a>
                                </el-dropdown-item>
                                <el-dropdown-item><a href="{{ route('rules')}}">Rights to Cancellation</a>
                                </el-dropdown-item>
                                <el-dropdown-item><a href="{{ route('rules')}}">Warranty</a></el-dropdown-item>
                                <el-dropdown-item><a href="{{ route('rules')}}">Taxes</a></el-dropdown-item>
                                <el-dropdown-item><a href="{{ route('shipping')}}">Freight</a></el-dropdown-item>
                                <el-dropdown-item><a href="{{ route('rules')}}">Cookies and Privacy Regulation</a>
                                </el-dropdown-item>
                            </el-dropdown-menu>
                        </el-dropdown>

                        <a href="{{ route('contact-form') }}">@lang('portal.contact')</a>

                    </div>

                    <div class="app-header-search">
                        <form action="{{ route('search') }}" method="POST">
                            {{ csrf_field() }}

                            <el-input required
                                    placeholder="Search" name="query"
                                    prefix-icon="el-icon-search">
                            </el-input>

                        </form>
                    </div>
                </div>
            @endif


        </el-header>

        <el-container class="app-content">

            @yield('content')

        </el-container>

        <el-footer height="auto" class="app-footer">

            <div class="app-footer--top">

                <div class="app-footer-social">
                    <a href="{{ get_option('facebook_url') }}"><i class="fa fa-facebook"></i></a>
                    <a href="{{ get_option('twitter_url') }}"><i class="fa fa-twitter"></i> </a>
                    <a href="{{ get_option('google_plus_url') }}"><i class="fa fa-google-plus"></i> </a>
                    <a href="{{ get_option('youtube_url') }}"><i class="fa fa-youtube"></i> </a>
                    <a href="{{ get_option('linked_in_url') }}"><i class="fa fa-linkedin"></i> </a>
                    <a href="{{ get_option('dribble_url') }}"><i class="fa fa-dribbble"></i> </a>
                </div>

                <div class="app-footer-newsletter">

                    <el-form inline label-position="top" method="POST" action="{{ route('add-lead') }}">
                        {{ csrf_field() }}
                        <el-form-item label="Sign Up to be informed about new Artworks">
                            <el-input name="email" type="email">
                                <el-button slot="append" native-type="submit" type="primary">Send</el-button>
                            </el-input>
                        </el-form-item>
                    </el-form>
                </div>

            </div>

            <div class="app-footer--bottom">
                <div class="app--wrapper">
                    <el-row :gutter="20">
                        <el-col :span="4">
                            <el-card shadow="hover">
                                <div slot="header" class="clearfix">
                                    <span>@lang('portal.about-us')</span>
                                </div>
                                <a href="{{ route('rules')}}">About BeArteSpace</a>
                                <a href="{{ route('rules')}}">BeArte Gallery</a>
                                <a href="{{ route('rules')}}">BeArte Design</a>
                            </el-card>
                        </el-col>
                        <el-col :span="4">
                            <el-card shadow="hover">
                                <div slot="header" class="clearfix">
                                    <span>For Clients</span>
                                </div>
                                <a href="{{ route('artists')}}">@lang('portal.artists')</a>
                                <a href="{{ route('artworks')}}">@lang('portal.artworks')</a>
                            </el-card>
                        </el-col>
                        <el-col :span="4">
                            <el-card shadow="hover">
                                <div slot="header" class="clearfix">
                                    <span>@lang('portal.information')</span>
                                </div>
                                <a href="{{ route('rules')}}">Terms & Conditions</a>
                                <a href="{{ route('rules')}}">RIghts to Cancellation</a>
                                <a href="{{ route('rules')}}">Warranty</a>
                                <a href="{{ route('rules')}}">Taxes</a>
                            </el-card>
                        </el-col>

                        <el-col :span="4">
                            <el-card shadow="hover">
                                <div slot="header" class="clearfix">
                                    <span>@lang('portal.auction')</span>
                                </div>
                                <a href="{{ route('auctions')}}">Go to Online Auction</a>
                            </el-card>
                        </el-col>

                        <el-col :span="8">
                            <el-card shadow="hover">
                                <div slot="header" class="clearfix">
                                    <span>@lang('portal.contact')</span>
                                </div>

                                {!! showPage('contacts-in-footer') !!}
                            </el-card>
                        </el-col>
                    </el-row>

                </div>

            </div>


        </el-footer>

    </el-container>

</div>

<script src="{{ mix('js/app.js') }}"></script>

@yield('page-js')

@yield('scripts')

</body>
</html>
