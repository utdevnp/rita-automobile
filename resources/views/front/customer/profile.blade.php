

@extends('front.layouts.master')

@section('content')



<div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{url("/")}}">home</a></li>
                            <li>Manage Profile</li>
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
                                            <h3>Manage Profile </h3>
                                        </div>
                                        
                                    </div>
                                       
                                </div>
                                <div class="tab-pane fade active">
                                <form class="" action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-box bg-white mt-4">
                                        <div class="form-box-title px-3 py-2">
                                            {{__('Basic info')}}
                                        </div>
                                        <div class="form-box-content p-3">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Your Name')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control mb-3" placeholder="{{__('Your Name')}}" name="name" value="{{ Auth::user()->name }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Your Email')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="email" class="form-control mb-3" placeholder="{{__('Your Email')}}" name="email" value="{{ Auth::user()->email }}" disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Photo')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="file" name="photo" id="file-3" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                                    <label for="file-3" class="mw-100 mb-3">
                                                        <span></span>
                                                        <strong>
                                                            <i class="fa fa-upload"></i>
                                                            {{__('Choose image')}}
                                                        </strong>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Your Password')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="password" class="form-control mb-3" placeholder="{{__('New Password')}}" name="new_password">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Confirm Password')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="password" class="form-control mb-3" placeholder="{{__('Confirm Password')}}" name="confirm_password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-box bg-white mt-4">
                                        <div class="form-box-title px-3 py-2">
                                            {{__('Shipping info')}}
                                        </div>
                                        <div class="form-box-content p-3">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Address')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Address')}}" rows="1" name="address">{{ Auth::user()->address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Country')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="mb-3">
                                                        <select class="form-control mb-3 selectpicker" data-placeholder="{{__('Select your country')}}" name="country">
                                                            @foreach (\App\Country::all() as $key => $country)
                                                                <option value="{{ $country->code }}" <?php if(Auth::user()->country == $country->code) echo "selected";?> >{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('City')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control mb-3" placeholder="{{__('Your City')}}" name="city" value="{{ Auth::user()->city }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Postal Code')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control mb-3" placeholder="{{__('Your Postal Code')}}" name="postal_code" value="{{ Auth::user()->postal_code }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Phone')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control mb-3" placeholder="{{__('Your Phone Number')}}" name="phone" value="{{ Auth::user()->phone }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right mt-4">
                                        <button type="submit" class="btn btn-styled btn-base-1">{{__('Update Profile')}}</button>
                                    </div>
                                </form>
                                 
                                </div>
                                
                                
                        </div>
                    </div>
                </div>        	
            </section>
        </div>	
    </div>	


@endsection
