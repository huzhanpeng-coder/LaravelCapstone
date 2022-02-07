@extends('common') 

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
		<hr />
	</div>
</div>


<div class="col-md-4 ">
	<div class="row">
		<table class="table">
			<tbody>
		@foreach ($categories as $category)
			<tr>
				<td>
					<li><a href="{{ route('public.show', $category->id) }}"> {{$category->name }}</a></li>
				</td>	
			</tr>	
		@endforeach
			</tbody>
		</table>
	</div>
</div> <!-- end of .col-md-8 -->

<div class="col-md-8">
	<table class="table">
		<tbody>
			<tr>
				@php ($i=0)
		@foreach ($items as $item)
				
				@if($i == 3)
					<tr>
				@endif
				<td><center><img src="{{ Storage::url('images/items/'.'tn_'.$item->picture) }}" > <br>
				{{$item->title }} <br>
				<p>Price: {{$item->price }} CAD.<p> 
					<a href="{{ route('public.edit', $item->id) }}" class="btn btn-primary ">Buy Now</a> </center></td>	
				@if($i == 2)
					@php ($i=0)
					</tr>
				@else
					@php ($i=$i+1)
				@endif

		@endforeach
			</tr>
	</tbody>
</table>
</div>


@endsection