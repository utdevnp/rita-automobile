@extends('layouts.app')

@section('content')

    <div class="panel">
    	<div class="panel-body">
    		<div class="invoice-masthead">
    			<div class="invoice-text">
    				<h3 class="h1 text-thin mar-no text-primary">{{ __('Partial Order Details') }}</h3>
					
    			</div>
    		</div>
         
          
    		<div class="invoice-bill row">
    			<div class="col-sm-6 text-xs-center">
    				<address>
        				<strong class="text-main">{{ json_decode($order->shipping_address)->name }}</strong><br>
                         {{ json_decode($order->shipping_address)->email }}<br>
                         {{ json_decode($order->shipping_address)->phone }}<br>
        				 {{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->country }}
                    </address>
                    @if ($order->manual_payment && is_array(json_decode($order->manual_payment_data, true)))
                        <br>
                        <strong class="text-main">{{ __('Payment Information') }}</strong><br>
                        Name: {{ json_decode($order->manual_payment_data)->name }}, Amount: {{ single_price(json_decode($order->manual_payment_data)->amount) }}, TRX ID: {{ json_decode($order->manual_payment_data)->trx_id }}
                        <br>
                        <a href="{{ asset(json_decode($order->manual_payment_data)->photo) }}" target="_blank"><img src="{{ asset(json_decode($order->manual_payment_data)->photo) }}" alt="" height="100"></a>
                    @endif
					<a href="{{ route('customer.invoice.download', $order->id) }}" class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></a>
					<a href="{{route("orders.show",["id"=>encrypt($order->id)])}}" class=" btn btn-primary btn-rounded float-right">Back to orders</a>
    			</div>
    			<div class="col-sm-6 text-xs-center">
			
    				<table class="invoice-details">
    				<tbody>
    				<tr>
    					<td class="text-main text-bold">
    						{{__('Order #')}}
    					</td>
    					<td class="text-right text-info text-bold">
    						{{ $order->code }}
    					</td>
    				</tr>
    				<tr>
    					<td class="text-main text-bold">
    						{{__('Order Status')}}
    					</td>
                        @php
                            $status = $order->orderDetails->first()->delivery_status;
                        @endphp
    					<td class="text-right">
                            @if($status == 'delivered')
                                <span class="badge badge-success">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                            @else
                                <span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                            @endif
    					</td>
    				</tr>
    				<tr>
    					<td class="text-main text-bold">
    						{{__('Order Date')}}
    					</td>
    					<td class="text-right">
    						{{ date('d-m-Y h:i A', $order->date) }} (UTC)
    					</td>
    				</tr>
                    <tr>
    					<td class="text-main text-bold">
    						{{__('Total amount')}}
    					</td>
    					<td class="text-right">
    						{{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}
    					</td>
    				</tr>
                    <tr>
    					<td class="text-main text-bold">
    						{{__('Payment method')}}
    					</td>
    					<td class="text-right">
    						{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}
    					</td>
    				</tr>
    				</tbody>
    				</table>
    			</div>
    		</div>
    		
    	</div>
    </div>
<div class="row">
	<div class="addform col-md-4">
		<form method="post" action="{{route("orderpartial.index")}}">
			@csrf
			<div class="panel">
				<!-- <div class="panel-header">
					Add Item
				</div> -->
				<input type="hidden" name="order_id" value="{{$order->id}}"/>
				<div class="panel-body">
					<div class="form-group">
						<label for="exampleInputEmail1">QTY</label>
						<input type="number" name="issue_qty" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Number">
						
					</div>
					<div class="form-group">
						<select name="order_product_id" required class="form-control">
							<option value="">Select Item </option>
							@php
                                $admin_user_id = \App\User::where('user_type', 'admin')->first()->id;
                            @endphp
                            @foreach ($order->orderDetails->where('seller_id', $admin_user_id) as $key => $orderDetail)
								<option value="{{ $orderDetail->product->id }}">{{ $orderDetail->product->name }} / Qty: {{ $orderDetail->quantity }} </option>
							@endforeach
						</select>
					</div>

					<button class="btn btn-primary">Issue Item</button>
				</div>
			</div>
		</form>	
	</div>

	<div class="addform col-md-8">
		<div class="panel">
			<div class="panel-header"></div>
			<div class="panel-body">
			
			<table class="table">
				<thead>
					<tr>
					<th scope="col">#</th>
					<th scope="col">Product</th>
					<th scope="col">Issued Qty</th>
					<th scope="col">Issued Date </th>
					</tr>
				</thead>
				<tbody>
					@foreach($partialorder as $order)
					<tr>
						<th scope="row">{{$loop->iteration}}</th>
						<td>{{$order->product->name}}</td>
						<td>{{$order->qty}}</td>
						<td>{{$order->created_at}}</td>

					</tr>
					@endforeach
				</tbody>
				</table>
			</div>
		</div>
	</div>

</div>



@endsection

@section('script')
    <script type="text/javascript">
        $('#update_delivery_status').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_delivery_status').val();
            $.post('{{ route('orders.update_delivery_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                showAlert('success', 'Delivery status has been updated');
            });
        });

        $('#update_payment_status').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_payment_status').val();
            $.post('{{ route('orders.update_payment_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                showAlert('success', 'Payment status has been updated');
            });
        });
    </script>
@endsection
