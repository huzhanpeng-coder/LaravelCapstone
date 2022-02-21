@extends('common_public') 

@section('pagetitle')
Products
@endsection

@section('pagename')
Laravel Project
@endsection

@section('content')
	
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h1>Thank You! This is your Receipt:</h1>
	</div>
	
</div>

<div class="col-md-8">

	<h1>Customer Details</h1>
	<h5>First Name: {{$current_order->First_name}}</h5>
	<h5>Last Name: {{$current_order->Last_name}}</h5>
	<h5>Email: {{$current_order->Email}}</h5>
	<h5>Phone: {{$current_order->Phone_number}}</h5>

	<table class="table">
        <tbody>
            
            <tr>
				<th>Quantity</th>
                <th>Item</th>
                <th>Price(each.)</th>
				<th>Total</th>  
        @foreach ($customer_orders as $customer_order)
            @foreach ($items_sold as $item_sold)
                @foreach ($items as $item)
                    
                @if($item->id == $item_sold->item_id)
                    @if ($customer_order->id == $item_sold->order_id)
                    </tr>
                        <td>{{$item_sold->quantity}}</td>
                        <td>{{$item->title}} </td>
						<td>{{$item->price}} </td>
                        <td>{{$item->price*$item_sold->quantity}}</td>
                    <tr>
                    @endif  
                @endif
                    @endforeach 
            @endforeach
        @endforeach 
            </tr>
			@php ($total=0)
			@foreach ($customer_orders as $customer_order)
				@foreach ($items_sold as $item_sold)
					@foreach ($items as $item)
						@if($item->id == $item_sold->item_id)
							@if ($customer_order->id == $item_sold->order_id)
								@php ($total += $item_sold->quantity*$item->price)
							@endif
						@endif	
					@endforeach
				@endforeach	
			@endforeach
			
			
            <tr>
				<th></th>
                <th></th>
				<th>Subtotal:</th>
                <th> {{$total}} CAD</th>   
			</tr>    
        </tbody>
    </table>
	
	@php(Cookie::queue('laravel_session', null, -1))
	
</div>


@endsection