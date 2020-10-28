
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Greetings</title>
</head>
<body>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Thank You <span>{{Auth::user()->name}}</span>  </h1>
          <p class="lead">Your order has been placed</p>
        </div>
        
        
        
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;    
                @endphp
                @foreach ($cart->items as $product)             
                <tr>
                    <th scope="row">{{$i++}} </th>
                    <td>{{$product['name']}} </td>
                    <td>${{$product['price']}} </td>
                    <td>{{$product['qty']}} </td>
                </tr>
                @endforeach
                <hr>
                Total Price: ${{$cart->totalPrice}}
                <br>
                Please click the link to view your order <a href="{{route('order')}} ">Click Here</a>
            </tbody>
        </table>
</body>
</html>

