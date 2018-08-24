@extends('layouts.app')

@section('content')

    <register-form user-type="{{ $userType ?? 'user' }}"></register-form>

@endsection

@section('scripts')

{{--    {!! NoCaptcha::renderJs() !!}--}}

@endsection
