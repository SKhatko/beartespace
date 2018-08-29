@if(count($artworks))

    <div class="app-artworks-list">

        @foreach($artworks as $artwork)

            <partials-artwork artwork_="{{ $artwork }}"></partials-artwork>

        @endforeach
    </div>

@else
    <h2 class="h2" style="text-align: center;margin: 50px 0;">
        No artworks found
    </h2>
@endif
