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
		<h1>Products</h1>
	</div>
	
	<div class="col-md-12">
		<center><img src="{{ Storage::url('images/items/'.'lrg_'.$item->picture) }}" > <br>
			Title: {{$item->title }} <br>
			<p>Product ID: {{$item->id }}</p>
			Description: {!! html_entity_decode($item->description) !!}<br><br>
			<p>Price: {{$item->price }} CAD.<p>
			<p>Quantity: {{$item->quantity }} units available.<p>
			<p>SKU: {{$item->sku }}<br><p>
				<a href="{{ route('public.shopping_store', $item->id) }}" class="btn btn-success btn-sm">Add to cart</a></div><div style='float:left;'>			
	</div>
</div>



@endsection