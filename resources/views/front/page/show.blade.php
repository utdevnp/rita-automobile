@extends('front.layouts.master')

@section('meta_title'){{ !empty($page_details->meta_title) ? $page_details->meta_title : $page_details->name }}@endsection

@section('meta_description'){{ !empty($page_details->meta_description) ? $page_details->meta_description : substr(strip_tags($page_details->description), 0, 200) }}@endsection

@section('meta_keywords'){{ $page_details->naem }}@endsection

@section('content')
 @if($page_details->status == 1)
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li>{{ $page_details->slug }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--about bg area start-->
<div class="about_bg_area">
    <div class="container">
        <!--about section area -->
        <section class="about_section mb-60">
            <div class="row align-items-center">
                <div class="col-12">
                    <figcaption class="about_content">
                        <h1>{{$page_details->name}}</h1>
                        <p>
                             {{$page_details->description}}
                        </p>

                    </figcaption>
                </div>
            </div>
        </section>
        <!--about section end-->

        <!--chose us area start-->
        <div class="choseus_area" data-bgimg="{{ asset('frontend_assets/assets/img/about/about-us-policy-bg.jpg') }}">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="single_chose">
                        <div class="chose_icone">
                            <img src="{{ asset('frontend_assets/assets/img/about/About_icon1.png') }}" alt="">
                        </div>
                        <div class="chose_content">
                            <h3>High Quality Products</h3>
                            <p>Erat metus sodales eget dolor consectetuer, porta ut purus at et alias, nulla ornare velit amet</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="single_chose">
                        <div class="chose_icone">
                            <img src="{{ asset('frontend_assets/assets/img/about/About_icon2.png') }}" alt="">
                        </div>
                        <div class="chose_content">
                            <h3>100% Money Back Guarantee</h3>
                            <p>Erat metus sodales eget dolor consectetuer, porta ut purus at et alias, nulla ornare velit amet</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="single_chose">
                        <div class="chose_icone">
                            <img src="{{ asset('frontend_assets/assets/img/about/About_icon3.png') }}" alt="">
                        </div>
                        <div class="chose_content">
                            <h3>Online Support 24/7</h3>
                            <p>Erat metus sodales eget dolor consectetuer, porta ut purus at et alias, nulla ornare velit amet</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--chose us area end-->

        <!--services img area-->
        <div class="about_gallery_section mb-55">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <article class="single_gallery_section">
                        <figure>
                            <div class="gallery_thumb">
                                <img src="{{ asset('frontend_assets/assets/img/about/about2.jpg') }}" alt="">
                            </div>
                            <figcaption class="about_gallery_content">
                                <h3>Purpose</h3>
                                <p>To become a leader in the automotive spare parts industry by providing enhanced
                                    services, relationship and profitability.</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-4 col-md-4">
                    <article class="single_gallery_section">
                        <figure>
                            <div class="gallery_thumb">
                                <img src="{{ asset('frontend_assets/assets/img/about/about3.jpg') }}" alt="">
                            </div>
                            <figcaption class="about_gallery_content">
                                <h3>Our Mission</h3>
                                <p>
                                    To build long term relationships with our customers and clients and
                                    provide exceptional customer service by pursuing business through innovation and advanced
                                    technology.
                                </p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-4 col-md-4">
                    <article class="single_gallery_section">
                        <figure>
                            <div class="gallery_thumb">
                                <img src="{{ asset('frontend_assets/assets/img/about/about4.jpg') }}" alt="">
                            </div>
                            <figcaption class="about_gallery_content">
                                <h3>Core Values</h3>
                                <p>We believe in treating our customers with respect and faith. We grow through
                                    dedication, commitment and innovation, we integrate honesty integrity and business ethics
                                    into all aspects of our business functioning.</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
            </div>
        </div>
        <!--services img end-->

    </div>
</div>
@endif
<!--about bg
 area end-->

@endsection