<div class="app-footer--top">

    <div class="app--wrapper">

        @if(!auth()->user() ? !Cookie::get('email_lead_subscription') : null)
            <div class="app-footer-subscribe">

                <div class="app-footer-subscribe-label">
                    Get fresh BearteSpace trends and unique gift ideas delivered right to your inbox. <br>
                    Sign up for our newsletter for exclusive deals, discount codes, and more!

                </div>
                <el-form method="POST"
                         action="{{ route('add-lead') }}">
                    {{ csrf_field() }}
                    <el-input name="email" type="email"
                              placeholder="Email" required>
                        <el-button slot="append" native-type="submit" type="primary">Join
                        </el-button>
                    </el-input>
                </el-form>
            </div>
        @endif


        <div class="app-footer-promos">

            <div class="promo">
                <div class="promo--top">
                    <div class="promo-image">
                        <i class="icon-wallet"></i>
                    </div>

                    <div class="h2">
                        Secured Payment
                    </div>

                    <div class="promo-description">
                        <div>Via</div>
                        <div class="icons">
                            <i class="icon-mastercard"></i>
                            <i class="icon-visa"></i>
                            <i class="icon-cc-paypal"></i>
                        </div>
                    </div>
                </div>

                <a href="{{ route('page', 'warranty')}}" class="promo-link">Learn more</a>

            </div>


            <div class="promo">
                <div class="promo--top">
                    <div class="promo-image">
                        <i class="icon-truck"></i>
                    </div>

                    <div class="h2">
                        Fast Delivery
                    </div>

                    <div class="promo-description">
                        We use DHL as a courier. Delivery time is dependent on recipient country
                    </div>
                </div>

                <a href="{{ route('page', 'freight')}}" class="promo-link">Learn more</a>
            </div>

            <div class="promo">
                <div class="promo--top">
                    <div class="promo-image">
                        <i class="icon-dropbox"></i>
                    </div>

                    <div class="h2">
                        Free Delivery
                    </div>

                    <div class="promo-description">
                        We deliver your new work of art freely
                    </div>
                </div>

                <a href="{{ route('page', 'freight')}}" class="promo-link">Learn more</a>
            </div>

            <div class="promo">
                <div class="promo--top">
                    <div class="promo-image">
                        <i class="icon-megaphone"></i>
                    </div>

                    <div class="h2">
                        Customer Support
                    </div>

                    <div class="promo-description">
                        +45 XXXX XXXX
                        sales@beartespace.com
                    </div>
                </div>

                <a href="{{ route('contact-form') }}" class="promo-link">Learn more</a>

            </div>

        </div>

    </div>

</div>
