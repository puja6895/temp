@extends('layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Products / Materials
        <small>Add Product</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product / Material</li>
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
              <h3 class="box-title">Add Product / Material</h3>
              <a href="{{route('products')}}" class="pull-right">
              	<button class="btn btn-primary">Back</button>
              </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{route('product.store')}}">
            @csrf
              <div class="box-body">
                {{-- Product Name --}}
                <div class="form-group {{ $errors->has('product_name') ? ' has-error' : '' }}">
                  <label for="Product_Name">Product Name
                  <span style="color: red;">*</span>
                  </label>
                  <input name="product_name" required type="text" class="form-control" id="product_name" placeholder="Enter Name Of Product" value="{{old('product_name') }}">
                   	@if ($errors->has('product_name'))
	                  <span class="help-block">
	                      <strong>{{ $errors->first('product_name') }}</strong>
	                  </span>
                  	@endif
                </div>

                {{-- Product Category --}}
                <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                  <label for="category_id">Select Category</label>
                  <select class="form-control" name="category_id">
                    <option selected="" disabled="">Please Select Category</option>
                    @foreach($categories as $category)
                      <option value="{{$category->category_id}}">
                        {{$category->category}}
                      </option>
                    @endforeach
                  </select>
                    @if ($errors->has('category_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('category_id') }}</strong>
                    </span>
                    @endif
                </div>

              </div>
              
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add Product</button>
              </div>
            </form>
          </div>
        </div>
       </div>
    </section>

  </div>


@endsection