<div class="app-cart-items">
    @foreach($cart as $item)

        <div class="item">
            <div class="item-image">
                <img src="/imagecache/fit-100{{ $item->model->image_url }}"
                     alt="{{ $item->model->image ? $item->model->image->original_name : 'image' }}">
            </div>

            <div class="item-info">

                <a href="{{ $item->model->user->url }}" class="item-artist">
                                    <span class="item-artist-avatar">
                                        <img src="/imagecache/fit-25{{ $item->model->user->avatar_url}}"/>
                                    </span>

                    {{ $item->model->user->name }}
                </a>

                <a href="{{ route('artwork', $item->id) }}" class="item-description">
                    {{ $item->name }}
                </a>

                <a href="{{ route('cart.item.remove', $item->model->id) }}" class="item-remove">Remove</a>
            </div>

            <div class="item--right">

                <div class="item-qty">
                    Qty: {{ $item->qty }}
                </div>

                @if($item->model->statusString($item->qty) === 'available')

                    <div class="item-price">
                        {{ $item->model->formatted_price }}
                    </div>

                @else
                    <div class="item-status">
                        @lang('stock-status.' . $item->model->statusString($item->qty))
                    </div>
                @endif
            </div>

        </div>

    @endforeach
</div>