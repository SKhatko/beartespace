<div class="app-header--top">

    <a href="{{ route('page', 'freight')}}">Always free shipping ( {{ geoip(request()->ip())->country }}
        )</a>
    <a href="{{ route('page', 'right-of-cancellation')}}">14-days return right</a>
    <a href="{{ route('selected-artworks')}}">Best art selection</a>

</div>
