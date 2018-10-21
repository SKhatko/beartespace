<div class="app-header--middle">

    <div class="app--wrapper middle">

        <div class="app-header--left">

            <div class="app-header-toggle hidden-sm-and-up" @click="showMainMenu = !showMainMenu">
                <i class="el-icon-minus"></i>
                <i class="el-icon-minus"></i>
                <i class="el-icon-minus"></i>
            </div>

            <a href="{{ route('home') }}" class="app-header-logo">
                <img src="/imagecache/height-40/logo.png" alt="BeArteSpace logo" class="hidden-xs-only"/>
                <img src="/imagecache/height-40/b-favicon-64.png" alt="BeArteSpace logo" class="hidden-sm-and-up"/>
            </a>

            @if(Route::currentRouteName() !== 'home')
                <div class="app-header-search hidden-xs-only">
                    <el-form action="{{ route('search') }}">
                        {{ csrf_field() }}

                        <el-input required
                                  placeholder="Search..." name="query"
                                  value="{{ Request::get('query') }}">
                            {{--prefix-icon="el-icon-search"--}}
                            <el-button native-type="submit" slot="append">Find</el-button>
                        </el-input>

                    </el-form>
                </div>
            @endif

        </div>

        <div class="app-header-currencies" style="display: none;">
            <el-dropdown trigger="click">
                      <span class="el-dropdown-link">
                          {{ getCurrentCurrency() }}
                          <i class="el-icon-arrow-down el-icon--right"></i>
                      </span>
                <el-dropdown-menu slot="dropdown">
                    @foreach(currency()->getCurrencies() as $currency)
                        @if($currency['code'] !== getCurrentCurrency())
                            <el-dropdown-item>
                                <a href="{{ route('switch-currency', $currency['code']) }}">{{ $currency['code'] }}</a>
                            </el-dropdown-item>
                        @endif
                    @endforeach
                </el-dropdown-menu>
            </el-dropdown>
        </div>

        <div class="app-header-languages" style="display: none;">
            <el-dropdown trigger="click">
                      <span class="el-dropdown-link">
                          {{ currentLanguage()->name ?? 'en' }}
                          <i class="el-icon-arrow-down el-icon--right"></i>
                      </span>
                <el-dropdown-menu slot="dropdown">
                    @foreach(getLanguages() as $lang)
                        @if($lang->code !== app()->getLocale())
                            <el-dropdown-item>
                                <a href="{{ route('switch-language', $lang->code) }}">{{ $lang->name }}</a>
                            </el-dropdown-item>
                        @endif
                    @endforeach
                </el-dropdown-menu>
            </el-dropdown>
        </div>

        <div class="app-header-auth">

            <a href="/sell" class="app-header-sell">Sell <span class="hidden-xs-only">on BearteSpace</span></a>

            @if (Auth::guest())

                | <a href="/register" style="margin-left: 2%;">{{ trans('portal.register') }}</a>

                <a href="{{ route('login') }}"
                   class="el-button el-button--default is-plain hidden-xs-only"
                   style="margin-left: 2%;">@lang('portal.sign-in')</a> &nbsp;
                <a href="{{ route('login') }}" style="margin-left: 2%;"
                   class="el-button el-button--default is-plain hidden-sm-and-up el-button--mini">@lang('portal.sign-in')</a>
                &nbsp;
            @else
                <el-popover
                        placement="bottom"
                        width="230"
                        trigger="click" class="app-header-auth-dropdown">

                    <el-dropdown-item>
                        <a href="{{route('dashboard')}}">View Profile</a>
                    </el-dropdown-item>

                    <el-dropdown-item divided>
                        <a href="{{route('dashboard.favorites')}}" class="el-dropdown-link">Favorites</a>
                    </el-dropdown-item>

                    @if(auth()->user()->orders->count() > 0 )
                        <el-dropdown-item>
                            <a href="{{ route('dashboard.orders') }}" class="el-dropdown-link">Orders</a>
                        </el-dropdown-item>
                    @endif

                    @if(!auth()->user()->isUser())

                        <el-dropdown-item>
                            <a href="{{route('dashboard.artworks')}}" class="el-dropdown-link">Artworks</a>
                        </el-dropdown-item>

                        <el-dropdown-item>
                            <a href="{{route('dashboard.artwork.create')}}" class="el-dropdown-link">Upload
                                Artwork</a>
                        </el-dropdown-item>

                    @endif

                    @if(auth()->user()->isAdmin())

                        <el-dropdown-item>
                            <a href="{{ route('admin.payments') }}" class="el-dropdown-link">Payments</a>
                        </el-dropdown-item>

                        <el-dropdown-item>
                            <a href="{{route('admin.messages')}}" class="el-dropdown-link"><i
                                        class="el-icon-message"></i> Messages</a>
                        </el-dropdown-item>

                        <el-dropdown-item>
                            <a href="{{ route('admin.users') }}"><i class="icon-user-outline"></i> Users</a>
                        </el-dropdown-item>

                        <el-dropdown-item>
                            <a href="{{ route('admin.translations') }}"><i class="el-icon-tickets"></i>
                                Translations</a>
                        </el-dropdown-item>

                        <el-dropdown-item>
                            <a href="{{ route('admin.languages') }}"><i class="el-icon-setting"></i>
                                Languages</a>
                        </el-dropdown-item>

                        <el-dropdown-item>
                            <a href="{{ route('admin.settings') }}"><i class="el-icon-setting"></i> Settings</a>
                        </el-dropdown-item>

                        <el-dropdown-item>
                            <a href="{{ route('admin.pages') }}"><i class="el-icon-document"></i> Pages</a>
                        </el-dropdown-item>

                        <el-dropdown-item>
                            <a href="{{ route('admin.articles') }}"><i class="el-icon-document"></i> Articles</a>
                        </el-dropdown-item>

                        <el-dropdown-item>
                            <a href="/horizon"><i class="el-icon-service"></i> Horizon</a>
                        </el-dropdown-item>

                    @endif

                    <el-dropdown-item>
                        <a href="{{route('dashboard.account')}}" class="el-dropdown-link">Account Settings</a>
                    </el-dropdown-item>

                    <el-dropdown-item divided>
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

                    <div slot="reference">
                              <span class="app-header-auth-avatar">
                                  <img src="/imagecache/fit-25/{{ auth()->user()->avatar_url}}"/>
                              </span>
                        <div class="app-header-auth-name hidden-xs-only">
                            You

                            <i class="el-icon-arrow-down el-icon--right"></i>
                        </div>

                    </div>
                </el-popover>
            @endif
        </div>

        @if(auth()->user())
            <a href="{{ route('dashboard.favorites') }}" class="app-header-favorites">
        <span class="app-header-favorites-icon">
               <i class="el-icon-star-off"></i>
        <template v-if="$store.state.favoriteArtworksCount">
            <sup>@{{ $store.state.favoriteArtworksCount }}</sup>
        </template>
        </span>
                <span class="app-header-favorites-title hidden-xs-only">Favorites</span>
            </a>
        @endif

        <a href="{{ route('cart') }}" class="app-header-cart">
            <span class="app-header-cart-icon">
                   <i class="el-icon-goods"></i>
            <template v-if="$store.state.shoppingCartCount">
                <sup>@{{ $store.state.shoppingCartCount }}</sup>
            </template>
            </span>
            <span class="app-header-cart-title hidden-xs-only">Cart</span>
        </a>

    </div>

</div>
