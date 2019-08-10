<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	{{-- Design And Developed By TechTool India (SENTRIQO IT SOLUTIONS PVT LTD) --}}
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('app.name', 'Laravel') }} | Dashboard</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
	<!-- DataTables -->
	<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="{{asset('admin/dist/css/skins/_all-skins.min.css')}}">
	<!-- Morris chart -->
	<!-- <link rel="stylesheet" href="{{asset('admin/bower_components/morris.js/morris.css')}}"> -->
	<!-- jvectormap -->
	<link rel="stylesheet" href="{{asset('admin/bower_components/jvectormap/jquery-jvectormap.css')}}">
	<!-- Date Picker -->
	<link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">

	<link rel="stylesheet" href="{{asset('admin/plugins/iCheck/all.css')}}">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">

	<!-- Select2 -->
	<!-- <link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}"> -->
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/mystyle.css')}}">

	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('icon.png') }}">
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<style>
		/* Absolute Center Spinner */
		.loading {
			position: fixed;
			z-index: 999;
			height: 2em;
			width: 2em;
			overflow: visible;
			margin: auto;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			display: none;
		}

		/* Transparent Overlay */
		.loading:before {
			content: '';
			display: block;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(0, 0, 0, 0.3);
		}

		/* :not(:required) hides these rules from IE9 and below */
		.loading:not(:required) {
			/* hide "loading..." text */
			font: 0/0 a;
			color: transparent;
			text-shadow: none;
			background-color: transparent;
			border: 0;
		}

		.loading:not(:required):after {
			content: '';
			display: block;
			font-size: 10px;
			width: 1em;
			height: 1em;
			margin-top: -0.5em;
			-webkit-animation: spinner 1500ms infinite linear;
			-moz-animation: spinner 1500ms infinite linear;
			-ms-animation: spinner 1500ms infinite linear;
			-o-animation: spinner 1500ms infinite linear;
			animation: spinner 1500ms infinite linear;
			border-radius: 0.5em;
			-webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
			box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
		}

		/* Animation */

		@-webkit-keyframes spinner {
			0% {
				-webkit-transform: rotate(0deg);
				-moz-transform: rotate(0deg);
				-ms-transform: rotate(0deg);
				-o-transform: rotate(0deg);
				transform: rotate(0deg);
			}

			100% {
				-webkit-transform: rotate(360deg);
				-moz-transform: rotate(360deg);
				-ms-transform: rotate(360deg);
				-o-transform: rotate(360deg);
				transform: rotate(360deg);
			}
		}

		@-moz-keyframes spinner {
			0% {
				-webkit-transform: rotate(0deg);
				-moz-transform: rotate(0deg);
				-ms-transform: rotate(0deg);
				-o-transform: rotate(0deg);
				transform: rotate(0deg);
			}

			100% {
				-webkit-transform: rotate(360deg);
				-moz-transform: rotate(360deg);
				-ms-transform: rotate(360deg);
				-o-transform: rotate(360deg);
				transform: rotate(360deg);
			}
		}

		@-o-keyframes spinner {
			0% {
				-webkit-transform: rotate(0deg);
				-moz-transform: rotate(0deg);
				-ms-transform: rotate(0deg);
				-o-transform: rotate(0deg);
				transform: rotate(0deg);
			}

			100% {
				-webkit-transform: rotate(360deg);
				-moz-transform: rotate(360deg);
				-ms-transform: rotate(360deg);
				-o-transform: rotate(360deg);
				transform: rotate(360deg);
			}
		}

		@keyframes spinner {
			0% {
				-webkit-transform: rotate(0deg);
				-moz-transform: rotate(0deg);
				-ms-transform: rotate(0deg);
				-o-transform: rotate(0deg);
				transform: rotate(0deg);
			}

			100% {
				-webkit-transform: rotate(360deg);
				-moz-transform: rotate(360deg);
				-ms-transform: rotate(360deg);
				-o-transform: rotate(360deg);
				transform: rotate(360deg);
			}
		}
	</style>

