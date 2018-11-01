@extends('layouts.sell')

@section('sell-status')
    <el-steps :active="1" align-center finish-status="success" class="app-header-sell">
        <el-step description="Name"></el-step>
        <el-step description="Profile"></el-step>
        <el-step description="Artworks"></el-step>
    </el-steps>
@endsection

@section('content')

    <div class="app--wrapper">
        <div class="app-sell-profile">

            <profile-form user_="{{ auth()->user() }}" sell-request_="seller"></profile-form>

        </div>
    </div>

@stop
