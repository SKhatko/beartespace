@extends('layouts.sell')

@section('sell-status')
    <el-steps :active="2" align-center finish-status="success" class="app-header-sell">
        <el-step description="Name"></el-step>
        <el-step description="Profile"></el-step>
        <el-step description="Artwork Upload"></el-step>
        <el-step description="Payments"></el-step>
    </el-steps>
@endsection

@section('content')

    <div class="app--wrapper">
        <div class="app-sell-artwork">

            <artwork-form artwork_="{{ $artwork ?? '' }}" page_="sell"></artwork-form>

        </div>
    </div>

@stop