</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="{{route('home')}}" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>V</b>TD</span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>Vivekanand</b> Traders</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">

						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="{{asset('man.png')}}" class="user-image" alt="User Image">
								<span class="hidden-xs">{{Auth::user()->name}}</span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<img src="{{asset('man.png')}}" class="img-circle" alt="User Image">

									<p>
										{{Auth::user()->name}} - Admin
									</p>
								</li>

								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="#" class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();document.getElementById('logout-form').submit();">

											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												{{ csrf_field() }}
											</form>
											Sign out
										</a>
									</div>
								</li>
							</ul>
						</li>

					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="{{asset('man.png')}}" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p>{{Auth::user()->name}}</p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				<!-- search form -->
				{{--  <form action="#" method="get" class="sidebar-form">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</form>  --}}
				<!-- /.search form -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header"><strong><b>Menus</b></strong></li>
					{{-- Dashboard --}}
					<li {!! (Route::is('home') ? 'class="active"' : '' ) !!}>
						<a href="{{route('home')}}">
							<i class="fa fa-dashboard"></i> <span>Dashboard</span>
						</a>
					</li>

					{{-- POS --}}
					<li class="treeview">
						<a href="#">
							<i class="fa fa-paypal"></i>
							<span>POS</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="{{route('sell')}}"><i class="fa fa-inr"></i> Sell </a></li>
							<li><a href="{{route('purchase')}}"><i class="fa fa-shopping-cart"></i> Purchase</a></li>
						</ul>
					</li>

					<!-- Financials -->
					<li class="treeview">
						<a href="#">
							<i class="fa fa-inr"></i>
							<span>Financials</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="{{route('sell')}}"><i class="fa fa-inr"></i> Recievables </a></li>
							<li><a href="{{route('payables.list')}}"><i class="fa fa-inr"></i> Payables </a></li>
							<li><a href="{{route('purchase')}}"><i class="fa fa-file"></i> Invoice List</a></li>
						</ul>
					</li>


					{{-- Customers --}}
					<li class="treeview">
						<a href="#">
							<i class="fa fa-users"></i>
							<span>Clients</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="{{route('customers')}}"><i class="fa fa-circle-o"></i> Client List</a></li>
							<!-- <li><a href=""><i class="fa fa-circle-o"></i> Customer Ladger</a></li> -->
						</ul>
					</li>

					{{-- Purchaser --}}

					<li class="treeview">
						<a href="#">
							<i class="fa fa-user-secret"></i>
							<span>Suppliers</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="{{route('purchasers')}}"><i class="fa fa-circle-o"></i> Supplier List</a></li>
							<!-- <li><a href=""><i class="fa fa-circle-o"></i> Purchaser Ladger</a></li> -->
						</ul>
					</li>
					<!-- Inventory -->
					<li class="treeview">
						<a href="#">
							<i class="fa fa-list"></i>
							<span>Inventory</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="{{route('inventory')}}"><i class="fa fa-circle-o"></i> Stock Inventory</a></li>
							<li><a href="{{route('inventory.log')}}"><i class="fa fa-circle-o"></i> Inventory Log</a></li>
						</ul>
					</li>

					{{-- Product --}}
					<li class="treeview">
						<a href="#">
							<i class="fa fa-product-hunt "></i>
							<span>Products/Materials</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="{{route('products')}}"><i class="fa fa-circle-o"></i> Product/Material List</a></li>
							<!-- <li><a href=""><i class="fa fa-circle-o"></i> Product/Material Ladger</a></li> -->
						</ul>
					</li>

					{{-- Lorry --}}
					<li class="treeview">
						<a href="#">
							<i class="fa fa-bus"></i> <span>Lorry</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="{{route('lorries')}}"><i class="fa fa-circle-o"></i> Lorry </a></li>
							<!-- <li><a href=""><i class="fa fa-circle-o"></i> Lorry Trip</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Lorry Expencess</a></li> -->
						</ul>
					</li>

					{{-- Default SET --}}
					<li class="treeview">
						<a href="#">
							<i class="fa fa-laptop"></i> <span>Set Deafaults</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="{{route('default.product.sell')}}"><i class="fa fa-circle-o"></i> Products Defaults </a></li>
							<!-- <li><a href=""><i class="fa fa-circle-o"></i> Report Defaults</a></li> -->
						</ul>
					</li>

					{{-- Master Data --}}
					<li class="treeview" {!! (Route::is('master.units') ? 'class="active"' : '' ) !!}>
						<a href="#">
							<i class="fa fa-maxcdn"></i> <span>Master Data</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="{{route('master.units')}}"><i class="fa fa-circle-o"></i> Unit</a></li>
							<li><a href="{{route('master.payment-mode')}}"><i class="fa fa-circle-o"></i> Payment Mode</a></li>
							<li><a href="{{route('master.category')}}"><i class="fa fa-circle-o"></i> Categories</a></li>
						</ul>
					</li>

					{{-- Setting --}}
					<li {!! (Route::is('setting') ? 'class="active"' : '' ) !!}>
						<a href="{{route('setting')}}">
							<i class="fa fa-gears"></i> <span>Setting</span>
						</a>
					</li>

				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>

		@yield('content')

		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1.1.0
			</div>
			<strong>TechTool CRM @ Copyright &copy; {{date('Y')}} <a href="https://techtoolindia.com">TechTool India (SENTRIQO IT SOLUTIONS PVT LTD)</a>.</strong> All rights
			reserved.
		</footer>


	</div>
	<!-- ./wrapper -->

	<!-- jQuery 3 -->
	<script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{asset('admin/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.7 -->
	<script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
	<!-- DataTables -->
	<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

	<!-- Select2 -->
	<!-- <script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
	<!-- Morris.js charts -->
	<!-- <script src="{{asset('admin/bower_components/raphael/raphael.min.js')}}"></script>
	<script src="{{asset('admin/bower_components/morris.js/morris.min.js')}}"></script> -->
	<!-- Sparkline -->
	<script src="{{asset('admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
	<!-- jvectormap -->
	<script src="{{asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
	<script src="{{asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
	<!-- jQuery Knob Chart -->
	<script src="{{asset('admin/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
	<!-- daterangepicker -->
	<script src="{{asset('admin/bower_components/moment/min/moment.min.js')}}"></script>
	<script src="{{asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	<!-- datepicker -->
	<script src="{{asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
	<!-- Slimscroll -->
	<script src="{{asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<!-- FastClick -->
	<script src="{{asset('admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
	<!-- AdminLTE App -->
	<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<!-- <script src="{{asset('admin/dist/js/pages/dashboard.js')}}"></script> -->
	<!-- AdminLTE for demo purposes -->
	<script src="{{asset('admin/dist/js/demo.js')}}"></script>

	<!-- InputMask -->
	<script src="{{asset('admin/plugins/input-mask/jquery.inputmask.js')}}"></script>
	<script src="{{asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
	<script src="{{asset('admin/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
	<!-- date-range-picker -->
	<script src="{{asset('admin/bower_components/moment/min/moment.min.js')}}"></script>
	<script src="{{asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	<!-- bootstrap datepicker -->
	<script src="{{asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
	<!-- bootstrap color picker -->
	<script src="{{asset('admin/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
	<!-- bootstrap time picker -->
	<script src="{{asset('admin/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
	<!-- SlimScroll -->
	<script src="{{asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<!-- iCheck 1.0.1 -->
	<script src="{{asset('admin/plugins/iCheck/icheck.min.js')}}"></script>

	<script>
		$(function() {
			$('#example1').DataTable()
			$('#example2').DataTable({
				'paging': true,
				'lengthChange': false,
				'searching': false,
				'ordering': true,
				'info': true,
				'autoWidth': true
			});

			$('.select2').select2();

			//Date picker
			$('.datepicker').datepicker({
				format: 'dd-mm-yyyy',
				autoclose: true
			})
		})
	</script>

	@yield('scripts')
</body>

</html>