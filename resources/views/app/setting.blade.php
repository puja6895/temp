@extends('layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        System Settings
        <small>Common Settings</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Settings</li>
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
              <h3 class="box-title">Setting</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{route('setting.update')}}" enctype="form/data">
            @csrf
              <div class="box-body">
                {{-- Company Name --}}
                <div class="form-group">
                  <label for="Company_Name">Company Name</label>
                  <input name="company_name" type="text" class="form-control" id="name" placeholder="Enter Name Of Company" value="{{isset($company_name) ? $company_name : '' }}">
                </div>

                {{-- Company Email ID --}}
                <div class="form-group">
                  <label for="email">Email ID</label>
                  <input name="company_email" type="email" class="form-control" id="email" placeholder="Enter email Id Of Company" value="{{isset($company_email) ? $company_email : '' }}">
                </div>

                {{-- Company Mobile --}}
                <div class="form-group">
                  <label for="Company_Mobile">Company Mobile</label>
                  <input name="company_mobile" type="text" class="form-control" id="mobile" placeholder="Enter Mobile No Of Company" value="{{isset($company_mobile) ? $company_mobile : '' }}">
                </div>

                {{-- Company GSTN --}}
                <div class="form-group">
                  <label for="Company_Gstn">Company GSTN No.</label>
                  <input name="company_gstn" type="text" class="form-control" id="gstn" placeholder="Enter GSTN No Of Company" value="{{isset($company_gstn) ? $company_gstn : '' }}">
                </div>

                {{-- Company Reg No --}}
                <div class="form-group">
                  <label for="Company_reg">Company Reg. No.</label>
                  <input name="company_reg" type="text" class="form-control" id="reg" placeholder="Enter Reg. No Of Company" value="{{isset($company_reg) ? $company_reg : '' }}">
                </div>

                {{-- Company Address --}}
                <div class="form-group">
                  <label for="Company_reg">Company Address</label>
                  <textarea class="form-control" name="company_address" id="address" placeholder="Company Address">{{isset($company_address) ? $company_address : '' }}</textarea>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update Setting</button>
              </div>
            </form>
          </div>
        </div>
       </div>
    </section>

  </div>


@endsection