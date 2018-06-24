<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@section('title') BeArteBid @show</title>

    {{--<link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">--}}

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @yield('page-css')

</head>
<body class="@if(is_rtl()) rtl @endif">

<div id="app" class="app">

    <el-container>

        <el-header height="auto" class="app-header">

            <div class="app-header--top">

                @if(Request::segment(1) === 'dashboard')
                    <a class="app-header-logo" href="{{ route('home') }}">
                        <img src="{{ logo_url() }}" title="BeArteBid" alt="BeArteBid logo"/>
                    </a>
                @endif

                <div class="app-header-languages">
                    <el-dropdown trigger="hover">
                      <span class="el-dropdown-link">
                          {{$current_lang->name}}
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
                        <a href="{{ route('login') }}">Login</a>&nbsp; | &nbsp; <a href="{{ route('register') }}">Register</a>
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
                                    <a href="{{route('profile')}}" class="el-dropdown-link">Profile</a>
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

                <a href="{{ route('checkout') }}" class="app-header-basket">
                    <el-badge is-dot class="item">
                        {{--<i class="el-icon-goods"></i>--}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 21">
                            <g fill="none" fill-rule="evenodd" transform="translate(0 1)">
                                <path stroke="#333" stroke-linecap="round"
                                      d="M0 .478h4.667l3.734 13.077H23.35l2.804-8.635"></path>
                                <circle cx="21.25" cy="17.669" r="1.635" fill="#333"></circle>
                                <circle cx="10.232" cy="17.924" r="1.635" fill="#333"></circle>
                            </g>
                        </svg>
                    </el-badge>
                </a>

            </div>

            @if(Request::segment(1) !== 'dashboard')
                <div class="app-header--bottom">


                    <a class="app-header-logo" href="{{ route('home') }}">
                        <img src="{{ logo_url() }}" title="BeArteBid" alt="BeArteBid logo"/>
                    </a>

                    <div class="app-header-links">


                        <a href="{{ route('home') }}" class="app-header-links__link">Home</a>
                        <a href="{{ route('artists') }}" class="app-header-links__link">Artists</a>
                        <a href="{{ route('paintings') }}" class="app-header-links__link">Paintings</a>
                        <a href="{{ route('sculptures') }}" class="app-header-links__link">Sculptures</a>
                        <a href="{{ route('auctions') }}" class="app-header-links__link">Auction</a>
                        <a href="{{ route('contacts') }}" class="app-header-links__link">Contacts</a>

                        <el-dropdown trigger="hover">
                      <span class="el-dropdown-link">
                       About
                      </span>
                            <el-dropdown-menu slot="dropdown">
                                <el-dropdown-item><a href="{{ route('rules')}}">The rules</a></el-dropdown-item>

                                <el-dropdown-item><a href="{{ route('shipping')}}">Shipping / Payments</a>
                                </el-dropdown-item>
                            </el-dropdown-menu>
                        </el-dropdown>


                        <div class="app-header-search">
                            <form action="{{ route('search_redirect') }}">
                                {{ csrf_field() }}

                                <el-input
                                        placeholder="Search" name="q"
                                        prefix-icon="el-icon-search">
                                </el-input>

                            </form>
                        </div>


                        <!-- TODO refactor -->
                        {{--@if($header_menu_pages->count() > 0)--}}
                        {{--@foreach($header_menu_pages as $page)--}}
                        {{--<div><a href="{{ route('single_page', $page->slug) }}">{{ $page->title }}</a></div>--}}
                        {{--@endforeach--}}
                        {{--@endif--}}

                    </div>
                </div>
            @endif


        </el-header>

        <el-container class="app-content">

            @yield('content')

        </el-container>

        <el-footer height="auto" class="app-footer">

            <div class="app-footer-menu">
                <div><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('portal.home')</a></div>

                @if($show_in_footer_menu->count() > 0)
                    @foreach($show_in_footer_menu as $page)
                        <div><a href="{{ route('single_page', $page->slug) }}">{{ $page->title }} </a></div>
                    @endforeach
                @endif
                <div><a href="{{ route('contacts') }}">@lang('portal.contacts')</a></div>
            </div>

            <div class="app-footer-heading">
                {{get_option('site_name')}}
            </div>

            <div class="app-footer-copyright">
                Copyright text
            </div>

            <div class="app-footer-social">
                <a href="{{ get_option('facebook_url') }}"><i class="fa fa-facebook"></i></a>
                <a href="{{ get_option('twitter_url') }}"><i class="fa fa-twitter"></i> </a>
                <a href="{{ get_option('google_plus_url') }}"><i class="fa fa-google-plus"></i> </a>
                <a href="{{ get_option('youtube_url') }}"><i class="fa fa-youtube"></i> </a>
                <a href="{{ get_option('linked_in_url') }}"><i class="fa fa-linkedin"></i> </a>
                <a href="{{ get_option('dribble_url') }}"><i class="fa fa-dribbble"></i> </a>
            </div>

        </el-footer>

    </el-container>

</div>

<script src="{{ mix('js/app.js') }}"></script>

@yield('page-js')

</body>
</html>
