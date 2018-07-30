<div class="app-artworks-list">

    @if($artworks[0]->count())
        @foreach($artworks as $artwork)

            <partials-artwork :artwork_="{{ $artwork }}"
                              :price_="'{{ currency($artwork->price) . optionalPrice($artwork->price) }}'"></partials-artwork>

        @endforeach
    @endif

</div>