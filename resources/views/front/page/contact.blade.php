
@extends('front.layouts.master')
@section('content')

<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li>contact us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<div class="contact_page_bg">
    <!--contact map start-->
    <div class="contact_map">
        <div class="map-area">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.909175587542!2d85.29059991431359!3d27.689201882799363!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19d92d76cc75%3A0xdd67cfe25c12cb8e!2sRita%20Automobiles%20Pvt%20Ltd!5e0!3m2!1sen!2snp!4v1611038816730!5m2!1sen!2snp" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>
    <!--contact map end-->
    <div class="container">
        <!--contact area start-->
        <div class="contact_area">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="contact_message content">
                        <h3>contact us</h3>
                        <p>We believe Rita Automobiles Pvt.Ltd enjoys one of the lowest employee turnovers in the
                            automotive spare parts industry. This essential continuity of key personnel has ensured total
                            consistency in our service, our employees are the key to our successful and growing business.</p>
                        <ul>
                            <li><i class="fa fa-fax"></i>  Address : Swastik Marg, Kantipur Colony Off Link Marg, Kuleshwor Kathmandu</li>
                            <li><i class="fa fa-phone"></i> <a href="#">Infor@ritaautomobiles.com</a></li>
                            <li><i class="fa fa-envelope-o"></i> (+977) 9857025575</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="contact_message form">
                        <h3>Tell us your project</h3>
                        <form id="contact-form" method="POST"  action="">
                            <p>
                                <label> Your Name (required)</label>
                                <input name="name" placeholder="Name *" type="text">
                            </p>
                            <p>
                                <label>  Your Email (required)</label>
                                <input name="email" placeholder="Email *" type="email">
                            </p>
                            <p>
                                <label>  Subject</label>
                                <input name="subject" placeholder="Subject *" type="text">
                            </p>
                            <div class="contact_textarea">
                                <label>  Your Message</label>
                                <textarea placeholder="Message *" name="message"  class="form-control2" ></textarea>
                            </div>
                            <button type="submit"> Send</button>
                            <p class="form-messege"></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--contact area end-->
    </div>
</div>

<!--brand area start-->
<div class="brand_area brand_padding">
    <div class="container">
        <div class="col-12">
            <div class="brand_container owl-carousel ">
                <div class="brand_list">
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand1.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand2.jpg') }}" alt=""></a>
                    </div>
                </div>
                <div class="brand_list">
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand3.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand4.jpg') }}" alt=""></a>
                    </div>
                </div>
                <div class="brand_list">
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand5.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand6.jpg') }}" alt=""></a>
                    </div>
                </div>
                <div class="brand_list">
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand7.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand8.jpg') }}" alt=""></a>
                    </div>
                </div>
                <div class="brand_list">
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand1.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand2.jpg') }}" alt=""></a>
                    </div>
                </div>
                <div class="brand_list">
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand3.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand4.jpg') }}" alt=""></a>
                    </div>
                </div>
                <div class="brand_list">
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand5.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand6.jpg') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--brand area end-->

@endsection