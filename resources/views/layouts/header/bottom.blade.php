@if(Route::currentRouteName() === 'home')
    <div class="app-header--bottom">

        <div class="app-header-logo">
            <a href="{{ route('home') }}">
                <img src="/imagecache/height-80/logo.png" title="BeArteSpace" alt="BeArteSpace logo"/>
            </a>
        </div>

        <div class="app-header-links">

            <a href="{{ route('artists') }}">@lang('portal.artists')</a>
            <a href="{{ route('artworks') }}">@lang('portal.artworks')</a>
            <a href="{{ route('auctions') }}">on-line auctions</a>

        </div>

        <div class="app-header-search">
            <form action="{{ route('search') }}">
                {{ csrf_field() }}

                <el-input required
                          placeholder="Search artworks and artists" name="query" value="{{ Request::get('query') }}">
                    {{--prefix-icon="el-icon-search"--}}
                    <el-button native-type="submit" slot="append" icon="el-icon-search"></el-button>
                </el-input>

            </form>
        </div>
    </div>
@endif
