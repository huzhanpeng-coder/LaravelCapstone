@extends('common') 

@section('pagetitle')
View Orders
@endsection

@section('pagename')
Laravel Project
@endsection

@section('content')
	
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h1>View Orders</h1>
	</div>
	
	<div class="col-md-12">
		<hr />
	</div>
</div>


<div class="col-md-4 ">
	<div class="row">
		<table class="table">
			<tbody>
			</tbody>
		</table>
	</div>
</div> <!-- end of .col-md-8 -->

<div class="col-md-8">
	<table class="table">
		<tbody>
			
			<tr>
                <th>Order ID</th>
				<th>Access</th>
            </tr>
			@foreach ($all_orders as $order)
			</tr>
				<td>{{$order->id}}</td>
				<td><a href="{{ route('public.check_receipt', $order->id ) }}" class="btn btn-success btn-sm">view</a></div><div style='float:left;'></td>
			<tr>
			@endforeach
	</tbody>
</table>
</div>


@endsection