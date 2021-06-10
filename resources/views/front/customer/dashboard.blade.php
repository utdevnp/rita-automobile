@extends('front.layouts.master')

@section('content')

<div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{url("/")}}">home</a></li>
                            <li>My account</li>
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
                                @include("front.customer.nav")
                            </div>    
                        </div>
                        <div class="col-sm-12 col-md-9 col-lg-9">
                            <!-- Tab panes -->
                            <div class="tab-content dashboard_content">
                                <div class="tab-pane fade show active" id="dashboard">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <h3>Dashboard </h3>
                                            <p >From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">Edit your password and account details.</a></p>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="card text-left">
                                                <div class="card-body">
                                                    <p class="card-text"> <b>Orders</b></p>
                                                    <h4 class="card-title">{{count($orders)}}</h4>
                                                </div>
                                                <div class="card-footer text-muted">
                                                    <a href="#">View All</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card text-left">
                                                <div class="card-body">
                                                    <p class="card-text"> <b>Wishlist</b></p>
                                                    <h4 class="card-title">{{count($wishlists)}}</h4>
                                                </div>
                                                <div class="card-footer text-muted">
                                                    <a href="#">View All</a>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="card text-left">
                                                <div class="card-body">
                                                    <p class="card-text"> <b>Category</b></p>
                                                    <h4 class="card-title">0</h4>
                                                </div>
                                                <div class="card-footer text-muted">
                                                    <a href="#">View All</a>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-5 mt-3">
                                            <div class="card text-left">
                                                <div class="card-header">
                                                    Shipping Information
                                                    <a class="pull-right" href="{{ route('profile') }}">Edit</a>
                                                </div>
                                                <div class="card-body">
                                                <table>
                                                    <tr>
                                                        <td>{{__('Address')}}:</td>
                                                        <td class="p-2">{{ Auth::user()->address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{__('Country')}}:</td>
                                                        <td class="p-2">
                                                            @if (Auth::user()->country != null)
                                                                @if(!empty(\App\Country::where('code', Auth::user()->country)->first()->name ))
                                                                {{ \App\Country::where('code', Auth::user()->country)->first()->name }}
                                                                @endif
                                                               
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{__('City')}}:</td>
                                                        <td class="p-2">{{ Auth::user()->city }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{__('Postal Code')}}:</td>
                                                        <td class="p-2">{{ Auth::user()->postal_code }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{__('Phone')}}:</td>
                                                        <td class="p-2">{{ Auth::user()->phone }}</td>
                                                    </tr>
                                                </table>
                                                </div>
                                            
                                            </div>
                                        </div>


                                        <div class="col-md-7 mt-3">
                                            <div class="card text-left">
                                                <div class="card-header">
                                                    Recent orders
                                                    <a class="pull-right" href="#">View All</a>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table">
                                                        <tr>
                                                            <th># Order Id</th>
                                                            <th>Qty </th>
                                                            <th>Amount</th>
                                                            <th>Status</th>
                                                        </tr>
                                                        @foreach($ordersLimit as $order)
                                                        <tr>
                                                           
                                                            <td> {{$order->code}} </td>
                                                            <td> {{ $order->orderDetails->where('order_id', $order->id)->sum("quantity") }}</td>
                                                            <td>{{$order->grand_total}}</td>
                                                            <td>{{$order->payment_status}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            
                                            </div>
                                        </div>





                                    </div>
                                       
                                </div>
                                <div class="tab-pane fade" id="orders">
                                    <h3>Orders</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Order</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Actions</th>	 	 	 	
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>May 10, 2018</td>
                                                    <td><span class="success">Completed</span></td>
                                                    <td>$25.00 for 1 item </td>
                                                    <td><a href="cart.html" class="view">view</a></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>May 10, 2018</td>
                                                    <td>Processing</td>
                                                    <td>$17.00 for 1 item </td>
                                                    <td><a href="cart.html" class="view">view</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="downloads">
                                    <h3>Downloads</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Downloads</th>
                                                    <th>Expires</th>
                                                    <th>Download</th>	 	 	 	
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Shopnovilla - Free Real Estate PSD Template</td>
                                                    <td>May 10, 2018</td>
                                                    <td><span class="danger">Expired</span></td>
                                                    <td><a href="#" class="view">Click Here To Download Your File</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Organic - ecommerce html template</td>
                                                    <td>Sep 11, 2018</td>
                                                    <td>Never</td>
                                                    <td><a href="#" class="view">Click Here To Download Your File</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="address">
                                   <p>The following addresses will be used on the checkout page by default.</p>
                                    <h4 class="billing-address">Billing address</h4>
                                    <a href="#" class="view">Edit</a>
                                    <p><strong>Bobby Jackson</strong></p>
                                    <address>
                                        House #15<br>
                                        Road #1<br>
                                        Block #C <br>
                                        Banasree <br>
                                        Dhaka <br>
                                        1212
                                    </address>
                                    <p>Bangladesh</p>   
                                </div>
                                <div class="tab-pane fade" id="account-details">
                                    <h3>Account details </h3>
                                    <div class="login">
                                        <div class="login_form_container">
                                            <div class="account_login_form">
                                                <form action="#">
                                                    <p>Already have an account? <a href="#">Log in instead!</a></p>
                                                    <div class="input-radio">
                                                        <span class="custom-radio"><input type="radio" value="1" name="id_gender"> Mr.</span>
                                                        <span class="custom-radio"><input type="radio" value="1" name="id_gender"> Mrs.</span>
                                                    </div> <br>
                                                    <label>First Name</label>
                                                    <input type="text" name="first-name">
                                                    <label>Last Name</label>
                                                    <input type="text" name="last-name">
                                                    <label>Email</label>
                                                    <input type="text" name="email-name">
                                                    <label>Password</label>
                                                    <input type="password" name="user-password">
                                                    <label>Birthdate</label>
                                                    <input type="text" placeholder="MM/DD/YYYY" value="" name="birthday">
                                                    <span class="example">
                                                      (E.g.: 05/31/1970)
                                                    </span>
                                                    <br>
                                                    <span class="custom_checkbox">
                                                        <input type="checkbox" value="1" name="optin">
                                                        <label>Receive offers from our partners</label>
                                                    </span>
                                                    <br>
                                                    <span class="custom_checkbox">
                                                        <input type="checkbox" value="1" name="newsletter">
                                                        <label>Sign up for our newsletter<br><em>You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.</em></label>
                                                    </span>
                                                    <div class="save_button primary_btn default_button">
                                                       <button type="submit">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>        	
            </section>
        </div>	
    </div>		



@endsection
