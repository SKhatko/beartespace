@if($artists->count())
    <div class="app-artists-block">
        @foreach($artists as $artist)

            <el-card style="margin-bottom: 20px;">
                <div class="artist">

                    <div class="artist-info">

                        <a href="{{ route('user', $artist->id) }}" class="artist-avatar">
                            <img src="/imagecache/fit-150{{ $artist->avatar_url }}"
                                 alt="{{ $artist->avatar ? $artist->avatar->name : $artist->name }}">
                        </a>

                        <a href="{{ $artist->url }}" class="h2"
                           style="margin-bottom: 20px;">
                            {{ $artist->name }}
                        </a>

                        <a href="{{ $artist->url }}" class="h3">
                            {{ $artist->country['country_name'] }}
                        </a>

                        @if(auth()->user())
                            <follow-button
                                    follow_="{{ auth()->user()->followedUsers->contains($artist->id) }}"
                                    user-id_="{{ $artist->id }}">
                                {{ $artist->name }}
                            </follow-button>
                        @endif

                    </div>

                    <div class="artist-artworks">

                        @foreach($artist->artworks->take(4) as $artwork)

                            <a href="{{ route('artwork', $artwork->id) }}" target="_blank" class="artist-artwork">
                                <img src="/imagecache/fit-150{{ $artwork->image_url }}"
                                     alt="{{ $artwork->image->name }}">
                            </a>

                        @endforeach

                    </div>

                </div>


            </el-card>

        @endforeach
    </div>
@endif
