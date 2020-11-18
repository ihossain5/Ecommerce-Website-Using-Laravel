@extends('admin.layouts.main')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Slider Tables</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active" aria-current="page">Slider Tables</li>
      </ol>
    </div>

    <div class="row">
      <div class="col-lg-12 mb-4">
        <!-- Simple Tables -->
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">All Slider</h6>
            <a class="btn btn-facebook" href="{{route('slider.create')}}">
              Add new
            </a>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Sl</th>
                  <th>Image</th>           
                  <th>Action</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @if (count($sliders)>0)
                    @foreach ($sliders as $key=>$slider)
                <tr>
                <td><a href="#">{{$key+1}}</a></td>
                <td>
                  <img src="{{asset('/storage/slider/'.$slider->image)}}" width="100" alt="image">
                 </td>
               
                  <td>
                  <form action="{{route('slider.destroy',[$slider->id])}}" method="POST" onsubmit="return confirmDelete()">@csrf
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                  </td>
                </tr>                         
                @endforeach
                     @else
                     <td>No Slider created yet</td>                 
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