<div class="app-artworks-list">

    @foreach($artworks as $artwork)

        <partials-artwork :artwork_="{{ $artwork }}"></partials-artwork>

    @endforeach

</div>