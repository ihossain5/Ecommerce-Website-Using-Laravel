@extends('layouts.app')

@section('content')


    <div class="container">
        <h2>Sub Category</h2>

      <div class="row">
        <div class="col-md-2">
             <form action="{{route('product.list',[$slug])}} " method="GET">
            <!--foreach subcategories-->
            @foreach ($subcategories as $subcategory)
              <p>
                  <input type="checkbox" name="subcategory[]" value="{{$subcategory->id}}"
                  @if(isset($filterSubCategories))
                  {{in_array($subcategory->id,$filterSubCategories)?'checked' :''}}
                 @endif
                  >
                     {{$subcategory->name}} 
            </p>
              @endforeach
           <!--end foreach-->
          <input type="submit" value="Filter" class="btn btn-success">
         </form>

         <hr>
         <h3>Filter by price</h3> 

         <form  action="{{route('product.list',[$slug])}}" method="GET">
             <input type="text" name="min" class="form-control" placeholder="minimum price" required="">
            <br>
             <input type="text" name="max" class="form-control" placeholder="maximum price" required=""  >
         <input type="hidden" name="categoryId" value="{{$categoryID}}">
             
             <br>
             <br>
            <input type="submit" value="Filter" class="btn btn-secondary">

        </form>
       <hr>
       <a href="{{route('product.list',[$slug])}}">Back</a>

        </div>
      <div class="col-md-10">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
          {{session('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        @endif
        <div class="row">
      <!--foreach products-->
      @foreach ($products as $product)
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
          <img src="{{Storage::url($product->image)}}" height="200" alt="image">
          <div class="card-body">
            <p><b>{{$product->name}} </b></p>
            <p class="card-text">
                {{Str::limit(strip_tags($product->description, 5))}}
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
    <!--endforeach-->
      </div>
    </div>
</div>
</div>

      
  

@endsection