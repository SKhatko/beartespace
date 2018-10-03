@extends('layouts.simple')

@section('content')

    <address-form addresses_="{{ $user->addresses }}" selected_="{{ $user->address_id }}"></address-form>

@stop