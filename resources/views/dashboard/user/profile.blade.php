@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')


    <el-card>
        <profile-form user_="{{ $user }}">
            {{ method_field('PUT') }}
        </profile-form>
    </el-card>

@endsection
