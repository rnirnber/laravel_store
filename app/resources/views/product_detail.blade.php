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
				$(".product_details_container").first().css("margin-top", num + 'px');
			}, 10);
			$(document).ready(function()
			{
				$("#add_to_cart").click(function()
				{
					$.get("{{ route('shopping_cart_add', ['id' => $prod['identifier']]) }}").done(function(r)
					{
						var img = $(".img_view").first();
						var new_img = $("<img />");
						new_img.attr("src", img.attr("src"));
						var offset = img.offset();
						var height = img.height();
						var width = img.width();
						var top = offset.top;
						var left = offset.left;

						new_img.css("height", (height + '') + 'px');
						new_img.css("width", (width + '') + 'px');
						new_img.css("position", "absolute");
						new_img.css("z-index", "100");
						new_img.css("top", (top + '') + 'px');
						new_img.css("left", (left + '') + 'px');
						new_img.css("opacity", "1.0");

						new_img.appendTo($("body"));

						var target_offset = $("#shopping_cart_img").offset();
						var new_width = $("#shopping_cart_img").width();
						var new_height = $("#shopping_cart_img").height();
						var target_top = target_offset.top;
						var target_left = target_offset.left;

						new_img.animate({"left": (target_left + '') + 'px', "top": (target_top + '') + 'px', "height": (new_height + '') + 'px', "width": (new_width + '') + 'px'}, 1000, function()
						{
							new_img.animate({"opacity": 0.0}, 250, function()
							{
								new_img.remove();
							});
						});
					});
				});
			});
		</script>
	</head>
	<body>
		@include('logo')
		@include('cart')
		<div class="product_details_container">
			<h1>{{ $prod["name"] }}</h1>
			<hr />
			<p class="prod_header"> {{ $prod["header"] }} </p>
			<hr />
			<img class="img_view" src="{{ $prod['img_link'] }}" />
			<p class="prod_description">
				{{ $prod["description"] }}
				<br />
				<br />
				<button id="add_to_cart">Add to Cart</button>
			</p>
		</div>
	</body>
</html>
