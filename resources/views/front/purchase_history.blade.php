@extends('front.layouts.master')

@section('content')



<div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{url("/")}}">home</a></li>
                            <li>Purchase History</li>
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
                                            <h3>Purchase History </h3>
                                        </div>
                                        
                                    </div>
                                       
                                </div>
                                <div class="tab-pane fade active">
                                    <div class="col-md-12">
                                        <table class="table table-sm table-hover table-responsive-md">
                                            <thead>
                                                <tr>
                                                    <th>{{__('Code')}}</th>
                                                    <th>{{__('Date')}}</th>
                                                    <th>{{__('Amount')}}</th>
                                                    <th>{{__('Delivery Status')}}</th>
                                                    <th>{{__('Payment Status')}}</th>
                                                    <th>{{__('Options')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $key => $order)
                                                    <tr>
                                                        <td>
                                                            <a href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})">{{ $order->code }}</a>
                                                        </td>
                                                        <td>{{ date('d-m-Y', $order->date) }}</td>
                                                        <td>
                                                            {{ single_price($order->grand_total) }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $status = $order->orderDetails->first()->delivery_status;
                                                            @endphp
                                                            @if($order->delivery_viewed == 0)
                                                                <span class="ml-2" style="color:green"><strong>({{ __('Updated') }})</strong></span>
                                                            @else
                                                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span class="badge badge--2 mr-4">
                                                                @if ($order->payment_status == 'paid')
                                                                    <i class="bg-green"></i> {{__('Paid')}}
                                                                @else
                                                                    <i class="bg-red"></i> {{__('Unpaid')}}
                                                                @endif
                                                                @if($order->payment_status_viewed == 0)<span class="ml-2" style="color:green"><strong>({{ __('Updated') }})</strong></span>@endif
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-v"></i>
                                                                </button>

                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
                                                                    <button onclick="show_purchase_history_details({{ $order->id }})" class="dropdown-item">{{__('Order Details')}}</button>
                                                                    <a href="{{ route('customer.invoice.download', $order->id) }}" class="dropdown-item">{{__('Download Invoice')}}</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="pagination-wrapper py-4">
                                        <ul class="pagination justify-content-end">
                                            {{ $orders->links() }}
                                        </ul>
                                    </div>
                                    

                                </div>
                                
                                
                        </div>
                    </div>
                </div>        	
            </section>
        </div>	
    </div>	
@endsection