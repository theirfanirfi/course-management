<?php
use App\Models\Enrollment;
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>designS2studio - COURSES</title>

	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />


	<!-- BEGIN CORE CSS -->
	<link rel="stylesheet" href="{{ URL::asset('css/admin1.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/elements.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/jasny-bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/jquery.dataTables.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/dataTables.bootstrap.css') }}">

	<!-- END CORE CSS -->

	<!-- BEGIN PLUGINS CSS -->
	<link rel="stylesheet" href="{{ URL::asset('css/plugins.css') }}">

	<link rel="stylesheet" href="{{ URL::asset('css/alertify.bootstrap.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/alertify.core.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/alertify.default.css') }}">

	<!-- END PLUGINS CSS -->

	<!-- BEGIN SHORTCUT AND TOUCH ICONS -->
	<link rel="shortcut icon" href="../../assets/globals/img/icons/favicon.ico">
	<link rel="apple-touch-icon" href="../../assets/globals/img/icons/apple-touch-icon.png">

	<!-- END SHORTCUT AND TOUCH ICONS -->

	<script src="{{ URL::asset('js/modernizr.min.js') }}"></script>
	<script src="{{ URL::asset('js/angular.min.js') }}"></script>
	<script src="{{ URL::asset('js/myscript.js') }}"></script>
</head>
<body>

	<div class="nav-bar-container" style="background-color:black;">

		<!-- BEGIN ICONS -->
		<div class="nav-menu">
			<div class="hamburger">
				<span class="patty"></span>
				<span class="patty"></span>
				<span class="patty"></span>
				<span class="patty"></span>
				<span class="patty"></span>
				<span class="patty"></span>
			</div><!--.hamburger-->
		</div><!--.nav-menu-->


		<div class="nav-user">

			<div class="cross">
				<span class="line"></span>
				<span class="line"></span>
			</div><!--.cross-->
		</div><!--.nav-user-->
		<!-- END OF ICONS -->

		<div class="nav-bar-border"></div><!--.nav-bar-border-->

		<!-- BEGIN OVERLAY HELPERS -->
		<div class="overlay">
			<div class="starting-point">
				<span></span>
			</div><!--.starting-point-->
			<div class="logo">designS2dio.com</div><!--.logo-->
		</div><!--.overlay-->

		<div class="overlay-secondary"></div><!--.overlay-secondary-->
		<!-- END OF OVERLAY HELPERS -->

	</div><!--.nav-bar-container-->

	<div class="content">

		<div class="page-header full-content">
			<div class="row">
				<div class="col-sm-6">
					<h1>Courses <small></small></h1>
				</div><!--.col-->
				<div class="col-sm-6">
					<ol class="breadcrumb">
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="">
						    @csrf
						  <button type="submit" style="" class="btn btn-danger">Logout</button>
						</form></ol>
				</div><!--.col-->
			</div><!--.row-->
		</div><!--.page-header-->

		<!-- content -->
		<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<div class="panel-title"></div>
				</div><!--.panel-heading-->
				<div class="panel-body">

					<div class="overflow-table">
					<table class="display datatables-basic" ng-app="allCoursesApp" ng-controller="allCoursesController">
						<thead>
							<tr>
								<th> Course Name</th>

								<th>Total Students</th>
								<th>Enrolled Students</th>
								<th>IMAGE </th>
								<th>Action</th>
							</tr>
						</thead>

						<tfoot>
							<tr>
								<th> Course Name</th>

								<th>Total Students</th>
								<th>Enrolled Students</th>
								<th>IMAGE </th>
								<th>Action</th>
							</tr>
						</tfoot>

						<tbody>
						@if(!empty($courses))
							@foreach($courses as $c)
							<tr id="{{$c->c_id}}">
								<td>{{$c->courseName}}</td>
								<td>{{$c->stdLimit}}</td>
								<td>
									<?php $ecount= Enrollment::where('c_id','=',$c->c_id)->get()->count(); ?>
									{{$ecount}}
								</td>
								<td><img style="height:100px;width:100px;" src="{{URL::to('/')}}/{{$c->image_path}}" /></td>
								<td>
									<a href="{{URL::to('/admin/courseStudentList')}}/{{$c->c_id}}" class="btn btn-primary btn-ripple">View List</a>
									<a href="#" class="btn btn-deep-orange btn-ripple" c_value="{{$c->c_id}}"  data-url="{{URL::to('/admin/deletecourse')}}/{{$c->c_id}}" onclick="deleteCourse(this);">Delete</a>
									<a href="{{URL::to('/admin/editCourse')}}/{{$c->c_id}}" class="btn btn-green btn-ripple">Edit</a>
								</td>
							</tr>
						@endforeach
						@endif


						</tbody>
					</table>
					</div><!--.overflow-table-->

				</div><!--.panel-body-->
			</div><!--.panel-->
		</div><!--.col-md-12-->
	</div><!--.row-->


		<!-- content -->

	</div><!--.content-->

	<div class="layer-container">

		<!-- BEGIN MENU LAYER -->
		<div class="menu-layer">
			<ul>
			<li>
			  <a href="{{URL::to('/admin/')}}"><img src="{{URL::asset('img/logo.png')}}" style="width:160px;height60px;" /></a>
			</li>
			  <li>
			    <a href="javascript:;">Course Management</a>
			    <ul class="child-menu">
			      <li><a href="{{URL::to('/admin/addcourse')}}">Add Course</a></li>
			      <li><a href="{{URL::to('/admin/courses')}}">View Courses</a></li>
			    </ul>
			  </li>
			      <li><a href="{{URL::to('/admin/studentList')}}">Student List</a></li>
			      <li><a href="{{URL::to('/admin/waitingStudents')}}">Waiting List</a></li>




			</ul>
		</div><!--.menu-layer-->
		<!-- END OF MENU LAYER -->


		<!-- END OF SEARCH LAYER -->
	</div><!--.layer-container-->

	<!-- BEGIN GLOBAL AND THEME VENDORS -->
	<script src="{{ URL::asset('js/global-vendors.js') }}"></script>
	<!-- END GLOBAL AND THEME VENDORS -->

	<!-- BEGIN PLUGINS AREA -->
	<!-- END PLUGINS AREA -->

	<!-- PLUGINS INITIALIZATION AND SETTINGS -->
	<!-- END PLUGINS INITIALIZATION AND SETTINGS -->

	<!-- PLEASURE -->
	<script src="{{ URL::asset('js/pleasure.js') }}"></script>	<script src="{{ URL::asset('js/jasny-bootstrap.min.js') }}"></script>	<script src="{{ URL::asset('js/pleasure.js') }}"></script>


	<!-- ADMIN 1 -->
	<script src="{{ URL::asset('js/layout.js') }}"></script>
	<script src="{{ URL::asset('js/alertify.min.js') }}"></script>
	<script src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::asset('js/dataTables.bootstrap.js') }}"></script>
	<script src="{{ URL::asset('js/tables-datatables.js') }}"></script>

	<!-- BEGIN INITIALIZATION-->
	<script>

	$(document).ready(function () {
		Pleasure.init();
		Layout.init();
		TablesDataTables.init();
	});
	</script>
	<!-- END INITIALIZATION-->

@if(Session('success'))
	<script>
	alertify.success('{{Session('success')}}')
	</script>
@endif

@if(Session('error'))
	<script>
	alertify.error('{{Session('error')}}')
	</script>
@endif
</body>
</html>
