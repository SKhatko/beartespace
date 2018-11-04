@extends('layouts.simple')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    @if($seller)

        <div class="app--wrapper">

            <div class="app-artist"
                 @if($seller->image) style="background-image: url('/imagecache/original{{ $seller->image_url }}')" @endif>

                <div class="artist">

                    <div class="artist-profile">

                        <div class="artist-info">

                            <div class="artist--left">

                                <div class="artist-avatar">
                                    <img src="/imagecache/fit-290{{ $seller->avatar_url }}"
                                         alt="">
                                </div>

                            </div>

                            <div class="artist--right">

                                <div class="h1">{{ $seller->name }} </div>

                                <div class="h5" style="margin-bottom: 20px;">
                                    @foreach($seller->profession as $profession)
                                        @if($loop->index > 0)
                                            |
                                        @endif
                                        {{ trans_input('profession.' . $profession) }}
                                    @endforeach
                                </div>
                                <div class="h4" style="margin-bottom: 30px;">
                                    {{ $seller->country['country_name'] }}
                                </div>

                                @if(auth()->user())
                                    <follow-button
                                            follow_="{{ auth()->user()->followedUsers->contains($seller->id) }}"
                                            user-id_="{{ $seller->id }}" style="margin-bottom: 20px;">
                                    </follow-button>
                                @endif

                                @if($seller->created_at)
                                    <div>
                                        Joined BearteSpace {{ $seller->created_at->diffForHumans() }}
                                    </div>
                                @endif

                                @if($seller->followedBy)
                                    <div>
                                        Followed by {{ $seller->followedBy->count() }} people
                                    </div>
                                @endif

                                @if($seller->inspiration)
                                    <div>
                                        <b>Inspiration:</b> {{ $seller->inspiration }}
                                    </div>
                                @endif

                                @if($seller->exhibition)
                                    <div>
                                        <b>Exhibition:</b> {{ $seller->exhibition }}
                                    </div>
                                @endif

                                <div class="artist-gender">{{ $seller->gender }}</div>

                                <div class="artist-education"><b>Education:</b> {{ $seller->education }}</div>
                                <div class="artist-education-title"><b>Education
                                        title:</b> {{ $seller->education_title }}</div>

                            </div>

                        </div>

                    </div>


                    <div class="artist-artworks">

                        <artworks-block
                                artworks_="{{ $seller->artworks->load('user:id,first_name,last_name,profile_name,name,url') }}">
                            <template slot="header">
                                <div class="h2">Artworks</div>
                            </template>
                        </artworks-block>

                    </div>

                </div>

            </div>

        </div>

    @endif

@endsection