@extends('admin.layouts.main')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Subcategory Tables</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active" aria-current="page">Subcategory Tables</li>
      </ol>
    </div>

    <div class="row">
      <div class="col-lg-12 mb-4">
        <!-- Simple Tables -->
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Subcategory Tables</h6>
            <a href="{{route('subcategory.create')}}">
              <button class="btn btn-facebook">Add new</button>
          </a>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th></th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @if (count($subcategories)>0)
                    @foreach ($subcategories as $key=>$subcategories)
                <tr>
                <td><a href="#">{{$key+1}}</a></td>
                  <td>{{$subcategories->name}}</td>
                  <td>{{$subcategories->category->name}}</td>
                  <td>
                      <a href="{{route('subcategory.edit',[$subcategories->id])}} " class="btn btn-sm btn-primary">Edit</a>
                 </td>
                  <td>
                  <form action="{{route('subcategory.destroy',[$subcategories->id])}}" method="POST" onsubmit="return confirmDelete()">@csrf
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                  </td>
                </tr>                         
                @endforeach
                     @else
                     <td>No category created yet</td>                 
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