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
					<h3>購物車</h3>
                    <form action="/buy" method="POST">
                        <table class="table table-responsive product-dashboard-table">
                            <tbody>
                                <!-- {{ $i = 0 }} -->
                                @foreach($cartData as $cart)
                                <tr>
                                    <td class="product-thumb">
                                        <img width="80px" height="auto" src="images/products/default.jpg" alt="image description"></td>
                                    <td class="product-details">
                                        <h3 class="title">{{ $cart['name'] }}</h3>
                                        <input type="hidden" name="list[{{ $i }}][pid]" value="{{ $cart['pid'] }}">
                                        <input type="hidden" name="list[{{ $i }}][quantity]" value="{{ $cart['quantity'] }}">
                                        <span><strong>數量</strong><time>{{ $cart['quantity'] }}</time> </span>
                                        <span><strong>總額</strong><time>${{ $cart['price'] }}</time> </span>
                                        <span class="status active"><strong>庫存量</strong>Active</span>
                                    </td>
                                    <td class="action" data-title="Action">
                                        <div class="">
                                            <ul class="list-inline justify-content-center">
                                                <li class="list-inline-item">
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit" class="edit" href="product-{{ $cart['pid'] }}">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <form action="/delFromCart" method="POST">
                                                        <input type="hidden" name="pid" value="{{ $cart['pid'] }}"></input>
                                                        <button data-toggle="tooltip" data-placement="top" title="Delete" class="deleteProduct" type="submit">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <!-- {{ $i++ }} -->
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <a class="pull-right">總額 ${{ $total }}</a><br>
                        <hr>
                        <button type="submit" class="pull-right btn-info btn-block btn">結帳</button><br><br>
                        @foreach ($errors->all() as $error)
                            <p style="color:red">{{ $error }}</p>
                        @endforeach
                    </form>
				</div>
			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</section>

@stop