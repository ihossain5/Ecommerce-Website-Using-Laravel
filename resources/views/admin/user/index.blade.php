@extends('admin.layouts.main')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">All User </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active" aria-current="page">users </li>
      </ol>
    </div>

    <div class="row">
      <div class="col-lg-12 mb-4">
        <!-- Simple Tables -->
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">User Tables</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @if (count($users)>0)
                    @foreach ($users as $key=>$user)
                <tr>
                <td><a href="#">{{$key+1}}</a></td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>
                  <form action="{{route('user.destroy',[$user->id])}}" method="POST" onsubmit="return confirmDelete()">@csrf
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-danger">Remove</button>
                  </form>
                  </td>
                </tr>                         
                @endforeach
                     @else
                     <td>No user registerd yet</td>                 
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