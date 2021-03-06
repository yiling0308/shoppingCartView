@extends('header')

@section('comment')

@stop

@section('content')

<section class="dashboard section">
	<!-- Container Start -->
	<div class="container">
		<!-- Row Start -->
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
                <div class="sidebar">
                    <!-- User Widget -->
                    <div class="widget user">
                        <!-- User Image -->
                        <div class="image d-flex justify-content-center">
                            <img src="images/user/{{ $user->image_name }}" alt="" class="">
                        </div>
                        <!-- User Name -->
                        <h5 class="text-center">{{ $user->username }}</h5>
                    </div>
                    <!-- Dashboard Links -->
                    <div class="widget dashboard-links">
                        <ul>
                            <li><a class="my-1 d-inline-block" href="order">我的訂單</a></li>
                        </ul>
                        <form action="/logout" method="POST" style="text-align: center">
                                <button type="submit" class="bg-info text-white border-0">登出</button>
                        </form>
                    </div>
                </div>
			</div>
			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Recently Favorited -->
				<div class="widget dashboard-container my-adslist">
					<h3>訂單編號: {{ $details['oid'] }}</h3>
                    <form action="/buy" method="POST">
                        <table class="table table-responsive product-dashboard-table">
                            <tbody>
                                <!-- {{ $i = 0 }} -->
                                @foreach($details['list'] as $detail)
                                <tr>
                                    <td class="product-thumb">
                                        <img width="80px" height="auto" src="images/products/default.jpg" alt="image description"></td>
                                    <td class="product-details">
                                        <h3 class="title">{{ $detail['name'] }}</h3>
                                        <span><strong>數量</strong><time>{{ $detail['quantity'] }}</time> </span>
                                        <span><strong>總額</strong><time>${{ $detail['quantity'] * $detail['price'] }}</time> </span>
                                    </td>
                                </tr>
                                <!-- {{ $i++ }} -->
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <a class="pull-right">總額 ${{ $details['total'] }}</a><br>
                    </form>
				</div>
			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</section>

@stop