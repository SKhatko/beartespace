@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')


    <el-card>
        <profile-form user_="{{ $user }}"></profile-form>

    </el-card>

    {{--        @include('dashboard.partials.profile')--}}

@endsection
