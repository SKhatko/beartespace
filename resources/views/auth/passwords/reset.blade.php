@extends('layouts.app')

@section('content')

    <password-reset-new-password token_="{{ $token }}"></password-reset-new-password>

@endsection
