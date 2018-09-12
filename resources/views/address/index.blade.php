@extends('layouts.simple')

@section('content')

    <address-form addresses_="{{ $addresses }}" selected_="{{ session('delivery-address') }}"></address-form>

@stop