@extends('admin.layouts.main')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">All Order </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">orders </li>
      </ol>
    </div>

    <div class="row">
      <div class="col-lg-12 mb-4">
        <!-- Simple Tables -->
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Order Tables</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Created At</th>
                  <th>View</th>
                </tr>
              </thead>
              <tbody>
                  @if (count($orders)>0)
                    @foreach ($orders as $key=>$order)
                <tr>
                <td><a href="#">{{$key+1}}</a></td>
                  <td>{{$order->user->name}}</td>
                  <td>{{$order->user->email}}</td>     
                  <td>{{date('d-M-y',strtotime($order->created_at)) }}</td>
                  <td>
                  <a href="{{route('order.user',[$order->user_id,$order->id])}}">
                        <button class="btn btn-primary">
                            view order
                        </button>
                     </a>
                  </td>     
                </tr>                         
                @endforeach
                     @else
                     <td>No order placed yet</td>                 
                @endif
              </tbody>
            </table>
          </div>
          <div class="card-footer"></div>
        </div>
      </div>
    </div>
    <!--Row-->
  </div>
@endsection