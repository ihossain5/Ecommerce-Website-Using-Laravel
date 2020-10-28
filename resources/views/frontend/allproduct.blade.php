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

      <form action="{{route('product.more')}}" method="GET">
        <div class="form-row">
          <div class="col-md-8">
            <input type="text" name="search" class="form-control" placeholder="search...">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-secondary">Submit</button>
          </div>
        </div>
        <div class="row mt-3">
            @foreach ($products as $product)

            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <img src="{{Storage::url($product->image)}}" height="200" alt="image">
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
        {{$products->links()}}
    </div>
@endsection