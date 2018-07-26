<!DOCTYPE html>
<html>
	<head>
		@include('fonts')
		@include('jquery')
		<link rel="stylesheet" type="text/css" href="/css/app.css" />
		<script type="text/javascript">
			setInterval(function()
			{
				var offset = $("#logo_img").offset().top;
				var height = $("#logo_img").height();

				var num = offset + height;
				num += 20;
				num = parseInt(num);
				num += '';
				$(".product_container").first().css("margin-top", num + 'px');
			}, 10);
		</script>
	</head>
	<body>
		@include('logo')
		@include('cart')
		<div class="product_container">
			<h2 class="cat_callout"> {{ $cat["name"] }} Products</h2>
			<hr />
			@foreach($prods as $prod)
				<div class="product">
					<img class="product_img" src="{{ $prod['img_link'] }}" />
					<p class="prod_name">{{ $prod["name"]}} </p>
					<p class="dolla">${{ $prod["price"] }}</p>
					<a href="{{route('product_detail', ['id' => $prod['identifier']])}}">
						<button class="buy_btn">Buy</button>
					</a>
				</div>
			@endforeach
		</div>
		</div>
		</div>
	</body>
</html>
