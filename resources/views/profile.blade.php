<?php use App\Models\Enrollment;
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>designS2dio - Profile</title>

	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

	<!-- BEGIN CORE CSS -->
	<link rel="stylesheet" href="{{ URL::asset('css/admin1.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/elements.css') }}">
	<!-- END CORE CSS -->
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />

	<!-- BEGIN PLUGINS CSS -->
	<link rel="stylesheet" href="{{ URL::asset('css/plugins.css') }}">
	<!-- END PLUGINS CSS -->
	<link rel="stylesheet" href="{{ URL::asset('css/alertify.bootstrap.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/alertify.core.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/alertify.default.css') }}">


	<!-- BEGIN SHORTCUT AND TOUCH ICONS -->
	<link rel="shortcut icon" href="../../assets/globals/img/icons/favicon.ico">
	<link rel="apple-touch-icon" href="../../assets/globals/img/icons/apple-touch-icon.png">
	<!-- END SHORTCUT AND TOUCH ICONS -->

	<script src="{{ URL::asset('js/modernizr.min.js') }}"></script>
  <style>

  .post
  {
      background-color: #FFF;
      overflow: hidden;
      box-shadow: 0 0 1px #CCC;
  }
  .modal-dialog {
  width: 400px;
}
.modal-content, .modal-body {
  width: 400px;
}
  .post img
  {

  }
  .post .content
  {
      padding: 15px;
  }
  .post .author
  {
      font-size: 11px;
      color: #737373;
      padding: 25px 30px 20px;
  }
  .post .post-img-content
  {
      height: 196px;
      position: relative;
  }
  .post .post-img-content img
  {
      position: absolute;
  }
  .post .post-title
  {
      display: table-cell;
      vertical-align: bottom;
      z-index: 2;
      position: relative;
  }
  .post .post-title b
  {
      background-color: rgba(51, 51, 51, 0.58);
      display: inline-block;
      margin-bottom: 5px;
      color: #FFF;
      padding: 10px 15px;
      margin-top: 5px;
  }

  </style>
</head>
<body>

	<div class="nav-bar-container">

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
		      <h1>Profile <small>Update Profile</small></h1>
		    </div><!--.col-->
		    <div class="col-sm-4">
		      <a href="{{URL::to('/home/notifications')}}"><i style="float:right;color:white;cursor:pointer;font-size:30px;margin:0px;" class="ion-android-notifications"><i id="notificationIcon" url="{{URL::to('/home/notify')}}" class="badge"></i></i></a>


		    </div>
		    <div class="col-sm-1">
		  <ol class="breadcrumb">

		        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="">
		            @csrf
		          <button type="submit" style="" class="btn btn-danger">Logout</button>
		        </form>
		        </ol>


		    </div><!--.col-->
		  </div><!--.row-->
		</div><!--.page-header-->
		<!-- content -->
    <div class="row">

			<div class="col-md-2"></div>
			<div class="col-md-6">
	{{Form::open(['url'=> '/home/submitProfile', 'method'=>'post'])}}
	<div class="inputer floating-label">
						<div class="input-wrapper">
							<input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
							<label for="name">FULL NAME</label>
						</div>
					</div>

					<div class="inputer floating-label">
										<div class="input-wrapper">
											<input type="text" class="form-control" id="age" name="age" value="{{$user->age}}">
											<label for="age">AGE</label>
										</div>
									</div>

									{!! csrf_field() !!}
									<div class="inputer floating-label">
														<div class="input-wrapper">
															<input type="text" class="form-control" id="level" name="level" value="{{$user->year_level}}">
															<label for="age">YEAR LEVEL</label>
														</div>
													</div>
						<button type="submit" class="btn btn-success">SAVE</button>
					{{Form::close()}}
				</div>



		</div><!--.row-->



		<!-- content -->


	</div><!--.content-->

	<div class="layer-container">

		<!-- BEGIN MENU LAYER -->
		<div class="menu-layer">
			<ul>
			  <li>
			    <a href="{{URL::to('/home/')}}">Home</a>
			  </li>

			    @if(Session()->get('enrolled') == 1 && Session()->get('isWaiting') == 0)
			      <li><a href="{{URL::to('home/class')}}">Class</a></li>
			    @endif

			    @if(Session()->get('isWaiting') == 1)
			      <li><a href="{{URL::to('home/waitinglist')}}">Waiting List</a></li>
			    @endif


			      <li><a href="{{URL::to('home/profile')}}">Profile</a></li>

			</ul>
		</div><!--.menu-layer-->
		<!-- END OF MENU LAYER -->

		<!-- BEGIN SEARCH LAYER -->
		<div class="search-layer">
			<div class="search">
				<form action="pages-search-results.html">
					<div class="form-group">
						<input type="text" id="input-search" class="form-control" placeholder="type something">
						<button type="submit" class="btn btn-default disabled"><i class="ion-search"></i></button>
					</div>
				</form>
			</div><!--.search-->


		</div><!--.search-layer-->
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
	<script src="{{ URL::asset('js/pleasure.js') }}"></script>
	<!-- ADMIN 1 -->
	<script src="{{ URL::asset('js/layout.js') }}"></script>
	<script src="{{ URL::asset('js/alertify.min.js') }}"></script>
	<script src="{{ URL::asset('js/myscript.js') }}"></script>


	<!-- BEGIN INITIALIZATION-->
	<script>
	$(document).ready(function () {
		Pleasure.init();
		Layout.init();
	});
	</script>
	<!-- END INITIALIZATION-->

	<!-- BEGIN Google Analytics -->

	<!-- END Google Analytics -->
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
