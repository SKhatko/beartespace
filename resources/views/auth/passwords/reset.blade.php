@extends('layouts.simple')

@section('content')

    <password-reset-new-password token_="{{ $token }}"></password-reset-new-password>

@endsection
