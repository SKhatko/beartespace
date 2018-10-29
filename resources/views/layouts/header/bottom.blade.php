<div class="app-header--bottom">

{{--    @dd(trans('artwork-category'))--}}
    <nav class="app-header-nav hidden-xs-only">


        <el-popover
                placement="bottom"
                trigger="hover">

            @foreach(trans('artwork-category') as $key => $trans)
                <el-dropdown-item>
                    <a href="/artwork?artwork-category={{ $key }}"
                       style="display: block;margin:10px 0">{{ $trans }}</a>
                </el-dropdown-item>
            @endforeach

            <a href="{{ route('artworks') }}" slot="reference">Artworks</a>
        </el-popover>

        <el-popover
                placement="bottom"
                trigger="hover">

            @foreach(trans('profession') as $key => $trans)
                <el-dropdown-item>
                    <a href="/people?profession={{ $key }}"
                       style="display: block;margin:10px 0">{{ $trans }}</a>
                </el-dropdown-item>
            @endforeach

            <a href="{{ route('people') }}" slot="reference">Artists</a>
        </el-popover>

        <el-popover
                placement="bottom"
                trigger="hover">

            @foreach(trans('article-category') as $key => $trans)
                <el-dropdown-item>
                    <a href="/article?article-category={{ $key }}"
                       style="display: block;margin:10px 0">{{ $trans }}</a>
                </el-dropdown-item>
            @endforeach

            <a href="{{ route('articles') }}" slot="reference">Articles</a>
        </el-popover>



        {{--<a href="{{ route('people') }}">@lang('portal.artists')</a>--}}
        {{--<a href="{{ route('artworks') }}">@lang('portal.artworks')</a>--}}
        {{--<a href="{{ route('auctions') }}">on-line auctions</a>--}}
        {{--<a href="{{ route('articles') }}">Articles</a>--}}

    </nav>

    <nav class="app-header-nav hidden-sm-and-up" v-if="showMainMenu">

        <a href="{{ route('people') }}">@lang('portal.artists')</a>
        <a href="{{ route('artworks') }}">@lang('portal.artworks')</a>
        {{--<a href="{{ route('auctions') }}">on-line auctions</a>--}}
        <a href="{{ route('articles') }}">Articles</a>

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
