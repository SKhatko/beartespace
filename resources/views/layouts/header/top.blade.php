<div class="app-header--top">

    @if(Route::currentRouteName() === 'home' && !auth()->user())
        <div class="app--wrapper links hidden-xs-only">
            <a href="{{ route('page', 'freight')}}">Always free shipping ( {{ geoip(request()->ip())->country }})</a>
            <a href="{{ route('page', 'right-of-cancellation')}}">14-days return right</a>
            <a href="{{ route('selected-artworks')}}">Best art selection</a>
        </div>
    @endif

    @if(auth()->user() && !auth()->user()->email_verified)
        <div class="app-wrapper">
            <div class="email">
                <div class="h4">Hi, your account is unconfirmed.</div>
                <div class="p"> Confirm <b>{{ auth()->user()->email }}</b> for access to all functionality BearteSpace.</div>
                <a href="{{ route('confirm-email.resend') }}" class="el-button el-button--default el-button--mini" style="margin-right: 10px;">Resend email</a>
                <a href="{{ route('dashboard.profile') }}">Change your email</a>
            </div>
        </div>

    @endif
</div>
