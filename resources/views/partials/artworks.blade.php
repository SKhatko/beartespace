<div class="app-artworks-list">

    @foreach($artworks as $artwork)

        <el-card class="artwork">
            <div class="artwork-top">
                <a href="{{ route('artwork', $artwork->id) }}" class="artwork-image">
                    <img src="{{ $artwork->images()->first()->url }}" alt="">
                </a>

                <div class="artwork-panel">
                    <el-button icon="el-icon-star-off" class="artwork-panel-favourite"
                               circle></el-button>
                    <el-button icon="el-icon-goods" class="artwork-panel-cart" circle></el-button>

                    {{--<a href="#" class="artwork-favorite"><span class="e"></span></a>--}}
                    {{--<a href="{{ route('toggle-to-cart', $artwork->id) }}" class="artwork-cart"><span class="el-icon-goods"></span></a>--}}
                </div>
            </div>

            <a href="{{ route('artwork', $artwork->id) }}" class="artwork-title">
                {{ $artwork->title }}
            </a>

            <div class="artwork-bottom">
                <div class="artwork-info">
                    <div class="h4">{{ $artwork->user['name'] }}</div>
                    <div class="h5">{{ $artwork->user->country['country_name'] }}</div>
                </div>

                <div class="artwork-price">
                    {{ $artwork->price }} EUR
                </div>
            </div>


        </el-card>

    @endforeach

</div>