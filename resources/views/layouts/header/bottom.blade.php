<div class="app-header--bottom">

    <nav class="app-header-nav hidden-xs-only">

        <a href="{{ route('artists') }}">@lang('portal.artists')</a>
        <a href="{{ route('artworks') }}">@lang('portal.artworks')</a>
        {{--<a href="{{ route('auctions') }}">on-line auctions</a>--}}
        {{--<a href="{{ route('articles') }}">Articles</a>--}}

    </nav>

    <nav class="app-header-nav hidden-sm-and-up" v-if="showMainMenu">

        <a href="{{ route('artists') }}">@lang('portal.artists')</a>
        <a href="{{ route('artworks') }}">@lang('portal.artworks')</a>
        {{--<a href="{{ route('auctions') }}">on-line auctions</a>--}}
        {{--<a href="{{ route('articles') }}">Articles</a>--}}

    </nav>

    @if(Route::currentRouteName() === 'home')
        <div class="app-header-search">
            <form action="{{ route('search') }}">
                {{ csrf_field() }}

                <el-input required
                          placeholder="Search artworks and artists" name="query"
                          value="{{ Request::get('query') }}">
                    {{--prefix-icon="el-icon-search"--}}
                    <el-button native-type="submit" slot="append" icon="el-icon-search"></el-button>
                </el-input>

            </form>
        </div>
    @endif

</div>
