@extends('layouts.app')
@section('content')
    
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-8">
             @foreach ($carts as $cart)
             <div class="card">
                 <div class="card-body">
                    @foreach ($cart->items as $item)
                    <span class="float-right">
                    <img src="{{Storage::url($item['image'])}}" width="100" alt="">
                    </span>
                        <p>Name: {{$item['name']}} </p>
                        <p>Price: ${{$item['price']}} </p>
                        <p>Quantity: {{$item['qty']}} </p>
                    @endforeach
                 </div>
             </div>  
             <p>
                <button class="btn button-green">
                    <span class="badge badge-success">
                       Total Price: ${{$cart->totalPrice}}
                    </span>
                </button>
            </p>                         
             @endforeach
         </div>
     </div>
 </div>

@endsection