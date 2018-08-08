@extends('layouts.app')

@section('title') Artist Registration | @parent @endsection

@section('content')

    <div class="app--wrapper">
        Artist invitation and registration
        <el-button><a href="{{ route('register') }}">Register</a></el-button>
    </div>

@endsection
