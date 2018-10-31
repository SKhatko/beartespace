@extends('layouts.dashboard')

@section('content')

    <div class="app--wrapper">
        <div class="app-dashboard">
            @yield('dashboard-content')
        </div>
    </div>

@endsection