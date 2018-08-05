@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    @if($artist)

        <div class="app-artist">

            <div class="artist">

                <div class="artist-image"
                     style="background-image: url({{ $artist->image->url }});">

                    <div class="artist-image--fade">

                        @if($artist->avatar)
                            <div class="artist-avatar">
                                <img src="{{ $artist->avatar->url }}" alt="{{ $artist->avatar->name }}">
                            </div>
                        @endif

                        <div class="artist-name">{{ $artist->name }} </div>
                        <div class="artist-dob">{{ $artist->dob }}</div>
                        <div class="artist-country">{{ $artist->country['country_name'] }}</div>


                    </div>

                </div>

                <div class="app--wrapper">

                    <div class="artist-info">

                        <div class="artist-gender">{{ $artist->gender }}</div>
                        <div class="artist-website">{{ $artist->website }}</div>
                        <div class="artist-education">{{ $artist->education }}</div>
                        <div class="artist-education-title">{{ $artist->education_title }}</div>
                        <div class="artist-inspiration">{{ $artist->inspiration }}</div>
                        <div class="artist-exhibition">{{ $artist->exhibition }}</div>
                        <div class="artist-technique">

                            @if($artist->technique)
                                @foreach($artist->technique as $medium)
                                    {{ trans('medium.' . $medium) && strpos(trans('medium.' . $medium), 'medium') !== false ? $medium : trans('medium.' . $medium)}}
                                @endforeach
                            @endif
                        </div>

                    </div>

                </div>

                <div class="artist-artworks">

                    <div class="app--wrapper">


                        <h2>Other artworks</h2>

                        @include('partials.artworks', ['artworks' => $artist->artworks])

                    </div>

                </div>

            </div>

        </div>

    @endif

@endsection