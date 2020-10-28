@extends('admin.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 ml-4 text-gray-800">Product</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Product</li>
            </ol>
    </div>
<!-- Datatables -->
<div class="col-lg-12">
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
    </div>
    <div class="table-responsive p-3">
      <table class="table align-items-center table-flush" id="dataTable">
        <thead class="thead-light">
          <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
            <th>Price</th>
            <th>Additional Info</th>
            <th>Category</th>
            <th>Action</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
            <th>Price</th>
            <th>Additional Info</th>
            <th>Category</th>
          </tr>
        </tfoot>
        <tbody>
          @if (count($products)>0)
          @foreach ($products as $product)
          <tr>
            <td>{{ $product->name}} </td>
            <td>
              <img src="{{Storage::url($product->image)}}" width="120" alt="image">
            </td>
            <td>{!! $product->description !!} </td>
            <td>${{ $product->price }} </td>
            <td>{!! $product->additional_info !!} </td>
            <td>{{ $product->Category->name }} </td>
            <td>
              <a href="{{route('product.edit',[$product->id])}} "> <button class="btn btn-primary">Edit</button></a>
            </td>
            <td>
              <form action="{{route('product.destroy',[$product->id])}}" method="POST" onsubmit="return confirmDelete()">@csrf
                {{method_field('DELETE')}}
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>          
          @endforeach
          @else <td>Nothing to show</td> 
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection