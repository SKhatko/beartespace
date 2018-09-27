@extends('layouts.simple')

@section('content')

    <register-form user-type_="{{ $userType ?? 'user' }}">
        @include('partials.errors')
    </register-form>

@endsection
