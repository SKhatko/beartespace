@extends('layouts.cart-checkout')

@section('cart-checkout-status')
    <el-steps :active="0" align-center finish-status="success" class="app-header-cartcheckout">
        <el-step description="Shipping"></el-step>
        <el-step description="Payment"></el-step>
        <el-step description="Review"></el-step>
    </el-steps>
@endsection

@section('content')

    <cart-shipping-form addresses_="{{ $user->addresses }}" selected_="{{ $user->address_id }}"></cart-shipping-form>

@stop