@extends('layouts.app')

@section('content')

    <el-aside>

        @include('dashboard.partials.menu', ['index' => 'translations'])

    </el-aside>

    <el-main>

        <div class="admin a">

            <div class="a-content">

                <translations
                        :languages_="{{ $languages }}"
                        :translations_="{{ $translations }}">
                </translations>

            </div>

        </div>

    </el-main>

@endsection
