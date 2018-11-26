@extends('layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Products
        <small>Edit Products</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Products</li>
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
        @elseif (count($errors) > 0)
           <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Error!</strong> {{ $errors->first() }}
          </div>
        @endif
        {{-- End Alert Message --}}
        
        <!-- left column -->
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Customer</h3>
              <a href="{{route('products')}}" class="pull-right">
                <button class="btn btn-primary">Back</button>
              </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{route('product.update')}}">
            @csrf
              <div class="box-body">
                {{-- Product Name --}}
                <div class="form-group {{ $errors->has('product_name') ? ' has-error' : '' }}">
                  <label for="Product_Name">Product Name
                  <span style="color: red;">*</span>
                  </label>
                  <input name="product_name" required type="text" class="form-control" id="product_name" placeholder="Enter Name Of Product" value="{{$product->product_name }}">
                    @if ($errors->has('product_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('product_name') }}</strong>
                    </span>
                    @endif
                </div>

                {{-- Category Id --}}
                <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                  <label for="category_id">Select Category</label>
                  <select name="category_id" class="form-control" id="category_id" >
                    <option disabled="">Please Select Category</option>
                    @foreach($categories as $category)
                    <option {{$category->category_id == $product->category_id ? 'selected' : ''}} value="{{$category->category_id}}"> {{$category->category}} </option>
                    @endforeach
                  </select>
                    @if ($errors->has('category_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('category_id') }}</strong>
                    </span>
                    @endif
                </div>

              </div>

              <input type="hidden" name="product_id" value="{{$product->product_id}}">
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update Customer</button>
              </div>
            </form>
          </div>
        </div>
       </div>
    </section>

  </div>


@endsection