<div class="app-artworks-list">

    @foreach($artworks as $artwork)

        <partials-artwork :artwork_="{{ $artwork }}" :price_="'{{ currency($artwork->price) . optionalPrice($artwork->price) }}'"></partials-artwork>

    @endforeach

</div>
