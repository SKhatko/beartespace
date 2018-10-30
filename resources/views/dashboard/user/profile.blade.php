@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')

    <div class="app-dashboard-profile-edit">

        @include('dashboard.partials.profile')

        <div class="app-dashboard-profile-edit">
            <el-card>
                <el-tabs value="{{ 'artworks' }}">

                    <el-tab-pane label="Artworks" name="artworks">
                        asdf
                    </el-tab-pane>

                    <el-tab-pane label="Followed People" name="artists">
                      asdf
                    </el-tab-pane>
                </el-tabs>
            </el-card>
        </div>
    </div>


    <profile-form user_="{{ $user }}"></profile-form>

@endsection

@section('script')
    {{--<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.api_key') }}&libraries=places"></script>--}}
@stop
