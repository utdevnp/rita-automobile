@extends('front.layouts.master')

@section('content')

<div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{url("/")}}">home</a></li>
                            <li>My Wallet</li>
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
                                <div class="tab-pane fade show active">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>My Wallet </h3>
                                        </div>
                                        
                                    </div>
                                       
                                </div>
                                <div class="tab-pane fade active">

                                <div class="row">
                                    <div class="col-md-4 offset-md-2">
                                        <div class="dashboard-widget text-center green-widget text-white mt-4 c-pointer">
                                            <i class="fa fa-dollar"></i>
                                            <span class="d-block title heading-3 strong-400">{{ single_price(Auth::user()->balance) }}</span>
                                            <span class="d-block sub-title">{{ __('Wallet Balance') }}</span>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" onclick="show_wallet_modal()">
                                            <i class="fa fa-plus"></i>
                                            <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Recharge Wallet') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card no-border mt-5">
                                    <div class="card-header py-3">
                                        <h4 class="mb-0 h6">{{__('Wallet recharge history')}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm table-responsive-md mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('Date') }}</th>
                                                    <th>{{__('Amount')}}</th>
                                                    <th>{{__('Payment Method')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($wallets) > 0)
                                                    @foreach ($wallets as $key => $wallet)
                                                        <tr>
                                                            <td>{{ $key+1 }}</td>
                                                            <td>{{ date('d-m-Y', strtotime($wallet->created_at)) }}</td>
                                                            <td>{{ single_price($wallet->amount) }}</td>
                                                            <td>{{ ucfirst(str_replace('_', ' ', $wallet ->payment_method)) }}</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td class="text-center pt-5 h4" colspan="100%">
                                                            <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                                        <span class="d-block">{{ __('No history found.') }}</span>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="pagination-wrapper py-4">
                                    <ul class="pagination justify-content-end">
                                        {{ $wallets->links() }}
                                    </ul>
                                </div>
                                 
                                </div>
                                
                                
                        </div>
                    </div>
                </div>        	
            </section>
        </div>	
    </div>	



    <div class="modal fade" id="wallet_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Recharge Wallet')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('wallet.recharge') }}" method="post">
                    @csrf
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{__('Amount')}} <span class="required-star">*</span></label>
                            </div>
                            <div class="col-md-10">
                                <input type="number" class="form-control mb-3" name="amount" placeholder="{{__('Amount')}}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{__('Payment Method')}}</label>
                            </div>
                            <div class="col-md-10">
                                <div class="mb-3">
                                    <select class="form-control selectpicker" data-minimum-results-for-search="Infinity" name="payment_option">
                                        @if (\App\BusinessSetting::where('type', 'paypal_payment')->first()->value == 1)
                                            <option value="paypal">{{__('Paypal')}}</option>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'stripe_payment')->first()->value == 1)
                                            <option value="stripe">{{__('Stripe')}}</option>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'sslcommerz_payment')->first()->value == 1)
                                            <option value="sslcommerz">{{__('SSLCommerz')}}</option>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'instamojo_payment')->first()->value == 1)
                                            <option value="instamojo">{{__('Instamojo')}}</option>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'paystack')->first()->value == 1)
                                            <option value="paystack">{{__('Paystack')}}</option>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'voguepay')->first()->value == 1)
                                            <option value="voguepay">{{__('VoguePay')}}</option>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'razorpay')->first()->value == 1)
                                            <option value="razorpay">{{__('Razorpay')}}</option>
                                        @endif
                                        @if (\App\Addon::where('unique_identifier', 'paytm')->first() != null && \App\Addon::where('unique_identifier', 'paytm')->first()->activated)
                                            <option value="paytm">{{__('Paytm')}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-base-1">{{__('Confirm')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        function show_wallet_modal(){
            $('#wallet_modal').modal('show');
        }
    </script>
@endsection
