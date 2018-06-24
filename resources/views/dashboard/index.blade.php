@extends('layouts.app')

@section('content')

    <div class="admin">

        @include('dashboard.partials.menu', ['index' => Request::segment(2) ?? 'dashboard'])

        <div class="a-content">

            @yield('admin-content')

        </div>

    </div>

@endsection