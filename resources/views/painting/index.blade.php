@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <h2 class="h2">Paintings</h2>

        <div class="app-artworks">
            <aside>

                <el-tree
                        :data="artworkFilters"
                        :props="defaultProps"
                        show-checkbox>
                </el-tree>

            </aside>

            <main>
                <div class="artworks">

                        @foreach($paintings as $painting)

                            <div class="artwork">
                                <a href="{{ route('artwork', $painting->id) }}" class="artwork-image">
                                    <img src="{{ $painting->images()->first()->name }}" alt="">
                                </a>

                                <div class="artwork-panel">
                                    <div class="h4">
                                        <a href="{{ route('artwork', $painting->id) }}" class="artwork-title">
                                            {{ $painting->title }}
                                        </a>
                                    </div>

                                    <div class="artwork-panel-right h3">
                                        <a class="artwork-favorite"><span class="el-icon-star-off"></span></a>
                                        <a class="artwork-cart"><span class="el-icon-goods"></span></a>
                                    </div>

                                </div>

                                <div class="h4">{{ $painting->user['name'] }}</div>

                                <div class="h5">{{ $painting->user->country['country_name'] }}</div>

                            </div>

                        @endforeach

                </div>
            </main>
        </div>


    </div>

@endsection