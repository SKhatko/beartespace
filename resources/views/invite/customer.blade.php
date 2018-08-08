@extends('layouts.app')

@section('title') Customer Registration | @parent @endsection

@section('content')

    <div class="app--wrapper">
        Customer invitation and registration
        <el-button><a href="{{ route('register') }}">Register</a></el-button>

    </div>

@endsection
