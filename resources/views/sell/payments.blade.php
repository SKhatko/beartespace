@extends('layouts.sell')

@section('sell-status')
    <el-steps :active="2" align-center finish-status="success" class="app-header-sell">
        <el-step description="Profile"></el-step>
        <el-step description="Artworks"></el-step>
        <el-step description="Payments"></el-step>
    </el-steps>
@endsection

@section('content')

    <div class="app--wrapper">
        <div class="app-sell-payments">

            <sell-payment-form
                    authorization_="{{ $clientToken }}">
                @include('partials.errors')
            </sell-payment-form>

        </div>
    </div>

@stop
