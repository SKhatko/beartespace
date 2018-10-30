@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')

    <div class="app-dashboard-profile">
        @include('dashboard.partials.profile')

        <div>

            <el-card>
                <el-tabs value="{{ 'artworks' }}">

                    <el-tab-pane label="Your public profile" name="profile">

                        <profile-form user_="{{ $user }}"></profile-form>

                    </el-tab-pane>

                    <el-tab-pane label="Change Password" name="password">
                        change password
                    </el-tab-pane>
                </el-tabs>
            </el-card>
        </div>
    </div>

@endsection
