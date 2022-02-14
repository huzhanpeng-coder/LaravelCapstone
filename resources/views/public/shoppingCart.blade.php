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
				<th>Price</th>
				<th></th>
			</thead>
			<tbody>
				@foreach ($items as $item)
							@foreach($shop_items as $shop_item)
							<tr>
								@if($shop_item->item_id == $item->id)
									<td>{{ $item->title }}</td>
									<td>{{ $shop_item->quantity_of_1 }}</td>
									<td> {{ $item->price }} CAD</td>
								@endif
							</tr>		
							@endforeach
					@endforeach
			</tbody>
		</table>
		
	</div>

</div>



@endsection