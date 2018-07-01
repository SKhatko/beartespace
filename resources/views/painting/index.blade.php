@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-artworks">
            <aside>

                <el-tree
                        :data="artworkFilters"
                        :props="defaultProps"
                        show-checkbox>
                </el-tree>

            </aside>

            <main>

                <h2 class="h2">Paintings</h2>

                <div class="artworks">

                    @foreach($paintings as $painting)

                        <div class="artwork">
                            <a href="{{ route('artwork', $painting->id) }}" class="artwork-image">
                                <img src="{{ $painting->images()->first()->name }}" alt="">
                            </a>

                            <a href="{{ route('artwork', $painting->id) }}" class="artwork-title">
                                {{ $painting->title }}
                            </a>


                            <div class="artwork-panel">
                                <a href="#" class="artwork-favorite"><span class="el-icon-star-off"></span></a>
                                <a href="{{ route('toggle-to-cart', $painting->id) }}" class="artwork-cart"><span class="el-icon-goods"></span></a>
                            </div>

                            <div class="h4">{{ $painting->user['name'] }}</div>


                            <el-row :gutter="20">

                                <el-col :span="16">
                                    <div class="h5">{{ $painting->user->country['country_name'] }}</div>
                                </el-col>

                                <el-col :span="8">
                                    <div class="artwork-price">
                                        {{ $painting->price }} EUR
                                    </div>
                                </el-col>
                            </el-row>

                        </div>

                    @endforeach

                </div>
            </main>
        </div>


    </div>

@endsection