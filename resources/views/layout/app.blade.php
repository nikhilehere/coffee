<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Coffee Shop</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" /> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
	<link href="{{ url('css/coffee-main.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ url('css/sidebar.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ url('css/contents.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ url('css/table.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ url('css/modal.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ url('css/fields.css') }}" rel="stylesheet" type="text/css">
	<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
	<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script> -->
</head>

<body>
	<header>
		<nav class="navbar navbar-dark cm-main-header">
		@if(Auth::user()->isCustomer())
			<a class="navbar-brand" href="/shopNow"><img src="{{ url('images/logo.png') }}" width="40" height="30" class="d-inline-block align-top" alt="">&nbsp; Coffee shop </a>
		@else
			<a class="navbar-brand" href="#"><img src="{{ url('images/logo.png') }}" width="40" height="30" class="d-inline-block align-top" alt="">&nbsp; Coffee shop </a>
		@endif
			<li class="nav-item dropdown cm-navbar-li">
				<a id="navbarDropdown" class="nav-link dropdown-toggle cm-navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> <i class="fas fa-user-cog"></i> {{ Auth::user()->name }} <span class="caret"></span> </a>
				<div class="dropdown-menu dropdown-menu-right cm-navbar-dropdown-menu" aria-labelledby="navbarDropdown"> 
					@if(Auth::user()->isCustomer())
					<a class="dropdown-item" href="/myProfile/1"><i class="fas fa-user-circle"></i> My Profile</a>
					<a class="dropdown-item" href="/wallet"><i class="fas fa-wallet"></i> Wallet &#8377; {{ number_format(Auth::user()->customer->wallet, 2) }}</a>
					@endif
          			<a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}</a>
					<form id="logout-form" action="/logout" method="POST" style="display: none;"> @csrf </form>
				</div>
			</li>
		</nav>
	</header>
    <!-- customer -->
	@if(Auth::user()->isCustomer())
	<div class="row cm-app-row">
		<div class="col-12 cm-content">
			<div class="tab-content" id="nav-tabContent"> @yield('content') </div>
		</div>
	</div>
	@endif
    <!-- admin -->
	@if(Auth::user()->isAdmin())
    <div class="row cm-app-row">
		<div class="col-2 cs-ad-sidebar"> @include('layout.sideBar') </div>
		<div class="col-10 cs-ad-content">
			<div class="tab-content" id="nav-tabContent"> @yield('content') </div>
		</div>
	</div>
	@endif
	@if(Session::has('message'))
	<p class="alert cs-alert-msg {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
	@endif

	<footer class="footer">
		
	</footer>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> -->
	<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
	<script src="{{ url('js/products.js') }}"></script>
	<script src="{{ url('js/customers.js') }}"></script>
	<script src="{{ url('js/orders.js') }}"></script>
	<script type="text/javascript">
		$("document").ready(function(){
			setTimeout(function(){
			$(".alert").slideUp(500);
			}, 4000 ); 
		});
	</script>
</body>

</html>