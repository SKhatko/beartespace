@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')

    <div class="app--wrapper">
        <div class="app-favorites">

            <el-card>
                <el-tabs value="artworks">
                    <el-tab-pane label="Artworks" name="artworks">
                        <artworks-block artworks_="{{ $artworks }}"></artworks-block>
{{--                        @include('partials.artworks', $artworks)--}}
                    </el-tab-pane>
                    <el-tab-pane label="Followed People" name="artists">

                        @include('artist.artists-block', ['artists' => $artists])
                    </el-tab-pane>
                </el-tabs>
            </el-card>

        </div>
    </div>

@endsection



