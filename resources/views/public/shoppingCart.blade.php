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

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h5 class="text-primary" style="text-align: center;">
				Customer Information
			</h5>
		</div>
	</div>

	<div style="margin:0px auto;width:600px" class="container">
		<div class="row">
			{!! Form::open(['route' => ['public.check_order',session('session_id') ], 'data-parsley-validate' => '', 
			                'files' => true]) !!}
			<div class="col-md-8">
				<div class="form-group" id="first-name-group">
					{!! Form::label('firstName', 'First Name:') !!}
					{!! Form::text('first_name', null, [
						'class'                         => 'form-control',
						'required'                      => 'required',
						'placeholder'                   => 'First Name',
						'data-parsley-required-message' => 'First name is required',
						'data-parsley-trigger'          => 'change focusout',
						'data-parsley-errors-container="#errorMessage1"',
						]) !!}
				</div>
			</div>
			<div class="col-md-4" id="errorMessage1"></div>
		
			<div class="col-md-8">
				<div class="form-group" id="last-name-group">
					{!! Form::label('lastName', 'Last Name:') !!}
					{!! Form::text('last_name', null, [
						'class'                         => 'form-control',
						'required'                      => 'required',
						'placeholder'                   => 'Last Name',
						'data-parsley-required-message' => 'Last name is required',
						'data-parsley-trigger'          => 'change focusout',
						'data-parsley-errors-container="#errorMessage2"',
						]) !!}
				</div>
			</div>
			<div class="col-md-4" id="errorMessage2"></div>
			
			<div class="col-md-8">
				<div class="form-group" id="email-group">
					{!! Form::label('email', 'Email address:') !!}
					{!! Form::email('email', null, [
						'class' => 'form-control',
						'placeholder'                   => 'email@example.com',
						'required'                      => 'required',
						'data-parsley-required-message' => 'Email name is required',
						'data-parsley-trigger'          => 'change focusout',
						'data-parsley-errors-container="#errorMessage3"',
						]) !!}
				</div>
			</div>
			<div class="col-md-4" id="errorMessage3"></div>
			
			<div class="col-md-8">
				<div class="form-group" id="phone-group">
					{!! Form::label('phone', 'Phone Number:') !!}
					{!! Form::text('phone', null, [
						'class' => 'form-control',
						'placeholder'                   => '780-888-8888',
						'required'                      => 'required',
						'data-parsley-required-message' => 'Number name is required',
						'data-parsley-trigger'          => 'change focusout',
						'data-parsley-minlength'        => '10',
						'data-parsley-errors-container="#errorMessage4"',
						]) !!}
				</div>
			</div>
			<div class="col-md-4" id="errorMessage4"></div>
			
			<div class="col-md-8">
				<div class="form-group">
					{!! Form::submit('Submit Order', ['class' => 'btn btn-primary btn-order', 'id' => 'submitBtn', 'style' => 'margin-bottom: 10px;']) !!}
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
	<!-- PARSLEY -->
	<script>
		window.ParsleyConfig = {
			errorsWrapper: '<div></div>',
			errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
			errorClass: 'has-error',
			successClass: 'has-success'
		};
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="http://parsleyjs.org/dist/parsley.js"></script>


</div>



@endsection