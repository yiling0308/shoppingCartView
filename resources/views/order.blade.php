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
					<h3>我的訂單</h3>
					<table class="table table-responsive product-dashboard-table">
                        @foreach($orders as $order)
						<tbody>
							<tr>
								<td class="product-details">
									<h3 class="title">訂單編號: {{ $order['oid'] }}</h3>
									<span><strong>下單日期: </strong><time>{{ $order['create_at'] }}</time> </span>
									<span class="status active"><strong>狀態</strong>運送中</span>
								</td>
								<td class="product-category"><span class="categories"></span>${{ $order['total'] }}</td>
								<td class="action" data-title="Action">
									<div class="">
										<ul class="list-inline justify-content-center">
											<li class="list-inline-item">
												<a data-toggle="tooltip" data-placement="top" title="View" class="view" href="category.html">
													<i class="fa fa-eye"></i>
												</a>
											</li>
										</ul>
									</div>
								</td>
							</tr>
						</tbody>
                        @endforeach
					</table>
				</div>
				<!-- pagination -->
				<div class="pull-right">
                    {!! $orders->links() !!}
                </div>
				<!-- pagination -->

			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</section>

@stop