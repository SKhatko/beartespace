@extends('layouts.app')

@section('content')


    <el-main class="app-auth">

        @if(auth()->user())

            <subscription-form stripe-key="{{ config('services.stripe.key') }}"
                               plans_="{{ $plans }}"
                               user_="{{ auth()->user() }}">
            </subscription-form>

        @endif

    </el-main>

@endsection

@section('script')

    <script src="https://checkout.stripe.com/checkout.js"></script>

@endsection
