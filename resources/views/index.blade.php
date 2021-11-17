@extends('header')

@section('comment')
    所有喵喵需要的東西，這裡應有盡有。
@stop

@section('content')

<!--===========================================
=            Product section            =
============================================-->

<section class="popular-deals section bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>All Product</h2>
				</div>
				<div class="product-grid-list">
					<div class="row mt-30">
						@foreach ($products as $product)
						<div class="col-sm-12 col-lg-4 col-md-6">
							<!-- product card -->
							<div class="product-item bg-light">
								<div class="card">
									<div class="thumb-content">
										<div class="price">${{ $product->price }}</div>
										<a href="product-{{ $product->id }}">
											<img class="card-img-top img-fluid" style="height:150px" src="images/products/default.jpg" alt="product-{{ $product->id }}">
										</a>
									</div>
									<div class="card-body">
										<h4 class="card-title"><a href="product-{{ $product->id }}">{{ $product->name }}</a></h4>
										<p class="card-text">{{ $product->description }}</p>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
  		</div>
  	</div>
</section>

@stop