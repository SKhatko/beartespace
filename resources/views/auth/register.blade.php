@extends('layouts.simple')

@section('content')

    <register-form user-type="{{ $userType ?? 'user' }}"></register-form>

@endsection
