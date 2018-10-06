<div class="app-cart-items">
    @foreach($cart as $artwork)

        <div class="item">
            <div class="item-image">
                <img src="/imagecache/height-100{{ $artwork->model->image_url }}"
                     alt="{{ $artwork->model->image ? $artwork->model->image->original_name : 'image' }}"
                     style="height: 100px;">
            </div>

            <div class="item-info">

                <a href="{{ route('artist', $artwork->model->user->id) }}" class="item-artist">
                                    <span class="item-artist-avatar">
                                        <img src="/imagecache/fit-25{{ $artwork->model->user->avatar_url}}"/>
                                    </span>

                    {{ $artwork->model->user->name }}
                </a>

                <a href="{{ route('artwork', $artwork->id) }}" class="item-description">
                    {{ $artwork->name }}
                </a>

                <a href="{{ route('cart.item.remove', $artwork->model->id) }}" class="item-remove">Remove</a>
            </div>

            <div class="item--right">

                <div class="item-qty">
                    Qty: {{ $artwork->qty }}
                </div>

                @if($artwork->model->availableInStockWithQuantity($artwork->qty) === 'available')

                    <div class="item-price">
                        {{ $artwork->model->formatted_price }}
                    </div>

                @else
                    <div class="item-status">
                        @lang('stock-status.' . $artwork->model->availableInStockWithQuantity($artwork->qty))
                    </div>
                @endif
            </div>

        </div>

    @endforeach
</div>