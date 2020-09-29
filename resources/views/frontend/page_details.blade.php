@extends('frontend.layouts.app')

@section('meta_title'){{ !empty($page_details->meta_title) ? $page_details->meta_title : $page_details->name }}@endsection

@section('meta_description'){{ !empty($page_details->meta_description) ? $page_details->meta_description : substr(strip_tags($page_details->description), 0, 200) }}@endsection

@section('meta_keywords'){{ $page_details->naem }}@endsection

@section('content')
    @if($page_details->status == 1)
        <div class="about-main"
                 style="background-image: url({{ asset($page_details->banner) }}), linear-gradient(-90deg,#fa771f52,#000000de);">
                <div class="container">
                    <div class="about-content">
                        <span>{{$page_details->name}}</span>
                    </div>
                </div>
            </div>
        <div class="about-data parent-gap">
            <div class="container">
                <div class="about-data-contant">
                    <div class="about-data-title">
                        <span>{{$page_details->name}}</span>
                    </div>
                    <div class="about-data-subtitle">
                        @if(!empty($page_details->video))
                            <div class="embed-responsive embed-responsive-21by9 mb-3">
                                <embed src="{{$page_details->youtubeLink}}" class="embed-responsive-item">
                            </div>
                        @endif
                        {{$page_details->description}}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
