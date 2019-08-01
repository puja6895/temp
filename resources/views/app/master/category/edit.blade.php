@extends('layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category Master
        <small>Edit Category</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Category Master</li>
      </ol>
    </section>

    

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
        
        <!-- Alert Message -->
        @if (Session::has('success'))
         <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Success!</strong> {{ Session::get('success') }}
          </div>
        @elseif (Session::has('error'))
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Error!</strong> {{ Session::get('error') }}
          </div>
        @endif
        {{-- End Alert Message --}}
        
        <!-- left column -->
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Category</h3>
              <a href="{{route('master.category')}}" class="pull-right">
              	<button class="btn btn-primary">Back</button>
              </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{route('master.category.update')}}">
            @csrf
              <div class="box-body">
                {{-- Category Name --}}
                <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                  <label for="Company_Name">Category</label>
                  <input name="category" required type="text" class="form-control" id="name" placeholder="Enter Category" value="{{$category->category }}">
                   	@if ($errors->has('category'))
	                  <span class="help-block">
	                      <strong>{{ $errors->first('category') }}</strong>
	                  </span>
                  	@endif
                </div>

              </div>
              <!-- /.box-body -->
              <input type="hidden" name="category_id" value="{{$category->category_id}}">
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update Category</button>
              </div>
            </form>
          </div>
        </div>
       </div>
    </section>

  </div>


@endsection