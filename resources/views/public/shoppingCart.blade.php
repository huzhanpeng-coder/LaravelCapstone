@extends('common') 

@section('pagetitle')
Shop
@endsection

@section('pagename')
Laravel Project
@endsection

@section('content')
	
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h1>Cart</h1>
		
	</div>
	
	<div class="col-md-12">
		<table class="table">
			<thead>
				<th>Title</th>
				<th>Quantity</th>
				<th>Price/unit</th>
				<th>Total</th>
				<th></th>
			</thead>
			<tbody>
				@foreach ($items as $item)
							@foreach($shop_items as $shop_item)
							<tr>
								@if($shop_item->item_id == $item->id)
									<td>{{ $item->title }}</td>
									
									{!! Form::model($shop_item, ['route' => ['public.update_cart', $shop_item->id], 'method'=>'PUT', 'data-parsley-validate' => '']) !!}
									
									<td>{{ Form::text('quantity_of_1', null, ['class'=>'form-control', 'style'=>'', 
				                                  'data-parsley-required'=>'', 'data-parsley-maxlength'=>'100']) }}</td>
									
									<td> {{ $item->price }} CAD</td>

									<td> {{($item->price)*($shop_item->quantity_of_1)}} CAD </td>
									
									<td style="width: 175px;"><div style='float:left; margin-right:5px;'>
										{{ Form::submit('Update', ['class'=>'btn btn-success btn-sm']) }}
									{!! Form::close() !!}	
									
								</div>
										<div style='float:left;'>
											<div style='float:left; margin-right:5px;'>
												<a href="{{ route('public.remove_item', $shop_item->id) }}" class="btn btn-success btn-sm">Remove</a>
											</div>
										</div>
									</td>
								@endif
								
							</tr>		
							@endforeach
					@endforeach
				</tr>
				<td><h4>Subtotal</h4></td>
				<td></td>
				<td></td>
				<td>
					@php ($total=0)
					@foreach ($items as $item)
							@foreach($shop_items as $shop_item)
								@if($shop_item->item_id == $item->id)
									@php ($total += $shop_item->quantity_of_1*$item->price)
								@endif
							@endforeach
					@endforeach	
					<h4>{{$total}} CAD </h4>
				</td>
			</tr>
			</tbody>
		</table>
		
	</div>

</div>



@endsection