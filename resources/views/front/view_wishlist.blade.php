@extends('front.layouts.master')

@section('content')





<div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{url("/")}}">home</a></li>
                            <li>Wishlist</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>


     <!-- my account start  -->
     <div class="account_page_bg">
        <div class="container">
            <section class="main_content_area">  
                <div class="account_dashboard">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <!-- Nav tabs -->
                            <div class="dashboard_tab_button">
                                <ul role="tablist" class="nav flex-column dashboard-list">
                                @include("front.customer.nav")
                                </ul>
                            </div>    
                        </div>
                        <div class="col-sm-12 col-md-9 col-lg-9">
                            <!-- Tab panes -->
                            <div class="tab-content dashboard_content">
                            <div class="tab-content dashboard_content">
                                <div class="tab-pane fade show active">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>Wishlists </h3>
                                        </div>
                                        
                                    </div>
                                       
                                </div>
                                <div class="tab-pane fade active">

                                <div class="row shop-default-wrapper shop-cards-wrapper shop-tech-wrapper mt-4">
                                    @foreach ($wishlists as $key => $wishlist)
                                        @if ($wishlist->product != null)
                                            <div class="col-xl-4 col-6" id="wishlist_{{ $wishlist->id }}">
                                                <div class="card card-product mb-3 product-card-2">
                                                    <div class="card-body p-3">
                                                        <div class="card-image">
                                                            <a href="{{ route('product', $wishlist->product->slug) }}" class="d-block" >
                                                                <img src="{{ asset($wishlist->product->thumbnail_img) }}" alt="{{ $wishlist->product->name }}">
                                                            </a>
                                                        </div>

                                                        <h2 class="heading heading-6 strong-600 mt-2 text-truncate-2">
                                                            <a href="{{ route('product', $wishlist->product->slug) }}">{{ $wishlist->product->name }}</a>
                                                        </h2>
                                                        <div class="star-rating star-rating-sm mb-1">
                                                            {{ renderStarRating($wishlist->product->rating) }}
                                                        </div>
                                                        <div class="mt-2">
                                                            <div class="price-box">
                                                                @if(home_base_price($wishlist->product->id) != home_discounted_base_price($wishlist->product->id))
                                                                    <del class="old-product-price strong-400">{{ home_base_price($wishlist->product->id) }}</del>
                                                                @endif
                                                                <span class="product-price strong-600">{{ home_discounted_base_price($wishlist->product->id) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer p-3">
                                                        <div class="product-buttons">
                                                            <div class="row align-items-center">
                                                                <div class="col-2">
                                                                    <a href="#" class="link link--style-3" data-toggle="tooltip" data-placement="top" title="Remove from wishlist" onclick="removeFromWishlist({{ $wishlist->id }})">
                                                                        <i class="la la-close"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="col-10">
                                                                    <button type="button" class="btn btn-block btn-base-1 btn-circle btn-icon-left" onclick="showAddToCartModal({{ $wishlist->product->id }})">
                                                                        <i class="la la-shopping-cart mr-2"></i>{{__('Add to cart')}}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="pagination-wrapper py-4">
                                    <ul class="pagination justify-content-end">
                                        {{ $wishlists->links() }}
                                    </ul>
                                </div>
                                 
                                </div>
                                
                                
                        </div>
                    </div>
                </div>        	
            </section>
        </div>	
    </div>	



    <div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>


    

@endsection

@section('script')
    <script type="text/javascript">
        function removeFromWishlist(id){
            $.post('{{ route('wishlists.remove') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                $('#wishlist').html(data);
                $('#wishlist_'+id).hide();
                showFrontendAlert('success', 'Item has been renoved from wishlist');
            })
        }
    </script>
@endsection
