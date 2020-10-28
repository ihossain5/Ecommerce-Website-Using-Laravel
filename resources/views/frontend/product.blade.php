@extends('layouts.app')

@section('content')
<div class="container">
    <main role="main">
      @if (session('success'))
      <div class="alert alert-success" role="alert">
        {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      @endif
          <div class="container">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                @foreach ($sliders as $key=> $slider)
                <div class="carousel-item {{$key == 0 ? 'active' : ''}} ">
                  <img src="{{Storage::url($slider->image)}} " class="d-block w-100" alt="slider-image">
                </div>
                @endforeach           
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        
      <h2>Category</h2>
      @foreach (App\Category::all() as $category)
          <a href="{{route('product.list',[$category->slug])}} ">
            <button class="btn btn-primary">{{$category->name}} </button>
          </a>
      @endforeach
        <div class="album py-5 bg-light">
          <div class="container">
            <h2>Products</h2>
            <div class="row">
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
          </div>
          <center>
          <a href="{{route('product.more')}}">
              <button class="btn btn-success">
                  More Procucts
              </button>
            </a>
          </center>
        </div>
       
      

        <div class="jumbotron">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row">
              @foreach($randomActiveProducts as $product)
              <div class="col-4">
                          <div class="card mb-4 shadow-sm">
                  <img src="{{Storage::url($product->image)}}" height="200" >
                  <div class="card-body">
                      <p><b>{{$product->name}}</b></p>
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
                      <small class="text-muted">${{$product->price}}</small>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
              
            </div>
          </div>
          <div class="carousel-item ">
            <div class="row">
              @foreach($randomItemProducts as $product)
      
              <div class="col-4">
                          <div class="card mb-4 shadow-sm">
                  <img src="{{Storage::url($product->image)}}" height="200">
                  <div class="card-body">
                      <p><b>{{$product->name}}</b></p>
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
                      <small class="text-muted">${{$product->price}}</small>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
             
            </div>
          </div>
          
         
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
        </div>


      </main>

      <footer class="text-muted">
        <div class="container">
          <p class="float-right">
            <a href="#">Back to top</a>
          </p>
          
        </div>
      </footer>
</div>
@endsection