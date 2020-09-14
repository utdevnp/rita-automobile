@extends('frontend.layouts.app')

@section('content')
<link href="https://kit-pro.fontawesome.com/releases/v5.13.0/css/pro.min.css" rel="stylesheet" />

<div class="about-main" style="background-image: url({{ asset('frontend/images/about.jpg') }}) ,linear-gradient(-90deg,#72bf40c4,#000000de);">
	<div class="container">
		<div class="about-content">
			<span>About Us</span>
		</div>
	</div>
</div>
<div class="about-data parent-gap">
	<div class="container">
		<div class="about-data-contant">
			<div class="about-data-title">
				<span>About Us</span>
				<i class="fas fa-heartbeat"></i>
			</div>
			<div class="about-data-subtitle">
				<span>Medilifepharmacy.com is designed to be a one stop-shop, offering all your healthcare and wellness products requirements. The products range from curative and nutritive products, baby care, lifestyle, wellness and rehabilitation to FMCG products, cosmetics, personal and home care products in addition to medical devices and equipment. The platform helps you to compare products with price, brands and offers and thereby allowing you make accurate decisions before purchasing them and getting them delivered to your doorstep.
Medilife Pharmacy is one of the pharmacy in the UAE to go online. Medilife online Pharmacy was created due to the high demand from its customers and to provide them the best service to buy healthcare products from their home or office and to get it delivered to their doorstep and thousands of products being offered through various categories and brands.</span>
			</div>
		</div>
	</div>
</div>

@endsection