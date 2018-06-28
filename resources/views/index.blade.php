@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app-index-content-artworks app--wrapper">
        artworks, autors, sliders (Main page here)
        {{--@foreach($artworks as $artwork)--}}
            {{--<div class="app-index-content-artwork">--}}

                {{--<div class="ads-thumbnail">--}}
                    {{--<a href="{{ route('single_ad', [$artwork->id, $artwork->slug]) }}">--}}
                        {{--<img itemprop="image" src="{{ media_url($artwork->feature_img) }}"--}}
                             {{--class="img-responsive" alt="{{ $artwork->title }}">--}}
                        {{--<span class="modern-img-indicator">--}}
                                        {{--@if(! empty($artwork->video_url))--}}
                                {{--<i class="fa fa-file-video-o"></i>--}}
                            {{--@else--}}

                            {{--@endif--}}
                                    {{--</span>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="caption">--}}
                    {{--<div class="ad-box-caption-title">--}}
                        {{--<a class="ad-box-title" href="{{ route('single_ad', [$artwork->id, $artwork->slug]) }}"--}}
                           {{--title="{{ $artwork->title }}">--}}
                            {{--{{ str_limit($artwork->title, 40) }}--}}
                        {{--</a>--}}
                    {{--</div>--}}

                    {{--<div class="ad-box-category">--}}
                        {{--@if($artwork->sub_category)--}}
                            {{--<a class="price text-muted"--}}
                               {{--href="{{ route('search', [ $artwork->country->country_code,  'category' => 'cat-'.$artwork->sub_category->id.'-'.$artwork->sub_category->category_slug]) }}">--}}
                                {{--<i class="fa fa-folder-o"></i> {{ $artwork->sub_category->category_name }}--}}
                            {{--</a>--}}
                        {{--@endif--}}

                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="ad-box-footer">--}}
                                    {{--<span class="ad-box-price">@lang('app.starting_price') {{ themeqx_price($artwork->price) }}--}}
                                        {{--,</span>--}}
                    {{--<span class="ad-box-price">@lang('app.current_bid') {{ themeqx_price($artwork->current_bid()) }}</span>--}}

                    {{--@if($artwork->price_plan == 'premium')--}}
                        {{--<div class="ad-box-premium" data-toggle="tooltip"--}}
                             {{--title="@lang('app.premium_ad')">--}}
                            {{--{!! $artwork->premium_icon() !!}--}}
                        {{--</div>--}}
                    {{--@endif--}}
                {{--</div>--}}


                {{--<div class="countdown" data-expire-date="{{$artwork->expired_at}}"></div>--}}
                {{--<div class="place-bid-btn">--}}
                    {{--<a href="{{ route('single_ad', [$artwork->id, $artwork->slug]) }}"--}}
                       {{--class="btn btn-primary">@lang('app.place_bid')</a>--}}
                {{--</div>--}}


            {{--</div>--}}
        {{--@endforeach--}}
    </div>

@endsection