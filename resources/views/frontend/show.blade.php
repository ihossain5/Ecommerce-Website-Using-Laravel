@extends('layouts.app')

@section('content')


<div class="container">
	@if (session('success'))
	<div class="alert alert-success" role="alert">
	  {{session('success')}}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	</div>
	@endif
<div class="card">
	<div class="row">
		<aside class="col-sm-5 border-right">
			<section class="gallery-wrap"> 
			<div class="img-big-wrap">
			  <div> <a href="#">
			  	<img src="{{Storage::url($product->image)}}" width="460"></a>
			  </div>
			</div> 
			
			</section> 
		</aside>
		<aside class="col-sm-7">
			<section class="card-body p-5">
            <h3 class="title mb-3">{{$product->name}}</h3>
<p class="price-detail-wrap"> 
	<span class="price h3 text-danger"> 
		<span class="currency">US $</span>{{$product->price}}
	</span> 
	 
</p> <!-- price-detail-wrap .// -->
  <h3>Description</h3>
  <p>{!!$product->description!!}</p>
  <h3>Additional information</h3>
  <p>{!!$product->additional_info!!}</p>


<hr>

	<a href="{{route('cart.add',[$product->id])}}">
		<button type="button" class="btn btn-sm btn-outline-primary">Add To cart</button>
	  </a>
	
	
</section> 
		</aside> 

	</div> 
</div> 

@if (count($similarProduct)>0)
	
<div class="jumbotron">
<div class="title text-center mb-3">
	<h3>Related Products</h3>
</div>
	<div class="row">
		@foreach ($similarProduct as $product)

		<div class="col-md-4">
		  <div class="card mb-4 shadow-sm">
			<img src="{{Storage::url($product->image)}}" height="270" alt="image">
			<div class="card-body">
			  <p><b>{{$product->name}} </b></p>
			  <p class="card-text">
				{{Str::words(strip_tags($product->description, 100))}}
			  </p>
			  <div class="d-flex justify-content-between align-items-center">
				<div class="btn-group">
				<a href="{{route('product.show',[$product->id])}} ">
				  <button type="button" class="btn btn-sm btn-outline-success">View</button>
				</a>  
				<a href="{{route('cart.add',[$product->id])}}">
					<button type="button" class="btn btn-sm btn-outline-primary">Add To cart</button>
				  </a>
				</div>
				<small class="text-muted">${{$product->price}} </small>
			  </div>
			</div>
		  </div>
		</div>
						  
		@endforeach
	  </div>
</div>
@endif

</div>

@endsection