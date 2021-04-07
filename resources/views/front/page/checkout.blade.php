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
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <!--breadcrumbs area end-->
    
    <!--Checkout page section-->
    <div class="checkout_page_bg">
        <div class="container">
            <div class="Checkout_section" id="accordion">
                <div class="row">
                   <div class="col-12">
                        <div class="user-actions">
                            <h3> 
                                <i class="fa fa-file-o" aria-hidden="true"></i>
                                Returning customer?
                                <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_login" aria-expanded="true">Click here to login</a>     

                            </h3>
                             <div id="checkout_login" class="collapse" data-parent="#accordion">
                                <div class="checkout_info">
                                    <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing & Shipping section.</p>  
                                    <form action="#">  
                                        <div class="form_group">
                                            <label>Username or email <span>*</span></label>
                                            <input type="text">     
                                        </div>
                                        <div class="form_group">
                                            <label>Password  <span>*</span></label>
                                            <input type="text">     
                                        </div> 
                                        <div class="form_group group_3 ">
                                            <button type="submit">Login</button>
                                            <label for="remember_box">
                                                <input id="remember_box" type="checkbox">
                                                <span> Remember me </span>
                                            </label>     
                                        </div>
                                        <a href="#">Lost your password?</a>
                                    </form>          
                                </div>
                            </div>    
                        </div>
                        <div class="user-actions">
                            <h3> 
                                <i class="fa fa-file-o" aria-hidden="true"></i>
                                Returning customer?
                                <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_coupon" aria-expanded="true">Click here to enter your code</a>     

                            </h3>
                             <div id="checkout_coupon" class="collapse" data-parent="#accordion">
                                <div class="checkout_info">
                                    <form action="#">
                                        <input placeholder="Coupon code" type="text">
                                        <button type="submit">Apply coupon</button>
                                    </form>
                                </div>
                            </div>    
                        </div>    
                   </div>
                </div>
                <div class="checkout_form">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="checkout_form_left">
                                <form action="#">
                                    <h3>Billing Details</h3>
                                    <div class="row">

                                        <div class="col-lg-6 mb-20">
                                            <label>First Name <span>*</span></label>
                                            <input type="text">    
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <label>Last Name  <span>*</span></label>
                                            <input type="text"> 
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label>Company Name</label>
                                            <input type="text">     
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label for="country">country <span>*</span></label>
                                            <select class="niceselect_option" name="cuntry" id="country"> 
                                                <option value="2">bangladesh</option>      
                                                <option value="3">Algeria</option> 
                                                <option value="4">Afghanistan</option>    
                                                <option value="5">Ghana</option>    
                                                <option value="6">Albania</option>    
                                                <option value="7">Bahrain</option>    
                                                <option value="8">Colombia</option>    
                                                <option value="9">Dominican Republic</option>   

                                            </select>
                                        </div>

                                        <div class="col-12 mb-20">
                                            <label>Street address  <span>*</span></label>
                                            <input placeholder="House number and street name" type="text">     
                                        </div>
                                        <div class="col-12 mb-20">
                                            <input placeholder="Apartment, suite, unit etc. (optional)" type="text">     
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label>Town / City <span>*</span></label>
                                            <input  type="text">    
                                        </div> 
                                         <div class="col-12 mb-20">
                                            <label>State / County <span>*</span></label>
                                            <input type="text">    
                                        </div> 
                                        <div class="col-lg-6 mb-20">
                                            <label>Phone<span>*</span></label>
                                            <input type="text"> 

                                        </div> 
                                         <div class="col-lg-6 mb-20">
                                            <label> Email Address   <span>*</span></label>
                                              <input type="text"> 

                                        </div> 
                                        <div class="col-12 mb-20">
                                            <input id="account" type="checkbox" data-target="createp_account" />
                                            <label for="account" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">Create an account?</label>

                                            <div id="collapseOne" class="collapse one" data-parent="#accordion">
                                                <div class="card-body1">
                                                   <label> Account password   <span>*</span></label>
                                                    <input placeholder="password" type="password">  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <input id="address" type="checkbox" data-target="createp_account" />
                                            <label class="righ_0" for="address" data-toggle="collapse" data-target="#collapsetwo" aria-controls="collapseOne">Ship to a different address?</label>

                                            <div id="collapsetwo" class="collapse one" data-parent="#accordion">
                                               <div class="row">
                                                    <div class="col-lg-6 mb-20">
                                                        <label>First Name <span>*</span></label>
                                                        <input type="text">    
                                                    </div>
                                                    <div class="col-lg-6 mb-20">
                                                        <label>Last Name  <span>*</span></label>
                                                        <input type="text"> 
                                                    </div>
                                                    <div class="col-12 mb-20">
                                                        <label>Company Name</label>
                                                        <input type="text">     
                                                    </div>
                                                    <div class="col-12 mb-20">
                                                        <div class="select_form_select">
                                                            <label for="countru_name">country <span>*</span></label>
                                                            <select class="niceselect_option" name="cuntry" id="countru_name"> 
                                                                <option value="2">bangladesh</option>      
                                                                <option value="3">Algeria</option> 
                                                                <option value="4">Afghanistan</option>    
                                                                <option value="5">Ghana</option>    
                                                                <option value="6">Albania</option>    
                                                                <option value="7">Bahrain</option>    
                                                                <option value="8">Colombia</option>    
                                                                <option value="9">Dominican Republic</option>   

                                                            </select>
                                                        </div> 
                                                    </div>

                                                    <div class="col-12 mb-20">
                                                        <label>Street address  <span>*</span></label>
                                                        <input placeholder="House number and street name" type="text">     
                                                    </div>
                                                    <div class="col-12 mb-20">
                                                        <input placeholder="Apartment, suite, unit etc. (optional)" type="text">     
                                                    </div>
                                                    <div class="col-12 mb-20">
                                                        <label>Town / City <span>*</span></label>
                                                        <input  type="text">    
                                                    </div> 
                                                     <div class="col-12 mb-20">
                                                        <label>State / County <span>*</span></label>
                                                        <input type="text">    
                                                    </div> 
                                                    <div class="col-lg-6 mb-20">
                                                        <label>Phone<span>*</span></label>
                                                        <input type="text"> 

                                                    </div> 
                                                     <div class="col-lg-6">
                                                        <label> Email Address   <span>*</span></label>
                                                          <input type="text"> 

                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="order-notes">
                                                 <label for="order_note">Order Notes</label>
                                                <textarea id="order_note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                            </div>    
                                        </div>     	    	    	    	    	    	    
                                    </div>
                                </form> 
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="checkout_form_right">
                                <form action="#">    
                                    <h3>Your order</h3> 
                                    <div class="order_table table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> Handbag  fringilla <strong> × 2</strong></td>
                                                    <td> $165.00</td>
                                                </tr>
                                                <tr>
                                                    <td>  Handbag  justo	 <strong> × 2</strong></td>
                                                    <td> $50.00</td>
                                                </tr>
                                                <tr>
                                                    <td>  Handbag elit	<strong> × 2</strong></td>
                                                    <td> $50.00</td>
                                                </tr>
                                                <tr>
                                                    <td> Handbag Rutrum	 <strong> × 1</strong></td>
                                                    <td> $50.00</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Cart Subtotal</th>
                                                    <td>$215.00</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping</th>
                                                    <td><strong>$5.00</strong></td>
                                                </tr>
                                                <tr class="order_total">
                                                    <th>Order Total</th>
                                                    <td><strong>$220.00</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>     
                                    </div>
                                    <div class="payment_method">
                                       <div class="panel-default">
                                            <input id="payment" name="check_method" type="radio" data-target="createp_account" />
                                            <label for="payment" data-toggle="collapse" data-target="#method" aria-controls="method">Create an account?</label>

                                            <div id="method" class="collapse one" data-parent="#accordion">
                                                <div class="card-body1">
                                                   <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                </div>
                                            </div>
                                        </div> 
                                       <div class="panel-default">
                                            <input id="payment_defult" name="check_method" type="radio" data-target="createp_account" />
                                            <label for="payment_defult" data-toggle="collapse" data-target="#collapsedefult" aria-controls="collapsedefult">PayPal <img src="assets/img/icon/papyel.png" alt=""></label>

                                            <div id="collapsedefult" class="collapse one" data-parent="#accordion">
                                                <div class="card-body1">
                                                   <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order_button">
                                            <button  type="submit">Proceed to PayPal</button> 
                                        </div>    
                                    </div> 
                                </form> 
                            </div>        
                        </div>
                    </div> 
                </div>        
            </div>
        </div>
    </div>
    
    <!--Checkout page section end-->

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
                            <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand5.jpg')  }}" alt=""></a>
                        </div>
                        <div class="single_brand">
                            <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand6.jpg') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="brand_list">
                        <div class="single_brand">
                        </div>
                        <div class="single_brand">
                            <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand8.jpg') }}" alt=""></a>
                        </div>
                    </div>
                     <div class="brand_list">
                        <div class="single_brand">
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
    
    <!--newsletter area start-->
    <div class="newsletter_area newsletter_padding">
        <div class="container">
            <div class="newsletter_inner">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="newsletter_container">
                            <h3>Follow Us</h3>
                            <p>We make consolidating, marketing and tracking your social media website easy.</p>
                            <div class="footer_social">
                               <ul>
                                   <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                                   <li><a class="twitter" href="#"><i class="icon-twitter2"></i></a></li>
                                   <li><a class="rss" href="#"><i class="icon-rss"></i></a></li>
                                   <li><a class="youtube" href="#"><i class="icon-youtube"></i></a></li>
                                   <li><a class="google" href="#"><i class="icon-google"></i></a></li>
                                   <li><a class="instagram2" href="#"><i class="icon-instagram2"></i></a></li>
                               </ul>
                           </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="newsletter_container">
                            <h3>Newsletter Now</h3>
                            <p>Join 60.000+ subscribers and get a new discount coupon on every Wednesday.</p>
                            <div class="subscribe_form">
                                <form id="mc-form" class="mc-form footer-newsletter" >
                                    <input id="mc-email" type="email" autocomplete="off" placeholder="Enter you email address here..." />
                                    <button id="mc-submit">Subscribe</button>
                                </form>
                                <!-- mailchimp-alerts Start -->
                                <div class="mailchimp-alerts text-centre">
                                    <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                    <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                    <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                                </div><!-- mailchimp-alerts end -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-7">
                        <div class="newsletter_container col_3">
                            <h3>GET THE APP</h3>
                            <p>Mazlay App is now available on Google Play & App Store. Get it now.</p>
                            <div class="app_img">
                               <ul>
                                   <li><a href="#"><img src="assets/img/icon/icon-app.jpg" alt=""></a></li>
                                   <li><a href="#"><img src="assets/img/icon/icon1-app.jpg" alt=""></a></li>
                               </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--newsletter area end-->
    
@endsection