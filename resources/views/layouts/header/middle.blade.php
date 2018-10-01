<div class="app-header--middle">

    <div class="app--wrapper middle">

        <div class="app-header--left">

            @if(Route::currentRouteName() === 'home')
                <div class="app-header-invites">
                    <a href="{{ route('invite.artist') }}">For Artists</a>| &nbsp;
                    <a href="{{ route('invite.gallery') }}">For Galleries</a>| &nbsp;
                    <a href="{{ route('invite.writer') }}">For Art Writers</a>
                </div>
            @else
                {{--        @elseif(Request::segment(1) === 'dashboard' || Request::segment(1) === 'login' || Request::segment(1) === 'register')--}}
                <div class="app-header-logo">
                    <a href="{{ route('home') }}">
                        <img src="/imagecache/height-40/logo.png" alt="BeArteSpace logo"/>
                    </a>
                </div>

                <div class="app-header-search">
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

                <div class="app-header-buttons">
                    <a href="{{ route('artists') }}">@lang('portal.artists')</a> |
                    <a href="{{ route('artworks') }}">@lang('portal.artworks')</a> |
                    <a href="{{ route('auctions') }}">on-line auctions</a>
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
            @if (Auth::guest())

                <signup-dialog type_="link"></signup-dialog>

                <a href="{{ route('login') }}" style="margin-left: 10px;"
                   class="el-button el-button--default is-plain">@lang('portal.sign-in')</a> &nbsp;
            @else
                <el-popover
                        placement="bottom"
                        width="230"
                        trigger="click">

                    <el-dropdown-item>
                        <a href="{{route('dashboard.profile')}}">View Profile</a>
                    </el-dropdown-item>

                    <el-dropdown-item divided>
                        <a href="{{route('dashboard')}}" class="el-dropdown-link">Dashboard</a>
                    </el-dropdown-item>

                    <el-dropdown-item>
                        <a href="{{route('dashboard.favorites')}}" class="el-dropdown-link">Favorites</a>
                    </el-dropdown-item>

                    <el-dropdown-item>
                        <a href="{{ route('dashboard.orders') }}" class="el-dropdown-link">Orders</a>
                    </el-dropdown-item>

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
                            <a href="/horizon"><i class="el-icon-service"></i> Horizon</a>
                        </el-dropdown-item>

                    @endif

                    <el-dropdown-item>
                        <a href="{{route('dashboard.change-password')}}" class="el-dropdown-link">Change
                            Password</a>
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

                    <div slot="reference" class="app-header-auth-dropdown">
                              <span class="app-header-auth-avatar">
                                  <img src="/imagecache/mini-avatar/{{ auth()->user()->avatar_url}}"/>
                              </span>
                        <div class="app-header-auth-name">
                            You
                            {{--                            {{ auth()->user()->name }}--}}

                            <i class="el-icon-arrow-down el-icon--right"></i>
                        </div>

                    </div>
                </el-popover>
            @endif
        </div>

        @if(!auth()->user() ? !Cookie::get('email_lead_subscription') : null)
            &nbsp; |
            <div class="app-header-subscribe">
                <el-popover
                        placement="bottom"
                        width="400"
                        trigger="click">
                    <el-form inline label-position="top" method="POST" action="{{ route('add-lead') }}">
                        {{ csrf_field() }}
                        <el-input name="email" type="email" placeholder="Sign up to our email news"
                                  required>
                            <el-button slot="append" native-type="submit" type="primary">Join</el-button>
                        </el-input>
                    </el-form>
                    <div slot="reference">Subscribe for Newsletters</div>

                </el-popover>
            </div>
        @endif

        @if(auth()->user())
            <a href="{{ route('dashboard.favorites') }}" class="app-header-favorites">
        <span class="app-header-favorites-icon">
               <i class="el-icon-star-off"></i>
        <template v-if="$store.state.favoriteArtworksCount">
            <sup>@{{ $store.state.favoriteArtworksCount }}</sup>
        </template>
        </span>
                <span class="app-header-favorites-title">Favorites</span>
            </a>
        @endif

        <a href="{{ route('cart') }}" class="app-header-cart">
            <span class="app-header-cart-icon">
                   <i class="el-icon-goods"></i>
            <template v-if="$store.state.shoppingCartCount">
                <sup>@{{ $store.state.shoppingCartCount }}</sup>
            </template>
            </span>
            <span class="app-header-cart-title">Cart</span>
        </a>

        @if(auth()->user() && auth()->user()->user_type === 'artist')
            <a href="{{ route('dashboard.artwork.create') }}" class="el-button el-button--success el-button--mini"
               style="margin-left: 10px;">
                Upload Artwork
            </a>
        @endif
    </div>

</div>
