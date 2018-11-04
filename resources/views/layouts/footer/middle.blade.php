<div class="app-footer--middle">
    <div class="app--wrapper">
        <el-row :gutter="20">

            <el-col :sm="6" class="app-footer-column">

                <div class="app-footer-submenu">

                    <div class="h5">@lang('portal.about-us')</div>

                    <p>BearteSpace is the marketplace for artists to sell artworks, gain
                        global exposure, grow social media popularity, and get paid for their work and skills.</p>

                    <a href="{{ route('page', 'about-beartespace')}}">About BeArteSpace</a>
                    <a href="{{ route('page', 'about-beartegallery')}}">BeArte Gallery</a>
                    <a href="{{ route('page', 'about-beartedesign')}}">BeArte Design</a>
                </div>


                <div class="app-footer-submenu">

                    <div class="h5">For Clients</div>

                    <a href="{{ route('people')}}">@lang('portal.artists')</a>
                    <a href="{{ route('artworks')}}">@lang('portal.artworks')</a>
                </div>

            </el-col>
            <el-col :sm="6" class="app-footer-column">


                <div class="app-footer-submenu">
                    <div class="h5">@lang('portal.information')</div>

                    <a href="{{ route('page', 'terms-and-conditions')}}">Terms and Conditions</a>
                    <a href="{{ route('page', 'right-of-cancellation')}}">Rights to Cancellation</a>
                    <a href="{{ route('page', 'warranty')}}">Warranty</a>
                    <a href="{{ route('page', 'taxes')}}">Taxes</a>
                    <a href="{{ route('page', 'freight')}}">Freight</a>
                    <a href="{{ route('page', 'cookies-and-privacy')}}">Cookies and Privacy Regulation</a>
                    <a href="{{ route('contact-form') }}">@lang('portal.contact')</a>
                </div>

                <div class="app-footer-submenu">
                    <div class="h5">@lang('portal.auction')</div>

                    <a href="{{ route('auctions')}}">Go to Online Auction</a>
                </div>

            </el-col>
            <el-col :sm="6" class="app-footer-column">

                <div class="app-footer-submenu">
                    <div class="h5">@lang('portal.contact')</div>

{{--                    {!! showPageContent(1) !!}--}}
                </div>

                <div class="app-footer-submenu" style="display: none;">

                    <div class="app-footer-currencies">
                        Currency:
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

                    <div class="app-footer-languages">
                        Language:
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
                </div>

            </el-col>
            <el-col :sm="6" class="app-footer-column">

                <div class="app-footer-submenu">

                    <div class="h5">Stay connected</div>

                    <a href="#"><i class="icon-facebook"></i> Facebook</a>
                    <a href="#"><i class="icon-twitter"></i> Twitter</a>
                    <a href="#"><i class="icon-google"></i> Google+</a>
                    <a href="#"><i class="icon-instagram"></i> Instagram</a>

                </div>

            </el-col>

        </el-row>
    </div>
</div>
