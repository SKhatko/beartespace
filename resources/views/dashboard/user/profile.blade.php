@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="admin a">

        @include('dashboard.partials.menu', ['index' => 'profile'])

        <div class="a-content">



            <profile
                    :trans_="{{ json_encode(trans('portal')) }}"
                    :user_="{{ $user }}"
                    :countries_="{{ $countries }}">
            </profile>






        </div>

    </div>

@endsection
