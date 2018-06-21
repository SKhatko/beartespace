@extends('layouts.app')

@section('content')

    <div class="admin a">

        @include('admin.sidebar_menu')

        <div class="a-content">

           <translations
                   :translations_="{{ $translations }}">
           </translations>

        </div>

    </div>

@endsection