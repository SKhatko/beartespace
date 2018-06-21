<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@section('title') {{ get_option('site_title') }} @show</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @yield('page-css')

    @if(get_option('additional_css'))
        <style type="text/css">
            {{ get_option('additional_css') }}
        </style>
    @endif

    <script type="text/javascript">
        window.jsonData = {!! frontendLocalisedJson() !!};
    </script>

</head>
<body class="@if(is_rtl()) rtl @endif">
<div id="app" class="app">

    <div class="app-header">

        <div class="app-header--top">
            <div class="app-header-links">
                <a href="{{ route('home') }}" class="app-header-links__link">BeArteBid Gallery</a>
                <a href="{{ route('auctions') }}" class="app-header-links__link">Auctions</a>
            </div>

            <div class="app-header-languages">

                @if(get_option('enable_language_switcher') == 1)

                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true"
                           aria-expanded="false"> @if($current_lang) {{$current_lang->language_name}} @else @lang('app.language') @endif
                            <span class="caret"></span></a>
                        <div class="dropdown-menu">
                            <div>
                                <a href="{{ route('switch_language', 'en') }}">English</a>
                            </div>
                            @foreach(get_languages() as $lang)
                                <div>
                                    <a href="{{ route('switch_language', $lang->language_code) }}">{{ $lang->language_name }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="app-header-auth">

                @if (Auth::guest())
                    <div><a href="{{ route('login') }}">@lang('app.login')</a></div>
                    <div><a href="{{ route('register') }}">@lang('app.register')</a></div>
                @else
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            {{ auth()->user()->name }} <span class="headerAvatar"> <img
                                        src="{{auth()->user()->get_gravatar()}}"/> </span> <span
                                    class="caret"></span>
                        </a>

                        <div class="dropdown-menu" role="menu">
                            <div><a href="{{route('dashboard')}}"> @lang('app.dashboard') </a></div>
                            <div>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    @lang('app.logout')
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <a href="{{ route('checkout') }}" class="app-header-basket">
                <i class="fa fa-shopping-cart"></i>
            </a>

            <a href="{{ route('contact_us_page') }}" class="app-header-contact">
                Contact
            </a>

        </div>

        <div class="app-header--bottom">

            <a class="app-header-logo" href="{{ route('home') }}">
                <img src="{{ logo_url() }}" title="{{get_option('site_name')}}" alt="{{get_option('site_name')}}"/>
            </a>

            <div class="app-header-search">
                <form action="{{ route('search_redirect') }}">
                    {{ csrf_field() }}

                    <input type="text" class="app-header-search__input" name="q"
                           placeholder="@lang('app.what_are_u_looking')">
                </form>
            </div>


            <!-- TODO refactor -->
            &nbsp;<div><a href="{{route('home')}}">@lang('app.home')</a></div>
            @if($header_menu_pages->count() > 0)
                @foreach($header_menu_pages as $page)
                    <div><a href="{{ route('single_page', $page->slug) }}">{{ $page->title }}</a></div>
                @endforeach
            @endif
            &nbsp;<div><a href="{{route('create_ad')}}">@lang('app.post_an_ad')</a></div>

        </div>
    </div>

    <div class="app-content">
        @yield('content')
    </div>

    <div class="app-footer">

        <div class="app-footer-menu">
            <div><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('app.home')</a></div>

            @if($show_in_footer_menu->count() > 0)
                @foreach($show_in_footer_menu as $page)
                    <div><a href="{{ route('single_page', $page->slug) }}">{{ $page->title }} </a></div>
                @endforeach
            @endif
            <div><a href="{{ route('contact_us_page') }}">@lang('app.contact_us')</a></div>
        </div>

        <div class="app-footer-heading">
            {{get_option('site_name')}}
        </div>

        <div class="app-footer-copyright">
            {{get_text_tpl(get_option('footer_copyright_text'))}}
        </div>


        <div class="app-footer-social">
            <a href="{{ get_option('facebook_url') }}"><i class="fa fa-facebook"></i></a>
            <a href="{{ get_option('twitter_url') }}"><i class="fa fa-twitter"></i> </a>
            <a href="{{ get_option('google_plus_url') }}"><i class="fa fa-google-plus"></i> </a>
            <a href="{{ get_option('youtube_url') }}"><i class="fa fa-youtube"></i> </a>
            <a href="{{ get_option('linked_in_url') }}"><i class="fa fa-linkedin"></i> </a>
            <a href="{{ get_option('dribble_url') }}"><i class="fa fa-dribbble"></i> </a>
        </div>

    </div>

</div>


<!-- Conditional page load script -->
@if(request()->segment(1) === 'dashboard')
    <script>

    </script>
@endif

<script src="{{ mix('js/app.js') }}"></script>


@if(get_option('additional_js'))
    {!! get_option('additional_js') !!}
@endif

@yield('page-js')
</body>
</html>
