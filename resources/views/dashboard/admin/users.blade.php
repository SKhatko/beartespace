@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="admin a">

        @include('dashboard.partials.menu', ['index' => 'users'])

        <div class="a-content">

            <users
                    :users_="{{ $users }}">
            </users>

        </div>

    </div>

@endsection
