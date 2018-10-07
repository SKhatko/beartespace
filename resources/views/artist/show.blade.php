@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    @if($artist)

        <div class="app--wrapper">

            <div class="app-artist" style="background-image: url('/imagecache/original{{ $artist->image_url }}')">

                <div class="artist">

                    <div class="artist-info">

                        <div class="artist--left">

                            <div class="artist-avatar">
                                <img src="/imagecache/fit-290{{ $artist->avatar_url }}"
                                     alt="">
                            </div>

                        </div>

                        <div class="artist--right">

                            <div class="h1">{{ $artist->name }} </div>

                            <div class="h5" style="margin-bottom: 20px;">
                                @foreach($artist->profession as $profession)
                                    @if($loop->index > 0)
                                        |
                                    @endif
                                    {{ trans_input('profession.' . $profession) }}
                                @endforeach
                            </div>
                            <div class="h4" style="margin-bottom: 30px;">
                                {{ $artist->country['country_name'] }}
                            </div>

                            @if(auth()->user())
                                <follow-button
                                        follow_="{{ auth()->user()->followedUsers->contains($artist->id) }}"
                                        user-id_="{{ $artist->id }}">
                                </follow-button>
                            @endif

                            @if($artist->created_at)
                                <div>
                                    Joined BearteSpace {{ $artist->created_at->diffForHumans() }}
                                </div>
                            @endif

                            @if($artist->followedBy)
                                Followed by {{ $artist->followedBy->count() }} people
                            @endif

                            @if($artist->inspiration)
                                Inspiration: {{ $artist->inspiration }}
                            @endif

                            @if($artist->exhibition)
                                Exhibition: {{ $artist->exhibition }}
                            @endif

                            <div class="artist-gender">{{ $artist->gender }}</div>

                            <div class="artist-education">Education: {{ $artist->education }}</div>
                            <div class="artist-education-title">Education title: {{ $artist->education_title }}</div>

                        </div>

                    </div>


                    <div class="artist-artworks">

                        <div class="h2">Artworks</div>
                        <artworks-block artworks_="{{ $artist->artworks }}"></artworks-block>

                    </div>

                </div>

            </div>

        </div>

    @endif

@endsection