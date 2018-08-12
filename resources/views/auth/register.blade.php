@extends('layouts.app')

@section('content')

    <register-form user-type="{{ $userType ?? 'user' }}" user-plan="{{ $userPlan ?? 'trial' }}"></register-form>

@endsection

@section('scripts')

{{--    {!! NoCaptcha::renderJs() !!}--}}

@endsection
