@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')

    <div class="app-dashboard-favorites">

        @include('dashboard.partials.profile')

        <div class="favorites">
            <el-card>
                <el-tabs value="{{ $category ? $category : 'artworks' }}">

                    <el-tab-pane label="Artworks" name="artworks">
                        @if($artworks->count())
                            <artworks-block artworks_="{{ $artworks }}"></artworks-block>
                        @else

                            <a href="/artwork" class="el-button el-button--default">Add favorite artworks</a>
                        @endif
                        {{--                        @include('partials.artworks', $artworks)--}}
                    </el-tab-pane>

                    <el-tab-pane label="Followed People" name="artists">
                        @if($artists->count())
                            @include('artist.artists-block', ['artists' => $artists])
                        @else

                            <a href="/artist" class="el-button el-button--default">Add favorite artists</a>
                        @endif
                    </el-tab-pane>
                </el-tabs>
            </el-card>
        </div>
    </div>

@endsection



