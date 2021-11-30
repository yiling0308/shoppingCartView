<!DOCTYPE html>
<html lang="en">
<head>
  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meow Shop</title>

  <!-- FAVICON -->
  <link href="img/favicon.png" rel="shortcut icon">
  <!-- PLUGINS CSS STYLE -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap-slider.css">
  <!-- Font Awesome -->
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Owl Carousel -->
  <link href="plugins/slick-carousel/slick/slick.css" rel="stylesheet">
  <link href="plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet">
  <!-- Fancy Box -->
  <link href="plugins/fancybox/jquery.fancybox.pack.css" rel="stylesheet">
  <link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
  <!-- twzipcode -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <!-- CUSTOM CSS -->
  <link href="css/style.css" rel="stylesheet">


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="body-wrapper">
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg navbar-light navigation">
					<a class="navbar-brand" href="/">
						<img src="images/logo.png" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto mt-10">

							<li class="nav-item">
								@if (!@$username)
								<a class="nav-link login-button" href="/login">登入</a>
								@else
								<a class="nav-link login-button" href="/profile">{{ $username }}</a>
								@endif
							</li>
							<li class="nav-item dropdown dropdown-slide">
								<a class="nav-link dropdown-toggle text-white add-button" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									購物車
								</a>
								<span class="cart_quantity">{{ $cartCount }}</span>
								<!-- Dropdown list -->
								<div class="dropdown-menu" style="width: 230px;">
									<div>
										<a class="text-left">總共</a> <a class="total">{{ $total }} 元</a>
									</div>
									<hr>
									@foreach ($cartData as $cart)
									<form action="/delFromCart" method="POST">
										<div class="dropdown-item">
											<input type="hidden" name="pid" value="{{ $cart['pid'] }}"></input>
											<a class="product-name">{{ $cart['name'] }}</a>
											<a class="product-quantity">x {{ $cart['quantity'] }}</a>
											<a class="product-total">${{ $cart['price'] }}</a>
                    						<button type="submit" class="product-delete btn btn-xs btn-danger pull-right">x</button>
										</div>
									</form>
									@endforeach
									<hr>
									<a class="text-center" href="cart"> 查看購物車 </a>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>

<!--===============================
=            Hero Area            =
================================-->

<section class="hero-area bg-1 text-center overly">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Header Contetnt -->
				<div class="content-block">
					<h1>Meow Shop</h1>
					<p>歡迎來到喵舍<br></p>
					<p>
						@section('comment')
							test
						@show
					</p>
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>
@section('content')
	content
@show

@include('footer')