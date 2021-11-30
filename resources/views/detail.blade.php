@extends('header')

@section('comment')

@stop

@section('content')

<!--===================================
=            Store Section            =
====================================-->
<section class="section bg-gray">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<!-- Left sidebar -->
			<div class="col-md-8">
				<div class="product-details">
					<h1 class="product-title">{{ $product->name }}</h1>
					<!-- product slider -->
					<div class="product-slider">
						<div class="product-slider-item my-4" data-image="images/products/default.jpg">
							<img class="img-fluid w-100" src="images/products/default.jpg" alt="product-img">
						</div>
						<div class="product-slider-item my-4" data-image="images/products/default-2.jpg">
							<img class="d-block img-fluid w-100" src="images/products/default-2.jpg" alt="Second slide">
						</div>
						<div class="product-slider-item my-4" data-image="images/products/default-3.jpg">
							<img class="d-block img-fluid w-100" src="images/products/default-3.jpg" alt="Third slide">
						</div>
						<div class="product-slider-item my-4" data-image="images/products/default-4.jpg">
							<img class="d-block img-fluid w-100" src="images/products/default-4.jpg" alt="Third slide">
						</div>
						<div class="product-slider-item my-4" data-image="images/products/default-5.jpg">
							<img class="d-block img-fluid w-100" src="images/products/default-5.jpg" alt="Third slide">
						</div>
					</div>

					<!-- product slider -->
					<div class="content mt-5 pt-5">
						<ul class="nav nav-pills  justify-content-center" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
								 aria-selected="true">產品說明</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile"
								 aria-selected="false">詳細來源</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact"
								 aria-selected="false">會員回饋</a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<p>{{ $product->description }}</p>

								<iframe width="100%" height="400" src="https://www.youtube.com/embed/ONAV1leRRcE"
								 frameborder="0" allowfullscreen></iframe>
							</div>
							<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								<table class="table table-bordered product-table">
									<tbody>
										<tr>
											<td>金額</td>
											<td>${{ $product->price }}</td>
										</tr>
										<tr>
											<td>建立日期</td>
											<td>{{ $product->created_at }}</td>
										</tr>
										<tr>
											<td>品牌</td>
											<td>貓侍</td>
										</tr>
										<tr>
											<td>生產地區</td>
											<td>台北</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
								<div class="product-review">
									<div class="media">
										<!-- Avater -->
										<img src="images/user/default.jpeg" alt="avater">
										<div class="media-body">
											<!-- Ratings -->
											<div class="ratings">
												<ul class="list-inline">
													<li class="list-inline-item">
														<i class="fa fa-star"></i>
													</li>
													<li class="list-inline-item">
														<i class="fa fa-star"></i>
													</li>
													<li class="list-inline-item">
														<i class="fa fa-star"></i>
													</li>
													<li class="list-inline-item">
														<i class="fa fa-star"></i>
													</li>
													<li class="list-inline-item">
														<i class="fa fa-star"></i>
													</li>
												</ul>
											</div>
											<div class="name">
												<h5>Jessica Brown</h5>
											</div>
											<div class="date">
												<p>Mar 20, 2021</p>
											</div>
											<div class="review-comment">
												<p>
													這鮮食太香了, 開起來就香氣撲鼻, 我家養了三隻貓都衝過來搶著吃, 連我也想吃了.
												</p>
											</div>
										</div>
									</div>
									<div class="review-submission">
										<h3 class="tab-title">Submit your review</h3>
										<!-- Rate -->
										<div class="rate">
											<div class="starrr"></div>
										</div>
										<div class="review-submit">
											<form action="#" class="row">
												<div class="col-lg-6">
													<input type="text" name="name" id="name" class="form-control" placeholder="Name">
												</div>
												<div class="col-lg-6">
													<input type="email" name="email" id="email" class="form-control" placeholder="Email">
												</div>
												<div class="col-12">
													<textarea name="review" id="review" rows="10" class="form-control" placeholder="Message"></textarea>
												</div>
												<div class="col-12">
													<button type="submit" class="btn btn-main">Sumbit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<div class="widget price text-center">
						<h4>Price</h4>
						<p>${{ $product->price }}</p>
					</div>
					<div class="widget text-center">
						<form action="/addToCart" method="POST">
							<input type=hidden name="pid" value="{{ $product->id }}"></input>
							<input type=hidden name="name" value="{{ $product->name }}"></input>
							<input type=hidden name="price" value="{{ $product->price }}"></input>
							<div class="input-group">
								<select name="quantity" class="form-control">
								    <option value="1">1</option>
								    <option value="2">2</option>
								    <option value="3">4</option>
								    <option value="5">5</option>
								    <option value="6">6</option>
								    <option value="7">7</option>
								    <option value="8">8</option>
								    <option value="9">9</option>
								    <option value="10">10</option>
								</select>
							  <button class="btn btn-outline-secondary" type="submit">選購<i class="fa fa-shopping-cart"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- Container End -->
</section>

@stop